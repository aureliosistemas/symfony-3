<?php

namespace Kod\Bundle\CaixaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Lancamento
 *
 * @ORM\Table(name="lancamento")
 * @ORM\Entity(repositoryClass="Kod\Bundle\CaixaBundle\Repository\LancamentoRepository")
 */
class Lancamento
{

	public function __construct() {
		$this->setData(new \DateTime());
	}

	public function __toString() {
		if(empty($this->produto)){
			return $this->profissional . " - " . $this->servico;
		}

		if(!empty($this->produto)){
			return $this->produto;
		}

	}


    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var \Kod\Bundle\EstoqueBundle\Entity\Produtos
     *
     * @ORM\Column(name="produto", type="integer", nullable=true)
     * * @ORM\ManyToOne(targetEntity="\Kod\Bundle\EstoqueBundle\Entity\Produtos")
     * @ORM\JoinColumn(name="produto_id", referencedColumnName="id")
     */
    private $produto;

    /**
     * @var \Kod\Bundle\CaixaBundle\Entity\Servicos
     *
     * @ORM\ManyToOne(targetEntity="\Kod\Bundle\CaixaBundle\Entity\Servicos")
     * @ORM\JoinColumn(name="servico_id", referencedColumnName="id")
     */
    private $servico;

    /**
     * @var string
     *
     * @ORM\Column(name="valor", type="decimal", precision=10, scale=2)
     */
    private $valor;

	/**
	 * @var \Kod\Bundle\CaixaBundle\Entity\CaixaFormaPagamento
	 *
	 * @ORM\ManyToOne(targetEntity="\Kod\Bundle\CaixaBundle\Entity\CaixaFormaPagamento")
	 * @ORM\JoinColumn(name="forma_pagamento_id", referencedColumnName="id")
	 */
	private $forma_pagamento;

    /**
     * @var \Kod\Bundle\CaixaBundle\Entity\Caixa
     *
     * @ORM\ManyToOne(targetEntity="\Kod\Bundle\CaixaBundle\Entity\Caixa", inversedBy="lancamentos")
     * @ORM\JoinColumn(name="caixa_id", referencedColumnName="id")
     */
    private $caixa;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="data", type="datetime")
     */
    private $data;

    /**
     * @var \Kod\Bundle\CaixaBundle\Entity\Profissional
     *
     * @ORM\ManyToOne(targetEntity="\Kod\Bundle\CaixaBundle\Entity\Profissional")
     * @ORM\JoinColumn(name="profissional_id", referencedColumnName="id")
     */
    private $profissional;


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
     * Set produto
     *
     * @param \Kod\Bundle\EstoqueBundle\Entity\Produtos $produto
     *
     * @return Lancamento
     */
    public function setProduto(\Kod\Bundle\EstoqueBundle\Entity\Produtos $produto)
    {
        $this->produto = $produto;

        return $this;
    }

    /**
     * Get produto
     *
     * @return \Kod\Bundle\EstoqueBundle\Entity\Produtos
     */
    public function getProduto()
    {
        return $this->produto;
    }

    /**
     * Set servico
     *
     * @param \Kod\Bundle\CaixaBundle\Entity\Servicos $servico
     *
     * @return Lancamento
     */
    public function setServico(\Kod\Bundle\CaixaBundle\Entity\Servicos $servico)
    {
        $this->servico = $servico;

        return $this;
    }

    /**
     * Get servico
     *
     * @return \Kod\Bundle\CaixaBundle\Entity\Servicos
     */
    public function getServico()
    {
        return $this->servico;
    }

	/**
	 * Set forma_pagamento
	 *
	 * @param \Kod\Bundle\CaixaBundle\Entity\CaixaFormaPagamento $forma_pagamento
	 *
	 * @return Lancamento
	 */
	public function setFormaPagamento(\Kod\Bundle\CaixaBundle\Entity\CaixaFormaPagamento $forma_pagamento)
	{
		$this->forma_pagamento = $forma_pagamento;

		return $this;
	}

	/**
	 * Get forma_pagamento
	 *
	 * @return \Kod\Bundle\CaixaBundle\Entity\CaixaFormaPagamento
	 */
	public function getFormaPagamento()
	{
		return $this->forma_pagamento;
	}

    /**
     * Set valor
     *
     * @param string $valor
     *
     * @return Lancamento
     */
    public function setValor($valor)
    {
        $this->valor = $valor;

        return $this;
    }

    /**
     * Get valor
     *
     * @return string
     */
    public function getValor()
    {
        return $this->valor;
    }

    /**
     * Set caixa
     *
     * @param \Kod\Bundle\CaixaBundle\Entity\Caixa $caixa
     *
     * @return Lancamento
     */
    public function setCaixa(\Kod\Bundle\CaixaBundle\Entity\Caixa $caixa)
    {
        $this->caixa = $caixa;

        return $this;
    }

    /**
     * Get caixa
     *
     * @return \Kod\Bundle\CaixaBundle\Entity\Caixa
     */
    public function getCaixa()
    {
        return $this->caixa;
    }

    /**
     * Set data
     *
     * @param \DateTime $data
     *
     * @return Lancamento
     */
    public function setData($data)
    {
        $this->data = $data;

        return $this;
    }

    /**
     * Get data
     *
     * @return \DateTime
     */
    public function getData()
    {
        return $this->data;
    }

	/**
	 * Set profissional
	 *
	 * @param \Kod\Bundle\CaixaBundle\Entity\Profissional $profissional
	 *
	 * @return Lancamento
	 */
    public function setProfissional( \Kod\Bundle\CaixaBundle\Entity\Profissional $profissional)
    {
        $this->profissional = $profissional;

        return $this;
    }

    /**
     * Get profissional
     *
     * @return  \Kod\Bundle\CaixaBundle\Entity\Profissional
     */
    public function getProfissional()
    {
        return $this->profissional;
    }
}

