<?php


namespace App\DataFixtures;
use App\Service\Security\PasswordService;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use App\Entity\User;

class BmsUserFixtures extends Fixture implements FixtureGroupInterface
{
    private ParameterBagInterface $params;
    private string $password;
    private string $email;
    private PasswordService $passwordService;


    public function __construct(ParameterBagInterface $params, PasswordService $passwordService)
    {
        $this->params = $params;
        $this->password = $_ENV['USER_PWD'];
        $this->email = $_ENV['AGENCY_EMAIL'];
        $this->passwordService = $passwordService;

    }

    public function load(ObjectManager $em)
    {
        $user = new User();
        $user->addRole(User::ROLE_ADMIN);
        $user->setEnabled(true)
            ->setEmail($this->email);
        $password = $this->passwordService->encode($user, $this->password);
        $user->setPassword($password);
        $em->persist($user);
        $em->flush();
    }

    public static function getGroups(): array
    {
        return ['users'];
    }
    public function getOrder(): int
    {
        return 1; // the order in which fixtures will be loaded
    }
}