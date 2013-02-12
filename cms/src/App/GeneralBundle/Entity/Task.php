<?php

namespace App\GeneralBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

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
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", nullable=false)
     * @Assert\NotBlank()
     */
    private $name;

    /**
     * @var boolean
     * 
     * @ORM\Column(name="global", type="boolean", nullable=false)
     */
    private $global;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="ProjectToTask", mappedBy="task")
     */
    private $projects;

    /**
     * Constructor
     *  
     */
    public function __construct()
    {
        $this->global = false;
        $this->projects = new ArrayCollection();
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
     * Set global
     *
     * @param boolean $global
     * @return Task
     */
    public function setGlobal($global)
    {
        $this->global = $global;
    
        return $this;
    }

    /**
     * Get global
     *
     * @return boolean 
     */
    public function getGlobal()
    {
        return $this->global;
    }

    /**
     * Add projects
     *
     * @param \App\GeneralBundle\Entity\ProjectToTask $projects
     * @return Task
     */
    public function addProject(\App\GeneralBundle\Entity\ProjectToTask $projects)
    {
        $this->projects[] = $projects;
    
        return $this;
    }

    /**
     * Remove projects
     *
     * @param \App\GeneralBundle\Entity\ProjectToTask $projects
     */
    public function removeProject(\App\GeneralBundle\Entity\ProjectToTask $projects)
    {
        $this->projects->removeElement($projects);
    }

    /**
     * Get projects
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getProjects()
    {
        return $this->projects;
    }
}
