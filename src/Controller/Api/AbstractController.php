<?php

namespace App\Controller\Api;

use App\Dto\Controller\Api\BaseResponseDto;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use Symfony\Component\HttpFoundation\Response;

abstract class AbstractController extends AbstractFOSRestController
{
    protected function successResponse(): Response
    {
        $view = $this->view((new BaseResponseDto()), Response::HTTP_OK);

        return $this->handleView($view);
    }
}