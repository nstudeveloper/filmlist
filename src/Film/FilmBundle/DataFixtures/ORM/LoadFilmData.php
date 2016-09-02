<?php

namespace Film\FilmBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Film\FilmBundle\Entity\Film;

class LoadFilmData extends AbstractFixture implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $film = new Film();
        $film->setTitle('12 Angry Men');
        $film->setDescription('A jury holdout attempts to prevent a miscarriage of justice by forcing his colleagues to reconsider the evidence. ');
        $film->addCategory($this->getReference('Crime'));
        $film->addActor($this->getReference('Actor1'));
        $film->addActor($this->getReference('Actor2'));
        $film->addActor($this->getReference('Actor3'));
        $film->addActor($this->getReference('Actor4'));
        $manager->persist($film);


        $film = new Film();
        $film->setTitle('Inception');
        $film->setDescription('A thief, who steals corporate secrets through use of dream-sharing technology, is given the inverse task of planting an idea into the mind of a CEO. ');
        $film->addCategory($this->getReference('Drama'));
        $film->addCategory($this->getReference('Adventure'));
        $film->addCategory($this->getReference('Action'));
        $film->addActor($this->getReference('Actor1'));
        $film->addActor($this->getReference('Actor2'));
        $film->addActor($this->getReference('Actor4'));

        $manager->persist($film);

        $film = new Film();
        $film->setTitle('The Shawshank Redemption');
        $film->setDescription('Two imprisoned men bond over a number of years, finding solace and eventual redemption through acts of common decency.');

        $film->addCategory($this->getReference('Drama'));
        $film->addCategory($this->getReference('Adventure'));
        $film->addCategory($this->getReference('Action'));
        $film->addActor($this->getReference('Actor1'));
        $film->addActor($this->getReference('Actor2'));
        $film->addActor($this->getReference('Actor4'));

        $manager->persist($film);

        $film = new Film();
        $film->setTitle('The Godfather');
        $film->setDescription('The aging patriarch of an organized crime dynasty transfers control of his clandestine empire to his reluctant son.');

        $film->addCategory($this->getReference('Drama'));
        $film->addCategory($this->getReference('Adventure'));
        $film->addCategory($this->getReference('Action'));
        $film->addActor($this->getReference('Actor1'));
        $film->addActor($this->getReference('Actor2'));
        $film->addActor($this->getReference('Actor4'));

        $manager->persist($film);

        $film = new Film();
        $film->setTitle('The Dark Knight');
        $film->setDescription('When the menace known as the Joker wreaks havoc and chaos on the people of Gotham,
         the caped crusader must come to terms with one of the greatest psychological tests of his ability to fight injustice.');

        $film->addCategory($this->getReference('Drama'));
        $film->addCategory($this->getReference('Adventure'));
        $film->addCategory($this->getReference('Action'));
        $film->addActor($this->getReference('Actor1'));
        $film->addActor($this->getReference('Actor2'));
        $film->addActor($this->getReference('Actor4'));

        $manager->persist($film);

        $film = new Film();
        $film->setTitle('Pulp Fiction');
        $film->setDescription('The lives of two mob hit men, a boxer, a gangster\'s wife, and a pair of diner bandits intertwine in four tales of violence and redemption.');

        $film->addCategory($this->getReference('Drama'));
        $film->addCategory($this->getReference('Adventure'));
        $film->addCategory($this->getReference('Action'));
        $film->addActor($this->getReference('Actor1'));
        $film->addActor($this->getReference('Actor2'));
        $film->addActor($this->getReference('Actor4'));

        $manager->persist($film);

        $film = new Film();
        $film->setTitle('The Good, the Bad and the Ugly');
        $film->setDescription('A bounty hunting scam joins two men in an uneasy alliance against a third in a race to find a fortune in gold buried in a remote cemetery.');

        $film->addCategory($this->getReference('Drama'));
        $film->addCategory($this->getReference('Adventure'));
        $film->addCategory($this->getReference('Action'));
        $film->addActor($this->getReference('Actor1'));
        $film->addActor($this->getReference('Actor2'));
        $film->addActor($this->getReference('Actor4'));

        $manager->persist($film);

        $film = new Film();
        $film->setTitle('Fight Club');
        $film->setDescription('An insomniac office worker, looking for a way to change his life,
         crosses paths with a devil-may-care soap maker, forming an underground fight club that evolves into something much, much more.');

        $film->addCategory($this->getReference('Drama'));
        $film->addCategory($this->getReference('Adventure'));
        $film->addCategory($this->getReference('Action'));
        $film->addActor($this->getReference('Actor1'));
        $film->addActor($this->getReference('Actor2'));
        $film->addActor($this->getReference('Actor4'));

        $manager->persist($film);

        $film = new Film();
        $film->setTitle('Forrest Gump');
        $film->setDescription('Forrest Gump, while not intelligent, has accidentally been present at many historic moments, but his true love, Jenny Curran, eludes him.');

        $film->addCategory($this->getReference('Drama'));
        $film->addCategory($this->getReference('Adventure'));
        $film->addCategory($this->getReference('Action'));
        $film->addActor($this->getReference('Actor1'));
        $film->addActor($this->getReference('Actor2'));
        $film->addActor($this->getReference('Actor4'));

        $manager->persist($film);

        $film = new Film();
        $film->setTitle('The Matrix');
        $film->setDescription('A computer hacker learns from mysterious rebels about the true nature of his reality and his role in the war against its controllers.');

        $film->addCategory($this->getReference('Drama'));
        $film->addCategory($this->getReference('Adventure'));
        $film->addCategory($this->getReference('Action'));
        $film->addActor($this->getReference('Actor1'));
        $film->addActor($this->getReference('Actor2'));
        $film->addActor($this->getReference('Actor4'));

        $manager->persist($film);

        $manager->flush();
    }

    public function getOrder()
    {
        return 3;
    }
}