<?php

namespace Kod\Bundle\CaixaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Caixa
 *
 * @ORM\Table(name="caixa")
 * @ORM\Entity(repositoryClass="Kod\Bundle\CaixaBundle\Repository\CaixaRepository")
 */
class Caixa
{
	public function __construct()
	{
		$this->lancamentos = new ArrayCollection();
		$this->retiradas = new ArrayCollection();
		$this->setAbertura(new \DateTime());
	}

	public function __toString() {
		return $this->abertura->format('d/m/Y');
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
     * @var \DateTime
     *
     * @ORM\Column(name="abertura", type="date", nullable=true)
     */
    private $abertura;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechamento", type="date", nullable=true)
     */
    private $fechamento;

	/**
	 * @ORM\OneToMany(targetEntity="\Kod\Bundle\CaixaBundle\Entity\Lancamento", mappedBy="caixa")
	 */
	private $lancamentos;

	/**
	 * @var string
	 */
	private $lancamentos_total;

	/**
	 * @ORM\OneToMany(targetEntity="\Kod\Bundle\CaixaBundle\Entity\Retirada", mappedBy="caixa")
	 */
	private $retiradas;


	/**
	 * @var string
	 */
	private $retiradas_total;

	/**
     * @var string
     *
     * @ORM\Column(name="valor_inicial", type="decimal", precision=10, scale=2, nullable=true)
     */
    private $valorInicial;

    /**
     * @var string
     *
     * @ORM\Column(name="valor_final", type="decimal", precision=10, scale=2, nullable=true)
     */
    private $valorFinal;


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
	 * Get retiradas
	 *
	 * @return array
	 */
	public function getRetiradas()
	{
		return $this->retiradas;
	}

	/**
	 * Get retiradas_total
	 *
	 * @return string
	 */
	public function setRetiradas_total()
	{
		$valor = 0;

		foreach ($this->retiradas as $retirada){
			$valor += $retirada->getValor();
		}

		$this->retiradas_total = $valor;
		return $this;
	}

	public function getSaldo(){
		$this->setRetiradas_total();
		$this->setLancamentos_total();
		return $this->lancamentos_total - $this->retiradas_total;
	}

	public function getRetiradas_total(){
		$this->setRetiradas_total();
		return $this->retiradas_total;
	}

	public function getLancamentos_total(){
		$this->setLancamentos_total();
		return $this->lancamentos_total;
	}

	/**
	 * Get lancamentos
	 *
	 * @return array
	 */
	public function getLancamentos()
	{
		return $this->lancamentos;
	}

	/**
	 * Get lancamentos_total
	 *
	 * @return string
	 */
	public function setLancamentos_total()
	{
		$valor = 0;

		foreach ($this->lancamentos as $lancamento){
			$valor += $lancamento->getValor();
		}

		$this->lancamentos_total = $valor;
		return $this;
	}



    /**
     * Set abertura
     *
     * @param \DateTime $abertura
     *
     * @return Caixa
     */
    public function setAbertura($abertura)
    {
        $this->abertura = $abertura;

        return $this;
    }

    /**
     * Get abertura
     *
     * @return \DateTime
     */
    public function getAbertura()
    {
        return $this->abertura;
    }

    /**
     * Set fechamento
     *
     * @param \DateTime $fechamento
     *
     * @return Caixa
     */
    public function setFechamento($fechamento)
    {
        $this->fechamento = $fechamento;

        return $this;
    }

    /**
     * Get fechamento
     *
     * @return \DateTime
     */
    public function getFechamento()
    {
        return $this->fechamento;
    }

    /**
     * Set valorInicial
     *
     * @param string $valorInicial
     *
     * @return Caixa
     */
    public function setValorInicial($valorInicial)
    {
        $this->valorInicial = $valorInicial;

        return $this;
    }

    /**
     * Get valorInicial
     *
     * @return string
     */
    public function getValorInicial()
    {
        return $this->valorInicial;
    }

    /**
     * Set valorFinal
     *
     * @param string $valorFinal
     *
     * @return Caixa
     */
    public function setValorFinal($valorFinal)
    {
        $this->valorFinal = $valorFinal;

        return $this;
    }

    /**
     * Get valorFinal
     *
     * @return string
     */
    public function getValorFinal()
    {
        return $this->valorFinal;
    }
}

