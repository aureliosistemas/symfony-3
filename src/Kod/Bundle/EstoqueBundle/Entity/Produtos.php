<?php

namespace Kod\Bundle\EstoqueBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Produtos
 *
 * @ORM\Table(name="produtos")
 * @ORM\Entity(repositoryClass="Kod\Bundle\EstoqueBundle\Repository\ProdutosRepository")
 */
class Produtos
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
     * @ORM\Column(name="nome", type="string", length=255)
     */
    private $nome;

    /**
     * @var \stdClass
     *
     * @ORM\Column(name="fornecedor", type="object", nullable=true)
     */
    private $fornecedor;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="validade", type="date", nullable=true)
     */
    private $validade;

    /**
     * @var bool
     *
     * @ORM\Column(name="preco_fixo", type="boolean")
     */
    private $precoFixo;

    /**
     * @var string
     *
     * @ORM\Column(name="valor_compra", type="decimal", precision=2, scale=10, nullable=true)
     */
    private $valorCompra;

    /**
     * @var string
     *
     * @ORM\Column(name="valor_venda", type="decimal", precision=2, scale=10)
     */
    private $valorVenda;

    /**
     * @var string
     *
     * @ORM\Column(name="descricao", type="text", nullable=true)
     */
    private $descricao;

    /**
     * @var \stdClass
     *
     * @ORM\Column(name="status", type="object")
     */
    private $status;

    /**
     * @var int
     *
     * @ORM\Column(name="quantidade_atual", type="integer")
     */
    private $quantidadeAtual;

    /**
     * @var int
     *
     * @ORM\Column(name="quantidade_ideal", type="integer", nullable=true)
     */
    private $quantidadeIdeal;

    /**
     * @var int
     *
     * @ORM\Column(name="quantidade_minima", type="integer", nullable=true)
     */
    private $quantidadeMinima;

    /**
     * @var \stdClass
     *
     * @ORM\Column(name="unidade_medida", type="object")
     */
    private $unidadeMedida;


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
     * @return Produtos
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

    /**
     * Set fornecedor
     *
     * @param \stdClass $fornecedor
     *
     * @return Produtos
     */
    public function setFornecedor($fornecedor)
    {
        $this->fornecedor = $fornecedor;

        return $this;
    }

    /**
     * Get fornecedor
     *
     * @return \stdClass
     */
    public function getFornecedor()
    {
        return $this->fornecedor;
    }

    /**
     * Set validade
     *
     * @param \DateTime $validade
     *
     * @return Produtos
     */
    public function setValidade($validade)
    {
        $this->validade = $validade;

        return $this;
    }

    /**
     * Get validade
     *
     * @return \DateTime
     */
    public function getValidade()
    {
        return $this->validade;
    }

    /**
     * Set precoFixo
     *
     * @param boolean $precoFixo
     *
     * @return Produtos
     */
    public function setPrecoFixo($precoFixo)
    {
        $this->precoFixo = $precoFixo;

        return $this;
    }

    /**
     * Get precoFixo
     *
     * @return bool
     */
    public function getPrecoFixo()
    {
        return $this->precoFixo;
    }

    /**
     * Set valorCompra
     *
     * @param string $valorCompra
     *
     * @return Produtos
     */
    public function setValorCompra($valorCompra)
    {
        $this->valorCompra = $valorCompra;

        return $this;
    }

    /**
     * Get valorCompra
     *
     * @return string
     */
    public function getValorCompra()
    {
        return $this->valorCompra;
    }

    /**
     * Set valorVenda
     *
     * @param string $valorVenda
     *
     * @return Produtos
     */
    public function setValorVenda($valorVenda)
    {
        $this->valorVenda = $valorVenda;

        return $this;
    }

    /**
     * Get valorVenda
     *
     * @return string
     */
    public function getValorVenda()
    {
        return $this->valorVenda;
    }

    /**
     * Set descricao
     *
     * @param string $descricao
     *
     * @return Produtos
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
     * Set status
     *
     * @param \stdClass $status
     *
     * @return Produtos
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return \stdClass
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set quantidadeAtual
     *
     * @param integer $quantidadeAtual
     *
     * @return Produtos
     */
    public function setQuantidadeAtual($quantidadeAtual)
    {
        $this->quantidadeAtual = $quantidadeAtual;

        return $this;
    }

    /**
     * Get quantidadeAtual
     *
     * @return int
     */
    public function getQuantidadeAtual()
    {
        return $this->quantidadeAtual;
    }

    /**
     * Set quantidadeIdeal
     *
     * @param integer $quantidadeIdeal
     *
     * @return Produtos
     */
    public function setQuantidadeIdeal($quantidadeIdeal)
    {
        $this->quantidadeIdeal = $quantidadeIdeal;

        return $this;
    }

    /**
     * Get quantidadeIdeal
     *
     * @return int
     */
    public function getQuantidadeIdeal()
    {
        return $this->quantidadeIdeal;
    }

    /**
     * Set quantidadeMinima
     *
     * @param integer $quantidadeMinima
     *
     * @return Produtos
     */
    public function setQuantidadeMinima($quantidadeMinima)
    {
        $this->quantidadeMinima = $quantidadeMinima;

        return $this;
    }

    /**
     * Get quantidadeMinima
     *
     * @return int
     */
    public function getQuantidadeMinima()
    {
        return $this->quantidadeMinima;
    }

    /**
     * Set unidadeMedida
     *
     * @param \stdClass $unidadeMedida
     *
     * @return Produtos
     */
    public function setUnidadeMedida($unidadeMedida)
    {
        $this->unidadeMedida = $unidadeMedida;

        return $this;
    }

    /**
     * Get unidadeMedida
     *
     * @return \stdClass
     */
    public function getUnidadeMedida()
    {
        return $this->unidadeMedida;
    }
}

