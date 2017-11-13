<?php
namespace AllDigitalRewards\FIS\Entity;

use AllDigitalRewards\FIS\Interfaces\FisEntityInterface;
use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Validator;

abstract class AbstractFisEntity implements FisEntityInterface
{
    public function __construct(?array $data = null)
    {
        if (!is_null($data)) {
            $this->hydrate($data);
        }
    }

    public function isValid(): bool
    {
        try {
            $this->getValidator()->assert((object) $this->toArray());
            return true;
        } catch (NestedValidationException $exception) {
            return false;
        }
    }

    public function getValidationErrors(): array
    {
        try {
            $this->getValidator()->assert((object) $this->toArray());
            return [];
        } catch (NestedValidationException $exception) {
            return $exception->getMessages();
        }
    }

    /**
     * @return Validator
     * @throws \Exception if called and stubbed method not replaced
     */
    public function getValidator()
    {
        throw new \Exception('Entity does not have validation rules');
    }

    public function toArray():array
    {
        $data = call_user_func('get_object_vars', $this);

        foreach ($data as $key => $value) {
            if ($value instanceof \DateTime) {
                $data[$key] = $value->format('Y-m-d H:i:s');
            }
        }

        return $data;
    }

    public function hydrate(iterable $options)
    {
        $methods = get_class_methods($this);
        foreach ($options as $key => $value) {
            $method = $this->getSetterMethod($key);
            if (in_array($method, $methods)) {
                $this->$method($value);
            }
        }
        return $this;
    }

    private function getSetterMethod($propertyName)
    {
        return "set" . str_replace(' ', '', ucwords(str_replace('_', ' ', $propertyName)));
    }
}
