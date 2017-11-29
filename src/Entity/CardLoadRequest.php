<?php
namespace AllDigitalRewards\FIS\Entity;

use AllDigitalRewards\FIS\Interfaces\Validateable;
use Respect\Validation\Validator;

class CardLoadRequest extends AbstractFisEntity implements Validateable
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
            ->attribute('amount', Validator::numeric()->length(0, 4));
    }
}
