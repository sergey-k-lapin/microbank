<?php
namespace App\Normalizer\Api;


use App\Entity\Account;
use App\Normalizer\AbstractNormalizer;
use JMS\Serializer\Context;
use JMS\Serializer\JsonSerializationVisitor;


class ListOfAccountsByPersonNormalizer extends AbstractNormalizer {
    protected static function getSerializationType(): ?string
    {
        return Account::class;
    }

    public function serialize(
        JsonSerializationVisitor $visitor,
        Account $account,
        array $type,
        Context $context
    ): array {
        return $visitor->visitArray([
            'id' => $account->getId(),
            'identifier' => $account->getIdentifier(),
            'amount' => $account->getAmount(),
        ], $type);
    }

}