<?php

namespace Codopenex\ClinicianBaseBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class SpecialtyType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('description')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Codopenex\ClinicianBaseBundle\Entity\Specialty'
        ));
    }

    public function getName()
    {
        return 'codopenex_clinicianbasebundle_specialtytype';
    }
}