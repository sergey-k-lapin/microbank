<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\BankRepository;

#[ORM\Entity(repositoryClass: BankRepository::class)]
class Bank
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;
    #[ORM\Column(length: 255, nullable: true)]
    private ?string $legalName = null;
    #[ORM\Column(length: 255, nullable: true)]
    private ?string $address = null;


    #[ORM\OneToMany(mappedBy: 'bank', targetEntity: Account::class)]
    /**
     * @var Collection
     */
    private Collection $accounts;

    public function __construct()
    {
        $this->accounts = new ArrayCollection();
    }
    public function getId() : ?int
    {
        return $this->id;
    }
    public function getLegalName() : ?string
    {
        return $this->legalName;
    }
    public function setLegalName(?string $legalName) : self
    {
        $this->legalName = $legalName;
        return $this;
    }
    public function getAddress() : ?string
    {
        return $this->address;
    }
    public function setAddress(?string $address) : self
    {
        $this->address = $address;
        return $this;
    }
    /**
     * @return Collection<int, Account>
     */
    public function getAccounts() : Collection
    {
        return $this->accounts;
    }
    public function addAccount(Account $account) : self
    {
        if (!$this->accounts->contains($account)) {
            $this->accounts->add($account);
            $account->setBankId($this);
        }
        return $this;
    }
    public function removeAccount(Account $account) : self
    {
        if ($this->accounts->removeElement($account)) {
            // set the owning side to null (unless already changed)
            if ($account->getBankId() === $this) {
                $account->setBankId(null);
            }
        }
        return $this;
    }
}
