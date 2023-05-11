<?php
namespace App\Controller\Api;

use App\Dto\Controller\Api\Account\Response\GetListOfAccountsByPersonDto;
use App\Controller\Api\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use OpenApi\Annotations as OA;
use Nelmio\ApiDocBundle\Annotation\Model;
use App\Entity\Person;

/**
 * @Route("/accounts")
 */
class AccountController extends AbstractController
{
    /**
    * @Route("/{personId}", methods={"GET"})
    * @ParamConverter("person", options={"mapping": {"personId": "id"}})
    *
    * @OA\Tag(name="Accounts")
    * @OA\Response(
    *     response=200,
    *     description="Deposit accounts list",
    *     @OA\JsonContent(
    *        type="object",
    *        ref=@Model(type=GetListOfAccountsByPersonDto::class),
    *     )
    * )
    * @param Person $person
    * @return Response
    */
    public function viewAccountsAction(Person $person) {
        $response = new GetListOfAccountsByPersonDto();
        $response->setListOfAccounts($person->getAccounts()->toArray());
        $view = $this->view($response, Response::HTTP_OK);
        return $this->handleView($view);
    }

}