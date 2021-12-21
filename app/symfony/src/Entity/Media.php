<?php

declare(strict_types=1);

namespace App\Entity;

use App\Entity\Traits\CreatedAtTrait;
use App\Entity\Traits\IdentifiableTrait;
use App\Entity\Traits\UpdatedAtTrait;
use App\Repository\MediaRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Context\ExecutionContextInterface;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity(repositoryClass=MediaRepository::class)
 * @Vich\Uploadable
 */
class Media
{
    use IdentifiableTrait;
    use UpdatedAtTrait;
    use CreatedAtTrait;
    use UpdatedAtTrait;

    public const FILES_EXTENSIONS = [
        'jpeg',
        'jpg',
        'png',
        'pdf',
        'svg',
    ];
    public const PHOTOS = [
        'jpeg',
        'jpg',
        'png',
    ];

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private string $type;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private string $fileName;

    /**
     * @ORM\Column(type="integer")
     */
    private int $fileSize = 0;

    /**
     * @ORM\Column(type="string", length=255,  nullable=true)
     */
    private string $fileUrl;


    /**
     * @Assert\File(maxSize="10M")
     * @Vich\UploadableField(mapping="medias", fileNameProperty="image")
     */
    private ?File $file = null;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private ?string $image = null;


    /**
     * @ORM\Column(type="string", length=5, nullable=true)
     */
    private $extension;

    /**
     * @ORM\ManyToOne(targetEntity=Services::class, inversedBy="medias")
     * @ORM\JoinColumn(nullable=true, onDelete="SET NULL")
     */
    private $services;

    /**
     * @ORM\ManyToOne(targetEntity=News::class, inversedBy="medias")
     * @ORM\JoinColumn(nullable=true, onDelete="SET NULL")
     */
    private $news;

    /**
     * @ORM\ManyToOne(targetEntity=AboutDescription::class, inversedBy="medias")
     */
    private $aboutDescription;

    /**
     * @ORM\ManyToOne(targetEntity=CompanyHistory::class, inversedBy="media")
     */
    private $companyHistory;

    /**
     * @ORM\ManyToOne(targetEntity=OurTeam::class, inversedBy="media")
     */
    private $ourTeam;

    /**
     * @ORM\ManyToOne(targetEntity=Partner::class, inversedBy="medias")
     */
    private $partner;

    /**
     * @ORM\ManyToOne(targetEntity=Presentation::class, inversedBy="medias")
     */
    private $presentation;

    /**
     * Media constructor.
     */
    public function __construct()
    {
        $this->createdAt = new \DateTime();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(?string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getFileName(): ?string
    {
        return $this->fileName;
    }

    public function setFileName(string $fileName): self
    {
        $this->fileName = $fileName;

        return $this;
    }

    public function getFileSize(): ?int
    {
        return $this->fileSize;
    }

    public function setFileSize(int $fileSize): self
    {
        $this->fileSize = $fileSize;

        return $this;
    }

    public function getFileUrl(): ?string
    {
        return $this->fileUrl;
    }

    public function setFileUrl(string $fileUrl): self
    {
        $this->fileUrl = $fileUrl;

        return $this;
    }


    /**
     * @return mixed
     */
    public function getMediaCode()
    {
        return $this->MediaCode;
    }

    /**
     * @param mixed $MediaCode
     */
    public function setMediaCode($MediaCode): self
    {
        $this->MediaCode = $MediaCode;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getExtension()
    {
        return $this->extension;
    }

    /**
     * @param $extension
     *
     * @return $this
     */
    public function setExtension($extension): self
    {
        $this->extension = $extension;

        return $this;
    }

    public function getServices(): ?Services
    {
        return $this->services;
    }

    public function setServices(?Services $services): self
    {
        $this->services = $services;

        return $this;
    }

    public function getFile()
    {
        return $this->file;
    }

    public function setFile(File $image = null)
    {
        $this->file = $image;

        if ($image) {
            $this->updatedAt = new \DateTime('now');
        }
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage($image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getNews(): ?News
    {
        return $this->news;
    }

    public function setNews(?News $news): self
    {
        $this->news = $news;

        return $this;
    }

    public function getAboutDescription(): ?AboutDescription
    {
        return $this->aboutDescription;
    }

    public function setAboutDescription(?AboutDescription $aboutDescription): self
    {
        $this->aboutDescription = $aboutDescription;

        return $this;
    }

    public function getCompanyHistory(): ?CompanyHistory
    {
        return $this->companyHistory;
    }

    public function setCompanyHistory(?CompanyHistory $companyHistory): self
    {
        $this->companyHistory = $companyHistory;

        return $this;
    }

    public function getOurTeam(): ?OurTeam
    {
        return $this->ourTeam;
    }

    public function setOurTeam(?OurTeam $ourTeam): self
    {
        $this->ourTeam = $ourTeam;

        return $this;
    }

    public function getPartner(): ?Partner
    {
        return $this->partner;
    }

    public function setPartner(?Partner $partner): self
    {
        $this->partner = $partner;

        return $this;
    }

    public function getPresentation(): ?Presentation
    {
        return $this->presentation;
    }

    public function setPresentation(?Presentation $presentation): self
    {
        $this->presentation = $presentation;

        return $this;
    }

}
