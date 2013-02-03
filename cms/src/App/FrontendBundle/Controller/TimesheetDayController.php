<?php

namespace App\FrontendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class TimesheetDayController extends Controller
{
    public function indexAction()
    {
        return $this->render('AppFrontendBundle:TimesheetDay:index.html.twig');
    }
}
