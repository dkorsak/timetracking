<?php

namespace App\GeneralBundle\DataFixtures\ORM\Defaults;

use App\GeneralBundle\Entity\ProjectStatus;
use App\GeneralBundle\DataFixtures\ORM\YamlFixtures;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;

class LoadProjectStatus extends YamlFixtures implements OrderedFixtureInterface, ContainerAwareInterface
{
    public function load(ObjectManager $manager)
    {
        $data = $this->getModelFixtures();
        foreach ($data as $reference => $item) {
            $object = new ProjectStatus();
            $this->fromArray($object, $item);
            $manager->persist($object);
            $this->addReference($reference, $object);
        }
        $manager->flush();
    }

    public function getOrder()
    {
        return 20;
    }

    public function getModelFile()
    {
        return 'project_status';
    }
}
