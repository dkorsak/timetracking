<?php

namespace App\FrontendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class HomepageController extends Controller
{
    public function indexAction()
    {
        if ($this->getUser()) {
            return $this->forward('AppFrontendBundle:TimesheetWeek:index');
        }

        return $this->render(
            'FOSUserBundle:Security:login.html.twig',
            array(
                'last_username' => "",
                'error'         => "",
                'csrf_token' => $this->container->get('form.csrf_provider')->generateCsrfToken('authenticate'),
            )
        );
    }
}
