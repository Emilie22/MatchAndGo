<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @UniqueEntity(fields={"email"}, message="There is already an account with this email")
 */
class User implements UserInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $email;

    /**
     * @ORM\Column(type="array")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

    /* nouvelle propriété qui va stocker le mot de passe en clair lors de l'inscription
    *
    */
    private $plainPassword;

    /**
     * @ORM\Column(type="string", length=30)
     */
    private $firstname;

    /**
     * @ORM\Column(type="string", length=30)
     */
    private $lastname;

    /**
     * @ORM\Column(type="string", length=30)
     */
    private $city;

    /**
     * @ORM\Column(type="date")
     */
    private $birthday;

    /**
     * @ORM\Column(type="string", length=10)
     */
    private $gender;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $phone;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Image
     * 
     */
    private $picture;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\Column(type="text")
     */
    private $countries;

    /**
    * @ORM\ManyToMany(targetEntity="App\Entity\Answer", mappedBy="user")
    */
    private $answers;

    /**
    * @ORM\OneToMany(targetEntity="App\Entity\Chat", mappedBy="userSender")
    */
    private $chats;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Chat", mappedBy="user_id")
     */
    private $chat_id;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Chat", mappedBy="salon")
     */
    private $salon;

    public function __construct()
    {
        $this->chat_id = new ArrayCollection();
        $this->salon = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->email;
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

    public function getPlainPassword() :string
    {
        return (string) $this->plainPassword;
    }

    public function setPlainPassword(string $plainPassword) :self
    {
        $this->plainPassword = $plainPassword;

        return $this;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        // not needed when using the "bcrypt" algorithm in security.yaml
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        $this->plainPassword = null;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getBirthday(): ?\DateTimeInterface
    {
        return $this->birthday;
    }

    public function setBirthday(\DateTimeInterface $birthday): self
    {
        $this->birthday = $birthday;

        return $this;
    }

    public function getGender(): ?string
    {
        return $this->gender;
    }

    public function setGender(string $gender): self
    {
        $this->gender = $gender;

        return $this;
    }

    public function getPhone(): ?int
    {
        return $this->phone;
    }

    public function setPhone(?int $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    public function getPicture()
    {
        return $this->picture;
    }

    public function setPicture($picture)
    {
        $this->picture = $picture;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getCountries(): ?string
    {
        return $this->countries;
    }

    public function setCountries(string $countries): self
    {
        $this->countries = $countries;

        return $this;
    }

    /**
    * @return Collection|Answer[]
    */
    public function getAnswers(): Collection
   {
       return $this->answers;
   }

   public function addAnswer(Answer $answer): self
   {
       if (!$this->answers->contains($answer)) {
           $this->answers[] = $answer;
           $answer->addUser($this);
       }

       return $this;
   }

   public function removeAnswer(Answer $answer): self
   {
       if ($this->answers->contains($answer)) {
           $this->answers->removeElement($answer);
           $answer->removeUser($this);
       }

       return $this;
   }

   /**
    * @return Collection|Chat[]
    */
   public function getSalon(): Collection
   {
       return $this->salon;
   }

   public function addSalon(Chat $salon): self
   {
       if (!$this->salon->contains($salon)) {
           $this->salon[] = $salon;
           $salon->addSalon($this);

       }

       return $this;
   }

   public function removeSalon(Chat $salon): self
   {
       if ($this->salon->contains($salon)) {
           $this->salon->removeElement($salon);
           $salon->removeSalon($this);

       }

       return $this;
   }
}

   


