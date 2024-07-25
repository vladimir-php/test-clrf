<?php

namespace App\Tests\Carrier;

use App\Repository\CarrierRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;


/**
 *
 * @todo change implementation to the base httpclient usage for the REST API (probably web client is redundant here)
 * $client = HttpClient::createForBaseUri('.../');
 * $result = $client->request('GET', '...')->toArray();
 */
class CarrierControllerTest extends WebTestCase
{

    /**
     * @return void
     */
    public function testList(): void
    {
        $client = static::createClient();
        $content = $this->request($client, 'GET', '/api/v1/carrier/');

        self::assertResponseIsSuccessful();
        self::assertTrue($content['success']);
        self::assertIsArray($content['data']['carriers']);

        $repository = static::getContainer()->get(CarrierRepository::class);
        self::assertEquals($repository->getIdNameList(), $content['data']['carriers']);
    }


    /**
     * @return void
     */
    public function testCalculatePrice()
    {
        $client = static::createClient();

        // Error value for a carrier name
        $content = $this->requestCarrierCalcPrice($client, 'ErrorValue', 1);
        self::assertFalse($content['success']);
        self::assertIsArray($content['errors']);

        // Error value for a weight
        $content = $this->requestCarrierCalcPrice($client, 'TransCompany', -1);
        self::assertFalse($content['success']);
        self::assertIsArray($content['errors']);

        // --- Checking TransCompany calculation logic
        $content = $this->requestCarrierCalcPrice($client, 'TransCompany', 9);
        self::assertTrue($content['success']);
        self::assertEquals(20, $content['data']['price']);

        $content = $this->requestCarrierCalcPrice($client, 'TransCompany', 11);
        self::assertTrue($content['success']);
        self::assertEquals(100, $content['data']['price']);
        // --

        // --- Checking PackGroup calculation logic
        $content = $this->requestCarrierCalcPrice($client, 'PackGroup', 9);
        self::assertTrue($content['success']);
        self::assertEquals(9, $content['data']['price']);

        $content = $this->requestCarrierCalcPrice($client, 'PackGroup', 11);
        self::assertTrue($content['success']);
        self::assertEquals(11, $content['data']['price']);
        // --

    }

    /**
     * @param  KernelBrowser  $client
     * @param  string         $method
     * @param  string         $uri
     * @param  array          $parameters
     *
     * @return array
     */
    protected function request(KernelBrowser $client, string $method, string $uri, array $parameters = []): array
    {
        $client->jsonRequest($method, $uri, $parameters);
        return json_decode($client->getResponse()->getContent(), true);
    }

    /**
     * @param  KernelBrowser  $client
     * @param  string         $carrierName
     * @param  int|float      $weight
     *
     * @return array
     */
    protected function requestCarrierCalcPrice(KernelBrowser $client, string $carrierName, int|float $weight): array
    {
        static $carrierByName = null;
        if ($carrierByName === null) {
            $repository = static::getContainer()->get(CarrierRepository::class);
            $carriers = $repository->getIdNameList();

            $carrierByName = [];
            foreach($carriers as $carrier) {
                $carrierByName[$carrier['name']] = $carrier['id'];
            }
        }

        return $this->request($client, 'POST', '/api/v1/carrier/calculate-price', [
            'carrier_id' => array_key_exists($carrierName, $carrierByName) ? $carrierByName[$carrierName] : null,
            'weight' => $weight,
        ]);
    }
}