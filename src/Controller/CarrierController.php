<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

/**
 *
 */
#[Route('/carrier')]
class CarrierController extends AbstractController
{

    /**
     * @return Response
     * @throws \Exception
     */
    #[Route('/')]
    public function list(): Response
    {
        $number = random_int(0, 100);

        return $this->json([1,2,4]);
    }
}