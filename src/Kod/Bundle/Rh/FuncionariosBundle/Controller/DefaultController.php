<?php

namespace Kod\Bundle\Rh\FuncionariosBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DefaultController extends Controller
{
    /**
     * @Route("/")
     */
    public function indexAction()
    {
        return $this->render('KodRhFuncionariosBundle:Default:index.html.twig');
    }
}
