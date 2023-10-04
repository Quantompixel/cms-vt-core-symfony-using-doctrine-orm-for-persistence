<?php

namespace App\Entity;

use App\Repository\MovieRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MovieRepository::class)]
class Movie
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $name = null;

    #[ORM\Column(nullable: true)]
    private ?int $releaseYear = null;

    #[ORM\OneToMany(mappedBy: 'movie', targetEntity: MovieQuote::class)]
    private Collection $movieQuotes;

    public function __construct()
    {
        $this->movieQuotes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getReleaseYear(): ?int
    {
        return $this->releaseYear;
    }

    public function setReleaseYear(?int $releaseYear): static
    {
        $this->releaseYear = $releaseYear;

        return $this;
    }

    /**
     * @return Collection<int, MovieQuote>
     */
    public function getMovieQuotes(): Collection
    {
        return $this->movieQuotes;
    }

    public function addMovieQuote(MovieQuote $movieQuote): static
    {
        if (!$this->movieQuotes->contains($movieQuote)) {
            $this->movieQuotes->add($movieQuote);
            $movieQuote->setMovie($this);
        }

        return $this;
    }

    public function removeMovieQuote(MovieQuote $movieQuote): static
    {
        if ($this->movieQuotes->removeElement($movieQuote)) {
            // set the owning side to null (unless already changed)
            if ($movieQuote->getMovie() === $this) {
                $movieQuote->setMovie(null);
            }
        }

        return $this;
    }
}
