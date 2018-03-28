<?php

namespace AllDigitalRewards\FIS\Entity;

class ZeroPurseResponse
{
    private $status;
    private $amtUnloaded;

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
    public function getAmtUnloaded()
    {
        return $this->amtUnloaded;
    }

    /**
     * @param mixed $amtUnloaded
     */
    public function setAmtUnloaded($amtUnloaded)
    {
        $this->amtUnloaded = $amtUnloaded;
    }
}
