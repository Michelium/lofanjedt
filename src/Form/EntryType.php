<?php

namespace App\Form;

use App\Entity\Entry;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\ChoiceList\Loader\CallbackChoiceLoader;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Flex\Options;

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
                'choice_loader' => new CallbackChoiceLoader(function () use ($options) {
                    $choices = array_combine(Entry::TYPE_PRONOUNS, Entry::TYPE_PRONOUNS);
                    if ($options['data']->getPronounsType()) {
                        $choices[$options['data']->getPronounsType()] = $options['data']->getPronounsType();
                    }
                    return $choices;
                }),
                'attr' => [
                    'class' => 'select-2 select2-custom',
                ],
            ])
            ->add('conjunctionsType', ChoiceType::class, [
                'required' => true,
                'label' => 'type (conjunctions)',
                'choice_loader' => new CallbackChoiceLoader(function () use ($options) {
                    $choices = array_combine(Entry::TYPE_CONJUNCTIONS, Entry::TYPE_CONJUNCTIONS);
                    if ($options['data']->getConjunctionsType()) {
                        $choices[$options['data']->getConjunctionsType()] = $options['data']->getConjunctionsType();
                    }
                    return $choices;
                }),
                'attr' => [
                    'class' => 'select-2 select2-custom',
                ],
            ])
            ->add('verbalRoots', TextType::class, [
                'label' => 'verbal roots',
                'required' => false,
            ])
            ->add('adpositionsType', ChoiceType::class, [
                'required' => true,
                'label' => 'type (adpositions)',
                'choice_loader' => new CallbackChoiceLoader(function () use ($options) {
                    $choices = array_combine(Entry::TYPE_ADPOSITIONS, Entry::TYPE_ADPOSITIONS);
                    if ($options['data']->getAdpositionsType()) {
                        $choices[$options['data']->getAdpositionsType()] = $options['data']->getAdpositionsType();
                    }
                    return $choices;
                }),
                'attr' => [
                    'class' => 'select-2 select2-custom',
                ],
            ])
            ->add('numeralsType', ChoiceType::class, [
                'required' => true,
                'label' => 'type (numerals)',
                'choice_loader' => new CallbackChoiceLoader(function () use ($options) {
                    $choices = array_combine(Entry::TYPE_NUMERALS, Entry::TYPE_NUMERALS);
                    if ($options['data']->getNumeralsType()) {
                        $choices[$options['data']->getNumeralsType()] = $options['data']->getNumeralsType();
                    }
                    return $choices;
                }),
                'attr' => [
                    'class' => 'select-2 select2-custom',
                ],
            ])
            ->add('affixesType', ChoiceType::class, [
                'required' => true,
                'label' => 'type (affixes)',
                'choice_loader' => new CallbackChoiceLoader(function () use ($options) {
                    $choices = array_combine(Entry::TYPE_AFFIXES, Entry::TYPE_AFFIXES);
                    if ($options['data']->getAffixesType()) {
                        $choices[$options['data']->getAffixesType()] = $options['data']->getAffixesType();
                    }
                    return $choices;
                }),
                'attr' => [
                    'class' => 'select-2 select2-custom',
                ],
            ])
            ->add('countability', ChoiceType::class, [
                'label' => 'countability',
                'required' => false,
                'choice_loader' => new CallbackChoiceLoader(function () use ($options) {
                    $choices = array_combine(Entry::COUNTABILITY, Entry::COUNTABILITY);
                    if ($options['data']->getCountability()) {
                        $choices[$options['data']->getCountability()] = $options['data']->getCountability();
                    }
                    return $choices;
                }),
                'attr' => [
                    'class' => 'select-2 select2-custom',
                ],
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
                'choice_loader' => new CallbackChoiceLoader(function () use ($options) {
                    $choices = array_combine(Entry::TRANSITIVITY, Entry::TRANSITIVITY);
                    if ($options['data']->getTransitivity()) {
                        $choices[$options['data']->getTransitivity()] = $options['data']->getTransitivity();
                    }
                    return $choices;
                }),
                'attr' => [
                    'class' => 'select-2 select2-custom',
                ],
            ])
            ->add('conjugation', ChoiceType::class, [
                'label' => 'conjugation',
                'required' => false,
                'choice_loader' => new CallbackChoiceLoader(function () use ($options) {
                    $choices = array_combine(Entry::CONJUGATION, Entry::CONJUGATION);
                    if ($options['data']->getConjugation()) {
                        $choices[$options['data']->getConjugation()] = $options['data']->getConjugation();
                    }
                    return $choices;
                }),
                'attr' => [
                    'class' => 'select-2 select2-custom',
                ],
            ])
            ->add('definiteness', ChoiceType::class, [
                'label' => 'definiteness',
                'required' => false,
                'choice_loader' => new CallbackChoiceLoader(function () use ($options) {
                    $choices = array_combine(Entry::DEFINITENESS, Entry::DEFINITENESS);
                    if ($options['data']->getDefiniteness()) {
                        $choices[$options['data']->getDefiniteness()] = $options['data']->getDefiniteness();
                    }
                    return $choices;
                }),
                'attr' => [
                    'class' => 'select-2 select2-custom',
                ],
            ])
            ->add('meaning', TextType::class, [
                'label' => 'meaning',
                'required' => false,
            ])
            ->add('gender', ChoiceType::class, [
                'label' => 'gender',
                'required' => false,
                'choice_loader' => new CallbackChoiceLoader(function () use ($options) {
                    $choices = array_combine(Entry::GENDER, Entry::GENDER);
                    if ($options['data']->getGender()) {
                        $choices[$options['data']->getGender()] = $options['data']->getGender();
                    }
                    return $choices;
                }),
                'attr' => [
                    'class' => 'select-2 select2-custom',
                ],
            ])
            ->add('literalMeaningEnglish', TextType::class, [
                'label' => 'literal meaning in English',
                'required' => false,
            ])
            ->add('partOfSpeech', TextType::class, [
                'label' => 'part of speech',
                'required' => false,
            ]);

        $builder->get('pronounsType')->resetViewTransformers();
        $builder->get('conjunctionsType')->resetViewTransformers();
        $builder->get('adpositionsType')->resetViewTransformers();
        $builder->get('numeralsType')->resetViewTransformers();
        $builder->get('affixesType')->resetViewTransformers();
        $builder->get('countability')->resetViewTransformers();
        $builder->get('transitivity')->resetViewTransformers();
        $builder->get('conjugation')->resetViewTransformers();
        $builder->get('definiteness')->resetViewTransformers();
        $builder->get('gender')->resetViewTransformers();
    }

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults([
            'data_class' => Entry::class,
            'data' => null,
        ]);
    }
}
