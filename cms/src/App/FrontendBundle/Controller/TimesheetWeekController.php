<?php

namespace App\FrontendBundle\Controller;

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
}
