<?php

namespace App\FrontendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class TimesheetWeekController extends Controller
{
    public function indexAction()
    {
        return $this->render('AppFrontendBundle:TimesheetWeek:index.html.twig');
    }
}
