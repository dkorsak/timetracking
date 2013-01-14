<?php

namespace App\GeneralBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

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
    protected $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="job_date", type="date", nullable=false)
     */
    protected $jobDate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="job_time", type="time", nullable=false)
     */
    protected $jobTime;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    protected $description;

    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="User", cascade={"persist"})
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id", nullable=false, onDelete="RESTRICT")
     */
    protected $user;

    /**
     * @var Task
     *
     * @ORM\ManyToOne(targetEntity="Task", cascade={"persist"})
     * @ORM\JoinColumn(name="task_id", referencedColumnName="id", nullable=false, onDelete="RESTRICT")
     */
    protected $task;
}