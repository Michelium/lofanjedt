<?php

namespace App\Entity;

use App\Repository\EntryRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EntryRepository::class)
 */
class Entry {

    // This categories array is also used in the API call that returns categories
    public const CATEGORIES = [
        'nouns',
        'adjectives',
        'toponyms',
        'demonyms',
        'verbs',
        'articles',
        'pronouns',
        'conjunctions',
        'adverbs',
        'adpositions',
        'numerals',
        'interjections',
        'affixes',
        'phrases',
        'names',
        'Daitic (obsolete)',
        'Codian (obsolete)',
    ];

    public const FIELDS = [
        'nouns' => ['baseForm', 'baseFormIpa', 'countability', 'pluralForm', 'pluralFormIpa', 'equivalentEnglish', 'definitionEnglish', 'equivalentOtherLanguages', 'additionalInformation', 'dialect', 'etymology'],
        'adjectives' => ['baseForm', 'baseFormIpa', 'pluralForm', 'pluralFormIpa', 'equivalentEnglish', 'definitionEnglish', 'equivalentOtherLanguages', 'additionalInformation', 'dialect', 'etymology'],
        'toponyms' => ['baseForm', 'baseFormIpa', 'equivalentEnglish', 'definitionEnglish', 'equivalentOtherLanguages', 'additionalInformation', 'dialect', 'etymology'],
        'demonyms' => ['baseForm', 'baseFormIpa', 'pluralForm', 'pluralFormIpa', 'equivalentEnglish', 'definitionEnglish', 'equivalentOtherLanguages', 'additionalInformation', 'dialect', 'etymology'],
        'verbs' => ['infinitive', 'infinitiveIpa', 'transitivity', 'conjugation', 'verbalRoots', 'equivalentEnglish', 'definitionEnglish', 'equivalentOtherLanguages', 'additionalInformation', 'dialect', 'etymology'],
        'articles' => ['baseForm', 'baseFormIpa', 'definiteness', 'pluralForm', 'pluralFormIpa', 'equivalentEnglish', 'definitionEnglish', 'equivalentOtherLanguages', 'additionalInformation', 'dialect', 'etymology'],
        'pronouns' => ['baseForm', 'baseFormIpa', 'pronounsType', 'equivalentEnglish', 'definitionEnglish', 'equivalentOtherLanguages', 'additionalInformation', 'dialect', 'etymology'],
        'conjunctions' => ['baseForm', 'baseFormIpa', 'conjunctionsType', 'equivalentEnglish', 'definitionEnglish', 'equivalentOtherLanguages', 'additionalInformation', 'dialect', 'etymology'],
        'adverbs' => ['baseForm', 'baseFormIpa', 'equivalentEnglish', 'definitionEnglish', 'equivalentOtherLanguages', 'additionalInformation', 'dialect', 'etymology'],
        'adpositions' => ['baseForm', 'baseFormIpa', 'adpositionsType', 'equivalentEnglish', 'definitionEnglish', 'equivalentOtherLanguages', 'additionalInformation', 'dialect', 'etymology'],
        'numerals' => ['baseForm', 'baseFormIpa', 'numeralsType', 'equivalentEnglish', 'definitionEnglish', 'equivalentOtherLanguages', 'additionalInformation', 'dialect', 'etymology'],
        'interjections' => ['baseForm', 'baseFormIpa', 'equivalentEnglish', 'definitionEnglish', 'equivalentOtherLanguages', 'additionalInformation', 'dialect', 'etymology'],
        'affixes' => ['baseForm', 'baseFormIpa', 'affixesType', 'pluralForm', 'pluralFormIpa', 'meaning', 'equivalentEnglish', 'definitionEnglish', 'equivalentOtherLanguages', 'additionalInformation', 'dialect', 'etymology'],
        'phrases' => ['baseForm', 'baseFormIpa', 'equivalentEnglish', 'definitionEnglish', 'equivalentOtherLanguages', 'additionalInformation', 'dialect', 'etymology'],
        'names' => ['baseForm', 'baseFormIpa', 'gender', 'literalMeaningEnglish', 'additionalInformation', 'dialect', 'etymology'],
        'Daitic (obsolete)' => ['baseForm', 'baseFormIpa', 'partOfSpeech', 'pluralForm', 'pluralFormIpa', 'equivalentEnglish', 'definitionEnglish', 'equivalentOtherLanguages', 'additionalInformation', 'dialect', 'etymology'],
        'Codian (obsolete)' => ['baseForm', 'baseFormIpa', 'partOfSpeech', 'pluralForm', 'pluralFormIpa', 'equivalentEnglish', 'definitionEnglish', 'equivalentOtherLanguages', 'additionalInformation', 'dialect', 'etymology'],
    ];

