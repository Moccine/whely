<?php

declare(strict_types=1);

namespace App\Security\Guard;

use App\Event\UserEvent;
use App\Service\Security\PasswordService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Guard\AbstractGuardAuthenticator;
use Symfony\Contracts\Translation\TranslatorInterface;

class UserAuthenticator extends AbstractGuardAuthenticator
{
    private PasswordService $passwordService;

    private UrlGeneratorInterface $urlGenerator;

    private TranslatorInterface $translator;

    private EventDispatcherInterface $eventDispatcher;

    private EntityManagerInterface $entityManager;
    private SessionInterface $session;

    public function __construct(
        PasswordService $passwordService,
        UrlGeneratorInterface $urlGenerator,
        TranslatorInterface $translator,
        EventDispatcherInterface $eventDispatcher,
        EntityManagerInterface $entityManager,
        SessionInterface $session
    )
    {
        $this->passwordService = $passwordService;
        $this->urlGenerator = $urlGenerator;
        $this->translator = $translator;
        $this->eventDispatcher = $eventDispatcher;
        $this->entityManager = $entityManager;
        $this->session = $session;
    }

    public function supports(Request $request): bool
    {
        if (!$request->request->has('email') || !$request->request->has('password')) {
            return false;
        }

        if ($this->urlGenerator->generate('user_login') !== $request->getPathInfo()) {
            return false;
        }

        if (!$request->isMethod(Request::METHOD_POST)) {
            return false;
        }

        return true;
    }

    public function start(Request $request, AuthenticationException $exception = null): RedirectResponse
    {
        return new RedirectResponse($this->urlGenerator->generate('user_login'));
    }

    public function getCredentials(Request $request): array
    {
        return [
            'email' => $request->request->get('email'),
            'password' => $request->request->get('password'),
        ];
    }

    /**
     * @param mixed $credentials
     * @param UserProviderInterface $userProvider
     * @return UserInterface|null
     */
    public function getUser($credentials, UserProviderInterface $userProvider): UserInterface
    {
        return $userProvider->loadUserByUsername($credentials['email']);
    }

    public function checkCredentials($credentials, UserInterface $user): bool
    {
        if (!$user->isEnabled()) {
            return false;
        }

        if ($this->passwordService->isValid($user, $credentials['password'])) {
            return true;
        }

        return false;
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token, $providerKey): RedirectResponse
    {
        $this->eventDispatcher->dispatch(
            new UserEvent($token->getUser()),
            UserEvent::LOGGED
        );

        return new RedirectResponse($this->urlGenerator->generate('dashboard'));
    }

    public function onAuthenticationFailure(Request $request, AuthenticationException $exception)
    {

    $this->session->getFlashBag()->set('login-error', 'Vos identifiants sont incorrect');
        //  return new JsonResponse($errors, JsonResponse::HTTP_UNAUTHORIZED);
    }

    public function supportsRememberMe(): bool
    {
        return false;
    }
}
