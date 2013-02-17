<?php

namespace App\FrontendBundle\Form\Type\TimesheetWeek;

use App\FrontendBundle\Form\EventListener\TimesheetWeek\AddTaskFormSubscriber;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\AbstractType;

class AddTaskFormType extends AbstractType
{
    /**
     * @var ObjectManager
     */
    private $em;

    /**
     * Constructor
     *
     * @param ObjectManager $em
     */
    public function __construct(ObjectManager $em)
    {
        $this->em = $em;
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('year', 'hidden')
            ->add('week', 'hidden')
            ->add('task', 'app_frontend_form_type_project_to_task_form_type');

        // handle form events
        $subscriber = new AddTaskFormSubscriber($this->em);
        $builder->addEventSubscriber($subscriber);
    }

    /**
     * {@inheritdoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $defaultValues = array(
            'cascade_validation' => true,
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
