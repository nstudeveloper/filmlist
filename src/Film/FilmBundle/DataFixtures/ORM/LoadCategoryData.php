<?php

namespace Film\FilmBundle\DataFixtures\ORM;


use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Film\FilmBundle\Entity\Category;

class LoadCategoryData extends AbstractFixture implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $category = new Category();
        $category->setName('Crime');
        $manager->persist($category);

        $category2 = new Category();
        $category2->setName('Drama');
        $manager->persist($category2);

        $category3 = new Category();
        $category3->setName('Action');
        $manager->persist($category3);

        $category4 = new Category();
        $category4->setName('Biography');
        $manager->persist($category4);

        $category5 = new Category();
        $category5->setName('History');
        $manager->persist($category5);

        $category6 = new Category();
        $category6->setName('Western');
        $manager->persist($category6);

        $category7 = new Category();
        $category7->setName('Sci-Fi');
        $manager->persist($category7);

        $category8 = new Category();
        $category8->setName('Adventure');
        $manager->persist($category8);

        $this->addReference('Crime', $category);
        $this->addReference('Drama', $category2);
        $this->addReference('Action', $category3);
        $this->addReference('Biography', $category4);
        $this->addReference('History', $category5);
        $this->addReference('Westrn', $category6);
        $this->addReference('Sci-Fi', $category7);
        $this->addReference('Adventure', $category8);

        $manager->flush();
    }

    public function getOrder()
    {
        return 2;
    }
}