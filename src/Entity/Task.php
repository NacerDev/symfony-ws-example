<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Topic\TopicModelInterface;

/**
 * @ORM\Table(name="tasks")
 * @ORM\Entity(repositoryClass="App\Repository\TaskRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Task implements TopicModelInterface
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
    private $title;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime")
     */
    private $updatedAt;

    public function getId() : ? int
    {
        return $this->id;
    }

    public function getTitle() : ? string
    {
        return $this->title;
    }

    public function setTitle(string $title) : self
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription() : ? string
    {
        return $this->description;
    }

    public function setDescription(string $description) : self
    {
        $this->description = $description;

        return $this;
    }

    public function getCreatedAt() : ? \DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt) : self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt() : ? \DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeInterface $updatedAt) : self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * @ORM\PrePersist
     */
    public function prePersist()
    {
        $this->createdAt = new \DateTime();
        $this->updatedAt = new \DateTime();
    }
    /**
     * @ORM\PreUpdate
     */
    public function preUpdate()
    {
        $this->updatedAt = new \DateTime();
    }





    public function toTopicModelArray(){
        return [
            "id"=>$this->id,
            "title"=>$this->title,
            "description"=>$this->description,
            "createdAt"=>$this->createdAt->format('Y-m-d H:i:s'),
            "updatedAt"=>$this->updatedAt->format('Y-m-d H:i:s')
        ];
    }
    public function getTopicModelName(){
        return 'Task';
    }
}
