<?php

namespace App\Entity;

use App\Entity\Traits\CreatedAtTrait;
use App\Entity\Traits\IdentifiableTrait;
use App\Entity\Traits\UpdatedAtTrait;
use App\Repository\ContactRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ContactRepository::class)
 * @ORM\HasLifecycleCallbacks()
 */
class Contact {
  use IdentifiableTrait;
  use CreatedAtTrait;
  use UpdatedAtTrait;

  /**
   * @ORM\Column(type="string", length=255)
   */
  private ?string $name;

  /**
   * @ORM\Column(type="string", length=255)
   */
  private ?string $email;

  /**
   * @ORM\Column(type="string", length=20, nullable=true)
   */
  private ?string $phone;

  /**
   * @ORM\Column(type="string", length=20, nullable=true)
   */
  private ?string $subject;

  /**
   * @ORM\Column(type="text", nullable=true)
   */
  private ?string $note;

  public function getName(): ?string {
    return $this->name;
  }

  public function setName(string $name): self {
    $this->name = $name;

    return $this;
  }

  public function getEmail(): ?string {
    return $this->email;
  }

  public function setEmail(string $email): self {
    $this->email = $email;

    return $this;
  }

  public function getPhone(): ?string {
    return $this->phone;
  }

  public function setPhone($phone): self {
    $this->phone = $phone;

    return $this;
  }

  /**
   * @return string|null
   */
  public function getSubject(): ?string {
    return $this->subject;
  }

  /**
   * @param string|null $subject
   * @return Contact
   */
  public function setSubject(?string $subject): self {
    $this->subject = $subject;

    return $this;

  }

  /**
   * @return string|null
   */
  public function getNote(): ?string {
    return $this->note;
  }

  /**
   * @param string|null $note
   * @return Contact
   */
  public function setNote(?string $note): self {
    $this->note = $note;

    return $this;
  }

}
