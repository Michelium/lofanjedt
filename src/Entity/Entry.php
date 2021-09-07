<?php

namespace App\Entity;

use App\Repository\EntryRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EntryRepository::class)
 */
class Entry {
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $term;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $ipa;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $ipa_plural;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $plural;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $part_of_speech;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $english;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $information;

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

    public function __construct() {
        $this->created_at = new \DateTime('now');
    }

    public function setId($id): void {
        $this->id = $id;
    }

    public function getId(): ?int {
        return $this->id;
    }

    public function getTerm(): ?string {
        return $this->term;
    }

    public function setTerm(string $term): self {
        $this->term = $term;

        return $this;
    }

    public function getIpa(): ?string {
        return $this->ipa;
    }

    public function setIpa(?string $ipa): self {
        $this->ipa = $ipa;

        return $this;
    }

    public function getIpaPlural(): ?string {
        return $this->ipa_plural;
    }

    public function setIpaPlural(?string $ipa_plural): self {
        $this->ipa_plural = $ipa_plural;

        return $this;
    }

    public function getPlural(): ?string {
        return $this->plural;
    }

    public function setPlural(?string $plural): self {
        $this->plural = $plural;

        return $this;
    }

    public function getPartOfSpeech(): ?string {
        return $this->part_of_speech;
    }

    public function setPartOfSpeech(?string $part_of_speech): self {
        $this->part_of_speech = $part_of_speech;

        return $this;
    }

    public function getEnglish(): ?string {
        return $this->english;
    }

    public function setEnglish(?string $english): self {
        $this->english = $english;

        return $this;
    }

    public function getInformation(): ?string {
        return $this->information;
    }

    public function setInformation(?string $information): self {
        $this->information = $information;

        return $this;
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
}
