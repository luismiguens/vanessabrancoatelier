<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AjaxController
 *
 * @author Luis Miguens <lmiguens@consolidador.com>
 */
class AjaxController extends Controller {

    //put your code here



    public function postsShowMoreAction(Request $request) {

        $limit = $request->query->get('limit');
        $offset = $request->query->get('offset');

        $posts = $this->getDoctrine()->getRepository('AppBundle:VbaPost')
                ->findPostsPartial($limit, $offset);

        $items = array();

        foreach ($posts as $key => $post) {
            $items[] = $this->renderView('AppBundle:Ajax:postsPartial.html.twig', array('post' => $post));
        }


        return new \Symfony\Component\HttpFoundation\JsonResponse(array(
            'items' => $items
        ));
    }

    public function worksAction(Request $request) {
        $em = $this->getDoctrine()->getManager();
        
        $type = $request->query->get('type');

        $query = $em->createQuery(
                'SELECT w
                FROM AppBundle:VbaWork w
                JOIN w.type t
                WHERE t.id = ?1
                ORDER BY w.createdAt DESC');
        $query->setParameter(1, $type);
        $works = $query->getResult();


        foreach ($works as $key => $work) {
            $items[] = $this->renderView('AppBundle:Ajax:worksPartial.html.twig', array('work' => $work));
        }


        return new \Symfony\Component\HttpFoundation\JsonResponse(array(
            'items' => $items
        ));
    }

}
