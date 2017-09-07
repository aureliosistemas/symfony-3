<?php

namespace Kod\Bundle\CaixaBundle\Controller;

use Kod\Bundle\CaixaBundle\Entity\ServicosTipo;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Servicostipo controller.
 *
 * @Route("servicostipo")
 */
class ServicosTipoController extends Controller
{
    /**
     * Lists all servicosTipo entities.
     *
     * @Route("/", name="servicostipo_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $servicosTipos = $em->getRepository('KodCaixaBundle:ServicosTipo')->findAll();

        return $this->render('servicostipo/index.html.twig', array(
            'servicosTipos' => $servicosTipos,
        ));
    }

    /**
     * Creates a new servicosTipo entity.
     *
     * @Route("/new", name="servicostipo_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $servicosTipo = new Servicostipo();
        $form = $this->createForm('Kod\Bundle\CaixaBundle\Form\ServicosTipoType', $servicosTipo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($servicosTipo);
            $em->flush();

            return $this->redirectToRoute('servicostipo_show', array('id' => $servicosTipo->getId()));
        }

        return $this->render('servicostipo/new.html.twig', array(
            'servicosTipo' => $servicosTipo,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a servicosTipo entity.
     *
     * @Route("/{id}", name="servicostipo_show")
     * @Method("GET")
     */
    public function showAction(ServicosTipo $servicosTipo)
    {
        $deleteForm = $this->createDeleteForm($servicosTipo);

        return $this->render('servicostipo/show.html.twig', array(
            'servicosTipo' => $servicosTipo,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing servicosTipo entity.
     *
     * @Route("/{id}/edit", name="servicostipo_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, ServicosTipo $servicosTipo)
    {
        $deleteForm = $this->createDeleteForm($servicosTipo);
        $editForm = $this->createForm('Kod\Bundle\CaixaBundle\Form\ServicosTipoType', $servicosTipo);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('servicostipo_edit', array('id' => $servicosTipo->getId()));
        }

        return $this->render('servicostipo/edit.html.twig', array(
            'servicosTipo' => $servicosTipo,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a servicosTipo entity.
     *
     * @Route("/{id}", name="servicostipo_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, ServicosTipo $servicosTipo)
    {
        $form = $this->createDeleteForm($servicosTipo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($servicosTipo);
            $em->flush();
        }

        return $this->redirectToRoute('servicostipo_index');
    }

    /**
     * Creates a form to delete a servicosTipo entity.
     *
     * @param ServicosTipo $servicosTipo The servicosTipo entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(ServicosTipo $servicosTipo)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('servicostipo_delete', array('id' => $servicosTipo->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
