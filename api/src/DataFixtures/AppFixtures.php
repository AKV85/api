<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Factory\RoomFactory;
use App\Factory\UserFactory;


class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);
        RoomFactory::createMany(40);
        UserFactory::createMany(10, function () {
            return [
                'room' => RoomFactory::random(),
            ];
        });

        // $manager->flush();
    }
}
