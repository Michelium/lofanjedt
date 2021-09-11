<?php

namespace App\Form;

use App\Entity\Entry;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EntryType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
            ->add('category', ChoiceType::class, [
                'required' => true,
                'label' => 'category',
                'choices' => array_combine(Entry::CATEGORIES, Entry::CATEGORIES),
            ])
            ->add('term', TextType::class, [
                'label' => 'term',
                'required' => true,
            ])
            ->add('plural', TextType::class, [
                'label' => 'plural',
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
                'label' => 'part of speech',
                'required' => false,
            ])
            ->add('english', TextType::class, [
                'label' => 'equivalent(s) in English',
                'required' => false,
            ])
            ->add('information', TextareaType::class, [
                'label' => 'additional information',
                'required' => false,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults([
            'data_class' => Entry::class,
        ]);
    }
}
