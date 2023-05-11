<?php

namespace App\Helper\Entity;

use Symfony\Component\PropertyAccess\PropertyAccess;

trait TraitPropertyAccess
{
    public function setFromArray(array $propertyList): void
    {
        $accessor = PropertyAccess::createPropertyAccessor();

        foreach ($propertyList as $property => $value) {
            if ($accessor->isWritable($this, $property)) {
                $accessor->setValue($this, $property, $value);
            }
        }
    }

    public function toArray(bool $nullValues = true, bool $emptyArrayValues = true): array
    {
        $result = [];

        foreach (get_object_vars($this) as $propertyName => $propertyValue) {
            if (!$nullValues && is_null($propertyValue)) {
                continue;
            }

            if (!$emptyArrayValues && is_array($propertyValue) && !$propertyValue) {
                continue;
            }

            $result[$propertyName] = $propertyValue;
        }

        return $result;
    }
}