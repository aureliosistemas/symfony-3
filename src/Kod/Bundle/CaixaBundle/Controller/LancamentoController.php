<?php

namespace Kod\Bundle\CaixaBundle\Controller;

use Kod\Bundle\CaixaBundle\Entity\Lancamento;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Lancamento controller.
 *
 * @Route("lancamento")
 */
class LancamentoController extends Controller
{
    /**
     * Lista todos os regiistro relacionados a lancamento.
     *
     * @Route("/", name="lancamento_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $lancamentos = $em->getRepository('KodCaixaBundle:Lancamento')->findAll();

        return $this->render('lancamento/index.html.twig', array(
            'lancamentos' => $lancamentos,
        ));
    }

    /**
     * Cria um novo lancamento.
     *
     * @Route("/new/{caixa}", defaults={"caixa" = 0,""}, name="lancamento_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request,$caixa)
    {
        $lancamento = new Lancamento();
        $form = $this->createForm('Kod\Bundle\CaixaBundle\Form\LancamentoType', $lancamento);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($lancamento);
            $em->flush();

            return $this->redirectToRoute('lancamento_index');
        }

        return $this->render('lancamento/new.html.twig', array(
            'lancamento' => $lancamento,
            'form' => $form->createView(),
	        'caixa' =>$caixa,
            'servico' => true,
            'produto' => true,
        ));
    }

	/**
	 * Cria um novo lancamento de produto.
	 *
	 * @Route("/new/servico/{caixa}", defaults={"caixa" = 0}, name="lancamento_servico_new")
	 * @Method({"GET", "POST"})
	 */
	public function servicoAction(Request $request,$caixa)
	{
		$lancamento = new Lancamento();
		$form = $this->createForm('Kod\Bundle\CaixaBundle\Form\LancamentoType', $lancamento);

		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->persist($lancamento);
			$em->flush();

			return $this->redirectToRoute('caixa_show', array("id" => $lancamento->getCaixa()->getId()));
		}

		return $this->render('lancamento/new.html.twig', array(
			'lancamento' => $lancamento,
			'form' => $form->createView(),
			'servico' => true,
			'produto' => false,
			'caixa' => $caixa,
		));
	}

    /**
	 * Cria um novo lancamento de serviço.
	 *
	 * @Route("/new/produto/{caixa}", defaults={"caixa" = 0}, name="lancamento_produto_new")
	 * @Method({"GET", "POST"})
	 */
	public function produtoAction(Request $request,$caixa)
	{
		$lancamento = new Lancamento();
		$form = $this->createForm('Kod\Bundle\CaixaBundle\Form\LancamentoType', $lancamento);

		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->persist($lancamento);
			$em->flush();

			return $this->redirectToRoute('lancamento_index');
		}

		return $this->render('lancamento/new.html.twig', array(
			'lancamento' => $lancamento,
			'form' => $form->createView(),
			'servico' => false,
			'produto' => true,
			'caixa' =>$caixa,
		));
	}

    /**
     * Busca e mostra lancamento.
     *
     * @Route("/{id}", name="lancamento_show")
     * @Method("GET")
     */
    public function showAction(Lancamento $lancamento)
    {
        $deleteForm = $this->createDeleteForm($lancamento);

        return $this->render('lancamento/show.html.twig', array(
            'lancamento' => $lancamento,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Caso exista mostra o formulario de edição da lancamento.
     *
     * @Route("/{id}/edit", name="lancamento_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Lancamento $lancamento)
    {
        $deleteForm = $this->createDeleteForm($lancamento);
        $editForm = $this->createForm('Kod\Bundle\CaixaBundle\Form\LancamentoType', $lancamento);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('lancamento_edit', array('id' => $lancamento->getId()));
        }

        return $this->render('lancamento/edit.html.twig', array(
            'lancamento' => $lancamento,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deleta a lancamento.
     *
     * @Route("/{id}", name="lancamento_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Lancamento $lancamento)
    {
        $form = $this->createDeleteForm($lancamento);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($lancamento);
            $em->flush();
        }

        return $this->redirectToRoute('lancamento_index');
    }

    /**
     * Cria o formulario para deletar lancamento.
     *
     * @param Lancamento $lancamento The lancamento entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Lancamento $lancamento)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('lancamento_delete', array('id' => $lancamento->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
