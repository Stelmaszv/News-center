<?php

namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\NewsRepository;
use App\Form\NewsType;
use App\Entity\News;
use Symfony\Component\Form\Form;

class NewsController extends AbstractController{
    public function index(Request $Request,NewsRepository $NewsRepository){
        $item=$NewsRepository->find($Request->get('id'));
        return $this->render('news/index.html.twig', [
            'controller_name' => 'NewsController',
            'array'=>$item
        ]);
    }
     /**
     * @Route("/show/{id}", name="show")
     */
    public function show(Request $Request,NewsRepository $NewsRepository){
        $item=$NewsRepository->find($Request->get('id'));
        return $this->render('news/index.html.twig', [
            'controller_name' => 'NewsController',
            'array'=>$item
        ]);
    }
      /**
     * @Route("/delete/{id}", name="delete")
     */
    public function delete(Request $Request,NewsRepository $NewsRepository){
        $item=$NewsRepository->find($Request->get('id'));
        $em =$this->getDoctrine()->getManager();
        $em->remove($item);
        $em->flush();
        return $this->redirect($this->generateUrl('main'));
    }
    /**
     * @Route("/edit/{id}", name="edit")
    */
    public function edit(Request $Request,NewsRepository $NewsRepository){
        $news= new News();
        $item=$NewsRepository->find($Request->get('id'));
        $news->setTitle($item->getTitle());
        $news->setDescription($item->getDescription());
        $news->setCategory($item->getCategory());
        $news->setToshow(0);
        $form= $this->createForm(NewsType::class,$news);
        $form->handleRequest($Request);
        if($form->isSubmitted() && $form->isValid()){
            $em =$this->getDoctrine()->getManager();
            $em->persist($news);
            $em->flush();
            return $this->redirect($this->generateUrl('main'));
        }
        return $this->render('news/create.html.twig', [
            'controller_name' => 'NewsController',
            'form'=> $form->createView()
        ]);
    }
    /**
     * @Route("/create", name="create")
    */
    public function create(Request $Request){
        $news= new News();
        $news->setToshow(0);
        $form= $this->createForm(NewsType::class,$news);
        $form->handleRequest($Request);
        if($form->isSubmitted() && $form->isValid()){
            $em =$this->getDoctrine()->getManager();
            $em->persist($news);
            $em->flush();
            return $this->redirect($this->generateUrl('main'));
        }
        return $this->render('news/create.html.twig', [
            'controller_name' => 'NewsController',
            'form'=> $form->createView()
        ]);
    }
}
