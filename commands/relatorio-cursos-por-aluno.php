<?php

use Alura\Doctrine\Entity\Aluno;
use Alura\Doctrine\Entity\Telefone;
use Alura\Doctrine\Helper\EntityManagerFactory;
use Doctrine\DBAL\Logging\DebugStack;

require_once __DIR__ . '/../vendor/autoload.php';

$entityManagerFactory = new EntityManagerFactory();
$entityManager = $entityManagerFactory->getEntityManager();

$alunosRepository = $entityManager->getRepository(Aluno::class);

$debugStack = new DebugStack();
$entityManager->getConfiguration()->setSQLLogger($debugStack);

/** @var Aluno[] $alunos */
$alunos = $alunosRepository->buscarCursoPorAluno();

/** @var Aluno [] $listaAlunos */
$alunos = $alunosRepository->findAll();

foreach ($alunos as $aluno) {
    $telefones = $aluno
    ->getTelefones()
    ->map(function (Telefone $telefone) {
        return $telefone->getNumero();
    })
    ->toArray();
    echo "ID: {$aluno->getId()}\nNome: {$aluno->getNome()}\n";
    echo "Telefones: " . implode(' ', $telefones);
  
    echo "\n\n";

    $cursos = $aluno->getCurso();

    foreach ($cursos as $curso) {
        echo "ID Curso: {$curso->getId()}\n";
        echo "\tCurso: {$curso->getNome()}";
        echo "\n";
    }
    echo "\n";
}
