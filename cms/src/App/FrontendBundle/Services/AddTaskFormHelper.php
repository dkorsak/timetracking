<?php

namespace App\FrontendBundle\Services;

use Symfony\Component\Validator\Constraints\Callback;
use Symfony\Component\Validator\ExecutionContext;
use Doctrine\Common\Persistence\ObjectManager;

class AddTaskFormHelper
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
     * @param array $options
     */
    public function getProjects($year, $week, $userId)
    {
        if (is_null($this->projects)) {
            $this->prepareData($year, $week, $userId);
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
    public function getTasks($year, $week, $userId)
    {
        if (is_null($this->projects)) {
            $this->prepareData($year, $week, $userId);
        }

        return $this->tasks;
    }

    /**
     * Create callback validation constraint for add task form type
     *
     * @param  array $options
     * @return array
     */
    public function createTaskValidationConstraint($options)
    {
        $helper = $this;
        $validation = function (array $data, ExecutionContext $context) use ($helper, $options) {
            if ($data['project'] > 0 && $data['task'] > 0) {
                $task = $helper->getProjectToTask($data['project'], $data['task']);
                if (!$task) {
                    $context->addViolation('Task does not exists');

                    return false;
                }
                // check if user has task in current week
                if ($helper->hasUserTaskInWeek($task->getId(), $options['year'], $options['week'], $options['user_id'])) {
                    $context->addViolation('Task exists in your current week');

                    return false;
                }
                if (!$helper->hasUserTaskPermission($task->getId(), $options['user_id'])) {
                    $context->addViolation('You do not have permissions for this task');

                    return false;
                }
            }
        };
        $callbackValidator = new Callback(array('methods' => array($validation)));

        return array($callbackValidator);
    }

    /**
     * @param  integer   $projectId
     * @param  integer   $taskId
     * @return Timesheet
     */
    public function getProjectToTask($projectId, $taskId)
    {
        return $this->em
            ->getRepository('AppGeneralBundle:ProjectToTask')
            ->findOneBy(array('project' => $projectId, 'task' => $taskId));
    }

    /**
     * @param  integer   $taskId
     * @param  string    $year
     * @param  string    $week
     * @param  string    $userId
     * @return Timesheet
     */
    public function hasUserTaskInWeek($taskId, $year, $week, $userId)
    {
        return $this->em
            ->getRepository('AppGeneralBundle:Timesheet')
            ->findOneBy(array('task' => $taskId, 'user' => $userId, 'week' => $week, 'year' => $year));
    }

    public function hasUserTaskPermission($taskId, $userId)
    {
        return true;//TOO
    }

    /**
     * @param string $year
     * @param string $week
     * @param string $userId
     */
    private function prepareData($year, $week, $userId)
    {
        $projects = $this->em->getRepository('AppGeneralBundle:Project')->getUserAvailableProjects($userId);
        $data = array();
        $taskData = array();
        $userTaskInWeek = $this->em->getRepository('AppGeneralBundle:Timesheet')->getUserTaskIdsForCurrentWeek($year, $week, $userId);
        foreach ($projects as $item) {
            // display only tasks which do not exist in current week
            if (!in_array($item['project_to_task_id'], $userTaskInWeek)) {
                $data[$item['company_id']]['company_name'] = $item['company_name'];
                $data[$item['company_id']]['projects'][$item['project_id']] = $item['project_name'];
                $taskData[$item['project_id']][] = array('id' => $item['task_id'], 'text' => $item['task_name']);
            }
        }

        $this->projects = $data;
        $this->tasks = $taskData;
    }
}
