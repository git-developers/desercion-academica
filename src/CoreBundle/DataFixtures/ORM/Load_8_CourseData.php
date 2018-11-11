<?php

namespace CoreBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use CoreBundle\Entity\Course;

class Load_8_CourseData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {

        $entity = new Course();
        $entity->setName('Matematica');
        $manager->persist($entity);

        $entity = new Course();
        $entity->setName('Lenguaje');
        $manager->persist($entity);

        $entity = new Course();
        $entity->setName('Geometria');
        $manager->persist($entity);


        $manager->flush();

    }

    public function getOrder()
    {
        // the order in which fixtures will be loaded
        // the lower the number, the sooner that this fixture is loaded
        return 8;
    }
}