<?php

namespace Kod\Bundle\CaixaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Profissional
 *
 * @ORM\Table(name="profissional")
 * @ORM\Entity(repositoryClass="Kod\Bundle\CaixaBundle\Repository\ProfissionalRepository")
 */
class Profissional
{
	public function __toString(){
		return $this->nome;
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
     * Get id
     *
     * @return int
     */
    public function getId() {
	    return $this->id;

    }

	 public function getNome(){
	    return $this->nome;
    }

	    public function setNome($nome){
	    $this->nome = $nome;
	    return $this;
    }
}

