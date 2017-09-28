<?php

namespace CoreBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use CoreBundle\Entity\Exam;

class Load_9_ExamData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {

        $entity = new Exam();
        $entity->setName('Examen 01');
        $entity->setDescription('Matematica Examen 01');
        $manager->persist($entity);

        $entity = new Exam();
        $entity->setName('Examen 02');
        $entity->setDescription('Matematica Examen 02');
        $manager->persist($entity);

        $entity = new Exam();
        $entity->setName('Examen 03');
        $entity->setDescription('Matematica Examen 03');
        $manager->persist($entity);


        $manager->flush();

    }

    public function getOrder()
    {
        // the order in which fixtures will be loaded
        // the lower the number, the sooner that this fixture is loaded
        return 9;
    }
}