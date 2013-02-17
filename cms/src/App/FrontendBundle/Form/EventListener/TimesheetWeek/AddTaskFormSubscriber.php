<?php

namespace App\FrontendBundle\Form\EventListener\TimesheetWeek;

use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Form\Event\DataEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class AddTaskFormSubscriber implements EventSubscriberInterface
{
    /**
     * @var ObjectManager
     */
    private $em;

    /**
     * Constructor
     *
     * @param ObjectManager $em
     */
    public function __construct(ObjectManager $em)
    {
        $this->em = $em;
    }

    /**
     * {@inheritdoc}
     */
    public static function getSubscribedEvents()
    {
        return array(FormEvents::POST_BIND => 'postBind');
    }

    /**
     * @param DataEvent $event
     */
    public function postBind(DataEvent $event)
    {
        $data = $event->getData();

        $project = $data->getTask()->getProject();
        $task = $data->getTask()->getTask();

        if ($task && $project) {
            $repository = $this->em->getRepository('AppGeneralBundle:ProjectToTask');
            $projectToTask = $repository->findOneBy(array("project" => $project->getId(), "task" => $task->getId()));
            if ($projectToTask) {
                $data->setTask($projectToTask);
            }
        }
    }
}
