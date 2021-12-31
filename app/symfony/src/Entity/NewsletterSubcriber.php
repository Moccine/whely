<?php

namespace App\Entity;

use App\Entity\Traits\CreatedAtTrait;
use App\Entity\Traits\IdentifiableTrait;
use App\Entity\Traits\UpdatedAtTrait;
use App\Repository\NewsletterSubcriberRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=NewsletterSubcriberRepository::class)
 */
class NewsletterSubcriber
{
  use IdentifiableTrait;
  use CreatedAtTrait;
  use UpdatedAtTrait;

  /**
   * @ORM\Column(type="string", length=255)
   */
  private $name;

  /**
   * @ORM\Column(type="string", length=255, unique=true)
   */
  private ?string $email;

  /**
   * @ORM\Column(type="string", length=20, nullable=true)
   */
  private ?string $phone;

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

  public function getEmail(): ?string
  {
    return $this->email;
  }

  public function setEmail(string $email): self
  {
    $this->email = $email;

    return $this;
  }


  public function getPhone(): ?string {
    return $this->phone;
  }


  public function setPhone($phone): self
  {
    $this->phone = $phone;
    return $this;

  }

}
