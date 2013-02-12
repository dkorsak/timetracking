<?php

namespace App\GeneralBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * App\GeneralBundle\Project
 * 
 * @ORM\Table(name="project")
 * @ORM\Entity()
 */
class Project
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
     * @var ProjectStatus
     *
     * @ORM\ManyToOne(targetEntity="ProjectStatus")
     * @ORM\JoinColumn(name="status_id", referencedColumnName="id", nullable=false, onDelete="RESTRICT")
     * @Assert\NotNull()
     */
    private $status;

    /**
     * @var Company
     * 
     * @ORM\ManyToOne(targetEntity="Company")
     * @ORM\JoinColumn(name="company_id", referencedColumnName="id", nullable=false, onDelete="RESTRICT")
     * @Assert\NotNull() 
     */
    private $company;

    /**
     * @var ArrayCollection
     *
     * @ORM\ManyToMany(targetEntity="User", inversedBy="projects")
     * @ORM\JoinTable(name="project_to_user",
     *     joinColumns={
     *         @ORM\JoinColumn(name="project_id", referencedColumnName="id", onDelete="CASCADE", nullable=false)
     *     },
     *     inverseJoinColumns={
     *         @ORM\JoinColumn(name="user_id", referencedColumnName="id", onDelete="CASCADE", nullable=false)
     *     }
     * )
     */
    private $users;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="ProjectToTask", mappedBy="project")
     */
    private $tasks;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->users = new \Doctrine\Common\Collections\ArrayCollection();
        $this->tasks = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return Project
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
     * Set status
     *
     * @param \App\GeneralBundle\Entity\ProjectStatus $status
     * @return Project
     */
    public function setStatus(\App\GeneralBundle\Entity\ProjectStatus $status)
    {
        $this->status = $status;
    
        return $this;
    }

    /**
     * Get status
     *
     * @return \App\GeneralBundle\Entity\ProjectStatus 
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set company
     *
     * @param \App\GeneralBundle\Entity\Company $company
     * @return Project
     */
    public function setCompany(\App\GeneralBundle\Entity\Company $company)
    {
        $this->company = $company;
    
        return $this;
    }

    /**
     * Get company
     *
     * @return \App\GeneralBundle\Entity\Company 
     */
    public function getCompany()
    {
        return $this->company;
    }

    /**
     * Add users
     *
     * @param \App\GeneralBundle\Entity\User $users
     * @return Project
     */
    public function addUser(\App\GeneralBundle\Entity\User $users)
    {
        $this->users[] = $users;
    
        return $this;
    }

    /**
     * Remove users
     *
     * @param \App\GeneralBundle\Entity\User $users
     */
    public function removeUser(\App\GeneralBundle\Entity\User $users)
    {
        $this->users->removeElement($users);
    }

    /**
     * Get users
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getUsers()
    {
        return $this->users;
    }

    /**
     * Add tasks
     *
     * @param \App\GeneralBundle\Entity\ProjectToTask $tasks
     * @return Project
     */
    public function addTask(\App\GeneralBundle\Entity\ProjectToTask $tasks)
    {
        $this->tasks[] = $tasks;
    
        return $this;
    }

    /**
     * Remove tasks
     *
     * @param \App\GeneralBundle\Entity\ProjectToTask $tasks
     */
    public function removeTask(\App\GeneralBundle\Entity\ProjectToTask $tasks)
    {
        $this->tasks->removeElement($tasks);
    }

    /**
     * Get tasks
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getTasks()
    {
        return $this->tasks;
    }
}
