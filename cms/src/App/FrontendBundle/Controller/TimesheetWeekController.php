<?php

namespace App\FrontendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class TimesheetWeekController extends Controller
{
    public function indexAction($year = "", $week = "")
    {
        if ($year == "" || $week = "") {
            
        }
        $currentDate = new \DateTime("now");
        return $this->render(
            'AppFrontendBundle:TimesheetWeek:index.html.twig',
            array(
                'currentDate' => $currentDate
            )
        );
    }
}
