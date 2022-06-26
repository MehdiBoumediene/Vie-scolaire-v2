<?php

namespace App\Form;

use App\Entity\Users;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Entity\Classes;
use App\Entity\Modules;
use App\Entity\Tuteurs;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;


class UsersType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email',EmailType::class)
            ->add('password', PasswordType::class,[  
            ])
            ->add('isVerified',CheckboxType::class,[
                'label' => 'Compte Activé', 
                'data' => true,
           
            ])
            ->add('roles', ChoiceType::class, [
                'choices' => [
                    'Étudiant' => 'ROLE_ETUDIANT',
                    'Intervenant' => 'ROLE_INTERVENANT',
                    'Tuteur' => 'ROLE_TUTEUR',
                    'Administrateur' => 'ROLE_ADMIN',
                    
                ],
                'expanded' => false,
                'multiple' => true,
                'required' => false,
               
                'label' => 'Rôles' 
            ])

            ->remove('nom',TextType::class)
            ->remove('prenom', TextType::class)
            ->remove('adresse',TextType::class)
            ->remove('telephone',TelType::class)

            

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Users::class,
        ]);
    }
}
