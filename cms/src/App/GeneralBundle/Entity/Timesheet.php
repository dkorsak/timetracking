<?php

namespace App\GeneralBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * App\GeneralBundle\Timesheet
 * 
 * @ORM\Table(name="timesheet")
 * @ORM\Entity()
 */
class Timesheet
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
     * @var \DateTime
     *
     * @ORM\Column(name="job_date", type="date", nullable=false)
     */
    private $jobDate;

    /**
     * @var integer
     *
     * @ORM\Column(name="job_time", type="integer", nullable=false)
     */
    private $time;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;

    /**
     * @var \DateTime
     *
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(type="datetime")
     */
    private $created;

    /**
     * @var \DateTime
     *
     * @Gedmo\Timestampable(on="update")
     * @ORM\Column(type="datetime")
     */
    private $updated;

    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="User", cascade={"persist"})
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id", nullable=false, onDelete="RESTRICT")
     */
    private $user;

    /**
     * @var ProjectToTask
     *
     * @ORM\ManyToOne(targetEntity="ProjectToTask", cascade={"persist"})
     * @ORM\JoinColumn(name="project_to_task_id", referencedColumnName="id", nullable=false, onDelete="RESTRICT")
     */
    private $task;

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
     * Set jobDate
     *
     * @param \DateTime $jobDate
     * @return Timesheet
     */
    public function setJobDate($jobDate)
    {
        $this->jobDate = $jobDate;
    
        return $this;
    }

    /**
     * Get jobDate
     *
     * @return \DateTime 
     */
    public function getJobDate()
    {
        return $this->jobDate;
    }

    /**
     * Set time
     *
     * @param integer $time
     * @return Timesheet
     */
    public function setTime($time)
    {
        $this->time = $time;
    
        return $this;
    }

    /**
     * Get time
     *
     * @return integer 
     */
    public function getTime()
    {
        return $this->time;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Timesheet
     */
    public function setDescription($description)
    {
        $this->description = $description;
    
        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     * @return Timesheet
     */
    public function setCreated($created)
    {
        $this->created = $created;
    
        return $this;
    }

    /**
     * Get created
     *
     * @return \DateTime 
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * Set updated
     *
     * @param \DateTime $updated
     * @return Timesheet
     */
    public function setUpdated($updated)
    {
        $this->updated = $updated;
    
        return $this;
    }

    /**
     * Get updated
     *
     * @return \DateTime 
     */
    public function getUpdated()
    {
        return $this->updated;
    }

    /**
     * Set user
     *
     * @param \App\GeneralBundle\Entity\User $user
     * @return Timesheet
     */
    public function setUser(\App\GeneralBundle\Entity\User $user)
    {
        $this->user = $user;
    
        return $this;
    }

    /**
     * Get user
     *
     * @return \App\GeneralBundle\Entity\User 
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set task
     *
     * @param \App\GeneralBundle\Entity\ProjectToTask $task
     * @return Timesheet
     */
    public function setTask(\App\GeneralBundle\Entity\ProjectToTask $task)
    {
        $this->task = $task;
    
        return $this;
    }

    /**
     * Get task
     *
     * @return \App\GeneralBundle\Entity\ProjectToTask 
     */
    public function getTask()
    {
        return $this->task;
    }
}