<?php

namespace Kod\Bundle\CaixaBundle\Controller;

use Kod\Bundle\CaixaBundle\Entity\Retirada;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Retirada controller.
 *
 * @Route("retirada")
 */
class RetiradaController extends Controller
{
    /**
     * Lista todos os regiistro relacionados a retirada.
     *
     * @Route("/", name="retirada_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $retiradas = $em->getRepository('KodCaixaBundle:Retirada')->findAll();

        return $this->render('retirada/index.html.twig', array(
            'retiradas' => $retiradas,
        ));
    }

    /**
     * Cria um novo retirada.
     *
     * @Route("/new/{caixa}", defaults={"caixa" = 0}, name="retirada_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request,$caixa)
    {
        $retirada = new Retirada();
        $form = $this->createForm('Kod\Bundle\CaixaBundle\Form\RetiradaType', $retirada);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($retirada);
            $em->flush();

	        return $this->redirectToRoute('caixa_show', array("id" => $retirada->getCaixa()->getId()));
        }

        return $this->render('retirada/new.html.twig', array(
            'retirada' => $retirada,
            'caixa' => $caixa,
            'form' => $form->createView(),
        ));
    }

    /**
     * Busca e mostra retirada.
     *
     * @Route("/{id}", name="retirada_show")
     * @Method("GET")
     */
    public function showAction(Retirada $retirada)
    {
        $deleteForm = $this->createDeleteForm($retirada);

        return $this->render('retirada/show.html.twig', array(
            'retirada' => $retirada,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Caso exista mostra o formulario de edição da retirada.
     *
     * @Route("/{id}/edit", name="retirada_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Retirada $retirada)
    {
        $deleteForm = $this->createDeleteForm($retirada);
        $editForm = $this->createForm('Kod\Bundle\CaixaBundle\Form\RetiradaType', $retirada);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('retirada_edit', array('id' => $retirada->getId()));
        }

        return $this->render('retirada/edit.html.twig', array(
            'retirada' => $retirada,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deleta a retirada.
     *
     * @Route("/{id}", name="retirada_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Retirada $retirada)
    {
        $form = $this->createDeleteForm($retirada);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($retirada);
            $em->flush();
        }

        return $this->redirectToRoute('retirada_index');
    }

    /**
     * Cria o formulario para deletar retirada.
     *
     * @param Retirada $retirada The retirada entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Retirada $retirada)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('retirada_delete', array('id' => $retirada->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
