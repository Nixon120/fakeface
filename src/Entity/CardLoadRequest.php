<?php
namespace AllDigitalRewards\FIS\Entity;

use Respect\Validation\Validator;

class CardLoadRequest extends AbstractFisEntity
{
    public $cardnum;

    public $amount;

    /**
     * @return mixed
     */
    public function getCardnum()
    {
        return $this->cardnum;
    }

    /**
     * @param mixed $cardnum
     */
    public function setCardnum($cardnum)
    {
        $this->cardnum = $cardnum;
    }

    /**
     * @return mixed
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * @param mixed $amount
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;
    }

    public function getValidator()
    {
        return Validator::attribute('cardnum', Validator::numeric()->length(1, 16))
            ->attribute('amount', Validator::numeric()->length(1, 4));
//            ->attribute('subProgId', Validator::alnum()->length(1, 50))
//            ->attribute('pkgId', Validator::alnum()->length(1, 50))
//            ->attribute('personId', Validator::alnum()->length(1, 35));
//            ->attribute('last', Validator::alnum()->length(1, 25));
    }

}