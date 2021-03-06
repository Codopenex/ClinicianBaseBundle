<?php
// src/Codopenex/ClinicianBaseBundle/Entity/Clinician.php

namespace Codopenex\ClinicianBaseBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Mapping\ClassMetadata;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Email;

/**
 * @ORM\Entity(repositoryClass="Codopenex\ClinicianBaseBundle\Repository\ClinicianRepository")
 * @ORM\Table(name="clinicians")
 */
class Clinician
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
     * @ORM\ManyToMany(targetEntity="Codopenex\ClinicianBaseBundle\Entity\Specialty", inversedBy="Clinician")
     * @ORM\JoinTable(name="clinicians_specialties",
	 *   joinColumns={
 	 *     @ORM\JoinColumn(name="clinician_id", referencedColumnName="id")
	 *   },
	 *   inverseJoinColumns={
	 *     @ORM\JoinColumn(name="specialty_id", referencedColumnName="id")
	 *   }
	 * )
     **/
    private $specialties;
	
	/**
     * Specialties
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getSpecialties()
    {
        return $this->specialties;
    }
	
	/**
     * Specialties
     *
	 * @param collection $specialties
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function setSpecialties($specialties)
    {
        $this->specialties = $specialties;
    }
	
    /**
     * @ORM\ManyToMany(targetEntity="Codopenex\ClinicianBaseBundle\Entity\MedicalFacility", inversedBy="Clinician")
     * @ORM\JoinTable(name="clinicians_medicalfacilities")
     **/
    private $medical_facilities;
	
	/**
     * Medical Facilities
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getMedicalFacilities()
    {
        return $this->medical_facilities;
    }
	
	/**
     * Medical Facilities
     *
	 * @param collection $medical_facilities
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function setMedicalFacilities($medical_facilities)
    {
        $this->medical_facilities = $medical_facilities;
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
     * Set id
     *
     * @param string $id
     * @return string
     */
    public function setId($id)
    {
        $this->id = $id;
    
        return $this;
    }
	
	/**
     * @ORM\Column(type="string")
     */
    protected $name;

    /**
     * Set name
     *
     * @param string $name
     * @return Clinician
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
     * @return Clinician
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
     * @return Clinician
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
     * Add specialties
     *
     * @param \Codopenex\ClinicianBaseBundle\Entity\Specialty $specialties
     * @return Clinician
     */
    public function addSpecialtie(\Codopenex\ClinicianBaseBundle\Entity\Specialty $specialties)
    {
        $this->specialties[] = $specialties;
    
        return $this;
    }

    /**
     * Remove specialties
     *
     * @param \Codopenex\ClinicianBaseBundle\Entity\Specialty $specialties
     */
    public function removeSpecialtie(\Codopenex\ClinicianBaseBundle\Entity\Specialty $specialties)
    {
        $this->specialties->removeElement($specialties);
    }

    /**
     * Add medical_facilities
     *
     * @param \Codopenex\ClinicianBaseBundle\Entity\MedicalFacility $medicalFacilities
     * @return Clinician
     */
    public function addMedicalFacilitie(\Codopenex\ClinicianBaseBundle\Entity\MedicalFacility $medicalFacilities)
    {
        $this->medical_facilities[] = $medicalFacilities;
    
        return $this;
    }

    /**
     * Remove medical_facilities
     *
     * @param \Codopenex\ClinicianBaseBundle\Entity\MedicalFacility $medicalFacilities
     */
    public function removeMedicalFacilitie(\Codopenex\ClinicianBaseBundle\Entity\MedicalFacility $medicalFacilities)
    {
        $this->medical_facilities->removeElement($medicalFacilities);
    }
}