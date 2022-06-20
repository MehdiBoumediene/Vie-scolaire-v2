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
            ->add('nom',TextType::class)
            ->add('prenom',TextType::class)
            ->add('adresse',TextType::class)
            ->add('telephone',TelType::class)
            ->add('email',EmailType::class)
            ->add('classes',EntityType::class, [
                'class' => Classes::class,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('u')
                        ->orderBy('u.nom', 'ASC');
                },
                'choice_label' => 'nom',
                'placeholder'=>'',
            ])

            ->add('villes', EntityType::class, [
                'mapped' => false,
                'class' => Villes::class,
                'choice_label' => 'nom',
                'placeholder' => '',
                'label' => 'Ville',
                'required' => false
            ])

            ->add('codepostale', ChoiceType::class, [
                'placeholder' => '',
                'label'=> 'Code postal',
                'required' => false
            ])
            ->remove('created_at')
            ->remove('created_by')

            ->add('modules', EntityType::class, [
                'mapped' => false,
                'class' => Modules::class,
                'choice_label' => 'nom',
                'placeholder' => '',
                'label' => 'Module',
                'required' => false
            ])

       
        ;

        $formModifier = function (FormInterface $form, Villes $villes = null) {
            $codepostal = null === $villes ? [] : $villes->getCodepostale();

            $form->add('codepostale', EntityType::class, [
                'class' => Codepostal::class,
                'choices' => $codepostal,
                'required' => false,
                'choice_label' => 'name',
                'placeholder' => '',
                'attr' => ['class' => 'custom-select'],
                'label' => 'Code postal'
            ]);
        };

        $builder->get('villes')->addEventListener(
            FormEvents::POST_SUBMIT,
            function (FormEvent $event) use ($formModifier) {
                $ville = $event->getForm()->getData();
                $formModifier($event->getForm()->getParent(), $ville);
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
