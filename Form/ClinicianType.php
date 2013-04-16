<?php

namespace Codopenex\ClinicianBaseBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ClinicianType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
			//->add('id')
            ->add('name')
            ->add('phone')
			->add('email', 'email')
			->add('medical_facilities')
			->add('specialties')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Codopenex\ClinicianBaseBundle\Entity\Clinician'
        ));
    }

    public function getName()
    {
        return 'codopenex_clinicianbasebundle_cliniciantype';
    }

}