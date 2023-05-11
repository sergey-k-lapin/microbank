<?php
namespace App\Dto\Controller\Api\Account\Response;

use App\Dto\Controller\Api\BaseResponseDto;
use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;

class GetListOfAccountsByPersonDto extends BaseResponseDto {

    /**
     * @SerializedName("ListOfAccounts")
     * @Type("array<App\Entity\Account>")
     *
     * @var ListOfAccounts[]
     */
    protected array $ListOfAccounts = [];

    /**
     * @return ListOfAccounts[]
     */
    public function getListOfAccounts(): array
    {
        return $this->ListOfAccounts;
    }

    public function setListOfAccounts(array $ListOfAccounts): void
    {
        $this->ListOfAccounts = $ListOfAccounts;
    }

}