<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\NewsRepository;

class NewsController extends AbstractController{
    /**
     * @Route("/news/{id}", name="news")
     */
    public function index(Request $Request,NewsRepository $NewsRepository){
        $item=$NewsRepository->find($Request->get('id'));
        return $this->render('news/index.html.twig', [
            'controller_name' => 'NewsController',
            'array'=>$item
        ]);
    }
}
