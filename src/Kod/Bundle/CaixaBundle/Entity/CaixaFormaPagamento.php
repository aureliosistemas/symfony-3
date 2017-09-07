<?php

namespace Kod\Bundle\CaixaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CaixaFormaPagamento
 *
 * @ORM\Table(name="caixa_forma_pagamento")
 * @ORM\Entity(repositoryClass="Kod\Bundle\CaixaBundle\Repository\CaixaFormaPagamentoRepository")
 */
class CaixaFormaPagamento
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nome", type="string", length=255, nullable=true)
     */
    private $nome;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nome
     *
     * @param string $nome
     *
     * @return CaixaFormaPagamento
     */
    public function setNome($nome)
    {
        $this->nome = $nome;

        return $this;
    }

    /**
     * Get nome
     *
     * @return string
     */
    public function getNome()
    {
        return $this->nome;
    }

	public function __toString(){
		return $this->nome;
	}
}

