<?php

namespace Alura\Doctrine\Repository;

use Alura\Doctrine\Entity\Aluno;
use Doctrine\ORM\EntityRepository;

class AlunoRepositorio extends EntityRepository
{
    public function buscarCursoPorAluno()
    {
        $buider = $this->createQueryBuilder('a')
        ->join('a.telefones', 't')
        ->join('a.cursos', 'c')
        ->addSelect('t')
        ->addSelect('c');
        $query = $buider->getQuery();

        return $query->getResult();
    }
}