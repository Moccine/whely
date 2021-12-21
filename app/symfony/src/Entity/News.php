<?php

namespace App\Entity;

use App\Entity\Traits\IdentifiableTrait;
use App\Entity\Traits\SlugTrait;
use App\Repository\NewsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Media;

/**
 * @ORM\Entity(repositoryClass=NewsRepository::class)
 */
class News
{

    use IdentifiableTrait;
    use SlugTrait;
    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $secondTitle;

    /**
     * @ORM\OneToMany(targetEntity=Media::class, mappedBy="news", cascade={"persist"})
     * @ORM\JoinColumn(nullable=true)
     */
    private $medias;

    /**
     * @ORM\Column(type="text")
     */
    private $content;

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private $elements = [];
    /**
     * @ORM\Column(type="text", length=100, nullable=true)
     */
    private $summary;

    public function __construct()
    {
        $this->medias = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getSecondTitle(): ?string
    {
        return $this->secondTitle;
    }

    public function setSecondTitle(string $secondTitle): self
    {
        $this->secondTitle = $secondTitle;

        return $this;
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
            $media->setNews($this);
        }

        return $this;
    }

    public function removeMedia(Media $media): self
    {
        if ($this->medias->removeElement($media)) {
            // set the owning side to null (unless already changed)
            if ($media->getNews() === $this) {
                $media->setNews(null);
            }
        }

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getElements(): ?array
    {
        return $this->elements;
    }

    public function setElements(array $elements): self
    {
        $this->elements = $elements;

        return $this;
    }
    public function __toString()
    {
        return $this->title;
    }

    /**
     * @return mixed
     */
    public function getSummary()
    {
        return  substr($this->summary, 0, 100);
    }

    /**
     * @param $summary
     * @return $this
     */
    public function setSummary($summary): self
    {
        $this->summary =  substr($summary, 0, 200);
        //$this->summary =  $summary;

        return $this;
    }
    public function getFirstMedia()
    {
        return $this->medias->first();
    }
}
