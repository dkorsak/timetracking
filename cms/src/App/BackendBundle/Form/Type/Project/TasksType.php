<?php

namespace App\BackendBundle\Form\Type\Project;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\AbstractType;

class TasksType extends AbstractType
{
    
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        //$builder->add('tags');
        //print_R(count($builder->getForm()->getData()));
    }

    /**
     * {@inheritdoc}
     */
    public function buildView(FormView $view, FormInterface $form, array $options)
    {
        
    }

    /**
     * {@inheritdoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $defaultValues = array(
            'type' => new TaskType(),
            'by_reference' => false,
            'allow_add' => true,
            'allow_delete' => true
        );
        $resolver->setDefaults($defaultValues);
    }
    
    public function getParent()
    {
        return 'collection';
    }
    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'app_backend_form_project_tasks_type';
    }
}