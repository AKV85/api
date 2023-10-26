<?php

namespace App\Entity;

use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Put;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Delete;
use App\Repository\RoomRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\ApiResource;
use Carbon\Carbon;
use Symfony\Component\Serializer\Annotation\Groups;
use ApiPlatform\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Metadata\ApiFilter;
use ApiPlatform\Doctrine\Orm\Filter\RangeFilter;
use function Symfony\Component\String\u;
use Symfony\Component\Validator\Constraints as Assert;


#[ORM\Entity(repositoryClass: RoomRepository::class)]
#[ApiResource(
    normalizationContext: [
        "groups" => ["room:read"]
    ],
    denormalizationContext: [
        'groups' => ['room:write'],
    ],
    formats: [
        'jsonld',
        'json',
        'html',
        'jsonhal',
        'csv' => 'text/csv',
    ],
    paginationItemsPerPage: 10,
    description: 'Rooms for clients',
    operations: [
        new Get(),
        new GetCollection(),
        new Post(),
        new Put(),
        new Patch(),
        new Delete()
    ]
)]

class Room
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[Assert\NotBlank]
    #[Groups(['room:read', 'room:write'])]
    #[ORM\Column(length: 255)]
    #[ApiFilter(SearchFilter::class, strategy: 'partial')]
    private ?string $roomNumber = null;

    #[Assert\NotBlank]
    #[Groups(['room:read', 'room:write'])]
    #[ORM\Column(length: 255)]
    #[ApiFilter(SearchFilter::class, strategy: 'partial')]
    private ?string $roomHotelName = null;

    #[Assert\NotBlank]
    #[Groups(['room:read', 'room:write'])]
    #[ORM\Column(length: 255)]
    private ?string $status = null;

    #[Groups(['room:read', 'room:write'])]
    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[Groups(['room:read', 'room:write'])]
    #[ORM\Column]
    private ?\DateTimeImmutable $updatedAt = null;

    #[Assert\GreaterThanOrEqual(0)]
    #[Assert\LessThanOrEqual(4)]
    #[Assert\NotBlank]
    #[Groups(['room:read', 'room:write'])]
    #[ORM\Column]
    private ?int $freeBed = null;

    #[Assert\GreaterThanOrEqual(0)]
    #[Assert\LessThanOrEqual(4)]
    #[Assert\NotBlank]
    #[Groups(['room:read', 'room:write'])]
    #[ORM\Column]
    #[ApiFilter(RangeFilter::class)]
    private ?int $totalbeds = null;

    #[ORM\OneToMany(mappedBy: 'room', targetEntity: User::class)]
    private Collection $users;

    public function __construct(string $roomHotelName)
    {
        $this->roomHotelName = $roomHotelName;
        $this->createdAt = new \DateTimeImmutable();
        $this->users = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRoomNumber(): ?string
    {
        return $this->roomNumber;
    }

    public function setRoomNumber(string $roomNumber): static
    {
        $this->roomNumber = $roomNumber;

        return $this;
    }

    public function getRoomHotelName(): ?string
    {
        return $this->roomHotelName;
    }

    #[Groups(['room:read'])]
    public function getShortRoomHotelName(): string
    {
        return u($this->getRoomHotelName())->truncate(6, '...');
    }

    public function setRoomHotelName(string $roomHotelName): static
    {
        $this->roomHotelName = $roomHotelName;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): static
    {
        $this->status=$status;

        return $this;
    }

    

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeImmutable $updatedAt): static
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    #[Groups(['room:read'])]
    public function getUpdatedAtAgo(): string
    {
        return Carbon::instance($this->updatedAt)->diffForHumans();
    }

    public function getFreeBed(): ?int
    {
        return $this->freeBed;
    }

    public function setFreeBed(int $freeBed): static
    {
        $this->freeBed = $freeBed;

        return $this;
    }

    public function getTotalbeds(): ?int
    {
        return $this->totalbeds;
    }

    public function setTotalbeds(int $totalbeds): static
    {
        $this->totalbeds = $totalbeds;

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): self
    {
        if (!$this->users->contains($user)) {
            $this->users->add($user);
            $user->setRoom($this);
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        if ($this->users->removeElement($user)) {
            // set the owning side to null (unless already changed)
            if ($user->getRoom() === $this) {
                $user->setRoom(null);
            }
        }

        return $this;
    }

}
