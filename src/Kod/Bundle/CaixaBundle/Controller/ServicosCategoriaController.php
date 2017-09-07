<?php

namespace Kod\Bundle\CaixaBundle\Controller;

use Kod\Bundle\CaixaBundle\Entity\ServicosCategoria;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Servicoscategorium controller.
 *
 * @Route("servicoscategoria")
 */
class ServicosCategoriaController extends Controller
{
    /**
     * Lists all servicosCategorium entities.
     *
     * @Route("/", name="servicoscategoria_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $servicosCategorias = $em->getRepository('KodCaixaBundle:ServicosCategoria')->findAll();

        return $this->render('servicoscategoria/index.html.twig', array(
            'servicosCategorias' => $servicosCategorias,
        ));
    }

    /**
     * Creates a new servicosCategorium entity.
     *
     * @Route("/new", name="servicoscategoria_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $servicosCategorium = new ServicosCategoria();
        $form = $this->createForm('Kod\Bundle\CaixaBundle\Form\ServicosCategoriaType', $servicosCategorium);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($servicosCategorium);
            $em->flush();

            return $this->redirectToRoute('servicoscategoria_show', array('id' => $servicosCategorium->getId()));
        }

        return $this->render('servicoscategoria/new.html.twig', array(
            'servicosCategorium' => $servicosCategorium,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a servicosCategorium entity.
     *
     * @Route("/{id}", name="servicoscategoria_show")
     * @Method("GET")
     */
    public function showAction(ServicosCategoria $servicosCategorium)
    {
        $deleteForm = $this->createDeleteForm($servicosCategorium);

        return $this->render('servicoscategoria/show.html.twig', array(
            'servicosCategorium' => $servicosCategorium,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing servicosCategorium entity.
     *
     * @Route("/{id}/edit", name="servicoscategoria_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, ServicosCategoria $servicosCategorium)
    {
        $deleteForm = $this->createDeleteForm($servicosCategorium);
        $editForm = $this->createForm('Kod\Bundle\CaixaBundle\Form\ServicosCategoriaType', $servicosCategorium);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('servicoscategoria_edit', array('id' => $servicosCategorium->getId()));
        }

        return $this->render('servicoscategoria/edit.html.twig', array(
            'servicosCategorium' => $servicosCategorium,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a servicosCategorium entity.
     *
     * @Route("/{id}", name="servicoscategoria_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, ServicosCategoria $servicosCategorium)
    {
        $form = $this->createDeleteForm($servicosCategorium);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($servicosCategorium);
            $em->flush();
        }

        return $this->redirectToRoute('servicoscategoria_index');
    }

    /**
     * Creates a form to delete a servicosCategorium entity.
     *
     * @param ServicosCategoria $servicosCategorium The servicosCategorium entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(ServicosCategoria $servicosCategorium)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('servicoscategoria_delete', array('id' => $servicosCategorium->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
