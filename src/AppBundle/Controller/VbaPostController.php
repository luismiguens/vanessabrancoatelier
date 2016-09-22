<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use AppBundle\Entity\VbaPost;
use AppBundle\Form\VbaPostType;

/**
 * VbaPost controller.
 *
 */
class VbaPostController extends Controller
{

    /**
     * Lists all VbaPost entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AppBundle:VbaPost')->findAll();

        return $this->render('AppBundle:VbaPost:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new VbaPost entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new VbaPost();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_post_show', array('id' => $entity->getId())));
        }

        return $this->render('AppBundle:VbaPost:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a VbaPost entity.
     *
     * @param VbaPost $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(VbaPost $entity)
    {
        $form = $this->createForm(new VbaPostType(), $entity, array(
            'action' => $this->generateUrl('admin_post_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new VbaPost entity.
     *
     */
    public function newAction()
    {
        $entity = new VbaPost();
        $form   = $this->createCreateForm($entity);

        return $this->render('AppBundle:VbaPost:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a VbaPost entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:VbaPost')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find VbaPost entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('AppBundle:VbaPost:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing VbaPost entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:VbaPost')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find VbaPost entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('AppBundle:VbaPost:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a VbaPost entity.
    *
    * @param VbaPost $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(VbaPost $entity)
    {
        $form = $this->createForm(new VbaPostType(), $entity, array(
            'action' => $this->generateUrl('admin_post_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing VbaPost entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:VbaPost')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find VbaPost entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('admin_post_edit', array('id' => $id)));
        }

        return $this->render('AppBundle:VbaPost:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a VbaPost entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AppBundle:VbaPost')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find VbaPost entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('admin_post'));
    }

    /**
     * Creates a form to delete a VbaPost entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_post_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
