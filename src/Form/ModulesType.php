<?php

namespace App\Form;

use App\Entity\Modules;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\FormInterface;
use Doctrine\ORM\EntityRepository;
use App\Entity\Blocs;
use App\Entity\Classes;
use App\Entity\Etudiants;
use App\Entity\Intervenants;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

class ModulesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom')
            ->remove('created_at')
            ->remove('created_by')

            ->add('classes', EntityType::class, [
                'class' => Classes::class,
            
                'choice_label' => 'nom',
                'placeholder' => '',
                'empty_data' => ''
            ])
           

           
            ;

            $formModifier = function (FormInterface $form, Classes $sport = null) {
                $positions = null === $sport ? [] : $sport->getBlocs();
                if (null === $sport) {
                    $empriseId= 0;
                }
                else { $empriseId= $sport->getId();
                }
                $form->add('bloc', EntityType::class, [
                    'class' => Blocs::class,
                    'query_builder' => function (EntityRepository $er) use ($empriseId) {
                        return $er->createQueryBuilder('u')
                        ->where('u.Classe = :val')
                        ->setParameter('val',$empriseId)
                            ->orderBy('u.nom', 'ASC');
                    },
                
                    'choice_label' => 'nom',
                ]);
            };

            $builder->addEventListener(
                FormEvents::PRE_SET_DATA,
                function (FormEvent $event) use ($formModifier) {
                    // this would be your entity, i.e. SportMeetup
                    $data = $event->getData();
    
                    $formModifier($event->getForm(), $data->getBloc());
                }
            );
    
            $builder->get('classes')->addEventListener(
                FormEvents::POST_SUBMIT,
                function (FormEvent $event) use ($formModifier) {
                    // It's important here to fetch $event->getForm()->getData(), as
                    // $event->getData() will get you the client data (that is, the ID)
                    $sport = $event->getForm()->getData();
    
                    // since we've added the listener to the child, we'll have to pass on
                    // the parent to the callback functions!
                    $formModifier($event->getForm()->getParent(), $sport);
                }
            );
    
    }
         

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Modules::class,
        ]);
    }
}
