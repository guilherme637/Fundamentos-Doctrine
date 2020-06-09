<?php

use Alura\Doctrine\Entity\Aluno;
use Alura\Doctrine\Helper\EntityManagerFactory;

require_once __DIR__ . '/../vendor/autoload.php';

$entityManagerFactory = new EntityManagerFactory();
$entityManger = $entityManagerFactory->getEntityManager();

$classe = Aluno::class;
$dql = "SELECT COUNT(a) FROM $classe a";
$query = $entityManger->createQuery($dql);
$totalAluno = $query->getSingleScalarResult();

echo "Total de alunos: $totalAluno";