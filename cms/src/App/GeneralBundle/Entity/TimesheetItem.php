<?php

namespace App\GeneralBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * App\GeneralBundle\TimesheetItem
 * 
 * @ORM\Table(name="timesheet_item")
 * @ORM\Entity()
 */
class TimesheetItem
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
     * @ORM\Column(name="week_day", type="integer", nullable=false)
     */
    private $weekDay;

    /**
     * @var integer
     *
     * @ORM\Column(name="work_time", type="integer", nullable=false)
     */
    private $workTime;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;

    /**
     * @var Timesheet
     *
     * @ORM\ManyToOne(targetEntity="Timesheet", inversedBy="timesheetItems", cascade={"persist"})
     * @ORM\JoinColumn(name="timesheet_id", referencedColumnName="id", nullable=false, onDelete="CASCADE")
     */
    private $timesheet;

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
     * Set weekDay
     *
     * @param integer $weekDay
     * @return TimesheetItem
     */
    public function setWeekDay($weekDay)
    {
        $this->weekDay = $weekDay;
    
        return $this;
    }

    /**
     * Get weekDay
     *
     * @return integer 
     */
    public function getWeekDay()
    {
        return $this->weekDay;
    }

    /**
     * Set workTime
     *
     * @param integer $workTime
     * @return TimesheetItem
     */
    public function setWorkTime($workTime)
    {
        $this->workTime = $workTime;
    
        return $this;
    }

    /**
     * Get workTime
     *
     * @return integer 
     */
    public function getWorkTime()
    {
        return $this->workTime;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return TimesheetItem
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
     * Set timesheet
     *
     * @param \App\GeneralBundle\Entity\Timesheet $timesheet
     * @return TimesheetItem
     */
    public function setTimesheet(\App\GeneralBundle\Entity\Timesheet $timesheet)
    {
        $this->timesheet = $timesheet;
    
        return $this;
    }

    /**
     * Get timesheet
     *
     * @return \App\GeneralBundle\Entity\Timesheet 
     */
    public function getTimesheet()
    {
        return $this->timesheet;
    }
}
