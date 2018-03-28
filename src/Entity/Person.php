<?php
namespace AllDigitalRewards\FIS\Entity;

class Person extends AbstractFisEntity
{
    public $firstname;

    public $lastname;

    public $address1;

    public $address2;

    public $city;

    public $state;

    public $zip;

    public $countryCode;

    public $fis_id;

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
    public function getAddress1()
    {
        return $this->address1;
    }

    /**
     * @param mixed $addr1
     */
    public function setAddress1($addr1)
    {
        $this->address1 = $addr1;
    }

    /**
     * @return mixed
     */
    public function getAddress2()
    {
        return $this->address2;
    }

    /**
     * @param mixed $addr2
     */
    public function setAddress2($addr2)
    {
        $this->address2 = $addr2;
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
     * @param mixed $code
     */
    public function setCountryCode($code)
    {
        $this->countryCode = $code;
    }
    /**
     * @return mixed
     */
    public function getCountryCode()
    {
        return $this->countryCode;
    }

    /**
     * @param mixed $zip
     */
    public function setZip($zip)
    {
        $this->zip = $zip;
    }


    public function setFisId($fisId)
    {
        $this->fis_id = $fisId;
    }

    public function getFisId()
    {
        return $this->fis_id;
    }

    public function getValidator()
    {

    }
}
