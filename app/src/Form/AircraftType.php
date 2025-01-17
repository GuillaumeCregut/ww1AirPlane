<?php

namespace App\Form;

use App\Entity\Years;
use App\Entity\Builder;
use App\Entity\Aircraft;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class AircraftType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class,[
                'label' => 'Nom : ',
                'attr' =>[
                    'class' => 'field-input',    
                ],
                'row_attr' =>[
                    'class' => 'field'
                ] 
            ])
            ->add('builder', EntityType::class, [
                'class' => Builder::class,
                'choice_label' => 'name',
                'label' => 'Constructeur : ',
                'attr' =>[
                    'class' => 'field-input',    
                ],
                'row_attr' =>[
                    'class' => 'field'
                ] 
            ])
            ->add('fullDateIn', null, [
                'widget' => 'single_text',
                'label' => 'Date de mise en service : ',
                'attr' =>[
                    'class' => 'field-input',    
                ],
                'row_attr' =>[
                    'class' => 'field'
                ] 
            ])
            ->add('fullDateOut', null, [
                'widget' => 'single_text',
                'label' => 'Date de retrait : ',
                'attr' =>[
                    'class' => 'field-input',    
                ],
                'row_attr' =>[
                    'class' => 'field'
                ] 
            ])
            ->add('dateIn', EntityType::class, [
                'class' => Years::class,
                'choice_label' => 'name',
                'label' => 'Année de mise en service : ',
                'attr' =>[
                    'class' => 'field-input',    
                ],
                'row_attr' =>[
                    'class' => 'field'
                ] 
            ])
            ->add('yearOut', EntityType::class, [
                'class' => Years::class,
                'choice_label' => 'name',
                'label' => 'date de retrait: ',
                'attr' =>[
                    'class' => 'field-input',    
                ],
                'row_attr' =>[
                    'class' => 'field'
                ] 
            ])
            
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Aircraft::class,
        ]);
    }
}
