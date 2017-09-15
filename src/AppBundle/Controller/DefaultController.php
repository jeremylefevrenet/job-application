<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

use AppBundle\Entity\Article;

use AppBundle\Form\ArticleType;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $article = new Article();
        $form = $this->createForm(ArticleType::class, $article);
        
        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
            $em->persist($article);
            $em->flush();

            $request->getSession()->getFlashBag()->add('success', 'Article registered.');
        }
        
        // replace this example code with whatever you need
        return $this->render(
                'AppBundle::index.html.twig',
                array(
                    'articles'  => $em->getRepository('AppBundle:Article')->findBy(array(), array('id' => 'DESC')),
                    'form'      => $form->createView()
                )
            );
    }
    
     /**
     * @Route("/edit/{id}", name="editpage" , defaults={"id": null}, requirements={"id": "\d+"})
     */
    public function editAction($id, Request $request)
    {
        if(!empty($id)) {
            $em = $this->getDoctrine()->getManager();

            $article = $em->getRepository('AppBundle:Article')->find($id);
            
            if(!empty($article)) {
                $form = $this->createForm(ArticleType::class, $article);
                
                if($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
                    $em->persist($article);
                    $em->flush();
                    $request->getSession()->getFlashBag()->add('success', 'Article updated successfully.');
                    return $this->redirectToRoute('homepage');
                }
                
                return $this->render(
                    'AppBundle::edit.html.twig',
                    array(
                        'form'      => $form->createView()
                    )
                );
                
            } else {
                $request->getSession()->getFlashBag()->add('error', 'Article does not exist.');
            }
            
        } else {
            $request->getSession()->getFlashBag()->add('error', 'Id is null or empty.');
        }
        
        return $this->redirectToRoute('homepage');
    }
    
    /**
     * @Route("/delete/{id}", name="deletepage" , defaults={"id": null}, requirements={"id": "\d+"})
     */
    public function deleteAction($id, Request $request)
    {
        if(!empty($id)) {
            $em = $this->getDoctrine()->getManager();

            $article = $em->getRepository('AppBundle:Article')->find($id);
            if(!empty($article)) {
                $em->remove($article);
                $em->flush();
                return new JsonResponse(array('response' => true));
            }
        }
        return new JsonResponse(array('response' => false));
    }
    
    /**
     * @Route("/steps", name="stepspage")
     */
    public function stepsAction()
    {
        return $this->render('AppBundle::steps.html.twig');
    }

    /**
     * @Route("/interact", name="interact")
     */
    public function interactAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('default/interact.html.twig');
    }
}
