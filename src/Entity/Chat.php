<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ChatRepository")
 */
class Chat
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;
    /**
     * @ORM\Column(type="string", length=255)
     */
    private $message;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date_send;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\user", inversedBy="salon")
     */
    private $salon;

    public function __construct()
    {
        $this->user_id = new ArrayCollection();
        $this->salon = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
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

    public function getDateSend(): ?\DateTimeInterface
    {
        return $this->date_send;
    }

    public function setDateSend(\DateTimeInterface $date_send): self
    {
        $this->date_send = $date_send;

        return $this;
    }

    /**
     * @return Collection|user[]
     */
    public function getSalon(): Collection
    {
        return $this->salon;
    }

    public function addSalon(user $salon): self
    {
        if (!$this->salon->contains($salon)) {
            $this->salon[] = $salon;
        }

        return $this;
    }
    public function removeSalon(user $salon): self
    {
        if ($this->salon->contains($salon)) {
            $this->salon->removeElement($salon);

        }

        return $this;
    }

    
}
