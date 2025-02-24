<?php

namespace App\Form;

use App\Entity\Years;
use App\Entity\Builder;
use App\Entity\Aircraft;
use App\Entity\AircraftType as aircraftTypeEntity;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class AircraftType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class,[
                'label' => 'Nom : ',
                'attr' =>[
                    'class' => 'field-input form-control',    
                ],
                'row_attr' =>[
                    'class' => 'field'
                ] 
            ])
            ->add('description', TextareaType::class,[
                'label' => 'Description : ',
                'attr' =>[
                    'class' => 'form-text',    
                ],
                'row_attr' =>[
                    'class' => 'field'
                ] 
            ])
            ->add('picture', FileType::class,[
                'label' => 'Photo : ',
                'label_attr' =>[
                    'class' =>'drop-container',
                    'data-aircraft-target'=> 'dropcontainer'
                ],
                "mapped" => false,
                'data_class' => null,
                'attr' =>[
                    'class' => 'file-field',    
                ],
                'required' => false,
                'row_attr' =>[
                    'class' => 'field'
                ], 
                'constraints' => [
                    new File([
                        'maxSize' => '1024k',
                        'mimeTypes' => [
                            'image/jpeg',
                            'image/png',
                        ],
                       'mimeTypesMessage' => 'Merci de choisir un fichier image (jpeg ou png) de moins de 1Mo.',
                    ])
                ]
            ])
            ->add('type', EntityType::class, [
                'class' => AircraftTypeEntity::class,
                'choice_label' => 'name',
                'multiple' => true,
                'expanded' => true,
                'required' => true,
                'label' => "Type d'avion :",
                'attr' =>[
                    'class' => 'field-input',    
                ],
                'row_attr' =>[
                    'class' => 'field'
                ] 
            ])
            ->add('nbSeats', ChoiceType::class,[
                'choices' =>[
                    '1'=>1,
                    '2'=>2,
                    '3'=>3,
                    'Plus'=>4,
                ], 
                'required' => true,
                'mapped' => false,
                'label'=>'Nombre déquipage',
                'expanded' => true,
                'multiple' => false,
                'row_attr' =>[
                    'class' => 'field',    
                ],
            ])
            ->add('nbWings', ChoiceType::class,[
                'choices' =>[
                    'Monoplan'=>1,
                    'Biplan'=>2,
                    'Triplan'=>3,
                ], 
                'required' => true,
                'mapped' => false,
                'label'=>'Ailes',
                'expanded' => true,
                'multiple' => false,
                'row_attr' =>[
                    'class' => 'field',    
                ],
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
                    'class' => 'field-input form-control',    
                ],
                'row_attr' =>[
                    'class' => 'field'
                ] 
            ])
            ->add('fullDateOut', null, [
                'widget' => 'single_text',
                'label' => 'Date de retrait : ',
                'attr' =>[
                    'class' => 'field-input  form-control',    
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
