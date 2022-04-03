<?php

namespace App\Entity;

use App\Repository\PublicationRepository;
use Doctrine\ORM\Mapping as ORM;

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
     */
    private $message;

    /**
     * @ORM\ManyToOne(targetEntity=Membre::class, inversedBy="publication")
     * @ORM\JoinColumn(nullable=false)
     */
    private $membre;

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
}
