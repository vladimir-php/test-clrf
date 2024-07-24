<?php

namespace App\Controller;

use App\Exceptions\ValidationException;
use App\Repository\CarrierRepository;
use App\Services\Carrier\CarrierService;
use App\Validators\Carrier\CarrierCalcPriceValidator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Exception;

/**
 *
 */
#[Route('/api/v1/carrier')]
class CarrierController extends AbstractController
{

    /**
     * @param  CarrierService     $service
     * @param  CarrierRepository  $repository
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
    public function calculatePrice(
        CarrierCalcPriceValidator $request,
        CarrierRepository $carrierRepository,
        CarrierService $service
    ): Response
    {
        try {
            $request->validate();

            // Trying to get a carrier by ID
            $carrier = $carrierRepository->find($request->get('carrier_id') );
            if (!$carrier) {
                throw (new ValidationException())
                    ->addError('carrier_id', 'Undefined carrier.');
            }
        }
        catch (ValidationException $e) {
            return $this->json(['success' => false, 'errors' => $e->getErrors()]);
        }

        return $this->json([]);
    }

}