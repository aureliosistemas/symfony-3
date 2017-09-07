<?php

namespace Kod\Bundle\CaixaBundle\Controller;

use Kod\Bundle\CaixaBundle\Entity\Servicos;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Servico controller.
 *
 * @Route("servicos")
 */
class ServicosController extends Controller
{
    /**
     * Lists all servico entities.
     *
     * @Route("/", name="servicos_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $servicos = $em->getRepository('KodCaixaBundle:Servicos')->findAll();

        return $this->render('servicos/index.html.twig', array(
            'servicos' => $servicos,
        ));
    }

    /**
     * Creates a new servico entity.
     *
     * @Route("/new", name="servicos_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $servico = new Servicos();
        $form = $this->createForm('Kod\Bundle\CaixaBundle\Form\ServicosType', $servico);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($servico);
            $em->flush();

            return $this->redirectToRoute('servicos_show', array('id' => $servico->getId()));
        }

        return $this->render('servicos/new.html.twig', array(
            'servico' => $servico,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a servico entity.
     *
     * @Route("/{id}", name="servicos_show")
     * @Method("GET")
     */
    public function showAction(Servicos $servico)
    {
        $deleteForm = $this->createDeleteForm($servico);

        return $this->render('servicos/show.html.twig', array(
            'servico' => $servico,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing servico entity.
     *
     * @Route("/{id}/edit", name="servicos_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Servicos $servico)
    {
        $deleteForm = $this->createDeleteForm($servico);
        $editForm = $this->createForm('Kod\Bundle\CaixaBundle\Form\ServicosType', $servico);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('servicos_edit', array('id' => $servico->getId()));
        }

        return $this->render('servicos/edit.html.twig', array(
            'servico' => $servico,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a servico entity.
     *
     * @Route("/{id}", name="servicos_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Servicos $servico)
    {
        $form = $this->createDeleteForm($servico);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($servico);
            $em->flush();
        }

        return $this->redirectToRoute('servicos_index');
    }

    /**
     * Creates a form to delete a servico entity.
     *
     * @param Servicos $servico The servico entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Servicos $servico)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('servicos_delete', array('id' => $servico->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
