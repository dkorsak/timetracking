<?php

namespace App\FrontendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class TimesheetDayController extends Controller implements PreExecuteControllerInterface
{
    /**
     * @var \App\GeneralBundle\Services\Timesheet
     */
    private $timesheetService;

    /**
     * {@inheritdoc}
     */
    public function preExecute()
    {
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
}
