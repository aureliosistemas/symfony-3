<?php

namespace Kod\Bundle\CaixaBundle\Controller;

use Kod\Bundle\CaixaBundle\Entity\CaixaFormaPagamento;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Caixaformapagamento controller.
 *
 * @Route("caixa-forma-pagamento")
 */
class CaixaFormaPagamentoController extends Controller
{
    /**
     * Lists all caixaFormaPagamento entities.
     *
     * @Route("/", name="caixaformapagamento_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $caixaFormaPagamentos = $em->getRepository('KodCaixaBundle:CaixaFormaPagamento')->findAll();

        return $this->render('caixaformapagamento/index.html.twig', array(
            'caixaFormaPagamentos' => $caixaFormaPagamentos,
        ));
    }

    /**
     * Creates a new caixaFormaPagamento entity.
     *
     * @Route("/new", name="caixa-forma-pagamento_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $caixaFormaPagamento = new Caixaformapagamento();
        $form = $this->createForm('Kod\Bundle\CaixaBundle\Form\CaixaFormaPagamentoType', $caixaFormaPagamento);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($caixaFormaPagamento);
            $em->flush();

            return $this->redirectToRoute('caixa-forma-pagamento_show', array('id' => $caixaFormaPagamento->getId()));
        }

        return $this->render('caixaformapagamento/new.html.twig', array(
            'caixaFormaPagamento' => $caixaFormaPagamento,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a caixaFormaPagamento entity.
     *
     * @Route("/{id}", name="caixa-forma-pagamento_show")
     * @Method("GET")
     */
    public function showAction(CaixaFormaPagamento $caixaFormaPagamento)
    {
        $deleteForm = $this->createDeleteForm($caixaFormaPagamento);

        return $this->render('caixaformapagamento/show.html.twig', array(
            'caixaFormaPagamento' => $caixaFormaPagamento,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing caixaFormaPagamento entity.
     *
     * @Route("/{id}/edit", name="caixa-forma-pagamento_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, CaixaFormaPagamento $caixaFormaPagamento)
    {
        $deleteForm = $this->createDeleteForm($caixaFormaPagamento);
        $editForm = $this->createForm('Kod\Bundle\CaixaBundle\Form\CaixaFormaPagamentoType', $caixaFormaPagamento);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('caixa-forma-pagamento_edit', array('id' => $caixaFormaPagamento->getId()));
        }

        return $this->render('caixaformapagamento/edit.html.twig', array(
            'caixaFormaPagamento' => $caixaFormaPagamento,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a caixaFormaPagamento entity.
     *
     * @Route("/{id}", name="caixa-forma-pagamento_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, CaixaFormaPagamento $caixaFormaPagamento)
    {
        $form = $this->createDeleteForm($caixaFormaPagamento);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($caixaFormaPagamento);
            $em->flush();
        }

        return $this->redirectToRoute('caixaformapagamento_index');
    }

    /**
     * Creates a form to delete a caixaFormaPagamento entity.
     *
     * @param CaixaFormaPagamento $caixaFormaPagamento The caixaFormaPagamento entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(CaixaFormaPagamento $caixaFormaPagamento)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('caixa-forma-pagamento_delete', array('id' => $caixaFormaPagamento->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
