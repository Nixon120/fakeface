<?php
namespace AllDigitalRewards\FIS\Entity;

class Transaction extends AbstractFisEntity
{
    public $transactionDate;

    public $postDate;

    public $merchant;

    public $reference;

    public $amount;

    public $type;

    /**
     * @return mixed
     */
    public function getTransactionDate()
    {
        return $this->transactionDate;
    }

    /**
     * @param mixed $transactionDate
     */
    public function setTransactionDate($transactionDate)
    {
        $this->transactionDate = $transactionDate;
    }

    /**
     * @return mixed
     */
    public function getPostDate()
    {
        return $this->postDate;
    }

    /**
     * @param mixed $postDate
     */
    public function setPostDate($postDate)
    {
        $this->postDate = $postDate;
    }

    /**
     * @return mixed
     */
    public function getMerchant()
    {
        return $this->merchant;
    }

    /**
     * @param mixed $merchant
     */
    public function setMerchant($merchant)
    {
        $this->merchant = $merchant;
    }

    /**
     * @return mixed
     */
    public function getReference()
    {
        return $this->reference;
    }

    /**
     * @param mixed $reference
     */
    public function setReference($reference)
    {
        $this->reference = $reference;
    }

    /**
     * @return mixed
     */
    public function getAmount()
    {
        return number_format(str_replace('-', '', $this->amount), 2, '.', '');
    }

    /**
     * @param mixed $amount
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;
    }

    public function isDebit()
    {
        return strpos($this->amount, '-') !== false;
    }

    public function getDisplayAmount()
    {
        if ($this->isDebit()) {
            return '-' . $this->getAmount();
        }

        return '+' . $this->getAmount();
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param mixed $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    public function isInitialValueLoad()
    {
        return $this->type === 'ValueLoad';
    }

    public function isCredit()
    {
        return $this->type === 'Adjustment' || $this->type === 'Deposit';
    }
}
