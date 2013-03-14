<?php

namespace App\FrontendBundle\Form\Type\TimesheetDay;

use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class EditTaskFormType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('workTime')
            ->add('description');
    }

    /**
     * {@inheritdoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $defaultValues = array(
            'data_class' => 'App\GeneralBundle\Entity\TimesheetItem'
        );
        $resolver->setDefaults($defaultValues);
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'app_frontend_form_type_timesheet_day_edit_task_form_type';
    }
}
