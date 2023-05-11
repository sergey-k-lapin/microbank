<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\PersonRepository;


#[ORM\Entity(repositoryClass: PersonRepository::class)]
class Person
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;
    #[ORM\Column(length: 255)]
    private ?string $given_name = null;
    #[ORM\Column(length: 255, nullable: true)]
    private ?string $family_name = null;
    #[ORM\Column(length: 255, nullable: true)]
    private ?string $additional_name = null;
    #[ORM\OneToMany(mappedBy: 'person', targetEntity: DepositAccount::class)]
    #[ORM\JoinColumn(name: "person_id", referencedColumnName: "id")]
    private Collection $accounts;
    public function __construct()
    {
        $this->accounts = new ArrayCollection();
    }
    public function getId() : ?int
    {
        return $this->id;
    }
    public function getGivenName() : ?string
    {
        return $this->given_name;
    }
    public function setGivenName(string $given_name) : self
    {
        $this->given_name = $given_name;
        return $this;
    }
    public function getFamilyName() : ?string
    {
        return $this->family_name;
    }
    public function setFamilyName(?string $family_name) : self
    {
        $this->family_name = $family_name;
        return $this;
    }
    public function getAdditionalName() : ?string
    {
        return $this->additional_name;
    }
    public function setAdditionalName(?string $additional_name) : self
    {
        $this->additional_name = $additional_name;
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
            $account->setPersonId($this);
        }
        return $this;
    }
    public function removeAccount(Account $account) : self
    {
        if ($this->accounts->removeElement($account)) {
            // set the owning side to null (unless already changed)
            if ($account->getPersonId() === $this) {
                $account->setPersonId(null);
            }
        }
        return $this;
    }
}
