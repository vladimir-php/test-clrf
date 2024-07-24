<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Carrier;

/**
 * php bin/console doctrine:fixtures:load
 */
class CarrierFixtures extends Fixture
{
    /**
     * @var array|array[]
     */
    protected array $data = [
        ['name' => 'TransCompany', 'policy' => 'TransCompanyPolicy'],
        ['name' => 'PackGroup', 'policy' => 'PackGroupPolicy']
    ];

    /**
     * @param  ObjectManager  $manager
     *
     * @return void
     */
    public function load(ObjectManager $manager)
    {
        foreach($this->data as $item) {
            $carrier = new Carrier();
            $carrier->setName($item['name']);
            $carrier->setPolicy($item['policy']);

            $manager->persist($carrier);
        }
        $manager->flush();
    }
}