<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\ArticleFormType;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Article;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\ArticleRepository;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class ArticleAdminController extends AbstractController
{
    /**
     * @Route("/article/admin", name="article_admin")
     */
    public function index(EntityManagerInterface $em,Request $request,ArticleRepository $repo)
    {

         
    	 
         $form=$this->createForm(ArticleFormType::class);


         $form->handleRequest($request);



         if ($form->isSubmitted() && $form->isValid()) {

              $file=$form->get('image')->getData();
              $fileName=time().$file->getClientOriginalName();

              $file->move(

                    $this->getParameter('video_directory'),
                    $fileName

                     );
              $article=$form->getData();

            $article->setImage($fileName);
                
             $em->persist($article);
             $em->flush();

             $this->addFlash('success', 'Article Created! Knowledge is power!');
            
        }
        return $this->render('article_admin/index.html.twig', [
            'formArticle' => $form->createView(),
        ]);
    }
}
