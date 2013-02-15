<?php

namespace App\FrontendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class TimesheetDayController extends Controller
{
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
        $currentDate = $this->get('app_general.services.timesheet')->getCurrentDate($year, $month, $year);

        $timesheetRepository = $this->getDoctrine()->getRepository('AppGeneralBundle:Timesheet');

        return $this->render(
            'AppFrontendBundle:TimesheetDay:index.html.twig',
            array(
                'currentDate' => $currentDate,
                'list' => $timesheetRepository->getDailyTimesheet($currentDate, $this->getUser()->getId())
            )
        );
    }
}
