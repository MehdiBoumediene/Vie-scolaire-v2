<?php

namespace App\Form;

use App\Entity\Calendrier;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ColorType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Doctrine\ORM\EntityRepository;
use App\Entity\Classes;
use App\Entity\Blocs;
use App\Entity\Modules;
use App\Entity\Users;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CalendrierType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('titre',ChoiceType::class, [
            'choices' => [
                'RDV' => 'RDV',
                'EXAMEN' => 'EXAMEN',
                
            ],
            'expanded' => false,
            'multiple' => false,
            'required' => false,
            'label' => 'Type' 
        ])

            ->add('start',DateTimeType::class,[
                'label' => 'Date début',
                'widget' => "single_text",
     
                
                
           
            ])
            ->add('end',DateTimeType::class,[
                'label' => 'Date fin',
                'widget' => "single_text",
          
                
                
            ])
            ->add('description',TextareaType::class,[
                'label'=>'Commentaire',
                'required' => false,
            ])
            ->remove('all_day')
            ->add('background_color', ColorType::class,[
                'label' => 'Couleur du fond ',
                'required' => false,
                
            ])
            ->add('border_color', ColorType::class,[
                'label' => 'Couleur bordure ',
                
                
            ])
            ->add('text_color', ColorType::class,[
                'label' => 'Couleur du texte ',
                'data'=> '#ffffff'
                
                
            ])

            ->add('classe', EntityType::class, [
                'class' => Classes::class,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('u')
                        ->orderBy('u.nom', 'ASC');
                },
                'choice_label' => 'nom',
                'multiple'=>false,
                'required' => true,
            ])

            ->remove('bloc', EntityType::class, [
                'class' => Blocs::class,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('u')
                        ->orderBy('u.nom', 'ASC');
                },
                'choice_label' => 'nom',
                'multiple'=>false,
                'required' => true,
            ])

            ->add('module', EntityType::class, [
                'class' => Modules::class,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('u')
                        ->orderBy('u.nom', 'ASC');
                },
                'choice_label' => 'nom',
                'multiple'=>false,
                'required' => true,
            ])

            ->add('intervenant', EntityType::class, [
                'class' => Users::class,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('u')
                        ->orderBy('u.email', 'ASC')
                        ->where('u.roles LIKE :role')
                            ->setParameter('role','%"'.'ROLE_INTERVENANT'.'"%')
                        ;
                },
                'choice_label' => 'email',
                'multiple'=>false,
                'required' => true,

            ])


            ->remove('type')
         ->add('date', DateType::class, [
        
                'widget' => 'single_text',
                'label' => 'Date'
            ])

            ->add('heurdebut', TimeType::class, [
        
                'widget' => 'single_text',
                'label' => false
            ])
            ->add('duree', TimeType::class, [
        
                'widget' => 'single_text',
                'label' => false
            ])
            ->remove('heurefin', TimeType::class, [
             
                'widget' => 'single_text',
                'label' => false
            ]);
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Calendrier::class,
        ]);
    }
}
