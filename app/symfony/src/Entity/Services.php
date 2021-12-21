<?php

namespace App\Entity;

use App\Entity\Traits\PresentationAndServiceTrait;
use App\Repository\ServicesRepository;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ServicesRepository::class)
 */
class Services
{
    use PresentationAndServiceTrait;
    /**
     * @ORM\OneToMany(targetEntity=Media::class, mappedBy="services", cascade={"persist"})
     * @ORM\JoinColumn(nullable=true)
     */
    private $medias;
    public function __construct()
    {
        $this->medias = new ArrayCollection();
    }

    /**
     * @return Collection|Media[]
     */
    public function getMedias(): Collection
    {
        return $this->medias;
    }

    public function addMedia(Media $media): self
    {
        if (!$this->medias->contains($media)) {
            $this->medias[] = $media;
            $media->setServices($this);
        }

        return $this;
    }

    public function removeMedia(Media $media): self
    {
        if ($this->medias->removeElement($media)) {
            // set the owning side to null (unless already changed)
            if ($media->getServices() === $this) {
                $media->setServices(null);
            }
        }

        return $this;
    }


}
