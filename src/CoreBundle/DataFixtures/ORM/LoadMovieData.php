<?php

namespace CoreBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use CoreBundle\Entity\Movie;

class LoadMovieData implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $movie = new Movie();
        $movie->setTitle('Rogue One: A Star Wars Story');
        $movie->setDuration(133);
        $movie->setReleaseDate(new \DateTime('2016-12-14'));
        $movie->setDirector($manager->getRepository('CoreBundle:Director')->findOneByLastName('Edwards'));
        $movie->setGenre($manager->getRepository('CoreBundle:Genre')->findOneByTitle('Science-fiction'));
        $manager->persist($movie);

        $movie = new Movie();
        $movie->setTitle('Arrival');
        $movie->setDuration(127);
        $movie->setReleaseDate(new \DateTime('2016-12-07'));
        $movie->setDirector($manager->getRepository('CoreBundle:Director')->findOneByLastName('Villeneuve'));
        $movie->setGenre($manager->getRepository('CoreBundle:Genre')->findOneByTitle('Science-fiction'));
        $manager->persist($movie);

        $manager->flush();
    }

    public function getOrder()
    {
        // the order in which fixtures will be loaded
        // the lower the number, the sooner that this fixture is loaded
        return 3;
    }
}