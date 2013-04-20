<?php
// src/Codopenex/ClinicianBaseBundle/Entity/Specialty.php

namespace Codopenex\ClinicianBaseBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Mapping\ClassMetadata;
use Symfony\Component\Validator\Constraints\NotBlank;

/**
 * @ORM\Entity(repositoryClass="Codopenex\ClinicianBaseBundle\Repository\SpecialtyRepository")
 * @ORM\Table(name="specialties")
 */
class Specialty
{
	/**
     * @ORM\ManyToMany(targetEntity="Codopenex\ClinicianBaseBundle\Entity\Clinician", mappedBy="Specialty")
	 * @ORM\JoinTable(name="clinicians_specialties"),
	 *   joinColumns={
 	 *     @ORM\JoinColumn(name="specialty_id", referencedColumnName="id")
	 *   },
	 *   inverseJoinColumns={
	 *     @ORM\JoinColumn(name="clinician_id", referencedColumnName="id")
	 *   }
	 * )
     **/
    private $clinicians;
	
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
		
        //$metadata->addPropertyConstraint('email', new Email(array('message' => 'Invalid Email!, custom message')));
		
        //$metadata->addPropertyConstraint('phone', new NotBlank());
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
     * @ORM\Column(type="string")
     */
    protected $name;
	
	/**
     * @ORM\Column(type="text")
     */
    protected $description;

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
     * @return Specialty
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
     * Set description
     *
     * @param string $description
     * @return Specialty
     */
    public function setDescription($description)
    {
        $this->description = $description;
    
        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Add clinicians
     *
     * @param \Codopenex\ClinicianBaseBundle\Entity\Clinician $clinicians
     * @return Specialty
     */
    public function addClinician(\Codopenex\ClinicianBaseBundle\Entity\Clinician $clinicians)
    {
        $this->clinicians[] = $clinicians;
    
        return $this;
    }

    /**
     * Remove clinicians
     *
     * @param \Codopenex\ClinicianBaseBundle\Entity\Clinician $clinicians
     */
    public function removeClinician(\Codopenex\ClinicianBaseBundle\Entity\Clinician $clinicians)
    {
        $this->clinicians->removeElement($clinicians);
    }

    /**
     * Get clinicians
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getClinicians()
    {
        return $this->clinicians;
    }
}