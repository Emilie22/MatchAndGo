<?php

namespace App\Entity;

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
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="chats")
     */
    private $userSender;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="chats")
     */
    private $userGetter;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $message;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUserSender(): ?User
    {
        return $this->userSender;
    }

    public function setUserSender(?User $userSender): self
    {
        $this->userSender = $userSender;

        return $this;
    }

    public function getUserGetter(): ?User
    {
        return $this->userGetter;
    }

    public function setUserGetter(?User $userGetter): self
    {
        $this->userGetter = $userGetter;

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
}
