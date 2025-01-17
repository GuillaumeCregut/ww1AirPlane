<?php

namespace App\Form;

use App\Entity\Builder;
use App\Entity\Country;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class BuilderType extends AbstractType
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
            ->add('country', EntityType::class, [
                'class' => Country::class,
                'label' => 'Constructeur',
                'choice_label' => 'name',
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
            'data_class' => Builder::class,
        ]);
    }
}
