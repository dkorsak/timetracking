<?php

namespace App\FrontendBundle\Form\Handler\TimesheetWeek;

use App\GeneralBundle\Entity\Timesheet;
use Symfony\Component\Form\FormInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Request;

class AddTaskFormHandler
{
    /**
     * @var FormInterface
     */
    private $form;

    /**
     * @var Request
     */
    private $request;

    /**
     * @var ObjectManager
     */
    private $em;

    /**
     * Constructor
     * 
     * @param FormInterface $form
     * @param Request $request
     * @param ObjectManager $em
     */
    public function __construct(FormInterface $form, Request $request, ObjectManager $em)
    {
        $this->form = $form;
        $this->request = $request;
        $this->em = $em;
    }

    public function processNew(Timesheet $timesheet)
    {
        /*
        $this->form->setData($unitStyle);
        if ('POST' == $this->request->getMethod()) {
            $this->form->bind($this->request);
            if ($this->form->isValid()) {
                $data = $this->form->getData();
                if ($data->getLogoFile() instanceof UploadedFile) {
                    $path = $this->fileService->uploadFile($data->getLogoFile(), UploadFileService::COMPANY_LOGO_DIR);
                    $data->setLogo($path);
                }

                $this->em->persist($data);
                $this->em->flush();

                return true;
            }
        }

        return false;
        */
    }

    public function processCreate()
    {

    }
}
