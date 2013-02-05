<?php

namespace App\FrontendBundle\Controller;

use Carbon\Carbon;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class TimesheetDayController extends Controller
{
    public function indexAction($year = "", $month = "", $day = "")
    {
        try {
            $currentDate = Carbon::create($year, $month, $day);
        } catch (\InvalidArgumentException $e) {
            $currentDate = Carbon::now();
        }
        return $this->render(
            'AppFrontendBundle:TimesheetDay:index.html.twig',
            array(
                'currentDate' => $currentDate
            )
        );
    }
}
