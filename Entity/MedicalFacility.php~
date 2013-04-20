<?php
// src/Codopenex/ClinicianBaseBundle/Entity/MedicalFacility.php

namespace Codopenex\ClinicianBaseBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Mapping\ClassMetadata;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Email;

/**
 * @ORM\Entity(repositoryClass="Codopenex\ClinicianBaseBundle\Repository\MedicalFacilityRepository")
 * @ORM\Table(name="medical_facilities")
 */
class MedicalFacility
{
    public function __construct()
    {
		// Stuff
		//$this->comments = new ArrayCollection();
		
        //$this->setCreated(new \DateTime());
        //$this->setUpdated(new \DateTime());
    }
	
	public static function loadValidatorMetadata(ClassMetadata $metadata)
    {
        $metadata->addPropertyConstraint('name', new NotBlank());
		
        $metadata->addPropertyConstraint('email', new Email(array('message' => 'Invalid Email!, custom message')));
		
        $metadata->addPropertyConstraint('phone', new NotBlank());
        //$metadata->addPropertyConstraint('subject', new MaxLength(50));
		
        //$metadata->addPropertyConstraint('body', new MinLength(50));
    }
	
	public function __toString()
	{
		return $this->getName();
	}
	
	/**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
	
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
     * @ORM\Column(type="string")
     */
    protected $name;

    /**
     * Set name
     *
     * @param string $name
     * @return MedicalFacility
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
     * @ORM\Column(type="string")
     */	 
    protected $phone;

    /**
     * Set phone
     *
     * @param string $phone
     * @return MedicalFacility
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
	
	/**
     * @ORM\Column(type="string")
     */	 
    protected $email;

    /**
     * Set email
     *
     * @param string $email
     * @return MedicalFacility
     */	 
    public function setEmail($email)
    {
        $this->email = $email;
    
        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }
	
	/**
     * @ORM\Column(type="string")
     */	 
    protected $address1;
	
	/**
     * @ORM\Column(type="string")
     */	 
    protected $address2;
	
	/**
     * @ORM\Column(type="string")
     */	 
    protected $address3;
	
	/**
     * @ORM\Column(type="string")
     */	 
    protected $address4;
	
	/**
     * @ORM\Column(type="string")
     */	 
    protected $address5;
	
	/**
     * @ORM\Column(type="string")
     */	 
    protected $town;
	
	/**
     * @ORM\Column(type="string")
     */	 
    protected $county;
	
	/**
     * @ORM\Column(type="string")
     */	 
    protected $postcode;

    /**
     * Set address1
     *
     * @param string $address1
     * @return MedicalFacility
     */
    public function setAddress1($address1)
    {
        $this->address1 = $address1;
    
        return $this;
    }

    /**
     * Get address1
     *
     * @return string 
     */
    public function getAddress1()
    {
        return $this->address1;
    }

    /**
     * Set address2
     *
     * @param string $address2
     * @return MedicalFacility
     */
    public function setAddress2($address2)
    {
        $this->address2 = $address2;
    
        return $this;
    }

    /**
     * Get address2
     *
     * @return string 
     */
    public function getAddress2()
    {
        return $this->address2;
    }

    /**
     * Set address3
     *
     * @param string $address3
     * @return MedicalFacility
     */
    public function setAddress3($address3)
    {
        $this->address3 = $address3;
    
        return $this;
    }

    /**
     * Get address3
     *
     * @return string 
     */
    public function getAddress3()
    {
        return $this->address3;
    }

    /**
     * Set address4
     *
     * @param string $address4
     * @return MedicalFacility
     */
    public function setAddress4($address4)
    {
        $this->address4 = $address4;
    
        return $this;
    }

    /**
     * Get address4
     *
     * @return string 
     */
    public function getAddress4()
    {
        return $this->address4;
    }

    /**
     * Set address5
     *
     * @param string $address5
     * @return MedicalFacility
     */
    public function setAddress5($address5)
    {
        $this->address5 = $address5;
    
        return $this;
    }

    /**
     * Get address5
     *
     * @return string 
     */
    public function getAddress5()
    {
        return $this->address5;
    }

    /**
     * Set town
     *
     * @param string $town
     * @return MedicalFacility
     */
    public function setTown($town)
    {
        $this->town = $town;
    
        return $this;
    }

    /**
     * Get town
     *
     * @return string 
     */
    public function getTown()
    {
        return $this->town;
    }

    /**
     * Set county
     *
     * @param string $county
     * @return MedicalFacility
     */
    public function setCounty($county)
    {
        $this->county = $county;
    
        return $this;
    }

    /**
     * Get county
     *
     * @return string 
     */
    public function getCounty()
    {
        return $this->county;
    }

    /**
     * Set postcode
     *
     * @param string $postcode
     * @return MedicalFacility
     */
    public function setPostcode($postcode)
    {
        $this->postcode = $postcode;
    
        return $this;
    }

    /**
     * Get postcode
     *
     * @return string 
     */
    public function getPostcode()
    {
        return $this->postcode;
    }
}