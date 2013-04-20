<?php

namespace Codopenex\ClinicianBaseBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class MedicalFacilityType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('phone')
			->add('email', 'email', array('required'=>false))
			->add('address1')
			->add('address2', 'text', array('required'=>false))
			->add('address3', 'text', array('required'=>false))
			->add('address4', 'text', array('required'=>false))
			->add('address5', 'text', array('required'=>false))
			->add('town')
			->add('county', 'text', array('required'=>false))
			->add('postcode')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Codopenex\ClinicianBaseBundle\Entity\MedicalFacility'
        ));
    }

    public function getName()
    {
        return 'codopenex_clinicianbasebundle_medicalfacilitytype';
    }
}