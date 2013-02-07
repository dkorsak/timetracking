<?php

namespace App\GeneralBundle\DataFixtures\ORM\Data;

use App\GeneralBundle\Entity\TimesheetItem;

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
            $object = new Timesheet();
            $object->setUser($this->getReference($item['user_id']));
            $object->setTask($this->getReference($item['task_id']));
            if ($item['year'] == 'current') {
                $item['year'] = date('Y');
            }
            if ($item['week'] == 'current') {
                $item['week'] = date('W');
            }
            $this->fromArray($object, $item);
            if (isset($item['timesheet_items'])) {
                foreach ($item['timesheet_items'] as $tItem) {
                    $timesheetItems = new TimesheetItem();
                    $this->fromArray($timesheetItems, $tItem);
                    $object->addTimesheetItem($timesheetItems);
                }
            }
            $manager->persist($object);
            $this->addReference($reference, $object);
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