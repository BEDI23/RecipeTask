<?php

namespace App\Form;

use App\Entity\Ingrediant;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;


class IngredientType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class,[
                'attr' => [
                    'class'=>'form-control',
                    'minlength'=>'2',
                    'maxlength'=>'50'
                ],
                'label' => 'Nom',
                'label_attr' => [
                    'class' => 'from-label mt-4'
                ],
                'constraints'=>[
                    new Assert\Length(['min'=>2,'max'=>50
                    ]),
                    new Assert\NotBlank()
                    ]
            ])
            ->add('prix')
            ->add('submit')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Ingrediant::class,
        ]);
    }
}
