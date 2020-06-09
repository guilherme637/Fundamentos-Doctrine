<?php

use Alura\Doctrine\Entity\Aluno;
use Alura\Doctrine\Helper\EntityManagerFactory;
use Doctrine\ORM\EntityManager;

require_once __DIR__ . '/../vendor/autoload.php';

$entityMangagerFactory = new EntityManagerFactory();
$entityManger = $entityMangagerFactory->getEntityManager();

$id = $argv[1];
$aluno = $entityManger->getReference(Aluno::class, $id);

$entityManger->remove($aluno);
$entityManger->flush();