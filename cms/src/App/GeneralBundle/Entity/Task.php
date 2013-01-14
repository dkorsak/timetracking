<?php

namespace App\GeneralBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * App\GeneralBundle\Task
 * 
 * @ORM\Table(name="task")
 * @ORM\Entity()
 */
class Task
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
     * @var string
     *
     * @ORM\Column(name="name", type="string", nullable=false)
     */
    protected $name;

    /**
     * @var Project
     *
     * @ORM\ManyToOne(targetEntity="Project", inversedBy="tasks")
     * @ORM\JoinColumn(name="project_id", referencedColumnName="id", nullable=false, onDelete="RESTRICT")
     */
    protected $project;
}