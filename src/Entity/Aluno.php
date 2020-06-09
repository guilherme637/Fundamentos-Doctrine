<?php

namespace Alura\Doctrine\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;


/**
 * @Entity(repositoryClass="Alura\Doctrine\Repository\AlunoRepositorio")
 */
class Aluno
{
    /**
     * @Id
     * @GeneratedValue
     * @Column(type="integer")
     */
    private $id;
    
    /**
     * @Column(type="string", unique=true)
     */
    private $nome;
    /**
     * @OneToMany(targetEntity="Telefone", mappedBy="aluno", cascade={"remove", "persist"}, fetch="EAGER")
     */
    private $telefones;
    /**
     * @ManyToMany(targetEntity="Curso", mappedBy="alunos")
     */
    private $cursos;

    public function __construct()
    {
        $this->telefones = new ArrayCollection();
        $this->cursos = new ArrayCollection();
    }

    public function getNome(): string
    {
        return $this->nome;
    }
 
    public function setNome($nome):self
    {
        $this->nome = $nome;

        return $this;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setNumero(Telefone $numero)
    {
        $this->telefones = $numero;
    }

    public function getTelefones(): Collection
    {
        return $this->telefones;        
    }

    public function addTelefones(Telefone $telefone)
    {
        if ($this->telefones->contains($telefone)) {
            return $this;
        }

        $this->telefones->add($telefone);
        $telefone->setAluno($this);
        return $this;
    }
    
    public function addCurso(Curso $curso): self
    {
        if ($this->cursos->contains($curso)) {
            return $this;
        }

        $this->cursos->add($curso);
        $curso->addAluno($this);

        return $this;
    }

    public function getCurso(): Collection
    {
        return $this->cursos;
    }
}