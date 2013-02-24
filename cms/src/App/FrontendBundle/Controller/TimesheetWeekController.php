<?php

namespace App\FrontendBundle\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class TimesheetWeekController extends Controller implements PreExecuteControllerInterface
{
    /**
     * @var \App\FrontendBundle\Form\Handler\TimesheetWeek\AddTaskFormHandler;
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
        $this->addTakFormHandler = $this->get('app_frontend.form.handler.timesheet_week.add_task_form_handler');
        $this->timesheetService = $this->get('app_general.services.timesheet');
    }

    /**
     * Displaying landing page for timesheet week mode
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
            'AppFrontendBundle:TimesheetWeek:index.html.twig',
            array(
                'currentDate' => $currentDate,
                'list' => $this->timesheetService->getWeeklyTimesheet($currentDate, $this->getUser()->getId())
            )
        );
    }

    /**
     * Ajax action for displaying add task form
     *
     * @param  string                                     $year
     * @param  string                                     $week
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function newTaskAction($year, $week)
    {
        $template = 'AppFrontendBundle:TimesheetWeek:_add.task.form.html.twig';

        $this->addTakFormHandler->processNew($year, $week, $this->getUser()->getId());

        return $this->render($template, array('form' => $this->addTakFormHandler->createView()));
    }

    /**
     * Ajax action for save new task form
     *
     * @param  string                                     $year
     * @param  string                                     $week
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function createTaskAction($year, $week)
    {
        $template = 'AppFrontendBundle:TimesheetWeek:_add.task.form.html.twig';

        $result = $this->addTakFormHandler->processCreate($year, $week, $this->getUser()->getId());

        if ($result !== false) {
            $response = new Response();
            $response->headers->set('Content-Type', 'application/json');
            $response->setContent(json_encode($result));

            return $response;
        }

        return $this->render($template, array('form' => $this->addTakFormHandler->createView()));
    }

    public function saveAction()
    {

    }

    public function removeTaskAction($id)
    {
        return new Response('todo');
    }
}
