<?php

namespace Symfony5\Doctrine\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony5\Doctrine\Repository\DoctrineEventRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=DoctrineEventRepository::class)
 */
class Event
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
    private $name;

    /**
     * @ORM\Column(type="date")
     */
    private $date;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $location;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\ManyToMany(targetEntity=Artist::class, inversedBy="events")
     * @ORM\JoinTable(name="event_artist")
     */
    private $attendees;

    public function __construct()
    {
        $this->attendees = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
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

    public function getLocation(): ?string
    {
        return $this->location;
    }

    public function setLocation(string $location): self
    {
        $this->location = $location;

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

    /**
     * @return Collection|Artist[]
     */
    public function getAttendees(): Collection
    {
        return $this->attendees;
    }

    public function getAttendee(): array
    {
        $attendee_list = array();

        /** @var Artist $attendee */
        foreach ( $this->attendees as $attendee) {
            $attendee_list[] = [
                'id' => $attendee->getId(),
                'name' => $attendee->getName(),
                'description' => $attendee->getDescription()
            ];
        }

        return $attendee_list;
    }

    public function addAttendee(Artist $attendee): self
    {
        if (!$this->attendees->contains($attendee)) {
            $this->attendees[] = $attendee;
        }

        return $this;
    }

    public function removeAttendee(Artist $attendee): self
    {
        $this->attendees->removeElement($attendee);

        return $this;
    }

    public function removeAllAttendees(): void
    {
        $this->attendees = new ArrayCollection();
    }
}
