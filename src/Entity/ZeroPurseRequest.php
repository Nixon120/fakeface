<?php

namespace AllDigitalRewards\FIS\Entity;

use AllDigitalRewards\FIS\Exception\FisException;
use Respect\Validation\Validator;

class ZeroPurseRequest extends AbstractFisEntity
{
    const STATUS_CLOSE = "close";
    const STATUS_VOID = "void";

    protected $proxyKey;
    protected $status;

    /**
     * @return mixed
     */
    public function getProxyKey()
    {
        return $this->proxyKey;
    }

    /**
     * @param mixed $proxyKey
     */
    public function setProxyKey($proxyKey)
    {
        $this->proxyKey = $proxyKey;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        if (is_null($this->status)) {
            return self::STATUS_CLOSE;
        }

        return $this->status;
    }

    public function setStatus(string $status)
    {
        if (!in_array($status, [self::STATUS_CLOSE, self::STATUS_VOID])) {
            throw new FisException(
                'Invalid Status. Must be either ' .
                self::STATUS_CLOSE .
                ' or ' .
                self::STATUS_VOID
            );
        }

        $this->status = $status;
    }

    public function getValidator()
    {
        return Validator::attribute(
            'proxyKey',
            Validator::stringType()->length(13)
        );
    }
}
