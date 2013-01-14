<?php

namespace App\GeneralBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * App\GeneralBundle\ProjectStatus
 * 
 * @ORM\Table(name="project_status")
 * @ORM\Entity()
 */
class ProjectStatus
{
    /**
     * @var integer
     * 
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", nullable=false)
     */
    protected $name;
}