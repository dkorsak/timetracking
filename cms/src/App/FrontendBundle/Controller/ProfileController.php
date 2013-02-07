<?php

namespace App\FrontendBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ProfileController extends Controller
{
    public function editAction(Request $request)
    {
        return $this->render(
            'AppFrontendBundle:Profile:edit.html.twig', 
            array(
                
            )
        );
    }

    public function updateAction(Request $request)
    {
        return $this->render(
            'AppFrontendBundle:Profile:edit.html.twig', 
            array(
                
            )
        );
    }
}
