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
     * @param Request       $request
     * @param ObjectManager $em
     */
    public function __construct(FormInterface $form, Request $request, ObjectManager $em)
    {
        $this->form = $form;
        $this->request = $request;
        $this->em = $em;
    }

    /**
     * @param unknown_type $year
     * @param unknown_type $week
     */
    public function processNew($year, $week)
    {
        $timesheet = new Timesheet();
        $timesheet->setYear($year);
        $timesheet->setWeek($week);

        $this->form->setData($timesheet);
    }

    /**
     * @param  Timesheet $timesheet
     * @return boolean
     */
    public function processCreate(Timesheet $timesheet)
    {
        $this->form->setData($timesheet);

        $this->form->bind($this->request);
        if ($this->form->isValid()) {
            $data = $this->form->getData();

            $this->em->persist($data);
            $this->em->flush();

            return true;
        }

        return false;
    }
}
