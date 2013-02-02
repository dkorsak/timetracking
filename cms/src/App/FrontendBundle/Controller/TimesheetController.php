<?php

namespace App\FrontendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class TimesheetController extends Controller
{
    public function indexAction()
    {
        return $this->render('AppFrontendBundle:Timesheet:index.html.twig');
    }
}
