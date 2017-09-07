<?php

namespace Kod\Bundle\CaixaBundle\Controller;

use Kod\Bundle\CaixaBundle\Entity\Profissional;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Profissional controller.
 *
 * @Route("/profissional")
 */
class ProfissionalController extends Controller
{
    /**
     * Lists all profissional entities.
     *
     * @Route("/list", name="profissional_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $profissionals = $em->getRepository('KodCaixaBundle:Profissional')->findAll();

        return $this->render('profissional/index.html.twig', array(
            'profissionals' => $profissionals,
        ));
    }

    /**
     * Creates a new profissional entity.
     *
     * @Route("/new", name="profissional_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $profissional = new Profissional();
        $form = $this->createForm('Kod\Bundle\CaixaBundle\Form\ProfissionalType', $profissional);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($profissional);
            $em->flush();

            return $this->redirectToRoute('profissional_show', array('id' => $profissional->getId()));
        }

        return $this->render('profissional/new.html.twig', array(
            'profissional' => $profissional,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a profissional entity.
     *
     * @Route("/{id}", name="profissional_show")
     * @Method("GET")
     */
    public function showAction(Profissional $profissional)
    {
        $deleteForm = $this->createDeleteForm($profissional);

        return $this->render('profissional/show.html.twig', array(
            'profissional' => $profissional,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing profissional entity.
     *
     * @Route("/{id}/edit", name="profissional_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Profissional $profissional)
    {
        $deleteForm = $this->createDeleteForm($profissional);
        $editForm = $this->createForm('Kod\Bundle\CaixaBundle\Form\ProfissionalType', $profissional);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('profissional_edit', array('id' => $profissional->getId()));
        }

        return $this->render('profissional/edit.html.twig', array(
            'profissional' => $profissional,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a profissional entity.
     *
     * @Route("/{id}", name="profissional_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Profissional $profissional)
    {
        $form = $this->createDeleteForm($profissional);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($profissional);
            $em->flush();
        }

        return $this->redirectToRoute('profissional_index');
    }

    /**
     * Creates a form to delete a profissional entity.
     *
     * @param Profissional $profissional The profissional entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Profissional $profissional)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('profissional_delete', array('id' => $profissional->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
