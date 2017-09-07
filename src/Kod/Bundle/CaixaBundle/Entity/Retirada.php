<?php

namespace Kod\Bundle\CaixaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Retirada
 *
 * @ORM\Table(name="retirada")
 * @ORM\Entity(repositoryClass="Kod\Bundle\CaixaBundle\Repository\RetiradaRepository")
 */
class Retirada
{
	public function __construct() {
		$data = new \Datetime();

		$this->setData($data);
	}

	public function __toString() {
		return $this->profissional . " - " . $this->descricao;
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
	 * @var \Kod\Bundle\CaixaBundle\Entity\Profissional
	 *
	 * @ORM\ManyToOne(targetEntity="\Kod\Bundle\CaixaBundle\Entity\Profissional")
	 * @ORM\JoinColumn(name="profissional_id", referencedColumnName="id")
	 */
    private $profissional;

    /**
     * @var string
     *
     * @ORM\Column(name="valor", type="decimal", precision=10, scale=2)
     */
    private $valor;

    /**
     * @var string
     *
     * @ORM\Column(name="descricao", type="text")
     */
    private $descricao;

	/**
	 * @var \Kod\Bundle\CaixaBundle\Entity\Caixa
	 *
	 * @ORM\ManyToOne(targetEntity="\Kod\Bundle\CaixaBundle\Entity\Caixa", inversedBy="retiradas")
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
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set profissional
     *
     * @param \Kod\Bundle\CaixaBundle\Entity\Profissional $profissional
     *
     * @return Retirada
     */
    public function setProfissional(\Kod\Bundle\CaixaBundle\Entity\Profissional $profissional)
    {
        $this->profissional = $profissional;

        return $this;
    }

    /**
     * Get profissional
     *
     * @return \Kod\Bundle\CaixaBundle\Entity\Profissional
     */
    public function getProfissional()
    {
        return $this->profissional;
    }

    /**
     * Set valor
     *
     * @param string $valor
     *
     * @return Retirada
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
     * Set descricao
     *
     * @param string $descricao
     *
     * @return Retirada
     */
    public function setDescricao($descricao)
    {
        $this->descricao = $descricao;

        return $this;
    }

    /**
     * Get descricao
     *
     * @return string
     */
    public function getDescricao()
    {
        return $this->descricao;
    }

    /**
     * Set caixa
     *
     * @param \Kod\Bundle\CaixaBundle\Entity\Caixa $caixa
     *
     * @return Retirada
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
     * @return Retirada
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
}

