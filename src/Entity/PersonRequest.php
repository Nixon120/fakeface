<?php
namespace AllDigitalRewards\FIS\Entity;

use AllDigitalRewards\FIS\Interfaces\Validateable;
use Respect\Validation\Validator;

class PersonRequest extends AbstractFisEntity implements Validateable
{
    public $firstname;

    public $lastname;

    public $addr1;

    public $addr2;

    public $city;

    public $state;

    public $zip;

    public $ssn = '999999999';

    public $countrycode;

    /**
     * @return mixed
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * @param mixed $firstname
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;
    }

    /**
     * @return mixed
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * @param mixed $lastname
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;
    }

    /**
     * @return mixed
     */
    public function getAddr1()
    {
        return $this->addr1;
    }

    /**
     * @param mixed $addr1
     */
    public function setAddr1($addr1)
    {
        $this->addr1 = $addr1;
    }

    /**
     * @return mixed
     */
    public function getAddr2()
    {
        return $this->addr2;
    }

    /**
     * @param mixed $addr2
     */
    public function setAddr2($addr2)
    {
        $this->addr2 = $addr2;
    }

    /**
     * @return mixed
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @param mixed $city
     */
    public function setCity($city)
    {
        $this->city = $city;
    }

    /**
     * @return mixed
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * @param mixed $state
     */
    public function setState($state)
    {
        $this->state = $state;
    }

    /**
     * @return mixed
     */
    public function getZip()
    {
        return $this->zip;
    }

    /**
     * @param mixed $zip
     */
    public function setZip($zip)
    {
        $this->zip = $zip;
    }

    /**
     * @return string
     */
    public function getSsn()
    {
        return $this->ssn;
    }

    /**
     * @param string $ssn
     */
    public function setSsn($ssn)
    {
        $this->ssn = $ssn;
    }

    /**
     * @return mixed
     */
    public function getCountrycode()
    {
        return $this->countrycode;
    }

    /**
     * @param mixed $countrycode
     */
    public function setCountrycode($countrycode)
    {
        $this->countrycode = $countrycode;
    }

    public function getValidator()
    {
        return Validator::attribute('firstname', Validator::stringType()->length(1, 50))
            ->attribute('lastname', Validator::stringType()->length(1, 50))
            ->attribute('addr1', Validator::stringType()->length(1, 50))
            ->attribute('addr2', Validator::optional(Validator::stringType()->length(1, 50)))
            ->attribute('city', Validator::stringType()->length(1, 35))
            ->attribute('state', Validator::stringType()->length(1, 25))
            ->attribute('zip', Validator::stringType()->length(1, 30))
            ->attribute('countrycode', Validator::numeric()->length(1, 3));
    }
}
