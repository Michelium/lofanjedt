<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType {
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
            ->add('username', TextType::class, [
                'label' => 'Username',
            ])
            ->add('role', ChoiceType::class, [
                'mapped' => false,
                'label' => 'Role',
                'choices' => [
                    'user' => 'ROLE_USER',
                    'admin' => 'ROLE_ADMIN',
                ],
            ])
            ->add('plainPassword', RepeatedType::class, [
                'required' => false,
                'type' => PasswordType::class,
                'first_options' => ['label' => 'Password', 'required' => false,],
                'second_options' => ['label' => 'Repeat password', 'required' => false,],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
