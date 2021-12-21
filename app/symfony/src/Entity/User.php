<?php

declare(strict_types=1);

namespace App\Entity;

use App\Entity\Traits\CreatedAtTrait;
use App\Entity\Traits\IdentifiableTrait;
use App\Entity\Traits\UpdatedAtTrait;
use App\Repository\UserRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @UniqueEntity(fields={"email"})
 * @ORM\HasLifecycleCallbacks()
 */
class User implements UserInterface
{
    public const ROLE_USER = 'ROLE_USER';
    public const ROLE_ADMIN = 'ROLE_ADMIN';

    use IdentifiableTrait;
    use CreatedAtTrait;
    use UpdatedAtTrait;

    public const ROLES = [
        self::ROLE_USER,
        self::ROLE_ADMIN,
    ];

    /**
     * @ORM\Column(length=180, unique=true)
     */
    private string $email;

    /**
     * @ORM\Column(type="string")
     */
    private string $password;

    /**
     * @Assert\NotBlank()
     * @Assert\Regex(
     *     pattern="/(?=(.*[0-9]))(?=.*[a-z])(?=(.*[A-Z]))(?=(.*)).{8,}/",
     *     message="Mot non conforme",
     * )
     */
    private string $plainPassword;

    /**
     * @ORM\OneToOne(targetEntity=Client::class, cascade={"persist"})
     * @Assert\Valid()
     */
    private ?Client $client;

    /**
     * @ORM\Column(type="boolean")
     */
    private bool $enabled = false;


    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * User constructor.
     * @param array $roles
     */
    public function __construct()
    {
        $this->roles = [self::ROLE_USER];
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles()
    {
        $roles = $this->roles;
        if (empty($roles)) {
            $roles[] = 'ROLE_USER';
        }

        return array_unique($roles);
    }

    function addRole($role)
    {
        $this->roles[] = $role;
    }

    public function removeRole($role)
    {
        $roles = $this->roles;
        if ($roles and ($key = array_search($role, $roles)) !== false) {
            unset($roles[$key]);
        }
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        // not needed when using the "bcrypt" algorithm in security.yaml
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getPlainPassword(): ?string
    {
        return $this->plainPassword;
    }

    public function setPlainPassword(string $plainPassword): self
    {
        $this->plainPassword = $plainPassword;

        return $this;
    }

    public function getClient(): ?Client
    {
        return $this->client;
    }

    public function setClient(?Client $client): self
    {
        $this->client = $client;

        return $this;
    }

    public function isEnabled(): bool
    {
        return $this->enabled;
    }

    public function setEnabled(bool $enabled): self
    {
        $this->enabled = $enabled;

        return $this;
    }

    public function hasRole(string $role): bool
    {

        return in_array($role, $this->getRoles());
    }
}
