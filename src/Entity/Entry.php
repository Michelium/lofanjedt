<?php

namespace App\Entity;

use App\Repository\EntryRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EntryRepository::class)]
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

    #[ORM\Id]
    #[ORM\Column(type: "integer")]
    #[ORM\GeneratedValue]
    private int $id;

    #[ORM\ManyToOne(inversedBy: 'entries')]
    private Language $language;

    #[ORM\Column(type: "datetime")]
    private \DateTime $created_at;

    #[ORM\Column(type: "datetime", nullable: true)]
    private \DateTime $modified_at;

    #[ORM\Column(type: "integer")]
    private int $view_status = 5;

    #[ORM\Column(type: "string", length: 255)]
    private ?string $category;

    #[ORM\Column(type: "string", length: 255, nullable: true)]
    private ?string $base_form = null;

    #[ORM\Column(type: "string", length: 255, nullable: true)]
    private ?string $base_form_ipa = null;

    #[ORM\Column(type: "string", length: 255, nullable: true)]
    private ?string $countability = null;

    #[ORM\Column(type: "string", length: 255, nullable: true)]
    private ?string $plural_form = null;

    #[ORM\Column(type: "string", length: 255, nullable: true)]
    private ?string $plural_form_ipa = null;

    #[ORM\Column(type: "string", length: 255, nullable: true)]
    private ?string $equivalent_english = null;

    #[ORM\Column(type: "string", length: 255, nullable: true)]
    private ?string $definition_english = null;

    #[ORM\Column(type: "string", length: 255, nullable: true)]
    private ?string $equivalent_other_languages = null;

    #[ORM\Column(type: "string", length: 255, nullable: true)]
    private ?string $additional_information = null;

    #[ORM\Column(type: "string", length: 255, nullable: true)]
    private ?string $dialect = null;

    #[ORM\Column(type: "string", length: 255, nullable: true)]
    private ?string $etymology = null;

    #[ORM\Column(type: "string", length: 255, nullable: true)]
    private ?string $infinitive = null;

    #[ORM\Column(type: "string", length: 255, nullable: true)]
    private ?string $infinitive_ipa = null;

    #[ORM\Column(type: "string", length: 255, nullable: true)]
    private ?string $transitivity = null;

    #[ORM\Column(type: "string", length: 255, nullable: true)]
    private ?string $conjugation = null;

    #[ORM\Column(type: "string", length: 255, nullable: true)]
    private ?string $definiteness = null;

    #[ORM\Column(type: "string", length: 255, nullable: true)]
    private ?string $meaning = null;

    #[ORM\Column(type: "string", length: 255, nullable: true)]
    private ?string $gender = null;

    #[ORM\Column(type: "string", length: 255, nullable: true)]
    private ?string $literal_meaning_english = null;

    #[ORM\Column(type: "string", length: 255, nullable: true)]
    private ?string $pronouns_type = null;

    #[ORM\Column(type: "string", length: 255, nullable: true)]
    private ?string $conjunctions_type = null;

    #[ORM\Column(type: "string", length: 255, nullable: true)]
    private ?string $adpositions_type = null;

    #[ORM\Column(type: "string", length: 255, nullable: true)]
    private ?string $numerals_type = null;

    #[ORM\Column(type: "string", length: 255, nullable: true)]
    private ?string $affixes_type = null;

    #[ORM\Column(type: "string", length: 255, nullable: true)]
    private ?string $part_of_speech = null;

    #[ORM\Column(type: "string", length: 255, nullable: true)]
    private ?string $verbal_roots = null;

    public function __construct() {
        $this->created_at = new \DateTime('now');
    }

    public function getId(): int {
        return $this->id;
    }

    public function setId(int $id): Entry {
        $this->id = $id;
        return $this;
    }
    
    public function getLanguage(): ?Language {
        return $this->language;
    }

    public function setLanguage(?Language $language): static {
        $this->language = $language;

        return $this;
    }

    public function getCreatedAt(): \DateTime {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTime $created_at): Entry {
        $this->created_at = $created_at;
        return $this;
    }

    public function getModifiedAt(): \DateTime {
        return $this->modified_at;
    }

    public function setModifiedAt(\DateTime $modified_at): Entry {
        $this->modified_at = $modified_at;
        return $this;
    }

    public function getViewStatus(): int {
        return $this->view_status;
    }

    public function setViewStatus(int $view_status): Entry {
        $this->view_status = $view_status;
        return $this;
    }

    public function getCategory(): ?string {
        return $this->category;
    }

    public function setCategory(?string $category): Entry {
        $this->category = $category;
        return $this;
    }

    public function getBaseForm(): ?string {
        return $this->base_form;
    }

    public function setBaseForm(?string $base_form): Entry {
        $this->base_form = $base_form;
        return $this;
    }

    public function getBaseFormIpa(): ?string {
        return $this->base_form_ipa;
    }

    public function setBaseFormIpa(?string $base_form_ipa): Entry {
        $this->base_form_ipa = $base_form_ipa;
        return $this;
    }

    public function getCountability(): ?string {
        return $this->countability;
    }

    public function setCountability(?string $countability): Entry {
        $this->countability = $countability;
        return $this;
    }

    public function getPluralForm(): ?string {
        return $this->plural_form;
    }

    public function setPluralForm(?string $plural_form): Entry {
        $this->plural_form = $plural_form;
        return $this;
    }

    public function getPluralFormIpa(): ?string {
        return $this->plural_form_ipa;
    }

    public function setPluralFormIpa(?string $plural_form_ipa): Entry {
        $this->plural_form_ipa = $plural_form_ipa;
        return $this;
    }

    public function getEquivalentEnglish(): ?string {
        return $this->equivalent_english;
    }

    public function setEquivalentEnglish(?string $equivalent_english): Entry {
        $this->equivalent_english = $equivalent_english;
        return $this;
    }

    public function getDefinitionEnglish(): ?string {
        return $this->definition_english;
    }

    public function setDefinitionEnglish(?string $definition_english): Entry {
        $this->definition_english = $definition_english;
        return $this;
    }

    public function getEquivalentOtherLanguages(): ?string {
        return $this->equivalent_other_languages;
    }

    public function setEquivalentOtherLanguages(?string $equivalent_other_languages): Entry {
        $this->equivalent_other_languages = $equivalent_other_languages;
        return $this;
    }

    public function getAdditionalInformation(): ?string {
        return $this->additional_information;
    }

    public function setAdditionalInformation(?string $additional_information): Entry {
        $this->additional_information = $additional_information;
        return $this;
    }

    public function getDialect(): ?string {
        return $this->dialect;
    }

    public function setDialect(?string $dialect): Entry {
        $this->dialect = $dialect;
        return $this;
    }

    public function getEtymology(): ?string {
        return $this->etymology;
    }

    public function setEtymology(?string $etymology): Entry {
        $this->etymology = $etymology;
        return $this;
    }

    public function getInfinitive(): ?string {
        return $this->infinitive;
    }

    public function setInfinitive(?string $infinitive): Entry {
        $this->infinitive = $infinitive;
        return $this;
    }

    public function getInfinitiveIpa(): ?string {
        return $this->infinitive_ipa;
    }

    public function setInfinitiveIpa(?string $infinitive_ipa): Entry {
        $this->infinitive_ipa = $infinitive_ipa;
        return $this;
    }

    public function getTransitivity(): ?string {
        return $this->transitivity;
    }

    public function setTransitivity(?string $transitivity): Entry {
        $this->transitivity = $transitivity;
        return $this;
    }

    public function getConjugation(): ?string {
        return $this->conjugation;
    }

    public function setConjugation(?string $conjugation): Entry {
        $this->conjugation = $conjugation;
        return $this;
    }

    public function getDefiniteness(): ?string {
        return $this->definiteness;
    }

    public function setDefiniteness(?string $definiteness): Entry {
        $this->definiteness = $definiteness;
        return $this;
    }

    public function getMeaning(): ?string {
        return $this->meaning;
    }

    public function setMeaning(?string $meaning): Entry {
        $this->meaning = $meaning;
        return $this;
    }

    public function getGender(): ?string {
        return $this->gender;
    }

    public function setGender(?string $gender): Entry {
        $this->gender = $gender;
        return $this;
    }

    public function getLiteralMeaningEnglish(): ?string {
        return $this->literal_meaning_english;
    }

    public function setLiteralMeaningEnglish(?string $literal_meaning_english): Entry {
        $this->literal_meaning_english = $literal_meaning_english;
        return $this;
    }

    public function getPronounsType(): ?string {
        return $this->pronouns_type;
    }

    public function setPronounsType(?string $pronouns_type): Entry {
        $this->pronouns_type = $pronouns_type;
        return $this;
    }

    public function getConjunctionsType(): ?string {
        return $this->conjunctions_type;
    }

    public function setConjunctionsType(?string $conjunctions_type): Entry {
        $this->conjunctions_type = $conjunctions_type;
        return $this;
    }

    public function getAdpositionsType(): ?string {
        return $this->adpositions_type;
    }

    public function setAdpositionsType(?string $adpositions_type): Entry {
        $this->adpositions_type = $adpositions_type;
        return $this;
    }

    public function getNumeralsType(): ?string {
        return $this->numerals_type;
    }

    public function setNumeralsType(?string $numerals_type): Entry {
        $this->numerals_type = $numerals_type;
        return $this;
    }

    public function getAffixesType(): ?string {
        return $this->affixes_type;
    }

    public function setAffixesType(?string $affixes_type): Entry {
        $this->affixes_type = $affixes_type;
        return $this;
    }

    public function getPartOfSpeech(): ?string {
        return $this->part_of_speech;
    }

    public function setPartOfSpeech(?string $part_of_speech): Entry {
        $this->part_of_speech = $part_of_speech;
        return $this;
    }

    public function getVerbalRoots(): ?string {
        return $this->verbal_roots;
    }

    public function setVerbalRoots(?string $verbal_roots): Entry {
        $this->verbal_roots = $verbal_roots;
        return $this;
    }
}
