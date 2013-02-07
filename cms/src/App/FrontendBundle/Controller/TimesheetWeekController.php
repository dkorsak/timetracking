<?php

namespace App\FrontendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class TimesheetWeekController extends Controller
{
    /**
     * Displaying landing page for timesheet week mode
     * 
     * @param string $year
     * @param string $month
     * @param string $day
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction($year = "", $month = "", $day = "")
    {
        $currentDate = $this->get('app_general.services.timesheet')->getCurrentDate($year, $month, $year);

        return $this->render(
            'AppFrontendBundle:TimesheetWeek:index.html.twig',
            array(
                'currentDate' => $currentDate,
                'list' => $this->getDoctrine()->getRepository('AppGeneralBundle:Timesheet')->getWeeklyTimesheet($currentDate, $this->getUser()->getId())
            )
        );
    }
}
