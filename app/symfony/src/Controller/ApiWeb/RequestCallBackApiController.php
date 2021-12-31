<?php


namespace App\Controller\ApiWeb;


use App\Entity\Contact;
use App\Entity\NewsletterSubcriber;
use App\Entity\RequestCallBack;
use App\Repository\NewsletterSubcriberRepository;
use App\Repository\NewsRepository;
use App\Repository\RequestCallBackRepository;
use App\Repository\ServicesRepository;
use App\Service\Mailer\Sender;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class RequestCallBackApiController extends AbstractController
{
    /**
     * @Route("/whelly/send/mail", name="whelly_send_mail", methods={"post"})
     */
    public function addRequestCallBack(Request $request,
                                       EntityManagerInterface $entityManager,
                                       SessionInterface $session,
                                       Sender $sender
    ): Response
    {
        if ($request->isXMLHttpRequest()) {
          dump($request);
            $name = $request->request->get('name');
            $email = $request->request->get('email');
            $phone = $request->request->get('phone');
            $subject = trim($request->request->get('subject'));
            $note = trim($request->request->get('note'));

            $newContact = new Contact();
          $newContact->setEmail($email)
                ->setName($name)
                ->setPhone($phone)
                ->setSubject($subject)
          ->setNote($note);
            $entityManager->persist($newContact);
            $entityManager->flush();

            $template = $sender->doTemplate('whelly/contactTemplate.html.twig', ['newContact' => $newContact,]);
            $sender->deliver(
              $newContact->getEmail(),
                'contact: '.$newContact->getSubject(),
                $template,
                [],
                []
            );

            return $this->json(['msg' => 'success']);

        }

    }

}