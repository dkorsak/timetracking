<?php

namespace App\BackendBundle\Form\Type\Project;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\AbstractType;

class TaskType extends AbstractType
{
    
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        //$builder->add('name');
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
            'data_class' => 'App\GeneralBundle\Entity\ProjectToTask',
        );
        $resolver->setDefaults($defaultValues);
    }
    

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'task';
    }
}
