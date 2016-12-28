<?php
namespace CoreBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use CoreBundle\Entity\Director;

class LoadDirectorData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $director = new Director();
        $director->setFirstName('Gareth');
        $director->setLastName('Edwards');
        $manager->persist($director);

        $director = new Director();
        $director->setFirstName('Denis');
        $director->setLastName('Villeneuve');
        $manager->persist($director);

        $manager->flush();
    }

    public function getOrder()
    {
        // the order in which fixtures will be loaded
        // the lower the number, the sooner that this fixture is loaded
        return 2;
    }
}