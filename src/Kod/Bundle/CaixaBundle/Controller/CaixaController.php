<?php

namespace Kod\Bundle\CaixaBundle\Controller;

use Kod\Bundle\CaixaBundle\Entity\Caixa;
use Kod\Bundle\CaixaBundle\Entity\Profissional;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Caixa controller.
 *
 * @Route("caixa")
 */
class CaixaController extends Controller
{
    /**
     * Lista todos os regiistro relacionados a caixa.
     *
     * @Route("/", name="caixa_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $caixas = $em->getRepository('KodCaixaBundle:Caixa')->findAll();

        return $this->render('caixa/index.html.twig', array(
            'caixas' => $caixas,
        ));
    }

    /**
     * Cria um novo caixa.
     *
     * @Route("/new", name="caixa_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $caixa = new Caixa();
        $form = $this->createForm('Kod\Bundle\CaixaBundle\Form\CaixaType', $caixa);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($caixa);
            $em->flush();

            return $this->redirectToRoute('caixa_show', array('id' => $caixa->getId()));
        }

        return $this->render('caixa/new.html.twig', array(
            'caixa' => $caixa,
            'form' => $form->createView(),
        ));
    }

    /**
     * Busca e mostra caixa.
     *
     * @Route("/{id}", name="caixa_show")
     * @Method("GET")
     */
    public function showAction(Caixa $caixa)
    {
    	$caixaId = $caixa->getId();
	    $em = $this->getDoctrine()->getManager();
	    $query = $em->createQuery("SELECT SUM(l.valor) as total, p.nome as nome from KodCaixaBundle:Lancamento l LEFT JOIN KodCaixaBundle:Profissional p WHERE l.caixa = {$caixaId} GROUP BY p.id");
		$profissionais = $query->getResult();

		return $this->render('caixa/show.html.twig', array(
            'caixa' => $caixa,
            'profissionais' => $profissionais,
        ));
    }

	/**
	 * Busca e mostra caixa.
	 *
	 * @Route("/fechar/{id}", name="caixa_fechar")
	 * @Method("GET")
	 */
	public function fecharAction(Caixa $caixa)
	{
		$caixa->setFechamento(new \DateTime);
		$this->getDoctrine()->getManager()->flush();
		return $this->redirectToRoute('caixa_show', array('id' => $caixa->getId()));
	}

    /**
     * Caso exista mostra o formulario de edição da caixa.
     *
     * @Route("/{id}/edit", name="caixa_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Caixa $caixa)
    {
        $deleteForm = $this->createDeleteForm($caixa);
        $editForm = $this->createForm('Kod\Bundle\CaixaBundle\Form\CaixaType', $caixa);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('caixa_edit', array('id' => $caixa->getId()));
        }

        return $this->render('caixa/edit.html.twig', array(
            'caixa' => $caixa,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deleta a caixa.
     *
     * @Route("/{id}", name="caixa_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Caixa $caixa)
    {
        $form = $this->createDeleteForm($caixa);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($caixa);
            $em->flush();
        }

        return $this->redirectToRoute('caixa_index');
    }

    /**
     * Cria o formulario para deletar caixa.
     *
     * @param Caixa $caixa The caixa entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Caixa $caixa)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('caixa_delete', array('id' => $caixa->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
