<?php

namespace App\Controller;

use App\Exceptions\ValidationException;
use App\Repository\CarrierRepository;
use App\Services\Carrier\CarrierService;
use App\Services\Carrier\PolicyFactory;
use App\Validators\Carrier\CarrierCalcPriceValidator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
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
        CarrierService $service,
        PolicyFactory $policyFactory,
    ): Response
    {
        try {
            $request->validate();

            // Trying to get a carrier by ID
            $carrier = $carrierRepository->find($request->get('carrier_id') );
            if (!$carrier) {
                throw (new ValidationException())->addError('carrier_id', 'Undefined carrier.');
            }

            // Getting a policy by a carrier
            $policy = $policyFactory->create($carrier->getPolicy());

            // Calculating a price for the weight
            $price = $service->calculate($policy, $request->get('weight'));

            return $this->json(['success' => true, 'data' => ['price' => $price]]);
        }
        catch (ValidationException $e) {
            return $this->json(['success' => false, 'errors' => $e->getErrors()]);
        }
        catch (Exception $e) {
            return $this->json(['success' => false, 'errors' => $e->getMessage()]);
        }
    }

}