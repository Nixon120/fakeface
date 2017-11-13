<?php
namespace AllDigitalRewards\FIS\Entity;

use Respect\Validation\Validator;

class CardCreateRequest extends AbstractFisEntity
{
    public $ssn = 999999999;

    public $subProgId;

    public $pkgId;

    public $personId;

    /**
     * @return mixed
     */
    public function getSsn()
    {
        return $this->ssn;
    }

    /**
     * @param mixed $ssn
     */
    public function setSsn($ssn)
    {
        $this->ssn = $ssn;
    }

    /**
     * @return mixed
     */
    public function getSubProgId()
    {
        return $this->subProgId;
    }

    /**
     * @param mixed $subProgramId
     */
    public function setSubProgId($subProgramId)
    {
        $this->subProgId = $subProgramId;
    }

    /**
     * @return mixed
     */
    public function getPkgId()
    {
        return $this->pkgId;
    }

    /**
     * @param mixed $pkgId
     */
    public function setPkgId($pkgId)
    {
        $this->pkgId = $pkgId;
    }

    /**
     * @return mixed
     */
    public function getPersonId()
    {
        return $this->personId;
    }

    /**
     * @param mixed $personId
     */
    public function setPersonId($personId)
    {
        $this->personId = $personId;
    }

    public function getValidator()
    {
        return Validator::attribute('subProgId', Validator::numeric()->length(1, 10))
            ->attribute('pkgId', Validator::numeric()->length(1, 10))
            ->attribute('personId', Validator::numeric()->length(1, 10));
    }
}
