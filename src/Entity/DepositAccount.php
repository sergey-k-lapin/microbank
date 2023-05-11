<?php


namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\AccountRepository;

#[ORM\Entity]
#[ORM\Table(name:"deposit_account")]

class DepositAccount extends Account {
    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: '0', nullable: true)]
    private ?string $baseRate = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: '0', nullable: true)]
    private ?string $period = null;

    /**
     * @return string|null
     */
    public function getBaseRate()
    {
        return $this->baseRate;
    }

    /**
     * @param string|null $baseRate
     */
    public function setBaseRate($baseRate)
    {
        $this->baseRate = $baseRate;
    }

    /**
     * @return string|null
     */
    public function getPeriod()
    {
        return $this->period;
    }

    /**
     * @param string|null $period
     */
    public function setPeriod($period)
    {
        $this->period = $period;
    }


}