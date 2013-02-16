<?php

namespace App\FrontendBundle\Form\Type\TimesheetWeek;

use App\FrontendBundle\Form\Type\ProjectToTaskType;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\AbstractType;

class AddTaskFormType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('year', 'text')
            ->add('week', 'text')
            ->add('task', new ProjectToTaskType());
    }

    /**
     * {@inheritdoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $defaultValues = array(
            'data_class' => 'App\GeneralBundle\Entity\Timesheet'
        );
        $resolver->setDefaults($defaultValues);
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'app_frontend_form_type_timesheet_week_add_task_form_type';
    }
}
