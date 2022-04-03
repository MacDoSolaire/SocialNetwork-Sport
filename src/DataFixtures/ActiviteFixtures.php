<?php

namespace App\DataFixtures;

use App\Factory\ActiviteFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ActiviteFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $data = json_decode(file_get_contents("data/activite.json", true), true);
        foreach ($data as $elmt) {
            ActiviteFactory::new()->create(['nom' => $elmt['name']]);
        }
    }
}
