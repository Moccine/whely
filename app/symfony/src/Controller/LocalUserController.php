<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class LocalUserController extends AbstractController
{
    /**
     * Change the locale for the current user.
     *
     * @param string $language
     *
     * @return RedirectResponse
     *
     * @Route("/setlocale/{language}", name="setlocale")
     */
    public function setLocaleAction(Request $request, $language = null)
    {
        if ($language != null) {
            // Store local in user session
            $this->get('session')->set('_locale', $language);
        }

        // Try to redirect user to referer url
        $url = $request->headers->get('referer');
        if (empty($url)) {
            $url = $this->container->get('router')->generate('index');
        }

        return new RedirectResponse($url);
    }
}
