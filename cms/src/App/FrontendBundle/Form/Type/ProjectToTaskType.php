<?php

namespace App\FrontendBundle\Form\Type;

use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\AbstractType;

class ProjectToTaskType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('project', null, array('property' => 'name'))
            ->add('task', null, array('property' => 'name'));
    }

    /**
     * {@inheritdoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $defaultValues = array(
            'data_class' => 'App\GeneralBundle\Entity\ProjectToTask'
        );
        $resolver->setDefaults($defaultValues);
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'app_frontend_form_type_project_to_task_form_type';
    }
}