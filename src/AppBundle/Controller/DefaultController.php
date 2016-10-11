<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller {

    public function contactAction(Request $request) {

        //contact

        $name = $request->query->get('name');
        if (!$name):
            $name = $request->request->get('name');
        endif;

        $email = $request->query->get('email');
        if (!$email):
            $email = $request->request->get('email');
        endif;

        $subject = $request->query->get('subject');
        if (!$subject):
            $subject = $request->request->get('subject');
        endif;

        $message = $request->query->get('message');
        if (!$message):
            $message = $request->request->get('message');
        endif;


        $email_message = \Swift_Message::newInstance()
                ->setSubject($subject)
                ->setFrom($email)
                ->setTo('contact@vanessabrancoatelier.com')
                ->setBcc('branco.vanessa@gmail.com')
                ->setBody($name . ' said: ' . $message);

        $this->get('mailer')->send($email_message);


        $response = array();
        $response["success"] = true;
        header('Access-Control-Allow-Origin: *');



//        return new \Symfony\Component\HttpFoundation\JsonResponse($response);

                return $this->render('AppBundle:Default:message.html.twig');



    }

    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request) {

        $em = $this->getDoctrine()->getManager();

        $works = $em->getRepository('AppBundle:VbaWork')->findBy(array(), array('createdAt' => 'DESC'));
        $posts = $em->getRepository('AppBundle:VbaPost')->findBy(array(), array('createdAt' => 'DESC'));
        $types = $em->getRepository('AppBundle:VbaType')->findAll();

        return $this->render('AppBundle:Default:index.html.twig', array(
                    'works' => $works,
                    'posts' => $posts,
                    'types' => $types));
    }


//    public function criteriasAction() {
//
//        $locale = $this->get('request')->getLocale();
//        $loggedUser = $this->getUser();
//
//        //module
//        $module = $this->getDoctrine()->getRepository('SkaphandrusAppBundle:SkIdentificationModule')
//                ->findBySlug($slug, $locale);
    
    
    public function postAction($title) {

      
        
       $em = $this->getDoctrine()->getManager();

        $works = $em->getRepository('AppBundle:VbaWork')->findBy(array(), array('createdAt' => 'DESC'));
        $posts = $em->getRepository('AppBundle:VbaPost')->findBy(array(), array('createdAt' => 'DESC'));
        $types = $em->getRepository('AppBundle:VbaType')->findAll();
   $post = $em->getRepository('AppBundle:VbaPost')->findOneBy(array('title'=>$title));
        
        
        
        
        
        return $this->render('AppBundle:Default:post.html.twig', array(
                    'works' => $works,
                    'posts' => $posts,
                    'types' => $types,
            'post'=>$post));

  
        
//
//        
//        
//        
//        return $this->render('AppBundle:Default:post.html.twig', array(
//                    'posts' => $posts,
//                    'post' => $post));
    }
    
    
    
}
