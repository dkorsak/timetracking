<?php

namespace App\FrontendBundle\Controller;

use App\GeneralBundle\Entity\Timesheet;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class TimesheetWeekController extends Controller implements PreExecuteControllerInterface
{
    /**
     * @var AddTaskFormType
     */
    private $addTaskForm;

    /**
     * @var AddTaskFormHandler
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
        $this->addTaskForm = $this->get('app_frontend.form.factory.timesheet_week.add_task_form');
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

        $this->addTakFormHandler->processNew($year, $week);

        return $this->render($template, array('form' => $this->addTaskForm->createView()));
    }

    /**
     * Ajax action for saving new user task
     *
     * @param  Request                                    $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function createTaskAction(Request $request)
    {
        $template = 'AppFrontendBundle:TimesheetWeek:_add.task.form.html.twig';

        $timesheet = new Timesheet();
        $timesheet->setUser($this->getUser());

        if ($this->addTakFormHandler->processCreate($timesheet)) {
            $data = array();
            $data['status'] = 'ok';

            $response = new Response();
            $response->headers->set('Content-Type', 'application/json');
            $response->setContent(json_encode($data));

            return $response;
        }

        //print_R($this->addTaskForm->getErrorsAsString());
        return $this->render($template, array('form' => $this->addTaskForm->createView()));
    }

    public function saveAction()
    {

    }

    public function removeAction($id)
    {

    }
}
