<?php

namespace App\GeneralBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

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
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", nullable=false)
     */
    protected $name;

    /**
     * @var ProjectStatus
     *
     * @ORM\ManyToOne(targetEntity="ProjectStatus")
     * @ORM\JoinColumn(name="status_id", referencedColumnName="id", nullable=false, onDelete="RESTRICT")
     */
    protected $status;

    /**
     * @var Company
     * 
     * @ORM\ManyToOne(targetEntity="Company")
     * @ORM\JoinColumn(name="company_id", referencedColumnName="id", nullable=false, onDelete="RESTRICT")
     */
    protected $company;

    /**
     * @var ArrayCollection
     *
     * @ORM\ManyToMany(targetEntity="User", inversedBy="projects")
     * @ORM\JoinTable(name="project_to_user",
     *     joinColumns={@ORM\JoinColumn(name="project_id", referencedColumnName="id", onDelete="CASCADE", nullable=false)},
     *     inverseJoinColumns={@ORM\JoinColumn(name="user_id", referencedColumnName="id", onDelete="CASCADE", nullable=false)}
     * )
     */
    protected $users;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="Task", mappedBy="project")
     */
    protected $tasks;
}