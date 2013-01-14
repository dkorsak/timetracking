<?php

namespace App\GeneralBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

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
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", nullable=false)
     */
    protected $name;

    /**
     * @var boolean
     *
     * @ORM\Column(name="status", type="boolean", nullable=false)
     */
    protected $status;

    /**
     * @var string
     *
     * @ORM\Column(name="invoice_address", type="text", nullable=true)
     */
    protected $invoiceAddress;

    /**
     * @var string
     *
     * @ORM\Column(name="nip", type="string", length=10, nullable=true)
     */
    protected $nip;

    /**
     * @var string
     *
     * @ORM\Column(name="regon", type="string", length=9, nullable=true)
     */
    protected $regon;

    /**
     * Constructor
     * 
     */
    public function __construct()
    {
        $this->status = self::STATUS_ENABLED;
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
     * @param boolean $status
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
     * @param string $invoiceAddress
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
     * @param string $nip
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
     * @param string $regon
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
}