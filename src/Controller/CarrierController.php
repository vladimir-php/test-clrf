<?php

namespace App\Controller;

use App\Repository\CarrierRepository;
use App\Services\Carrier\CarrierService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

/**
 *
 */
#[Route('/api/v1/carrier')]
class CarrierController extends AbstractController
{

    /**
     * @param  CarrierService  $service
     *
     * @return Response
     */
    #[Route('/', methods: 'GET')]
    public function list(CarrierService $service, CarrierRepository $repository): Response
    {
        return $this->json(['success' => true, 'list' => $repository->getIdNameList()]);
    }


    /**
     * @param  CarrierService  $service
     *
     * @return Response
     */
    #[Route('/calculate-price', methods: 'POST')]
    public function calculatePrice(Request $request, CarrierService $service): Response
    {
        dd($request->get('test'));
        try {
            $policy = $service->createPolicy();
        }
        catch (\Exception $e) {

        }

        return $this->json($service->getNames());
    }

}