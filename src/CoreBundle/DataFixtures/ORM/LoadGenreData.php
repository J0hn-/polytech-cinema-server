<?php
namespace CoreBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use CoreBundle\Entity\Genre;

class LoadGenreData implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $list = array(
            'Comedie', 'Drame', 'Romance', 'Action', 'Histoire', 'Péplum', 'Cape et épée', 'Western', 'Aventure',
            'Thriller', 'Fantastique', 'Science-fiction', 'Horreur', 'Catastrophe', 'Érotique', 'Pornographique'
        );

        foreach ($list as $item) {
            $genre = new Genre();
            $genre->setTitle($item);
            $manager->persist($genre);
        }

        $manager->flush();
    }

    public function getOrder()
    {
        // the order in which fixtures will be loaded
        // the lower the number, the sooner that this fixture is loaded
        return 1;
    }
}