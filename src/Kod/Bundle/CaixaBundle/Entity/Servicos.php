<?php

namespace Kod\Bundle\CaixaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Servicos
 *
 * @ORM\Table(name="servicos")
 * @ORM\Entity(repositoryClass="Kod\Bundle\CaixaBundle\Repository\ServicosRepository")
 */
class Servicos
{
	public function __toString(){
		return $this->nome . " - " . $this->tipo . "/" . $this->categoria;
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
	 * @var string
	 *
	 * @ORM\Column(type="string")
	 */
	private $nome;

	/**
	 * @ORM\ManyToOne(targetEntity="ServicosCategoria", inversedBy="servicos")
	 * @ORM\JoinColumn(name="categoria_id", referencedColumnName="id")
	 */
	private $categoria;

	/**
	 * @ORM\ManyToOne(targetEntity="ServicosTipo", inversedBy="servicos")
	 * @ORM\JoinColumn(name="tipo_id", referencedColumnName="id")
	 */
	private $tipo;

	public function getNome(){
		return $this->nome;
	}

	public function getTipo(){
		return $this->tipo;
	}
	public function getCategoria(){
		return $this->categoria;
	}

	public function __get( $name ) {
		return $this->$name;
	}

	public function __set( $name, $value ) {
		$this->$name = $value;
		return $this;
	}

	/**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

}

