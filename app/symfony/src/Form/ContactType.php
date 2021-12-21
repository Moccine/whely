<?php

namespace App\Form;

use App\Entity\Contact;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', null, [
                'label' => false,

                'attr' => [
                    'class' => 'input',
                    'placeholder' => 'Nom',
                    "data-delay" => "300"

                ]
            ])
            ->add('email', EmailType::class, [
                'label' => false,
                'attr' => [
                    'class' => 'input',
                    'placeholder' => 'Email',
                    "data-delay" => "300"

                ]
            ])
            ->add('phone', null, [
                'label' => false,
                'attr' => [
                    'class' => 'input',
                    'placeholder' => 'Télephone',
                    "data-delay" => "300"

                ]
            ])
            ->add('message', TextareaType::class, [
                'label' => false,
                'attr' => [
                    'class' => 'input',
                    'placeholder' => 'Message',
                    "data-delay" => "300"
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Contact::class,
        ]);
    }
}
