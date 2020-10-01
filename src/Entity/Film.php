<?php

namespace App\Entity;

use App\Repository\FilmRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=FilmRepository::class)
 */
class Film
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $titre;

    /**
     * @ORM\Column(type="integer")
     */
    private $note;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $duree;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $type;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $dateDeSortie;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $classification;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $synopsis;

    /**
     * @ORM\Column(type="string", length=300, nullable=true)
     */
    private $videos;

    /**
     * @ORM\Column(type="json")
     */
    private $critiquesPresse;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $poster;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $nationalite;

    /**
     * @ORM\OneToMany(targetEntity=Commentaire::class, mappedBy="film", orphanRemoval=true)
     */
    private $commentaires;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $realisateurs;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $acteurs;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $trailer;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $seances;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $critiquesSpectateurs;

    /**
     * @ORM\Column(type="json", length=255, nullable=true)
     */
    private $photos;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $casting;

    /**
     * @ORM\Column(type="integer", unique=true)
     */
    private $codeAllocine;

    public function __construct()
    {
        $this->commentaires = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getNote(): ?int
    {
        return $this->note;
    }

    public function setNote(int $note): self
    {
        $this->note = $note;

        return $this;
    }

    public function getDuree(): ?string
    {
        return $this->duree;
    }

    public function setDuree(string $duree): self
    {
        $this->duree = $duree;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getDateDeSortie(): ?string
    {
        return $this->dateDeSortie;
    }

    public function setDateDeSortie(string $dateDeSortie): self
    {
        $this->dateDeSortie = $dateDeSortie;

        return $this;
    }

    public function getClassification(): ?string
    {
        return $this->classification;
    }

    public function setClassification(string $classification): self
    {
        $this->classification = $classification;

        return $this;
    }

    public function getSynopsis(): ?string
    {
        return $this->synopsis;
    }

    public function setSynopsis(string $synopsis): self
    {
        $this->synopsis = $synopsis;

        return $this;
    }

    public function getVideos(): ?string
    {
        return $this->videos;
    }

    public function setVideos(string $videos): self
    {
        $this->videos = $videos;

        return $this;
    }

    public function getCritiquesPresse(): ?array
    {
        return $this->critiquesPresse;
    }

    public function setCritiquesPresse(?array $critiquesPresse): self
    {
        $this->critiquesPresse = $critiquesPresse;

        return $this;
    }

    public function getPoster(): ?string
    {
        return $this->poster;
    }

    public function setPoster(string $poster): self
    {
        $this->poster = $poster;

        return $this;
    }

    public function getNationalite(): ?string
    {
        return $this->nationalite;
    }

    public function setNationalite(string $nationalite): self
    {
        $this->nationalite = $nationalite;

        return $this;
    }

    /**
     * @return Collection|Commentaire[]
     */
    public function getCommentaires(): Collection
    {
        return $this->commentaires;
    }

    public function addCommentaire(Commentaire $commentaire): self
    {
        if (!$this->commentaires->contains($commentaire)) {
            $this->commentaires[] = $commentaire;
            $commentaire->setFilm($this);
        }

        return $this;
    }

    public function removeCommentaire(Commentaire $commentaire): self
    {
        if ($this->commentaires->contains($commentaire)) {
            $this->commentaires->removeElement($commentaire);
            // set the owning side to null (unless already changed)
            if ($commentaire->getFilm() === $this) {
                $commentaire->setFilm(null);
            }
        }

        return $this;
    }

    public function getRealisateurs(): ?string
    {
        return $this->realisateurs;
    }

    public function setRealisateurs(?string $realisateurs): self
    {
        $this->realisateurs = $realisateurs;

        return $this;
    }

    public function getActeurs(): ?string
    {
        return $this->acteurs;
    }

    public function setActeurs(?string $acteurs): self
    {
        $this->acteurs = $acteurs;

        return $this;
    }

    public function getTrailer(): ?string
    {
        return $this->trailer;
    }

    public function setTrailer(?string $trailer): self
    {
        $this->trailer = $trailer;

        return $this;
    }

    public function getSeances(): ?string
    {
        return $this->seances;
    }

    public function setSeances(?string $seances): self
    {
        $this->seances = $seances;

        return $this;
    }

    public function getCritiquesSpectateurs(): ?string
    {
        return $this->critiquesSpectateurs;
    }

    public function setCritiquesSpectateurs(?string $critiquesSpectateurs): self
    {
        $this->critiquesSpectateurs = $critiquesSpectateurs;

        return $this;
    }

    public function getPhotos(): ?array
    {
        return $this->photos;
    }

    public function setPhotos(?array $photos): self
    {
        $this->photos = $photos;

        return $this;
    }

    public function getNo(): ?string
    {
        return $this->no;
    }

    public function setNo(string $no): self
    {
        $this->no = $no;

        return $this;
    }

    public function getCasting(): ?string
    {
        return $this->casting;
    }

    public function setCasting(?string $casting): self
    {
        $this->casting = $casting;

        return $this;
    }

    public function getCodeAllocine(): ?int
    {
        return $this->codeAllocine;
    }

    public function setCodeAllocine(int $codeAllocine): self
    {
        $this->codeAllocine = $codeAllocine;

        return $this;
    }

}
