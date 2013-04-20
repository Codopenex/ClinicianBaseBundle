<?php
// src/Codopenex/ClinicianBaseBundle/Form/SearchType.php

namespace Codopenex\ClinicianBaseBundle\Form;

use Doctrine\ORM\EntityManager;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

use Codopenex\ClinicianBaseBundle\Repository\SpecialtyRepository;

class SearchType extends AbstractType
{
	public function __construct(EntityManager $entityManager)
	{
		$this->em = $entityManager;
	}
	
    public function buildForm(FormBuilderInterface $builder, array $options)
    {	
		$builder->add('specialties', 'entity', array(
			'class' => 'CodopenexClinicianBaseBundle:Specialty',
			'property' => 'name',
		));	
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            //'data_class' => 'Codopenex\ClinicianBaseBundle\Entity\Specialty'
			'data_class' => NULL
        ));
    }

    public function getName()
    {
        return 'codopenex_clinicianbasebundle_searchtype';
    }
}