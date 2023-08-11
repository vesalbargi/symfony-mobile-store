<?php

namespace App\Form;

use App\Entity\MobileCompany;
use App\Entity\MobilePhone;
use App\Repository\MobileCompanyRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MobilePhoneType extends AbstractType
{

    private Security $security;
    private MobileCompanyRepository $mobileCompanyRepository;

    public function __construct(Security $security, MobileCompanyRepository $mobileCompanyRepository)
    {
        $this->security = $security;
        $this->mobileCompanyRepository = $mobileCompanyRepository;
    }

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
            ->add('mobileCompany', EntityType::class, [
                'class' => MobileCompany::class,
                'choices' => $this->getOwnedMobileCompanies(),
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => MobilePhone::class,
        ]);
    }

    public function getOwnedMobileCompanies(): array
    {
        $ownedMobileCompanies = [];
        $user = $this->security->getUser();
        $mobileCompanies = $this->mobileCompanyRepository->findAll();
        foreach ($mobileCompanies as $mobileCompany) {
            if ($mobileCompany->getOwner() === $user) {
                $ownedMobileCompanies[] = $mobileCompany;
            }
        }
        return $ownedMobileCompanies;
    }
}
