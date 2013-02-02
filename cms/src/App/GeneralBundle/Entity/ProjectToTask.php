<?php

namespace App\GeneralBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * App\GeneralBundle\ProjectToTask
 * 
 * @ORM\Table(name="project_to_task")
 * @ORM\Entity()
 */
class ProjectToTask
{
    /**
     * @var integer
     *
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var boolean
     * 
     * @ORM\Column(name="billable", type="boolean", nullable=false)
     */
    private $billable;

    /**
     * @var Project
     *
     * @ORM\ManyToOne(targetEntity="Project", inversedBy="tasks")
     * @ORM\JoinColumn(name="project_id", referencedColumnName="id", nullable=false, onDelete="RESTRICT")
     */
    private $project;

    /**
     * @var Task
     * 
     * @ORM\ManyToOne(targetEntity="Task", inversedBy="projects")
     * @ORM\JoinColumn(name="task_id", referencedColumnName="id", nullable=false, onDelete="RESTRICT")
     */
    private $task;

    /**
     * Constructor
     * 
     */
    public function __construct()
    {
        $this->billable = false;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->getTask()->getName();
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set billable
     *
     * @param boolean $billable
     * @return ProjectToTask
     */
    public function setBillable($billable)
    {
        $this->billable = $billable;
    
        return $this;
    }

    /**
     * Get billable
     *
     * @return boolean 
     */
    public function getBillable()
    {
        return $this->billable;
    }

    /**
     * Set project
     *
     * @param \App\GeneralBundle\Entity\Project $project
     * @return ProjectToTask
     */
    public function setProject(\App\GeneralBundle\Entity\Project $project)
    {
        $this->project = $project;
    
        return $this;
    }

    /**
     * Get project
     *
     * @return \App\GeneralBundle\Entity\Project 
     */
    public function getProject()
    {
        return $this->project;
    }

    /**
     * Set task
     *
     * @param \App\GeneralBundle\Entity\Task $task
     * @return ProjectToTask
     */
    public function setTask(\App\GeneralBundle\Entity\Task $task)
    {
        $this->task = $task;
    
        return $this;
    }

    /**
     * Get task
     *
     * @return \App\GeneralBundle\Entity\Task 
     */
    public function getTask()
    {
        return $this->task;
    }
}