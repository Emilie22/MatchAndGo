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
     * @ORM\ManyToMany(targetEntity="App\Entity\User", inversedBy="id_chats")
     */
    private $chat_id;

    public function __construct()
    {
        $this->chat_id = new ArrayCollection();
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
     * @return Collection|User[]
     */
    public function getChatId(): Collection
    {
        return $this->chat_id;
    }

    public function addChatId(User $chatId): self
    {
        if (!$this->chat_id->contains($chatId)) {
            $this->chat_id[] = $chatId;
        }

        return $this;
    }

    public function removeChatId(User $chatId): self
    {
        if ($this->chat_id->contains($chatId)) {
            $this->chat_id->removeElement($chatId);
        }

        return $this;
    }
}
