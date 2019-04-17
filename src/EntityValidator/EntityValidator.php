<?php declare(strict_types=1);

namespace Comquer\Serialization\Validation;

use Comquer\Validator\ArrayValidator\ArrayMissingRequiredKeysException;
use Comquer\Validator\ArrayValidator\ArrayValidator;

class EntityValidator
{
    public static function validateSerialized(string $entityName, array $requiredKeys, array $serializedEntity): void
    {
        try {
            ArrayValidator::validateMultipleKeysExist($requiredKeys, $serializedEntity);
        } catch (ArrayMissingRequiredKeysException $exception) {
            throw EntityValidatorException::missingRequiredKeysInSerializedEntity($entityName, $exception->getMissingKeys());
        }
    }
}