    public const HUMAN_FIELDS = [
        'nouns' => ['base form', 'base form IPA', 'countability', 'plural form', 'plural form IPA', 'equivalent English', 'definition English', 'equivalent other languages', 'additional information', 'dialect', 'etymology'],
        'adjectives' => ['base form', 'base form IPA', 'plural form', 'plural form IPA', 'equivalent english', 'definition English', 'equivalent other languages', 'additional information', 'dialect', 'etymology'],
        'toponyms' => ['base form', 'base form IPA', 'equivalent english', 'definition English', 'equivalent other languages', 'additional information', 'dialect', 'etymology'],
        'demonyms' => ['base form', 'base form IPA', 'plural form', 'plural form IPA', 'equivalent english', 'definition English', 'equivalent other languages', 'additional information', 'dialect', 'etymology'],
        'verbs' => ['infinitive', 'infinitive IPA', 'transitivity', 'conjugation', 'verbalRoots', 'equivalent english', 'definition English', 'equivalent other languages', 'additional information', 'dialect', 'etymology'],
        'articles' => ['base form', 'base form IPA', 'definiteness', 'plural form', 'plural form IPA', 'equivalent english', 'definition English', 'equivalent other languages', 'additional information', 'dialect', 'etymology'],
        'pronouns' => ['base form', 'base form IPA', 'pronounsType', 'equivalent english', 'definition English', 'equivalent other languages', 'additional information', 'dialect', 'etymology'],
        'conjunctions' => ['base form', 'base form IPA', 'conjunctions type', 'equivalent english', 'definition English', 'equivalent other languages', 'additional information', 'dialect', 'etymology'],
        'adverbs' => ['base form', 'base form IPA', 'equivalent english', 'definition English', 'equivalent other languages', 'additional information', 'dialect', 'etymology'],
        'adpositions' => ['base form', 'base form IPA', 'adpositionsType', 'equivalent english', 'definition English', 'equivalent other languages', 'additional information', 'dialect', 'etymology'],
        'numerals' => ['base form', 'base form IPA', 'numeralsType', 'equivalent english', 'definition English', 'equivalent other languages', 'additional information', 'dialect', 'etymology'],
        'interjections' => ['base form', 'base form IPA', 'equivalent english', 'definition English', 'equivalent other languages', 'additional information', 'dialect', 'etymology'],
        'affixes' => ['base form', 'base form IPA', 'affixesType', 'plural form', 'plural form IPA', 'meaning', 'equivalent english', 'definition English', 'equivalent other languages', 'additional information', 'dialect', 'etymology'],
        'phrases' => ['base form', 'base form IPA', 'equivalent english', 'definition English', 'equivalent other languages', 'additional information', 'dialect', 'etymology'],
        'names' => ['base form', 'base form IPA', 'gender', 'literal meaning English', 'additional information', 'dialect', 'etymology'],
        'Daitic (obsolete)' => ['base form', 'base form IPA', 'part of speech', 'plural form', 'plural form IPA', 'equivalent english', 'definition English', 'equivalent other languages', 'additional information', 'dialect', 'etymology'],
        'Codian (obsolete)' => ['base form', 'base form IPA', 'part of speech', 'plural form', 'plural form IPA', 'equivalent english', 'definition English', 'equivalent other languages', 'additional information', 'dialect', 'etymology'],
    ];

