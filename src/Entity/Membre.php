<?php

namespace App\Entity;

use App\Repository\MembreRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass=MembreRepository::class)
 * @ORM\Table(name="membre")
 */
class Membre implements UserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $mail;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $prenom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $ville;

    /**
     * @ORM\Column(type="integer")
     */
    private $cdPost;

    /**
     * @ORM\OneToMany(targetEntity=Publication::class, mappedBy="membre")
     */
    private $publication;

    /**
     * @ORM\ManyToMany(targetEntity=Evenement::class, inversedBy="membres")
     */
    private $evenement;

    /**
     * @ORM\ManyToMany(targetEntity=MessagePrive::class, inversedBy="membres")
     */
    private $messagePrive;

    /**
     * @ORM\OneToMany(targetEntity=Amitie::class, mappedBy="membre")
     */
    private $amitie;

    /**
     * @ORM\Column(type="blob")
     */
    private $avatar;

    public function __construct()
    {
        $this->publication = new ArrayCollection();
        $this->evenement = new ArrayCollection();
        $this->messagePrive = new ArrayCollection();
        $this->amitie = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMail(): ?string
    {
        return $this->mail;
    }

    public function setMail(string $mail): self
    {
        $this->mail = $mail;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->mail;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string) $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Returning a salt is only needed, if you are not using a modern
     * hashing algorithm (e.g. bcrypt or sodium) in your security.yaml.
     *
     * @see UserInterface
     */
    public function getSalt(): ?string
    {
        return null;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(string $ville): self
    {
        $this->ville = $ville;

        return $this;
    }

    public function getCdPost(): ?int
    {
        return $this->cdPost;
    }

    public function setCdPost(int $cdPost): self
    {
        $this->cdPost = $cdPost;

        return $this;
    }

    /**
     * @return Collection|Publication[]
     */
    public function getPublication(): Collection
    {
        return $this->publication;
    }

    public function addPublication(Publication $publication): self
    {
        if (!$this->publication->contains($publication)) {
            $this->publication[] = $publication;
            $publication->setMembre($this);
        }

        return $this;
    }

    public function removePublication(Publication $publication): self
    {
        if ($this->publication->removeElement($publication)) {
            // set the owning side to null (unless already changed)
            if ($publication->getMembre() === $this) {
                $publication->setMembre(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Evenement[]
     */
    public function getEvenement(): Collection
    {
        return $this->evenement;
    }

    public function addEvenement(Evenement $evenement): self
    {
        if (!$this->evenement->contains($evenement)) {
            $this->evenement[] = $evenement;
        }

        return $this;
    }

    public function removeEvenement(Evenement $evenement): self
    {
        $this->evenement->removeElement($evenement);

        return $this;
    }

    /**
     * @return Collection|MessagePrive[]
     */
    public function getMessagePrive(): Collection
    {
        return $this->messagePrive;
    }

    public function addMessagePrive(MessagePrive $messagePrive): self
    {
        if (!$this->messagePrive->contains($messagePrive)) {
            $this->messagePrive[] = $messagePrive;
        }

        return $this;
    }

    public function removeMessagePrive(MessagePrive $messagePrive): self
    {
        $this->messagePrive->removeElement($messagePrive);

        return $this;
    }

    /**
     * @return Collection|Amitie[]
     */
    public function getAmitie(): Collection
    {
        return $this->amitie;
    }

    public function addAmitie(Amitie $amitie): self
    {
        if (!$this->amitie->contains($amitie)) {
            $this->amitie[] = $amitie;
            $amitie->setMembre($this);
        }

        return $this;
    }

    public function removeAmitie(Amitie $amitie): self
    {
        if ($this->amitie->removeElement($amitie)) {
            // set the owning side to null (unless already changed)
            if ($amitie->getMembre() === $this) {
                $amitie->setMembre(null);
            }
        }

        return $this;
    }

    public function getAvatar()
    {
        return $this->avatar;
    }

    public function setAvatar($avatar): self
    {
        $this->avatar = $avatar;

        return $this;
    }
}
