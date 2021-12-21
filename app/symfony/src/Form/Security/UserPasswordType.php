<?php

declare(strict_types=1);

namespace App\Form\Security;

use App\Model\UserPassword;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserPasswordType extends AbstractType
{
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => UserPassword::class,
        ]);
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('currentPassword', PasswordType::class, [
                'label' => 'app.form.edit.oldPassword',
            ])
            ->add('newPassword', RepeatedType::class, [
                'label' => false,
                'type' => PasswordType::class,
                'invalid_message' => 'app.form.registration.password_not_identical',
                'first_options' => [
                    'label' => false,
                    'attr' => [
                        'placeholder' => 'app.form.edit.plainPassword',
                    ]
                ],
                'second_options' => [
                    'label' => false,
                    'attr' => [
                        'placeholder' => 'app.form.edit.secondPassword',
                    ]
                ],
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'app.form.registration.submit',
            ])
        ;
    }
}
