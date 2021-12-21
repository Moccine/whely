<?php


namespace App\Controller\ApiWeb;


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
     * @Route("/add/request/call/back", name="add_request_call_back")
     */
    public function addRequestCallBack(Request $request,
                                       EntityManagerInterface $entityManager,
                                       ServicesRepository $servicesRepository,
                                       RequestCallBackRepository $requestCallBackRepository,
                                       SessionInterface $session,
                                       Sender $sender
    ): Response
    {
        if ($request->isXMLHttpRequest()) {
            $name = $request->request->get('request_call_back')['name'];
            $email = $request->request->get('request_call_back')['email'];
            $phone = $request->request->get('request_call_back')['phone'];
            $subject = trim($request->request->get('request_call_back')['subject']);
            $requestCallBacExist = $requestCallBackRepository->findOneBy(
                [
                    'email' => $email,
                    'subject' => $subject,
                ]);
            if ($requestCallBacExist instanceof RequestCallBack) {
                return $this->json(['msg' => 'Cette demande  exist déjà']);
            }
            $requestCallBack = new RequestCallBack();
            $requestCallBack->setEmail($email)
                ->setName($name)
                ->setPhone($phone)
                ->setSubject($subject);
            $entityManager->persist($requestCallBack);
            $entityManager->flush($requestCallBack);

            $template = $sender->doTemplate('newsletter/subscriberConfirm.html.twig', ['newslettersSubcriber' => $requestCallBack,]);
            $sender->deliver(
                $requestCallBack->getEmail(),
                'Inscription  à notre new letter',
                $template,
                [],
                []
            );

            return $this->json(['msg' => 'success']);

        }

    }

}