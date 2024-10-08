<?php

namespace App\Entity;

use App\Repository\EpisodeRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EpisodeRepository::class)]
class Episode
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'episodes')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Season $season = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column]
    private ?int $duration = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $releaseDateAt = null;

    #[ORM\Column]
    private ?int $episodeNumber = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $episodeDescription = null;

    #[ORM\Column(length: 255)]
    private ?string $episodeCoverImage = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSeason(): ?Season
    {
        return $this->season;
    }

    public function setSeason(?Season $season): static
    {
        $this->season = $season;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getDuration(): ?int
    {
        return $this->duration;
    }

    public function setDuration(int $duration): static
    {
        $this->duration = $duration;

        return $this;
    }

    public function getReleaseDateAt(): ?\DateTimeImmutable
    {
        return $this->releaseDateAt;
    }

    public function setReleaseDateAt(\DateTimeImmutable $releaseDateAt): static
    {
        $this->releaseDateAt = $releaseDateAt;

        return $this;
    }

    public function getEpisodeNumber(): ?int
    {
        return $this->episodeNumber;
    }

    public function setEpisodeNumber(int $episodeNumber): static
    {
        $this->episodeNumber = $episodeNumber;

        return $this;
    }

    public function getEpisodeDescription(): ?string
    {
        return $this->episodeDescription;
    }

    public function setEpisodeDescription(string $episodeDescription): static
    {
        $this->episodeDescription = $episodeDescription;

        return $this;
    }

    public function getEpisodeCoverImage(): ?string
    {
        return $this->episodeCoverImage;
    }

    public function setEpisodeCoverImage(string $episodeCoverImage): static
    {
        $this->episodeCoverImage = $episodeCoverImage;

        return $this;
    }
}
