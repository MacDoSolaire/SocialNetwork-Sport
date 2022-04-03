<?php

namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use App\Repository\EvenementRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EvenementRepository::class)
 * @ORM\Table(name="evenement")
 */
class Evenement
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $adresse;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateDeb;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateFin;

    /**
     * @ORM\Column(type="integer")
     */
    private $visibilite;

    /**
     * @Assert\Positive()
     * @ORM\Column(type="integer")
     */
    private $nbPers;

    /**
     * @ORM\Column(type="integer")
     */
    private $signalement;

    /**
     * @ORM\Column(type="text")
     */
    private $message;

    /**
     * @ORM\OneToMany(targetEntity=EvenementLike::class, mappedBy="evenement")
     */
    private $evenementLikes;

    /**
     * @ORM\OneToMany(targetEntity=EvenementReply::class, mappedBy="evenement")
     */
    private $replies;

    /**
     * @ORM\ManyToOne(targetEntity=Membre::class, inversedBy="evenements")
     */
    private $membre;

    /**
     * @ORM\OneToMany(targetEntity=ParticiperEvent::class, mappedBy="evenement")
     */
    private $participations;

    /**
     * @ORM\ManyToMany(targetEntity=Activite::class, inversedBy="evenements")
     */
    private $activites;

    public function __construct()
    {
        $this->membres = new ArrayCollection();
        $this->evenementLikes = new ArrayCollection();
        $this->replies = new ArrayCollection();
        $this->participations = new ArrayCollection();
        $this->activites = new ArrayCollection();
        $this->dateDeb =  new \DateTime();
        $this->dateFin =  new \DateTime();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateDeb(): ?\DateTimeInterface
    {
        return $this->dateDeb;
    }

    public function setDateDeb(\DateTimeInterface $dateDeb): self
    {
        $this->dateDeb = $dateDeb;

        return $this;
    }

    public function getDateFin(): ?\DateTimeInterface
    {
        return $this->dateFin;
    }

    public function setDateFin(\DateTimeInterface $dateFin): self
    {
        $this->dateFin = $dateFin;

        return $this;
    }

    public function getVisibilite(): ?int
    {
        return $this->visibilite;
    }

    public function setVisibilite(int $visibilite): self
    {
        $this->visibilite = $visibilite;

        return $this;
    }

    public function getNbPers(): ?int
    {
        return $this->nbPers;
    }

    public function setNbPers(int $nbPers): self
    {
        $this->nbPers = $nbPers;

        return $this;
    }

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function setMessage(string $message): self
    {
        $this->message = $message;

        return $this;
    }

    /**
     * @return Collection|EvenementLike[]
     */
    public function getEvenementLikes(): Collection
    {
        return $this->evenementLikes;
    }

    public function addEvenementLike(EvenementLike $evenementLike): self
    {
        if (!$this->evenementLikes->contains($evenementLike)) {
            $this->evenementLikes[] = $evenementLike;
            $evenementLike->setEvenement($this);
        }

        return $this;
    }

    public function removeEvenementLike(EvenementLike $evenementLike): self
    {
        if ($this->evenementLikes->removeElement($evenementLike)) {
            // set the owning side to null (unless already changed)
            if ($evenementLike->getEvenement() === $this) {
                $evenementLike->setEvenement(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|EvenementReply[]
     */
    public function getReplies(): Collection
    {
        return $this->replies;
    }

    public function addReply(EvenementReply $reply): self
    {
        if (!$this->replies->contains($reply)) {
            $this->replies[] = $reply;
            $reply->setEvenement($this);
        }

        return $this;
    }

    public function removeReply(EvenementReply $reply): self
    {
        if ($this->replies->removeElement($reply)) {
            // set the owning side to null (unless already changed)
            if ($reply->getEvenement() === $this) {
                $reply->setEvenement(null);
            }
        }

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getMembre(): ?Membre
    {
        return $this->membre;
    }

    public function setMembre(?Membre $membre): self
    {
        $this->membre = $membre;

        return $this;
    }

    public function getSignalement(): ?int
    {
        return $this->signalement;
    }

    public function setSignalement(int $signalement): self
    {
        $this->signalement = $signalement;

        return $this;
    }

    public function isMemberParticipating(Membre $membre) : bool {
        foreach ($this->participations as $like) {
            if ($like->getMembre() === $membre) return true;

        }
        return false;
    }

    public function isLikedByMember(Membre $membre) : bool {
        foreach ($this->evenementLikes as $like) {
            if ($like->getMembre() === $membre) return true;

        }
        return false;
    }

    /**
     * @return Collection|ParticiperEvent[]
     */
    public function getParticipations(): Collection
    {
        return $this->participations;
    }

    public function addParticipation(ParticiperEvent $participation): self
    {
        if (!$this->participations->contains($participation)) {
            $this->participations[] = $participation;
            $participation->setEvenement($this);
        }

        return $this;
    }

    public function removeParticipation(ParticiperEvent $participation): self
    {
        if ($this->participations->removeElement($participation)) {
            // set the owning side to null (unless already changed)
            if ($participation->getEvenement() === $this) {
                $participation->setEvenement(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Activite[]
     */
    public function getActivites(): Collection
    {
        return $this->activites;
    }

    public function addActivite(Activite $activite): self
    {
        if (!$this->activites->contains($activite)) {
            $this->activites[] = $activite;
        }

        return $this;
    }

    public function removeActivite(Activite $activite): self
    {
        $this->activites->removeElement($activite);

        return $this;
    }
}
