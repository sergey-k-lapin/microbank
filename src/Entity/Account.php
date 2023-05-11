<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\AccountRepository;
use App\Entity\DepositAccount;
//use Doctrine\ORM\Mapping\MappedSuperclass;

#[ORM\MappedSuperclass]
#[ORM\Entity(repositoryClass: AccountRepository::class)]
#[ORM\InheritanceType('JOINED')]
#[ORM\DiscriminatorColumn(name: 'discr', type: 'string')]
#[ORM\DiscriminatorMap(['account' => Account::class, 'depositaccount' => DepositAccount::class])]
class Account
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;
    #[ORM\ManyToOne(inversedBy: 'accounts')]
    #[ORM\JoinColumn(nullable: false, name: "bank_id")]
    private ?Bank $bank = null;
    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false, name: "amount_id")]
    private ?MonetaryAmount $amount = null;
    #[ORM\ManyToOne(inversedBy: 'accounts')]
    #[ORM\JoinColumn(nullable: false, name: "person_id")]
    private ?Person $person = null;
    #[ORM\Column(length: 255)]
    private ?string $identifier = null;
    public function getId() : ?int
    {
        return $this->id;
    }
    public function getBank() : ?Bank
    {
        return $this->bank;
    }
    public function setBank(?Bank $bank) : self
    {
        $this->bank = $bank;
        return $this;
    }
    public function getAmount() : ?MonetaryAmount
    {
        return $this->amount;
    }
    public function setAmount(MonetaryAmount $amount) : self
    {
        $this->amount = $amount;
        return $this;
    }
    public function getPerson() : ?Person
    {
        return $this->person;
    }
    public function setPerson(?Person $person) : self
    {
        $this->person = $person;
        return $this;
    }
    public function getIdentifier() : ?string
    {
        return $this->identifier;
    }
    public function setIdentifier(string $identifier) : self
    {
        $this->identifier = $identifier;
        return $this;
    }
}
