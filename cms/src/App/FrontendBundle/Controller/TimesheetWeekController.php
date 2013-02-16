<?php

namespace App\FrontendBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class TimesheetWeekController extends Controller
{
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
        $service = $this->get('app_general.services.timesheet');
        $currentDate = $service->getCurrentDate($year, $month, $day);

        return $this->render(
            'AppFrontendBundle:TimesheetWeek:index.html.twig',
            array(
                'currentDate' => $currentDate,
                'list' => $service->getWeeklyTimesheet($currentDate, $this->getUser()->getId())
            )
        );
    }

    /**
     * Ajax action for displaying add task form
     *
     * @param  string                                     $year
     * @param  string                                     $month
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function newTaskAction($year, $month)
    {
        $template = 'AppFrontendBundle:TimesheetWeek:_add.task.form.html.twig';

        $form = $this->get('app_frontend.form.factory.timesheet_week.add_task_form');
        $formHandler = $this->get('app_frontend.form.handler.timesheet_week.add_task_form_handler');

        return $this->render($template, array('form' => $form->createView()));
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

        $data = array();
        $data['status'] = 'ok';

        return new Response(json_encode($data));
        return $this->render($template, array('form' => 'TODO'));
    }
}
