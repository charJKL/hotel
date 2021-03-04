<?php

namespace App\Entity;

use App\Repository\AccommodationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AccommodationRepository::class)
 */
class Accommodation
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer", options={"unsigned":true, "default":0})
     */
    private $status;

    /**
     * @ORM\Column(type="datetime")
     */
    private $checkInAt;

    /**
     * @ORM\Column(type="datetime")
     */
    private $checkOutAt;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $bookAt;

    /**
     * @ORM\Column(type="integer", options={"unsigned":true})
     */
    private $roomsAmount;

    /**
     * @ORM\Column(type="integer", options={"unsigned":true})
     */
    private $peopleAmount;
	 
	/**
	 * @ORM\ManyToMany(targetEntity="App\Entity\Room")
	 */
	private $rooms;
	
	/**
	 * @ORM\ManyToMany(targetEntity="App\Entity\Guest")
	 */ 
	private $guests;

    public function __construct()
    {
		$this->status = 0;
		$this->rooms = new ArrayCollection();
		$this->guests = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStatus(): ?int
    {
        return $this->status;
    }

    public function setStatus(int $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getCheckInAt(): ?\DateTimeInterface
    {
        return $this->checkInAt;
    }

    public function setCheckInAt(\DateTimeInterface $checkInAt): self
    {
        $this->checkInAt = $checkInAt;

        return $this;
    }

    public function getCheckOutAt(): ?\DateTimeInterface
    {
        return $this->checkOutAt;
    }

    public function setCheckOutAt(\DateTimeInterface $checkOutAt): self
    {
        $this->checkOutAt = $checkOutAt;

        return $this;
    }

    public function getBookAt(): ?\DateTimeInterface
    {
        return $this->bookAt;
    }

    public function setBookAt(\DateTimeInterface $bookAt): self
    {
        $this->bookAt = $bookAt;

        return $this;
    }

    public function getRoomsAmount(): ?int
    {
        return $this->roomsAmount;
    }

    public function setRoomsAmount(int $roomsAmount): self
    {
        $this->roomsAmount = $roomsAmount;

        return $this;
    }

    public function getPeopleAmount(): ?int
    {
        return $this->peopleAmount;
    }

    public function setPeopleAmount(int $peopleAmount): self
    {
        $this->peopleAmount = $peopleAmount;

        return $this;
    }

    /**
     * @return Collection|Room[]
     */
    public function getRooms(): Collection
    {
        return $this->rooms;
    }

    public function addRoom(Room $room): self
    {
        if (!$this->rooms->contains($room)) {
            $this->rooms[] = $room;
        }

        return $this;
    }

    public function removeRoom(Room $room): self
    {
        $this->rooms->removeElement($room);

        return $this;
    }

    /**
     * @return Collection|Guest[]
     */
    public function getGuests(): Collection
    {
        return $this->guests;
    }

    public function addGuest(Guest $guest): self
    {
        if (!$this->guests->contains($guest)) {
            $this->guests[] = $guest;
        }

        return $this;
    }

    public function removeGuest(Guest $guest): self
    {
        $this->guests->removeElement($guest);

        return $this;
    }
}
