<?php

namespace App\Entity;

use App\Repository\EntryRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EntryRepository::class)
 */
class Entry {

    public const CATEGORIES = [
        'nouns',
        'adjectives',
        'geographical names and demonyms',
    ];

    public const TYPE_OF_PRONOUN = [
        'personal (1st person sg. nom.)', 'personal (2nd person sg. nom.)', 'personal (3rd person sg. nom.)', 'personal (1st person pl. nom.)', 'personal (2nd person pl. nom.)',
        'personal (3rd person pl. nom.)', 'personal (1st person sg. acc.)', 'personal (2nd person sg. acc.)', 'personal (3rd person sg. acc.)', 'personal (1st person pl. acc.)',
        'personal (2nd person pl. acc.)', 'personal (3rd person pl. acc.)', 'personal (1st person sg. gen.)', 'personal (2nd person sg. gen.)', 'personal (3rd person sg. gen.)',
        'personal (1st person pl. gen.)', 'personal (2nd person pl. gen.)', 'personal (3rd person pl. gen.)', 'personal (1st person sg. dat.)', 'personal (2nd person sg. dat.)',
        'personal (3rd person sg. dat.)', 'personal (1st person pl. dat.)', 'personal (2nd person pl. dat.)', 'personal (3rd person pl. dat.)',
        'indefinite', 'demonstrative', 'reflexive', 'reciprocal', 'relative', 'interrogative', 'other',
    ];

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
}
