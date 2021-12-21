<?php

namespace App\Entity;

use App\Entity\Traits\CreatedAtTrait;
use App\Entity\Traits\IdentifiableTrait;
use App\Entity\Traits\SlugTrait;
use App\Entity\Traits\UpdatedAtTrait;
use App\Repository\CompanyHistoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CompanyHistoryRepository::class)
 */
class CompanyHistory
{

    use IdentifiableTrait;
    use SlugTrait;
    use CreatedAtTrait;
    use UpdatedAtTrait;
    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $title;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $historyDate;

    /**
     * @ORM\OneToMany(targetEntity=Media::class, mappedBy="companyHistory")
     */
    private $media;

    public function __construct()
    {
        $this->media = new ArrayCollection();
        $this->createdAt = new \DateTime();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(?string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getHistoryDate(): ?\DateTimeInterface
    {
        return $this->historyDate;
    }

    public function setHistoryDate(?\DateTimeInterface $historyDate): self
    {
        $this->historyDate = $historyDate;

        return $this;
    }

    /**
     * @return Collection|Media[]
     */
    public function getMedia(): Collection
    {
        return $this->media;
    }

    public function addMedium(Media $medium): self
    {
        if (!$this->media->contains($medium)) {
            $this->media[] = $medium;
            $medium->setCompanyHistory($this);
        }

        return $this;
    }

    public function removeMedium(Media $medium): self
    {
        if ($this->media->removeElement($medium)) {
            // set the owning side to null (unless already changed)
            if ($medium->getCompanyHistory() === $this) {
                $medium->setCompanyHistory(null);
            }
        }

        return $this;
    }
}
