<?php

namespace App\Form;

use App\Entity\Intervenants;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Doctrine\ORM\EntityRepository;
use App\Entity\Modules;
use App\Entity\Classes;
use App\Entity\Codepostal;
use App\Entity\Villes;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormInterface;

class IntervenantsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom',TextType::class,[
                
                'label'=>false,
            ])
            ->add('prenom',TextType::class,[
                
                'label'=>false,
            ])
            ->add('adresse',TextType::class,[
                
                'label'=>false,
            ])
            ->add('telephone',TelType::class,[
                
                'label'=>false,
            ])
            ->add('email',EmailType::class,[
                
                'label'=>false,
            ])
            ->add('classes',EntityType::class, [
                'class' => Classes::class,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('u')
                        ->orderBy('u.nom', 'ASC');
                },
                'choice_label' => 'nom',
                'label'=>false,
                'placeholder'=>'',
                'autocomplete' => true,
            ])

            ->add('villes', EntityType::class, [
                'mapped' => false,
                'class' => Villes::class,
                'choice_label' => 'nom',
                'placeholder' => '',
                'label' => false,
                'required' => false,
              
            ])
     

            ->add('codepostale', ChoiceType::class, [
                'placeholder' => 'Département (Choisir une région)',
                'required' => false
            ])
            
            ->remove('created_at')
            ->remove('created_by')

            ->remove('modules', EntityType::class, [
                'mapped' => false,
                'class' => Modules::class,
                'choice_label' => 'nom',
                'placeholder' => '',
                'label' => false,
                'autocomplete' => true,
                'required' => false
            ])

       
        ;

        $formModifier = function (FormInterface $form, Villes $sport = null) {
            $positions = null === $sport ? [] : $sport->getCodepostale();

            $form->add('codepostale', EntityType::class, [
                'class' => Codepostal::class,
                'placeholder' => '',
                'choices' => $positions,
            ]);
        };

        $builder->addEventListener(
            FormEvents::PRE_SET_DATA,
            function (FormEvent $event) use ($formModifier) {
                // this would be your entity, i.e. SportMeetup
                $data = $event->getData();

                $formModifier($event->getForm(), $data->getCodepostale());
            }
        );

        $builder->get('villes')->addEventListener(
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
            'data_class' => Intervenants::class,
        ]);
    }
}