    public const TYPE_PRONOUNS = [
        'personal (1st person sg. nom.)', 'personal (2nd person sg. nom.)', 'personal (3rd person sg. nom.)', 'personal (1st person pl. nom.)', 'personal (2nd person pl. nom.)',
        'personal (3rd person pl. nom.)', 'personal (1st person sg. acc.)', 'personal (2nd person sg. acc.)', 'personal (3rd person sg. acc.)', 'personal (1st person pl. acc.)',
        'personal (2nd person pl. acc.)', 'personal (3rd person pl. acc.)', 'personal (1st person sg. gen.)', 'personal (2nd person sg. gen.)', 'personal (3rd person sg. gen.)',
        'personal (1st person pl. gen.)', 'personal (2nd person pl. gen.)', 'personal (3rd person pl. gen.)', 'personal (1st person sg. dat.)', 'personal (2nd person sg. dat.)',
        'personal (3rd person sg. dat.)', 'personal (1st person pl. dat.)', 'personal (2nd person pl. dat.)', 'personal (3rd person pl. dat.)', 'personal',
        'indefinite', 'demonstrative', 'reflexive', 'reciprocal', 'relative', 'interrogative', 'other',
    ];
    public const TYPE_CONJUNCTIONS = ['coordinating', 'temporal', 'correlative', 'subordinating'];
    public const TYPE_ADPOSITIONS = ['preposition', 'postposition'];
    public const TYPE_NUMERALS = ['cardinal', 'ordinal'];
    public const TYPE_AFFIXES = ['prefix', 'suffix', 'infix', 'circumfix'];

    public const COUNTABILITY = ['countable', 'uncountable'];
    public const DEFINITENESS = ['definite', 'indefinite'];
    public const TRANSITIVITY = ['transitive', 'intransitive', 'ambitransitive'];
    public const CONJUGATION = ['regular', 'regular + «xa»', 'irregular', 'impersonal'];
    public const GENDER = ['male', 'female'];

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $created_at;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $modified_at;

    /**
     * @ORM\Column(type="integer")
     */
    private $view_status = 5;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $category;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $base_form;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $base_form_ipa;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $countability;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $plural_form;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $plural_form_ipa;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $equivalent_english;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $definition_english;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $equivalent_other_languages;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $additional_information;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $dialect;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $etymology;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $infinitive;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $infinitive_ipa;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $transitivity;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $conjugation;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $definiteness;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $meaning;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $gender;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $literal_meaning_english;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $pronouns_type;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $conjunctions_type;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $adpositions_type;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $numerals_type;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $affixes_type;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $part_of_speech;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $verbal_roots;

    public function __construct() {
        $this->created_at = new \DateTime('now');
    }

    public function setId($id): void {
        $this->id = $id;
    }

    public function getId(): ?int {
        return $this->id;
    }

    public function getCreatedAt(): ?\DateTimeInterface {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeInterface $created_at): self {
        $this->created_at = $created_at;

        return $this;
    }

    public function getModifiedAt(): ?\DateTimeInterface {
        return $this->modified_at;
    }

    public function setModifiedAt(?\DateTimeInterface $modified_at): self {
        $this->modified_at = $modified_at;

        return $this;
    }

    public function getViewStatus(): ?int {
        return $this->view_status;
    }

    public function setViewStatus(int $view_status): self {
        $this->view_status = $view_status;

        return $this;
    }

    public function getCategory(): ?string {
        return $this->category;
    }

    public function setCategory(string $category): self {
        $this->category = $category;

        return $this;
    }

    public function getBaseForm(): ?string {
        return $this->base_form;
    }

    public function setBaseForm(?string $base_form): self {
        $this->base_form = $base_form;

        return $this;
    }

    public function getBaseFormIpa(): ?string {
        return $this->base_form_ipa;
    }

    public function setBaseFormIpa(?string $base_form_ipa): self {
        $this->base_form_ipa = $base_form_ipa;
        return $this;
    }

    public function getCountability() {
        return $this->countability;
    }

    public function setCountability($countability): void {
        $this->countability = $countability;
    }

    public function getPluralForm() {
        return $this->plural_form;
    }

