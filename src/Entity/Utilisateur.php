<?php
namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Entity
 * @ORM\Table(name="Utilisateur")
 * @ApiResource
 */
class Utilisateur implements UserInterface
{


    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", unique=true)
     * @Assert\NotBlank()
     */
    private $login;

    /**
     * @ORM\Column(type="string" )
     * @Assert\NotBlank()
     * @Assert\Length(min=2, max=50)
     */
    private $nomUtilisateur;

    /**
     * @ORM\Column(type="string")
     * @Assert\NotBlank()
     * @Assert\Length(min=2, max=50)
     */
    private $prenomUtilisateur;

    /**
     * @ORM\Column(type="string", unique=true )
     * @Assert\Email()
     */
    private $email;

    /**
     * @ORM\Column(type="string")
     * @Assert\NotBlank()
     */
    private $password;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @ORM\OneToMany(targetEntity=CommentaireAtelier::class, mappedBy="proprietaire", orphanRemoval=true)
     */
    private $commentaireAteliers;

    /**
     * Utilisateur constructor.
     */
    public function __construct()
    {
        $this->id = -1;
        $this->login = "";
        $this->nomUtilisateur = "";
        $this->prenomUtilisateur = "";
        $this->email = "";
        $this->password = "";
        $this->roles = "";
        $this->commentaireAteliers = new ArrayCollection();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setLogin(string $login): void
    {
        $this->login = $login;
    }

    public function getLogin(): string
    {
        return $this->login;
    }

    public function getNomUtilisateur(): string
    {
        return $this->nomUtilisateur;
    }

    public function setNomUtilisateur(string $nomUtilisateur): void
    {
        $this->nomUtilisateur = $nomUtilisateur;
    }

    public function getPrenomUtilisateur(): string
    {
        return $this->prenomUtilisateur;
    }

    public function setPrenomUtilisateur(string $prenomUtilisateur): void
    {
        $this->prenomUtilisateur = $prenomUtilisateur;
    }


    /*
    * Méthode obligatoire pour répondre aux besoins de l'héritage à userInterface
    */
    public function getUserName(): string
    {
        return $this->login;
    }



    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    /*
    * Méhtode héritée de UserInterface
    */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    /*
    * Méhtode héritée de UserInterface
    */
    public function getRoles(): array
    {
        $roles = $this->roles;

// il est obligatoire d'avoir au moins un rôle si on est authentifié, par convention c'est ROLE_USER
        if (empty($roles)) {
            $roles[] = 'ROLE_USER';
        }

        return array_unique($roles);
    }

    public function setRoles(array $roles): void
    {
        $this->roles = $roles;
    }

    /*
    * Méhtode héritée de UserInterface
    */
    public function getSalt(): ?string
    {
        return null;
    }

    /*
    * Méhtode héritée de UserInterface
    */
    public function eraseCredentials(): void
    {
    }

    /**
     * @return Collection|CommentaireAtelier[]
     */
    public function getCommentaireAteliers(): Collection
    {
        return $this->commentaireAteliers;
    }

    public function addCommentaireAtelier(CommentaireAtelier $commentaireAtelier): self
    {
        if (!$this->commentaireAteliers->contains($commentaireAtelier)) {
            $this->commentaireAteliers[] = $commentaireAtelier;
            $commentaireAtelier->setProprietaire($this);
        }

        return $this;
    }

    public function removeCommentaireAtelier(CommentaireAtelier $commentaireAtelier): self
    {
        if ($this->commentaireAteliers->removeElement($commentaireAtelier)) {
            // set the owning side to null (unless already changed)
            if ($commentaireAtelier->getProprietaire() === $this) {
                $commentaireAtelier->setProprietaire(null);
            }
        }

        return $this;
    }
}