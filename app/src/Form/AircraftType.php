<?php

namespace App\Form;

use App\Entity\Aircraft;
use App\Entity\Builder;
use App\Entity\Years;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AircraftType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('fullDateIn', null, [
                'widget' => 'single_text',
            ])
            ->add('fullDateOut', null, [
                'widget' => 'single_text',
            ])
            ->add('dateIn', EntityType::class, [
                'class' => Years::class,
                'choice_label' => 'name',
            ])
            ->add('yearOut', EntityType::class, [
                'class' => Years::class,
                'choice_label' => 'name',
            ])
            ->add('builder', EntityType::class, [
                'class' => Builder::class,
                'choice_label' => 'name',
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
