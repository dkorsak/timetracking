<?php

namespace App\FrontendBundle\Form\Type\TimesheetWeek;

use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Collection;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\Options;
use App\FrontendBundle\Services\AddTaskFormHelper;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\AbstractType;

class AddTaskFormType extends AbstractType
{
    /**
     * @var AddTaskFormHelper
     */
    private $helper;

    /**
     * Constructor
     *
     * @param AddTaskFormHelper $helper
     */
    public function __construct(AddTaskFormHelper $helper)
    {
        $this->helper = $helper;
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $choices = $this->helper->getProjects($options['year'], $options['week'], $options['user_id']);
        $projectOptions = array('required' => false, 'choices' => $choices, 'empty_value' => '');

        $builder
            ->add('project', 'choice', $projectOptions)
            ->add('task', 'text');
    }

    /**
     * {@inheritdoc}
     */
    public function buildView(FormView $view, FormInterface $form, array $options)
    {
        $tasks = $this->helper->getTasks($options['year'], $options['week'], $options['user_id']);
        $view->set('tasks', json_encode($tasks));
    }

    /**
     * {@inheritdoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $helper = $this->helper;
        $defaultValues = array(
            'error_bubling' => false,
            'validation_constraint' => function (Options $options) use ($helper) {
                return array_merge($helper->createTaskValidationConstraint($options), $this->getDefultValidation());
            }
        );
        $resolver->setDefaults($defaultValues);

        $optionNames = array('year', 'week', 'user_id');
        $resolver->setRequired($optionNames);
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'app_frontend_form_type_timesheet_week_add_task_form_type';
    }

    protected function getDefultValidation()
    {
        $collection = new Collection(
            array(
                'allowExtraFields' => true,
                'fields' => array(
                    'project' => array(new NotBlank()),
                    'task' => array(new NotBlank())
                )
            )
        );

        return array($collection);
    }
}
