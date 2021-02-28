<?php

namespace App\Entity;

use App\Repository\ChildRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ChildRepository::class)
 */
class Child
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $firstName;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $lastName;

    /**
     * @ORM\OneToMany(targetEntity=TopicDay::class, mappedBy="child")
     */
    private $topicDays;

    public function __construct()
    {
        $this->topicDays = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * @return Collection|TopicDay[]
     */
    public function getTopicDays(): Collection
    {
        return $this->topicDays;
    }

    public function addTopicDay(TopicDay $topicDay): self
    {
        if (!$this->topicDays->contains($topicDay)) {
            $this->topicDays[] = $topicDay;
            $topicDay->setChild($this);
        }

        return $this;
    }

    public function removeTopicDay(TopicDay $topicDay): self
    {
        if ($this->topicDays->removeElement($topicDay)) {
            // set the owning side to null (unless already changed)
            if ($topicDay->getChild() === $this) {
                $topicDay->setChild(null);
            }
        }

        return $this;
    }
}
