<?php

namespace App\Form;

use App\Entity\Entry;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EntryType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
            ->add('term', TextType::class, [
                'label' => 'Term',
                'required' => true,
            ])
            ->add('plural', TextType::class, [
                'label' => 'Plural',
                'required' => false,
            ])
            ->add('ipa', TextType::class, [
                'label' => 'IPA',
                'required' => false,
            ])
            ->add('ipa_plural', TextType::class, [
                'label' => 'IPA plural',
                'required' => false,
            ])
            ->add('part_of_speech', TextType::class, [
                'label' => 'Part of speech',
                'required' => false,
            ])
            ->add('english', TextType::class, [
                'label' => 'Equivalent(s) in English',
                'required' => false,
            ])
            ->add('information', TextareaType::class, [
                'label' => 'Additional information',
                'required' => false,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults([
            'data_class' => Entry::class,
        ]);
    }
}
