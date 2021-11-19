<?php

namespace App\Form;

use App\Entity\Entry;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
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
            ->add('baseForm', TextType::class, [
                'label' => 'base form',
                'required' => false,
            ])
            ->add('baseFormIpa', TextType::class, [
                'label' => 'base form IPA',
                'required' => false,
                'attr' => [
                    'class' => 'ipa-popup',
                    'data-bs-toggle' => "popover",
                    'data-bs-content' => '1',
                    'data-bs-placement' => 'bottom',
                    'data-bs-container' => 'body',
                ],
            ])
            ->add('pronounsType', ChoiceType::class, [
                'required' => true,
                'label' => 'type (pronouns)',
                'choices' => array_combine(Entry::TYPE_PRONOUNS, Entry::TYPE_PRONOUNS),
            ])
            ->add('conjunctionsType', ChoiceType::class, [
                'required' => true,
                'label' => 'type (conjunctions)',
                'choices' => array_combine(Entry::TYPE_CONJUNCTIONS, Entry::TYPE_CONJUNCTIONS),
            ])
            ->add('verbalRoots', TextType::class, [
                'label' => 'verbal roots',
                'required' => false,
            ])
            ->add('adpositionsType', ChoiceType::class, [
                'required' => true,
                'label' => 'type (adpositions)',
                'choices' => array_combine(Entry::TYPE_ADPOSITIONS, Entry::TYPE_ADPOSITIONS),
            ])
            ->add('numeralsType', ChoiceType::class, [
                'required' => true,
                'label' => 'type (numerals)',
                'choices' => array_combine(Entry::TYPE_NUMERALS, Entry::TYPE_NUMERALS),
            ])
            ->add('affixesType', ChoiceType::class, [
                'required' => true,
                'label' => 'type (affixes)',
                'choices' => array_combine(Entry::TYPE_AFFIXES, Entry::TYPE_AFFIXES),
            ])
            ->add('countability', ChoiceType::class, [
                'label' => 'countability',
                'required' => false,
                'choices' => array_combine(Entry::COUNTABILITY, Entry::COUNTABILITY),
            ])
            ->add('pluralForm', TextType::class, [
                'label' => 'plural form',
                'required' => false,
            ])
            ->add('pluralFormIpa', TextType::class, [
                'label' => 'plural form IPA',
                'required' => false,
                'attr' => [
                    'class' => 'ipa-popup',
                    'data-bs-toggle' => "popover",
                    'data-bs-content' => '1',
                    'data-bs-placement' => 'bottom',
                    'data-bs-container' => 'body',
                ],
            ])
            ->add('equivalentEnglish', TextType::class, [
                'label' => 'equivalent(s) in English',
                'required' => false,
            ])
            ->add('definitionEnglish', TextType::class, [
                'label' => 'definition in English',
                'required' => false,
            ])
            ->add('equivalentOtherLanguages', TextType::class, [
                'label' => 'equivalent(s) in other language(s)',
                'required' => false,
            ])
            ->add('additionalInformation', TextType::class, [
                'label' => 'additional information',
                'required' => false,
            ])
            ->add('dialect', TextType::class, [
                'label' => 'dialect',
                'required' => false,
            ])
            ->add('etymology', TextType::class, [
                'label' => 'etymology',
                'required' => false,
            ])
            ->add('infinitive', TextType::class, [
                'label' => 'infinitive',
                'required' => false,
            ])
            ->add('infinitiveIpa', TextType::class, [
                'label' => 'infinitive IPA',
                'required' => false,
            ])
            ->add('transitivity', ChoiceType::class, [
                'label' => 'transitivity',
                'required' => false,
                'choices' => array_combine(Entry::TRANSITIVITY, Entry::TRANSITIVITY),
            ])
            ->add('conjugation', ChoiceType::class, [
                'label' => 'conjugation',
                'required' => false,
                'choices' => array_combine(Entry::CONJUGATION, Entry::CONJUGATION),
            ])
            ->add('definiteness', ChoiceType::class, [
                'label' => 'definiteness',
                'required' => false,
                'choices' => array_combine(Entry::DEFINITENESS, Entry::DEFINITENESS),
            ])
            ->add('meaning', TextType::class, [
                'label' => 'meaning',
                'required' => false,
            ])
            ->add('gender', ChoiceType::class, [
                'label' => 'gender',
                'required' => false,
                'choices' => array_combine(Entry::GENDER, Entry::GENDER),
            ])
            ->add('literalMeaningEnglish', TextType::class, [
                'label' => 'literal meaning in English',
                'required' => false,
            ])
            ->add('partOfSpeech', TextType::class, [
                'label' => 'part of speech',
                'required' => false,
            ])
            ;
    }

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults([
            'data_class' => Entry::class,
        ]);
    }
}
