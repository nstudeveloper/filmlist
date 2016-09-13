<?php

namespace Film\FilmBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Film\FilmBundle\Entity\Actor;

class LoadActorData extends AbstractFixture implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $actor1 = new Actor();
        $actor1->setFirstName('Tim');
        $actor1->setLastName('Robbins');
        $manager->persist($actor1);

        $actor2 = new Actor();
        $actor2->setFirstName('Marlon');
        $actor2->setLastName('Brando');
        $manager->persist($actor2);

        $actor3 = new Actor();
        $actor3->setFirstName('Al');
        $actor3->setLastName('Pacino');
        $manager->persist($actor3);

        $actor4 = new Actor();
        $actor4->setFirstName('James');
        $actor4->setLastName('Caan');
        $manager->persist($actor4);

        $this->addReference('Actor1', $actor1);
        $this->addReference('Actor2', $actor2);
        $this->addReference('Actor3', $actor3);
        $this->addReference('Actor4', $actor4);

        $manager->flush();
    }

    public function getOrder()
    {
        return 1;
    }
}