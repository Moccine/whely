<?php
declare(strict_types=1);

namespace App\Controller\ApiWeb;

use App\Entity\NewsletterSubcriber;
use App\Form\NewsletterType;
use App\Repository\NewsletterSubcriberRepository;
use App\Repository\NewsRepository;
use App\Repository\ServicesRepository;
use App\Service\Mailer\Sender;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;


class NewLetterApiController extends AbstractController
{
    /**
     * @Route("/add/news/letter/suscriber", name="add_news_letter_suscriber")
     */
    public function addNewslettersSuscriber(Request $request,
                                            EntityManagerInterface $entityManager,
                                            ServicesRepository $servicesRepository,
                                            NewsRepository $newsRepository,
                                            SessionInterface $session,
                                            NewsletterSubcriberRepository $newsletterSubcriberRepository,
    Sender $sender
    ): Response
    {
        if ($request->isXMLHttpRequest()) {
            $name  = $request->request->get('newsletter')['name'];
            $email  = $request->request->get('newsletter')['email'];
            $newslettersSubcriberExist = $newsletterSubcriberRepository->findOneBy(['email' => $email]);
              if($newslettersSubcriberExist instanceof NewsletterSubcriber){
                  return $this->json(['msg' => 'cet email exist déjà']);
              }
            $newslettersSubcriber = new NewsletterSubcriber();
            $newslettersSubcriber->setEmail($email)->setName($name);
                $entityManager->persist($newslettersSubcriber);
                $entityManager->flush($newslettersSubcriber);

                $template = $sender->doTemplate('newsletter/subscriberConfirm.html.twig', ['newslettersSubcriber' => $newslettersSubcriber,]);
                $sender->deliver(
                    $newslettersSubcriber->getEmail(),
                    'Inscription  à notre new letter',
                    $template,
                    [],
                    []
                );

            return $this->json(['msg' => 'success']);

        }

    }

    /**
     * @Route("/subscriber/form/template", name="subscriber_form_template")
     */
    public function getSubcriberFprm(Request $request)
    {
        if ($request->isXMLHttpRequest()) {

            $newsLetter = new NewsletterSubcriber();
            $newsLetterForm = $this->createForm(NewsletterType::class, $newsLetter);
            $template = $this->renderView('newsletter/subscriberFormTemplate.html.twig', [
                'newsLetterForm' => $newsLetterForm->createView(),

            ]);
            return $this->json(['template' => $template]);
        }

        return $this->json(['error' => 'forbidden'], Response::HTTP_FORBIDDEN);
    }


}