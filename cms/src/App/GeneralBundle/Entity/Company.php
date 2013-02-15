<?php

namespace App\GeneralBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * App\GeneralBundle\Company
 *
 * @ORM\Table(name="company")
 * @ORM\Entity()
 */
class Company
{
    const STATUS_DISABLED = false;
    const STATUS_ENABLED = true;

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
     * @ORM\Column(name="status", type="boolean", nullable=false)
     */
    private $status;

    /**
     * @var string
     *
     * @ORM\Column(name="invoice_address", type="text", nullable=true)
     */
    private $invoiceAddress;

    /**
     * @var string
     *
     * @ORM\Column(name="nip", type="string", length=10, nullable=true)
     */
    private $nip;

    /**
     * @var string
     *
     * @ORM\Column(name="regon", type="string", length=9, nullable=true)
     */
    private $regon;

    /**
     * @var string
     *
     * @ORM\Column(name="phone", type="string", length=30, nullable=true)
     */
    private $phone;

    /**
     * Constructor
     *
     */
    public function __construct()
    {
        $this->status = self::STATUS_ENABLED;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->getName();
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
     * @param  string  $name
     * @return Company
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
     * @param  boolean $status
     * @return Company
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return boolean
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set invoiceAddress
     *
     * @param  string  $invoiceAddress
     * @return Company
     */
    public function setInvoiceAddress($invoiceAddress)
    {
        $this->invoiceAddress = $invoiceAddress;

        return $this;
    }

    /**
     * Get invoiceAddress
     *
     * @return string
     */
    public function getInvoiceAddress()
    {
        return $this->invoiceAddress;
    }

    /**
     * Set nip
     *
     * @param  string  $nip
     * @return Company
     */
    public function setNip($nip)
    {
        $this->nip = $nip;

        return $this;
    }

    /**
     * Get nip
     *
     * @return string
     */
    public function getNip()
    {
        return $this->nip;
    }

    /**
     * Set regon
     *
     * @param  string  $regon
     * @return Company
     */
    public function setRegon($regon)
    {
        $this->regon = $regon;

        return $this;
    }

    /**
     * Get regon
     *
     * @return string
     */
    public function getRegon()
    {
        return $this->regon;
    }

    /**
     * Set phone
     *
     * @param  string  $phone
     * @return Company
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get phone
     *
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }
}