    public function setPluralForm($plural_form): void {
        $this->plural_form = $plural_form;
    }

    public function getPluralFormIpa() {
        return $this->plural_form_ipa;
    }

    public function setPluralFormIpa($plural_form_ipa): void {
        $this->plural_form_ipa = $plural_form_ipa;
    }

    public function getEquivalentEnglish() {
        return $this->equivalent_english;
    }

    public function setEquivalentEnglish($equivalent_english): void {
        $this->equivalent_english = $equivalent_english;
    }

    public function getDefinitionEnglish() {
        return $this->definition_english;
    }

    public function setDefinitionEnglish($definition_english): void {
        $this->definition_english = $definition_english;
    }

    public function getEquivalentOtherLanguages() {
        return $this->equivalent_other_languages;
    }

    public function setEquivalentOtherLanguages($equivalent_other_languages): void {
        $this->equivalent_other_languages = $equivalent_other_languages;
    }

    public function getAdditionalInformation() {
        return $this->additional_information;
    }

    public function setAdditionalInformation($additional_information): void {
        $this->additional_information = $additional_information;
    }

    public function getDialect() {
        return $this->dialect;
    }

    public function setDialect($dialect): void {
        $this->dialect = $dialect;
    }

    public function getEtymology() {
        return $this->etymology;
    }

    public function setEtymology($etymology): void {
        $this->etymology = $etymology;
    }

    public function getInfinitive() {
        return $this->infinitive;
    }

    public function setInfinitive($infinitive): void {
        $this->infinitive = $infinitive;
    }

    public function getInfinitiveIpa() {
        return $this->infinitive_ipa;
    }

    public function setInfinitiveIpa($infinitive_ipa): void {
        $this->infinitive_ipa = $infinitive_ipa;
    }

    public function getTransitivity() {
        return $this->transitivity;
    }

    public function setTransitivity($transitivity): void {
        $this->transitivity = $transitivity;
    }

    public function getConjugation() {
        return $this->conjugation;
    }

    public function setConjugation($conjugation): void {
        $this->conjugation = $conjugation;
    }

    public function getDefiniteness() {
        return $this->definiteness;
    }

    public function setDefiniteness($definiteness): void {
        $this->definiteness = $definiteness;
    }

    public function getMeaning() {
        return $this->meaning;
    }

    public function setMeaning($meaning): void {
        $this->meaning = $meaning;
    }

    public function getGender() {
        return $this->gender;
    }

    public function setGender($gender): void {
        $this->gender = $gender;
    }

    public function getLiteralMeaningEnglish() {
        return $this->literal_meaning_english;
    }

    public function setLiteralMeaningEnglish($literal_meaning_english): void {
        $this->literal_meaning_english = $literal_meaning_english;
    }

    public function getPronounsType() {
        return $this->pronouns_type;
    }

    public function setPronounsType($pronouns_type): void {
        $this->pronouns_type = $pronouns_type;
    }

    public function getConjunctionsType() {
        return $this->conjunctions_type;
    }

    public function setConjunctionsType($conjunctions_type): void {
        $this->conjunctions_type = $conjunctions_type;
    }

    public function getAdpositionsType() {
        return $this->adpositions_type;
    }

    public function setAdpositionsType($adpositions_type): void {
        $this->adpositions_type = $adpositions_type;
    }

    public function getNumeralsType() {
        return $this->numerals_type;
    }

    public function setNumeralsType($numerals_type): void {
        $this->numerals_type = $numerals_type;
    }

    public function getAffixesType() {
        return $this->affixes_type;
    }

    public function setAffixesType($affixes_type): void {
        $this->affixes_type = $affixes_type;
    }

    public function getPartOfSpeech() {
        return $this->part_of_speech;
    }

    public function setPartOfSpeech($part_of_speech): void {
        $this->part_of_speech = $part_of_speech;
    }

    public function getVerbalRoots() {
        return $this->verbal_roots;
    }

    public function setVerbalRoots($verbal_roots): void {
        $this->verbal_roots = $verbal_roots;
    }
}
