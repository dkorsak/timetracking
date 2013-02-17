<?php

namespace App\FrontendBundle\EventListener;

use App\FrontendBundle\Controller\PreExecuteControllerInterface;
use Symfony\Component\HttpKernel\Event\FilterControllerEvent;

class PreExecuteControllerListener
{
    /**
     * Event listener
     *
     * @param FilterControllerEvent $event
     */
    public function onKernelController(FilterControllerEvent $event)
    {
        $controller = $event->getController();

        if (!is_array($controller)) {
            return;
        }

        if ($controller[0] instanceof PreExecuteControllerInterface) {
            $controller[0]->preExecute();
        }
    }
}
