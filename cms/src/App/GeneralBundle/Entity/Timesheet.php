<?php

namespace App\GeneralBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * App\GeneralBundle\Timesheet
 *
 * @ORM\Table(name="timesheet")
 * @ORM\Entity(repositoryClass="App\GeneralBundle\Entity\TimesheetRepository")
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
     * @var integer
     *
     * @ORM\Column(name="task_year", type="integer", nullable=false)
     */
    private $year;

    /**
     * @var integer
     *
     * @ORM\Column(name="task_week", type="integer", nullable=false)
     */
    private $week;

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
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="TimesheetItem", mappedBy="timesheet", cascade={"persist"})
     */
    private $timesheetItems;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->timesheetItems = new ArrayCollection();
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
     * Set year
     *
     * @param  integer   $year
     * @return Timesheet
     */
    public function setYear($year)
    {
        $this->year = $year;

        return $this;
    }

    /**
     * Get year
     *
     * @return integer
     */
    public function getYear()
    {
        return $this->year;
    }

    /**
     * Set week
     *
     * @param  integer   $week
     * @return Timesheet
     */
    public function setWeek($week)
    {
        $this->week = $week;

        return $this;
    }

    /**
     * Get week
     *
     * @return integer
     */
    public function getWeek()
    {
        return $this->week;
    }

    /**
     * Set user
     *
     * @param  \App\GeneralBundle\Entity\User $user
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
     * @param  \App\GeneralBundle\Entity\ProjectToTask $task
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

    /**
     * Add timesheetItems
     *
     * @param  \App\GeneralBundle\Entity\TimesheetItem $timesheetItems
     * @return Timesheet
     */
    public function addTimesheetItem(\App\GeneralBundle\Entity\TimesheetItem $timesheetItems)
    {
        $this->timesheetItems[] = $timesheetItems;
        $timesheetItems->setTimesheet($this);

        return $this;
    }

    /**
     * Remove timesheetItems
     *
     * @param \App\GeneralBundle\Entity\TimesheetItem $timesheetItems
     */
    public function removeTimesheetItem(\App\GeneralBundle\Entity\TimesheetItem $timesheetItems)
    {
        $this->timesheetItems->removeElement($timesheetItems);
    }

    /**
     * Get timesheetItems
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTimesheetItems()
    {
        return $this->timesheetItems;
    }
}
