<?php
namespace AllDigitalRewards\FIS;

use AllDigitalRewards\FIS\Entity\Card;
use AllDigitalRewards\FIS\Entity\CardCreateRequest;
use AllDigitalRewards\FIS\Entity\CardLoadRequest;
use AllDigitalRewards\FIS\Entity\PersonRequest;
use AllDigitalRewards\FIS\Entity\Person;
use AllDigitalRewards\FIS\Exception\FisException;

class Client
{
    private $certificate;

    private $password;

    private $development = true;

    private $requestParameters;

    private $httpClient;

    /**
     * @var int
     */
    private $clientId;

    /**
     * @var string
     */
    private $responseString;

    /**
     * @var array
     */
    private $response;

    /**
     * constructor
     */
    public function __construct(\GuzzleHttp\Client $httpClient, array $parameters, $development = true)
    {
        $this->httpClient = $httpClient;
        $this->requestParameters = [
            'userid' => $parameters['userId'],
            'pwd' => $parameters['password'],
            'sourceid' => $parameters['sourceId']
        ];
        $this->certificate = $parameters['fisCertificate'];
        $this->password = $parameters['fisCertificatePassword'];
        $this->development = $development;
    }

    /**
     * @param int $clientId
     * @return Client
     */
    public function setClientId(int $clientId): Client
    {
        $this->clientId = $clientId;
        return $this;
    }

    public function getClientId():int
    {
        return $this->clientId;
    }

    public function setDevelopment(bool $development): Client
    {
        $this->development = $development;
        return $this;
    }

    public function isDevelopmentMode():bool
    {
        return $this->development === true;
    }

    /**
     * @param string $proxyKey
     * @return Card|bool
     */
    public function getCardByProxy(string $proxyKey)
    {
        $proxy = [
            'ProxyKey' => $proxyKey
        ];

        if ($this->dispatchRequest("a2a/CO_GetPurseAcct_ByCardnum.asp", $proxy) === false) {
            return false;
        }

        $vendorResponse = $this->getResponse();

        $card = new Card;
        $card->setProxy($proxyKey);
        $card->setNumber($vendorResponse[9]);
        $card->setCvv2($vendorResponse[26]);
        $card->setBalance($vendorResponse[4]);
        $card->setStatus($vendorResponse[14]);
        $card->setCreationDate($vendorResponse[28]);
        $card->setExpirationDate($vendorResponse[11]);
        return $card;
    }

    /**
     * @param int $fisPersonId
     * @return Person|bool
     */
    public function getPersonById(int $fisPersonId)
    {
        $proxy = [
            'PersonID' => $fisPersonId
        ];

        if ($this->dispatchRequest("a2a/CO_GetPersonInfo.asp", $proxy) === false) {
            return false;
        }

        $vendorResponse = $this->getResponse();

        $person = new Person;
        $person->setFisId($vendorResponse[0]);
        $person->setFirstname($vendorResponse[7]);
        $person->setLastname($vendorResponse[9]);
        $person->setAddress1($vendorResponse[12]);
        $person->setAddress2($vendorResponse[13]);
        $person->setCity($vendorResponse[14]);
        $person->setState($vendorResponse[15]);
        $person->setZip($vendorResponse[16]);
        $person->setCountryCode($vendorResponse[18]);
        return $person;
    }

    /**
     * @param PersonRequest $request
     * @return Person|bool
     * @throws FisException
     */
    public function createPerson(PersonRequest $request)
    {
        if ($this->dispatchRequest("a2a/CO_CREATEPERSON.asp", $request->toArray()) === false) {
            throw new FisException('Unable to create vendor card account');
        }

        return $this->getPersonById($this->getResponse()[0]);
    }

    /**
     * @param CardCreateRequest $request
     * @return Card|bool
     * @throws FisException
     */
    public function createCard(CardCreateRequest $request)
    {
        if ($this->dispatchRequest("a2a/CO_AssignCard2ExistingPerson.asp", $request->toArray()) === false) {
            throw new FisException('Unable to create vendor card');
        }

        $vendorResponse = $this->getResponse();
        return $this->getCardByProxy($vendorResponse[4]);
    }

    /**
     * @param CardLoadRequest $card
     * @return $this
     * @throws FisException
     */
    public function loadCard(CardLoadRequest $card): Client
    {
        if ($this->dispatchRequest("a2a/CO_LoadValue.asp", $card->toArray()) === false) {
            throw new FisException('Unable to load panelist card');
        }

        return $this;
    }

    /**
     * @param Card $request
     * @return $this
     * @throws FisException
     */
    public function activateCard(Card $request): Client
    {
        $activation = [
            "cardnum" => $request->getNumber(),
            "Status" => "ACTIVATE"
        ];

        if ($this->dispatchRequest("a2a/CO_StatusAcct.asp", $activation) === false) {
            throw new FisException('Unable to activate panelist card');
        }

        return $this;
    }

    /**
     * @param $action
     * @return string
     */
    public function getUrl(string $action): string
    {
        $this->requestParameters['clientid'] = $this->getClientId();
        $url = $this->development === true ? 'https://a2a.uatfisprepaid.com' : 'https://a2a.fisprepaid.com';
        $url = $url . '/' . $action . '?' . http_build_query($this->requestParameters);
        return $url;
    }

    /**
     * This second parameter should always be a "SomethingRequest" -- maybe an interface for that?
     *
     * @param $action
     * @param array $request
     * @return bool
     * @throws \Exception
     */
    private function dispatchRequest($action, array $request): bool
    {
        $url = $this->getUrl($action);
        $response = $this->httpClient->request(
            'POST',
            $url,
            [
                'cert' => [
                    $this->certificate,
                    $this->password
                ],
                'form_params' => $request
            ]
        );

        if ($response->getStatusCode() !== 200) {
            throw new FisException('Cannot connect to FIS for payload delivery.');
        }

        $this->setResponseString((string)$response->getBody());
        if ($this->isRequestAccepted()) {
            //@TODO pipe traversal would be nice here
            $this->setResponse(
                $this->formatResponse(
                    $this->getResponseString()
                )
            );
            return true;
        }

        return false;
    }

    private function setResponse(array $response)
    {
        $this->response = $response;
    }

    private function getResponse(): array
    {
        return $this->response;
    }

    private function formatResponse(string $responseString): array
    {
        $response = substr($responseString, 2);
        $response = substr($response, 0, -1);
        return explode("|", $response);
    }

    private function isRequestAccepted(): bool
    {
        return ((int) mb_substr($this->responseString, 0, 1)) === 1;
    }

    private function setResponseString(string $response)
    {
        $this->responseString = $response;
    }

    private function getResponseString():string
    {
        return $this->responseString;
    }
}
