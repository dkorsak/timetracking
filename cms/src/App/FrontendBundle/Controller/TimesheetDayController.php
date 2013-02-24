<?php

namespace App\FrontendBundle\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class TimesheetDayController extends Controller implements PreExecuteControllerInterface
{
    /**
     * @var App\FrontendBundle\Form\Handler\TimesheetDay\AddTaskFormHandler
     */
    private $addTakFormHandler;

    /**
     * @var \App\GeneralBundle\Services\Timesheet
     */
    private $timesheetService;

    /**
     * {@inheritdoc}
     */
    public function preExecute()
    {
        $this->addTakFormHandler = $this->get('app_frontend.form.handler.timesheet_day.add_task_form_handler');
        $this->timesheetService = $this->get('app_general.services.timesheet');
    }

    /**
     * Displaying landing page for timesheet day mode
     *
     * @param  string                                     $year
     * @param  string                                     $month
     * @param  string                                     $day
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction($year = "", $month = "", $day = "")
    {
        $currentDate = $this->timesheetService->getCurrentDate($year, $month, $day);

        return $this->render(
            'AppFrontendBundle:TimesheetDay:index.html.twig',
            array(
                'currentDate' => $currentDate,
                'list' => $this->timesheetService->getDailyTimesheet($currentDate, $this->getUser()->getId())
            )
        );
    }

    /**
     * Ajax action for displaying add task form
     *
     * @param  string                                     $year
     * @param  string                                     $week
     * @param  string                                     $weekDay
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function newTaskAction($year, $week, $weekDay)
    {
        $template = 'AppFrontendBundle:TimesheetDay:_add.task.form.html.twig';

        $this->addTakFormHandler->processNew($year, $week, $weekDay, $this->getUser()->getId());

        return $this->render($template, array('form' => $this->addTakFormHandler->createView()));
    }

    /**
     * Ajax action for save new task form
     *
     * @param  string                                     $year
     * @param  string                                     $week
     * @param  string                                     $weekDay
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function createTaskAction($year, $week, $weekDay)
    {
        $template = 'AppFrontendBundle:TimesheetDay:_add.task.form.html.twig';

        $result = $this->addTakFormHandler->processCreate($year, $week, $weekDay, $this->getUser()->getId());

        if ($result !== false) {
            $response = new Response();
            $response->headers->set('Content-Type', 'application/json');
            $response->setContent(json_encode($result));

            return $response;
        }

        return $this->render($template, array('form' => $this->addTakFormHandler->createView()));
    }

    public function editTaskAction($id)
    {

    }

    public function updateTaskAction($id)
    {

    }

    public function removeTaskAction($id)
    {

    }
}
