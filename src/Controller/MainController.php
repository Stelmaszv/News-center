<?php
namespace App\Controller;
use App\Entity\News;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class MainController extends AbstractController{
    /**
     * @Route("/", name="main")
     */
    public function index(){
        
        return $this->render('main/index.html.twig', [
            'controller_name' => 'kotek',
        ]);
    }
    /**
     * @Route("/create", name="create")
     */
    public function create(){
        $news = new News();
        $news->setTittle('fqef');
        $news->setToshow(0);
        $em= $this->getDoctrine()->getManager();
        $em->persist($news);
        $em->flush();
        return new Response('post was created');

    }
}
