<?php
namespace AllDigitalRewards\FIS;

use AllDigitalRewards\FIS\Entity\Card;
use AllDigitalRewards\FIS\Entity\CardCreateRequest;
use AllDigitalRewards\FIS\Entity\CardLoadRequest;
use AllDigitalRewards\FIS\Entity\Person;
use AllDigitalRewards\FIS\Entity\PersonRequest;
use AllDigitalRewards\FIS\Exception\FisException;
use AllDigitalRewards\FIS\Interfaces\Validateable;
use PHPUnit\Framework\TestCase;

class EntityTest extends TestCase
{
    /**
     * All of our entities should implement the Validateable interface.
     */
    public function testIsValidatable()
    {
        $cardCreateRequest = new CardCreateRequest;
        $cardLoadRequest = new CardLoadRequest;
        $personRequest = new PersonRequest;

        $this->assertInstanceOf(Validateable::class, $cardCreateRequest);
        $this->assertInstanceOf(Validateable::class, $cardLoadRequest);
        $this->assertInstanceOf(Validateable::class, $personRequest);
    }

    public function testIsNotValidatable()
    {
        $person = new Person;
        $person->isValid();
        $this->expectException(FisException::class);
    }

    /**
     * All entities must implement the JsonSerializable interface.
     */
    public function testIsJsonSerializeazble()
    {
        $cardCreateRequest = new CardCreateRequest;
        $cardLoadRequest = new CardLoadRequest;
        $personRequest = new PersonRequest;
        $card = new Card;
        $person = new Person;

        $this->assertInstanceOf(\JsonSerializable::class, $cardCreateRequest);
        $this->assertInstanceOf(\JsonSerializable::class, $cardLoadRequest);
        $this->assertInstanceOf(\JsonSerializable::class, $personRequest);
        $this->assertInstanceOf(\JsonSerializable::class, $card);
        $this->assertInstanceOf(\JsonSerializable::class, $person);
        $this->assertTrue(is_string(json_encode($person)));
    }

    public function testConstructToArray()
    {
        $cardCreateRequest = [
            'ssn' => '999999999',
            'subProgId' => 123,
            'pkgId' => 321,
            'personId' => 123456789
        ];

        $cardCreateRequestEntity= new CardCreateRequest($cardCreateRequest);

        $this->assertSame($cardCreateRequest, $cardCreateRequestEntity->toArray());
    }

    public function testCanValidate()
    {
        $cardCreateRequest = new CardCreateRequest([
            'ssn' => '999999999',
            'subProgId' => 123,
            'pkgId' => 321,
            'personId' => 123456789
        ]);

        $this->assertTrue($cardCreateRequest->isValid());
    }


    public function testGetEmptyValidationErrorArrayWhenValid()
    {
        $cardCreateRequest = new CardCreateRequest([
            'ssn' => '999999999',
            'subProgId' => 123,
            'pkgId' => 321,
            'personId' => 123456789
        ]);

        $this->assertTrue(empty($cardCreateRequest->getValidationErrors()));
    }

    public function testCanInvalidate()
    {
        $cardCreateRequest = new CardCreateRequest([
            'ssn' => '999999999',
            'subProgId' => 123,
            'personId' => 123456789
        ]);

        $this->assertFalse($cardCreateRequest->isValid());
    }

    public function testCanGetArrayOfValidationErrors()
    {
        //missing pkgid, personid
        $cardCreateRequest = new CardCreateRequest([
            'ssn' => '999999999',
            'subProgId' => 123,
        ]);

        $errors = $cardCreateRequest->getValidationErrors();

        $this->assertTrue(is_array($errors));
        $this->assertTrue((count($errors) > 0));
    }
}