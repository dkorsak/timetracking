<?php

namespace App\FrontendBundle\Form\Handler\TimesheetWeek;

use App\GeneralBundle\Entity\Timesheet;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Form\FormInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Request;

class AddTaskFormHandler
{
    /**
     * @var FormFactoryInterface
     */
    private $factory;

    /**
     * @var Request
     */
    private $request;

    /**
     * @var ObjectManager
     */
    private $em;

    /**
     * @var FormInterface
     */
    private $form;

    /**
     * Constructor
     *
     * @param FormInterface $form
     * @param Request       $request
     * @param ObjectManager $em
     */
    public function __construct(FormFactoryInterface $factory, Request $request, ObjectManager $em)
    {
        $this->factory = $factory;
        $this->request = $request;
        $this->em = $em;
    }

    /**
     * @param string  $year
     * @param string  $week
     * @param integer $userId
     */
    public function processNew($year, $week, $userId)
    {
        $this->createForm($year, $week, $userId);
    }

    /**
     * @param  string  $year
     * @param  string  $week
     * @param  integer $userId
     * @return mixed
     */
    public function processCreate($year, $week, $userId)
    {
        $this->createForm($year, $week, $userId);

        $this->form->bind($this->request);
        if ($this->form->isValid()) {
            $data = $this->form->getData();

            $user = $this->em->getRepository('AppGeneralBundle:User')->find($userId);

            $task = $this->em
                ->getRepository('AppGeneralBundle:ProjectToTask')
                ->findOneBy(array("project" => $data["project"], "task" => $data["task"]));

            if ($task && $user) {
                $timesheet = new Timesheet();
                $timesheet->setTask($task);
                $timesheet->setWeek($week);
                $timesheet->setYear($year);
                $timesheet->setUser($user);

                $this->em->persist($timesheet);
                $this->em->flush();

                return $this->convartToArray($timesheet);
            }

        }

        return false;
    }

    /**
     * @return \Symfony\Component\Form\FormView
     */
    public function createView()
    {
        return $this->form->createView();
    }

    /**
     * @param string  $year
     * @param string  $week
     * @param integer $userId
     */
    private function createForm($year, $week, $userId)
    {
        $type = 'app_frontend_form_type_timesheet_week_add_task_form_type';
        $options = array('year' => $year, 'week' => $week, 'user_id' => $userId, 'translation_domain' => 'timesheet');

        $this->form = $this->factory->createNamed('task', $type, null, $options);
    }

    /**
     * @param  Timesheet $timesheet
     * @return array
     */
    private function convartToArray(Timesheet $timesheet)
    {
        return array(
            'company_name' => $timesheet->getTask()->getProject()->getCompany()->getName(),
            'project_name' => $timesheet->getTask()->getProject()->getName(),
            'task_name' => $timesheet->getTask()->getTask()->getName(),
            'id' => $timesheet->getId()
        );
    }
}
