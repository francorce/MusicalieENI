<?php

namespace App\DataFixtures;


use App\Entity\Departement;
use App\Entity\Artiste;
use App\Entity\Festival;
use App\Entity\Instrument;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker;


class AppFixtures extends Fixture
{


    public function __construct()
    {

    }

    public function load(ObjectManager $manager): void
    {
        //Les Départements Nouvelle Aquitaine
            $departement = new Departement();
            $departement->setNom('Charente');
            $departement->setNumero(16);
            $manager->persist($departement);

            $departement = new Departement();
            $departement->setNom('Charente-Maritime');
            $departement->setNumero(17);
            $manager->persist($departement);

            $departement = new Departement();
            $departement->setNom('Deux-Sèvres');
            $departement->setNumero(79);
            $manager->persist($departement);


            $artiste = new Artiste();
            $artiste->setNomScene("Tame Impala");
            $artiste->setStyle("Musique Indé");
            $manager->persist($artiste);

        $artiste = new Artiste();
        $artiste->setNomScene("Eminem");
        $artiste->setStyle("Rap");
        $manager->persist($artiste);

        $artiste = new Artiste();
        $artiste->setNomScene("Three Days Grace");
        $artiste->setStyle("Rock");
        $manager->persist($artiste);

        $artiste = new Artiste();
        $artiste->setNomScene("Skrillex");
        $artiste->setStyle("Dubstep");
        $manager->persist($artiste);

        $artiste = new Artiste();
        $artiste->setNomScene("Mystery skulls");
        $artiste->setStyle("Pop");
        $manager->persist($artiste);


        $manager->flush();
    }
}
