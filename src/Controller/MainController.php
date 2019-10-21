<?php
namespace App\Controller;
use App\Repository\NewsRepository;
use App\Repository\CategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;


class MainController extends AbstractController{
    /**
     * @Route("/", name="main")
     */
    public function index(NewsRepository $NewsRepository,CategoryRepository $CategoryRepository){
        return $this->render('main/index.html.twig',[
            'sport'=>$CategoryRepository->getCategory('sport',$NewsRepository),
            'fasion'=>$CategoryRepository->getCategory('fasion',$NewsRepository),
        ]);
    }

     /**
     * @Route("/create", name="create")
     */
    /*
    public function getNews(){
        $array=$this->findAll();
        $items=array(
            '1'=>array(),
        );
        foreach($array as $item){
            array_push($item->getCategory(),$item);
        }
        return $items;
    }
    */
    public function create(){
        $news = new News();
        $Category =new Category();
        $news->setTitle('fqef');
        $Category->setName('jgj');
        $news->setDescription('new des');
        $news->setCategory($Category);
        $news->setToshow(0);
        $em= $this->getDoctrine()->getManager();
        $em->persist($news);
        $em->flush();
        return new Response('post was created');

    }
    private function getContent($array,$section):object{
        return $this->render('main/section.html.twig',[
            'sectioname'=>$section,
            'data'=>$array
        ]);
    }
}
