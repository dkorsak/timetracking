<?php

namespace App\GeneralBundle\DataFixtures\ORM\Data;

use App\GeneralBundle\Entity\ProjectToTask;
use App\GeneralBundle\Entity\Project;
use App\GeneralBundle\DataFixtures\ORM\YamlFixtures;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;

class LoadProject extends YamlFixtures implements OrderedFixtureInterface, ContainerAwareInterface
{
    public function load(ObjectManager $manager)
    {
        $data = $this->getModelFixtures();
        foreach ($data as $reference => $item) {
            $object = new Project();
            $this->fromArray($object, $item);
            $object->setCompany($this->getReference($item['company_id']));
            $object->setStatus($this->getReference($item['status_id']));
            if (isset($item['user_list'])) {
                foreach ($item['user_list'] as $user) {
                    $object->addUser($this->getReference($user));
                }
            }
            if (isset($item['task_list'])) {
                foreach ($item['task_list'] as $taskReference => $task) {
                    $ptt = new ProjectToTask();
                    $ptt->setProject($object);
                    $ptt->setTask($this->getReference($task['task_id']));
                    $manager->persist($ptt);
                    $this->addReference($taskReference, $ptt);
                }
            }
            $manager->persist($object);
            $this->addReference($reference, $object);
        }
        $manager->flush();
    }

    public function getOrder()
    {
        return 150;
    }

    public function getModelFile()
    {
        return 'project';
    }
}
