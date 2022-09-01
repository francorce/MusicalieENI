<?php

namespace App\Form;

use App\Entity\Festival;
use App\Entity\Artiste;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;

class FestivalType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Nom')
            ->add('Lieu')
            ->add('photo', FileType::class, [
                'label' => 'photo',
                // unmapped means that this field is not associated to any entity property
                'mapped' => false,

                // make it optional so you don't have to re-upload the PDF file
                // every time you edit the Product details
                'required' => false,

                // unmapped fields can't define their validation using annotations
                // in the associated entity, so you can use the PHP constraint classes
                'constraints' => [
                    new File([
                        'maxSize' => '1024k',
                        'mimeTypes' => [
                            'image/jpg',
                            'image/png',
                            'image/jpeg',
                            'image/jfif',
                            'image/webp',
                            'image/gif',
                        ],
                        'mimeTypesMessage' => 'Please upload a valid PDF document',
                    ])
                ],
                'attr' => [
                    'accept' => '.jpg, .jpeg, .png, .gif, .webp',
                ],
            ])
            ->add('description')
            //->add('departement')
            ->add('artiste', EntityType::class,[
                'class' => 'App\Entity\Artiste',
                'choice_label' => function($artiste) {
                    return $artiste->getNomScene();
                },
                'multiple' => true,
                'expanded' => true
            ])
            ->add('departement', EntityType::class,[
                'class' => 'App\Entity\Departement',
                'choice_label' => function($departement) {
                    return $departement->getNom();
                },
                'multiple' => false,
                'expanded' => true
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Festival::class,
        ]);
    }
}
