<?php

namespace App\Entity;

use App\Entity\Traits\IdentifiableTrait;
use App\Entity\Traits\SlugTrait;
use App\Repository\StatisticsRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=StatisticsRepository::class)
 */
class Statistics
{
    use IdentifiableTrait;

    /**
     * @ORM\Column(type="integer")
     */
    private $client;

    /**
     * @ORM\Column(type="integer")
     */
    private $employees;

    /**
     * @ORM\Column(type="integer")
     */
    private $satistifiedCustomer;

    /**
     * @ORM\Column(type="integer")
     */
    private $satisfaction;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getClient(): ?int
    {
        return $this->client;
    }

    public function setClient(int $client): self
    {
        $this->client = $client;

        return $this;
    }

    public function getEmployees(): ?int
    {
        return $this->employees;
    }

    public function setEmployees(int $employees): self
    {
        $this->employees = $employees;

        return $this;
    }

    public function getSatistifiedCustomer(): ?int
    {
        return $this->satistifiedCustomer;
    }

    public function setSatistifiedCustomer(int $satistifiedCustomer): self
    {
        $this->satistifiedCustomer = $satistifiedCustomer;

        return $this;
    }

    public function getSatisfaction(): ?int
    {
        return $this->satisfaction;
    }

    public function setSatisfaction(int $satisfaction): self
    {
        $this->satisfaction = $satisfaction;

        return $this;
    }
}
