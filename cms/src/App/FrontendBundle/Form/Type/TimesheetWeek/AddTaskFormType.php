<?php

namespace App\FrontendBundle\Form\Type\TimesheetWeek;

use Symfony\Component\Validator\ExecutionContext;

use Symfony\Component\Validator\Constraints\Callback;

use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Collection;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
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
     * @var array
     */
    private $projects;

    /**
     * @var array
     */
    private $tasks;

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
        $projectOptions = array('required' => false, 'choices' => $this->getProjects($options), 'empty_value' => '');
        $builder
            ->add('project', 'choice', $projectOptions)
            ->add('task', 'text');
    }

    /**
     * {@inheritdoc}
     */
    public function buildView(FormView $view, FormInterface $form, array $options)
    {
        $view->set('tasks', json_encode($this->getTasks($options)));
    }

    /**
     * {@inheritdoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $em = $this->em;
        $validation = function(array $data, ExecutionContext $context) use ($em) {
            //print_R($data);

        };
        $collectionConstraint = new Collection(
            array(
                'project' => array(new NotBlank()),
                'task' => array(new NotBlank())
            )
        );

        $callbackValidator = new Callback(array('methods' => array($validation)));
        $defaultValues = array(
            'error_bubling' => false,
            'validation_constraint' => array($collectionConstraint, $callbackValidator)
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

    /**
     * @param array $options
     */
    private function prepareData(array $options)
    {
        $projects = $this->em->getRepository('AppGeneralBundle:Project')->getUserAvailableProjects($options['user_id']);
        $data = array();
        $taskData = array();
        //TODO remove tasks for current week
        foreach ($projects as $item) {
            $data[$item['company_id']]['company_name'] = $item['company_name'];
            $data[$item['company_id']]['projects'][$item['project_id']] = $item['project_name'];
            $taskData[$item['project_id']][] = array('id' => $item['task_id'], 'text' => $item['task_name']);
        }

        $this->projects = $data;
        $this->tasks = $taskData;
    }

    /**
     * @param array $options
     */
    private function getProjects(array $options)
    {
        if (is_null($this->projects)) {
            $this->prepareData($options);
        }
        $projects = array();
        foreach ($this->projects as $item) {
            $projects[$item['company_name']] = $item['projects'];
        }

        return $projects;
    }

    /**
     * @param array $options
     */
    private function getTasks(array $options)
    {
        if (is_null($this->projects)) {
            $this->prepareData($options);
        }

        return $this->tasks;
    }
}
