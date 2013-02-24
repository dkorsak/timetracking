<?php

namespace App\FrontendBundle\Form\Type\TimesheetDay;

use App\FrontendBundle\Form\Type\TimesheetWeek\AddTaskFormType as WeekFormType;
use Symfony\Component\Form\FormBuilderInterface;

class AddTaskFormType extends WeekFormType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);
        $builder->add('description', 'textarea');
        $builder->add('time');
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'app_frontend_form_type_timesheet_day_add_task_form_type';
    }
}
