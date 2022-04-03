<?php

namespace App\Entity;

use App\Repository\PublicationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=PublicationRepository::class)
 * @ORM\Table(name="publication")
 */
class Publication
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date;

    /**
     * @ORM\Column(type="integer")
     */
    private $visibilite;

    /**
     * @ORM\Column(type="integer")
     */
    private $signalement;

    /**
     * @ORM\Column(type="text")
     * @Assert\NotBlank(message="Ce champ ne peut pas etre vide.")
     */
    private $message;

    /**
     * @ORM\ManyToOne(targetEntity=Membre::class, inversedBy="publication")
     * @ORM\JoinColumn(nullable=false)
     */
    private $membre;

    /**
     * @ORM\OneToMany(targetEntity=PublicationLike::class, mappedBy="publication")
     */
    private $publicationLikes;

    /**
     * @ORM\OneToMany(targetEntity=PublicationReply::class, mappedBy="publication")
     */
    private $replies;

    public function __construct()
    {
        $this->publicationLikes = new ArrayCollection();
        $this->replies = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

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

    public function getSignalement(): ?int
    {
        return $this->signalement;
    }

    public function setSignalement(int $signalement): self
    {
        $this->signalement = $signalement;

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

    public function getMembre(): ?Membre
    {
        return $this->membre;
    }

    public function setMembre(?Membre $membre): self
    {
        $this->membre = $membre;

        return $this;
    }

    /**
     * @return Collection|PublicationLike[]
     */
    public function getPublicationLikes(): Collection
    {
        return $this->publicationLikes;
    }

    public function addPublicationLike(PublicationLike $publicationLike): self
    {
        if (!$this->publicationLikes->contains($publicationLike)) {
            $this->publicationLikes[] = $publicationLike;
            $publicationLike->setPublication($this);
        }

        return $this;
    }

    public function removePublicationLike(PublicationLike $publicationLike): self
    {
        if ($this->publicationLikes->removeElement($publicationLike)) {
            // set the owning side to null (unless already changed)
            if ($publicationLike->getPublication() === $this) {
                $publicationLike->setPublication(null);
            }
        }

        return $this;
    }

    public function isLikedByMember(Membre $membre) : bool {
        foreach ($this->publicationLikes as $like) {
            if ($like->getMembre() === $membre) return true;

        }
        return false;
    }

    /**
     * @return Collection|PublicationReply[]
     */
    public function getReplies(): Collection
    {
        return $this->replies;
    }

    public function addReply(PublicationReply $reply): self
    {
        if (!$this->replies->contains($reply)) {
            $this->replies[] = $reply;
            $reply->setPublication($this);
        }

        return $this;
    }

    public function removeReply(PublicationReply $reply): self
    {
        if ($this->replies->removeElement($reply)) {
            // set the owning side to null (unless already changed)
            if ($reply->getPublication() === $this) {
                $reply->setPublication(null);
            }
        }

        return $this;
    }
}
