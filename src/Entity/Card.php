<?php
namespace AllDigitalRewards\FIS\Entity;

class Card extends AbstractFisEntity
{
    /**
     * @var string
     */
    public $number;

    public $proxy;

    public $status;

    public $cvv2;

    public $balance;

    public $expiration_date;

    public $creation_date;

    /**
     * @return string
     */
    public function getNumber(): string
    {
        return $this->number;
    }

    /**
     * @param string $number
     */
    public function setNumber(string $number)
    {
        $this->number = $number;
    }

    public function getMaskedNumber(): string
    {
        return substr_replace(
            $this->getNumber(),
            'xxxxxxxxxxxx',
            0,
            12
        );
    }

    /**
     * @return mixed
     */
    public function getProxy()
    {
        return $this->proxy;
    }

    /**
     * @param mixed $proxy
     */
    public function setProxy($proxy)
    {
        $this->proxy = $proxy;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param mixed $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * @return mixed
     */
    public function getCvv2()
    {
        return $this->cvv2;
    }

    /**
     * @param mixed $cvv2
     */
    public function setCvv2($cvv2)
    {
        $this->cvv2 = $cvv2;
    }

    /**
     * @return mixed
     */
    public function getBalance()
    {
        return number_format($this->balance, 2, '.', '');
    }

    /**
     * @param mixed $balance
     */
    public function setBalance($balance)
    {
        $this->balance = $balance;
    }

    /**
     * @return mixed
     */
    public function getExpirationDate()
    {
        return $this->expiration_date;
    }

    /**
     * @param mixed $expiration_date
     */
    public function setExpirationDate($expiration_date)
    {
        $this->expiration_date = $expiration_date;
    }

    /**
     * @return mixed
     */
    public function getCreationDate()
    {
        return $this->creation_date;
    }

    /**
     * @param mixed $creation_date
     */
    public function setCreationDate($creation_date)
    {
        $this->creation_date = $creation_date;
    }

    public function getValidator()
    {

    }
}
