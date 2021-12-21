<?php

namespace App\Form;

use App\Entity\RequestCallBack;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RequestCallBackType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', null,  [
                'label' => false,
                'attr' => [
                    'placeholder' => 'Nom'
                ]
            ])
            ->add('email', EmailType::class,  [
                'label' => false,
                'attr' => [
                    'placeholder' => 'Email'
                ]
            ])
            ->add('phone', NumberType::class, [
                'label' => false,
                'attr' => [
                    'placeholder' => 'Téléphone'
                ]
            ])
            ->add('subject', ChoiceType::class, [
                'label' => false,
                'attr' => [
                    'placeholder' => 'Objet de votre demande'
                ],
                'choices' => [
                    'Choisir votre objectif' => 'Choisir votre objectif',
                    'Etude de votre dossier' => 'Etude de votre dossier',
                    'Accompagnement' => 'Accompagnement',
                    'Autre' => 'Autre',
                ],
                'data' => 'Choisir votre objectif'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => RequestCallBack::class,
        ]);
    }
}
