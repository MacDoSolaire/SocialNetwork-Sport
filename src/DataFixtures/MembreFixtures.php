<?php

namespace App\DataFixtures;

use App\Factory\MembreFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class MembreFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        MembreFactory::new()->create(['mail' => 'theoG@projetS4.com']);
        MembreFactory::new()->create(['mail' => 'hugo@projetS4.com']);
        MembreFactory::new()->create(['mail' => 'bastien@projetS4.com']);
        MembreFactory::new()->create(['mail' => 'theoN@projetS4.com']);
        MembreFactory::new()->create(['mail' => 'vincent@projetS4.com']);
        MembreFactory::new()->create(['mail' => 'didier@projetS4.com']);
    }
}
