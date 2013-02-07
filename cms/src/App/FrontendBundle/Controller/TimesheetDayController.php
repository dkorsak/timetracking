<?php

namespace App\FrontendBundle\Controller;

use Carbon\Carbon;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class TimesheetDayController extends Controller
{
    /**
     * Displaying landing page for timesheet day mode
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
            'AppFrontendBundle:TimesheetDay:index.html.twig',
            array(
                'currentDate' => $currentDate,
                'list' => $this->getDoctrine()->getRepository('AppGeneralBundle:Timesheet')->getDailyTimesheet($currentDate, $this->getUser()->getId())
            )
        );
    }
}
