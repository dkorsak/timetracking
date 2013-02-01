<?php

namespace App\GeneralBundle\DataFixtures\ORM\Data;

use App\GeneralBundle\Entity\Timesheet;
use App\GeneralBundle\DataFixtures\ORM\YamlFixtures;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;

class LoadTimesheet extends YamlFixtures implements OrderedFixtureInterface, ContainerAwareInterface
{
    public function load(ObjectManager $manager)
    {
        $data = $this->getModelFixtures();
        foreach ($data as $reference => $item) {
            //$object = new Timesheet();
            //$this->fromArray($object, $item);
            //$manager->persist($object);
            //$this->addReference($reference, $object);
        }
        $manager->flush();
    }

    public function getOrder()
    {
        return 200;
    }

    public function getModelFile()
    {
        return 'timesheet';
    }
}