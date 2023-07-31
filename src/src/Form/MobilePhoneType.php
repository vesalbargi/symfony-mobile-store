<?php

namespace App\Form;

use App\Entity\MobilePhone;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MobilePhoneType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('brand')
            ->add('model')
            ->add('operatingSystem')
            ->add('screenSize')
            ->add('memory')
            ->add('storage')
            ->add('camera')
            ->add('batteryCapacity')
            ->add('price')
            ->add('mobileCompany')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => MobilePhone::class,
        ]);
    }
}
