<?php

namespace App\DataFixtures;

use App\Entity\Bar;
use App\Entity\Baz;
use App\Entity\Foo;
use App\Entity\Qux;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for ($index = 1; $index <= 10; $index++) {
            $manager->persist(
                (new Foo())
                    ->setName(sprintf("Foo %d", $index))
                    ->addBar((new Bar())->setName("Bar 1"))
                    ->addBar((new Bar())->setName("Bar 2"))
                    ->addBaz((new Baz())->setName("Baz 1"))
                    ->addBaz((new Baz())->setName("Baz 2"))
                    ->addQux((new Qux())->setName("Qux 1"))
                    ->addQux((new Qux())->setName("Qux 2"))
            );
        }
        $manager->flush();
    }
}
