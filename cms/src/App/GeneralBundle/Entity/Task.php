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
     * Set name
     *
     * @param string $name
     * @return Task
     */
    public function setName($name)
    {
        $this->name = $name;
    
        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set project
     *
     * @param \App\GeneralBundle\Entity\Project $project
     * @return Task
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
}