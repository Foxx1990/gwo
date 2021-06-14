<?php

namespace App\DataFixtures;

use App\Entity\Customers;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\DBAL\Schema\ForeignKeyConstraint;
use Doctrine\Persistence\ObjectManager;

class CustomersFixture extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for($i = 1; $i<= 10; $i++) {

        
         $customer = new Customers();
         $customer->setName('Adam');
         $customer->setSurname("Kowalski".$i);
         $customer->setNumber('55257654'.$i);
         $manager->persist($customer);
        }
        $manager->flush();
    }
}
