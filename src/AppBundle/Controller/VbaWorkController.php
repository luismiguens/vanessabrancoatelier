<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use AppBundle\Entity\VbaWork;
use AppBundle\Form\VbaWorkType;

/**
 * VbaWork controller.
 *
 */
class VbaWorkController extends Controller
{

    /**
     * Lists all VbaWork entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AppBundle:VbaWork')->findAll();

        return $this->render('AppBundle:VbaWork:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new VbaWork entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new VbaWork();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_work_show', array('id' => $entity->getId())));
        }

        return $this->render('AppBundle:VbaWork:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a VbaWork entity.
     *
     * @param VbaWork $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(VbaWork $entity)
    {
        $form = $this->createForm(new VbaWorkType(), $entity, array(
            'action' => $this->generateUrl('admin_work_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new VbaWork entity.
     *
     */
    public function newAction()
    {
        $entity = new VbaWork();
        $form   = $this->createCreateForm($entity);

        return $this->render('AppBundle:VbaWork:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a VbaWork entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:VbaWork')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find VbaWork entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('AppBundle:VbaWork:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing VbaWork entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:VbaWork')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find VbaWork entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('AppBundle:VbaWork:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a VbaWork entity.
    *
    * @param VbaWork $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(VbaWork $entity)
    {
        $form = $this->createForm(new VbaWorkType(), $entity, array(
            'action' => $this->generateUrl('admin_work_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing VbaWork entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:VbaWork')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find VbaWork entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('admin_work_edit', array('id' => $id)));
        }

        return $this->render('AppBundle:VbaWork:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a VbaWork entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AppBundle:VbaWork')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find VbaWork entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('admin_work'));
    }

    /**
     * Creates a form to delete a VbaWork entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_work_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
