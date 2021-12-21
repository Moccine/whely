<?php


namespace App\Entity\Traits;


use App\Entity\Media;
use App\Entity\Services;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

trait PresentationAndServiceTrait
{
    use SluggableTrait;
    use IdentifiableTrait;
    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $secondTitle;



    /**
     * @ORM\Column(type="text")
     */
    private $content;

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private $elements = [];
    /**
     * @ORM\Column(type="text", length=6000, nullable=true)
     */
    private $summary;

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

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(?string $content): self
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
        return $this->summary;
    }

    /**
     * @param $summary
     * @return $this
     */
    public function setSummary($summary): self
    {
        $this->summary =  substr($summary, 0, 99);
        //$this->summary =  $summary;

        return $this;
    }
    public function getFirstMedia()
    {
        return $this->medias->first();
    }
}