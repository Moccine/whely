<?php
namespace App\Controller;


use App\Repository\AboutDescriptionRepository;
use App\Repository\CompanyHistoryRepository;
use App\Repository\OurTeamRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
/**
* @Route("/", name="whelly_index")
*/
    public function wellyIndex(Request  $request): Response
    {
        return $this->render('whelly/index.html.twig', [
        ]);
    }
  /**
   * @Route("/whelly/contact", name="whelly_contact")
   */
  public function wellyContact(Request  $request): Response
  {
    return $this->render('whelly/contact.html.twig', [
    ]);
  }
  /**
   * @Route("/whelly/about-us", name="whelly_about_us")
   */
  public function wellyAboutUs(Request  $request): Response
  {
    return $this->render('whelly/about.html.twig', [
    ]);
  }
  /**
   * @Route("/whelly/offers", name="whelly_offers")
   */
  public function wellyOffers(Request  $request): Response
  {
    return $this->render('whelly/offers.html.twig', [
    ]);
  }
  /**
   * @Route("/whelly/project", name="whelly_project")
   */
  public function wellyProject(Request  $request): Response
  {
    return $this->render('whelly/projects.html.twig', [
    ]);
  }
  /**
   * @Route("/whelly/news", name="whelly_news")
   */
  public function wellyNews(Request  $request): Response
  {
    return $this->render('whelly/news.html.twig', [
    ]);
  }
  /**
   * @Route("/whelly/send/mail", name="whelly_send_mail", methods={"post"})
   */
  public function wellySendMail(Request  $request): Response
  {


    return $this->redirectToRoute('whelly_index');
  }
}