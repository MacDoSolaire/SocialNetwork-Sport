<?php

namespace App\Entity;

use App\Repository\MembreRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Vich\UploaderBundle\Entity\File as EmbeddedFile;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity(repositoryClass=MembreRepository::class)
 * @ORM\Table(name="membre")
 *  * @Vich\Uploadable
 * @UniqueEntity(fields={"mail"}, message="There is already an account with this mail")
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
     * @ORM\Embedded(class="Vich\UploaderBundle\Entity\File")
     * @ORM\Column(type="blob", nullable=true)
     */
    private  $avatar;

    /**
     * @ORM\ManyToMany(targetEntity=Conversation::class, inversedBy="membres")
     */
    private $conversations;

    /**
     * @ORM\OneToMany(targetEntity=MessagePrive::class, mappedBy="membre")
     */
    private $messagePrives;

    /**
     * @ORM\OneToMany(targetEntity=PublicationLike::class, mappedBy="membre")
     */
    private $likes;

    /**
     * @ORM\OneToMany(targetEntity=PublicationReply::class, mappedBy="membre")
     */
    private $replies;

    /**
     * @ORM\OneToMany(targetEntity=EvenementLike::class, mappedBy="membre")
     */
    private $likesEvenement;

    /**
     * @ORM\OneToMany(targetEntity=EvenementReply::class, mappedBy="membre")
     */
    private $repliesEvenement;

    /**
     * @ORM\OneToMany(targetEntity=Evenement::class, mappedBy="membre")
     */
    private $evenements;

    /**
     * @ORM\OneToMany(targetEntity=ParticiperEvent::class, mappedBy="membre")
     */
    private $participations;

    /**
     * @ORM\ManyToMany(targetEntity=Activite::class, inversedBy="membres")
     */
    private $activites;

    public function __construct()
    {
        $this->publication = new ArrayCollection();
        $this->evenement = new ArrayCollection();
        $this->conversations = new ArrayCollection();
        $this->messagePrives = new ArrayCollection();
        $this->likes = new ArrayCollection();
        $this->replies = new ArrayCollection();
        $this->likesEvenement = new ArrayCollection();
        $this->repliesEvenement = new ArrayCollection();
        $this->evenements = new ArrayCollection();
        $this->participations = new ArrayCollection();
        $this->activites = new ArrayCollection();
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

    public function getAvatar()
    {
        return $this->avatar;
    }

    public function setAvatar($avatar): self
    {
        $this->avatar = $avatar;

        return $this;
    }

    /**
     * @return Collection|Conversation[]
     */
    public function getConversations(): Collection
    {
        return $this->conversations;
    }

    public function addConversation(Conversation $conversation): self
    {
        if (!$this->conversations->contains($conversation)) {
            $this->conversations[] = $conversation;
        }

        return $this;
    }

    public function removeConversation(Conversation $conversation): self
    {
        $this->conversations->removeElement($conversation);

        return $this;
    }

    /**
     * @return Collection|MessagePrive[]
     */
    public function getMessagePrives(): Collection
    {
        return $this->messagePrives;
    }

    public function addMessagePrife(MessagePrive $messagePrife): self
    {
        if (!$this->messagePrives->contains($messagePrife)) {
            $this->messagePrives[] = $messagePrife;
            $messagePrife->setMembre($this);
        }

        return $this;
    }

    public function removeMessagePrife(MessagePrive $messagePrife): self
    {
        if ($this->messagePrives->removeElement($messagePrife)) {
            // set the owning side to null (unless already changed)
            if ($messagePrife->getMembre() === $this) {
                $messagePrife->setMembre(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|PublicationLike[]
     */
    public function getLikes(): Collection
    {
        return $this->likes;
    }

    public function addLike(PublicationLike $like): self
    {
        if (!$this->likes->contains($like)) {
            $this->likes[] = $like;
            $like->setMembre($this);
        }

        return $this;
    }

    public function removeLike(PublicationLike $like): self
    {
        if ($this->likes->removeElement($like)) {
            // set the owning side to null (unless already changed)
            if ($like->getMembre() === $this) {
                $like->setMembre(null);
            }
        }

        return $this;
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
            $reply->setMembre($this);
        }

        return $this;
    }

    public function removeReply(PublicationReply $reply): self
    {
        if ($this->replies->removeElement($reply)) {
            // set the owning side to null (unless already changed)
            if ($reply->getMembre() === $this) {
                $reply->setMembre(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|EvenementLike[]
     */
    public function getLikesEvenement(): Collection
    {
        return $this->likesEvenement;
    }

    public function addLikesEvenement(EvenementLike $likesEvenement): self
    {
        if (!$this->likesEvenement->contains($likesEvenement)) {
            $this->likesEvenement[] = $likesEvenement;
            $likesEvenement->setMembre($this);
        }

        return $this;
    }

    public function removeLikesEvenement(EvenementLike $likesEvenement): self
    {
        if ($this->likesEvenement->removeElement($likesEvenement)) {
            // set the owning side to null (unless already changed)
            if ($likesEvenement->getMembre() === $this) {
                $likesEvenement->setMembre(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|EvenementReply[]
     */
    public function getRepliesEvenement(): Collection
    {
        return $this->repliesEvenement;
    }

    public function addRepliesEvenement(EvenementReply $repliesEvenement): self
    {
        if (!$this->repliesEvenement->contains($repliesEvenement)) {
            $this->repliesEvenement[] = $repliesEvenement;
            $repliesEvenement->setMembre($this);
        }

        return $this;
    }

    public function removeRepliesEvenement(EvenementReply $repliesEvenement): self
    {
        if ($this->repliesEvenement->removeElement($repliesEvenement)) {
            // set the owning side to null (unless already changed)
            if ($repliesEvenement->getMembre() === $this) {
                $repliesEvenement->setMembre(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Evenement[]
     */
    public function getEvenements(): Collection
    {
        return $this->evenements;
    }

    public function addEvenement(Evenement $evenement): self
    {
        if (!$this->evenements->contains($evenement)) {
            $this->evenements[] = $evenement;
            $evenement->setMembre($this);
        }

        return $this;
    }

    public function removeEvenement(Evenement $evenement): self
    {
        if ($this->evenements->removeElement($evenement)) {
            // set the owning side to null (unless already changed)
            if ($evenement->getMembre() === $this) {
                $evenement->setMembre(null);
            }
        }

        return $this;
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
            $participation->setMembre($this);
        }

        return $this;
    }

    public function removeParticipation(ParticiperEvent $participation): self
    {
        if ($this->participations->removeElement($participation)) {
            // set the owning side to null (unless already changed)
            if ($participation->getMembre() === $this) {
                $participation->setMembre(null);
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
