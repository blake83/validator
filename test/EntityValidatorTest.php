<?php declare(strict_types=1);

namespace ComquerTest\Validation;

use Comquer\Validator\ArrayValidator\ArrayMissingRequiredKeysException;
use Comquer\Validator\ArrayValidator\ArrayValidator;
use Comquer\Validator\EntityValidator\EntityValidator;
use Comquer\Validator\EntityValidator\EntityValidatorException;
use PHPUnit\Framework\TestCase;

class EntityValidatorTest extends TestCase
{
    /** @test */
    public function throws_exception_for_single_keys_missing()
    {
        $serializedEntity = [
            'this key' => 'exists',
            'this key also' => 'exists',
        ];

        $expectedException = EntityValidatorException::missingRequiredKeysInSerializedEntity('SomeEntity', ['but not this one']);
        $this->expectException(get_class($expectedException));
        $this->expectExceptionMessage($expectedException->getMessage());

        EntityValidator::validateSerialized('SomeEntity', ['this key', 'this key also', 'but not this one'], $serializedEntity);
    }
}