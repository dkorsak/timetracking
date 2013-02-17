<?php

namespace App\FrontendBundle\Controller;

interface PreExecuteControllerInterface
{
    /**
     * Pre execute controller action
     */
    public function preExecute();
}
