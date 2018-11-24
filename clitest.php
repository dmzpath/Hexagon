<?php
/**
 * Created by PhpStorm.
 * User: patricio
 * Date: 24/11/18
 * Time: 02:00
 */

require_once 'config/bootstrap.php';

$entityManager = getEntityManager();

$user = new \Hexagon\Model\Kernel\User\User();

$user->setName('Guachin');

$entityManager->persist($user);
$entityManager->flush();

var_dump($user->getId());

