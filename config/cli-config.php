<?php
/**
 * Created by PhpStorm.
 * User: patricio
 * Date: 23/11/18
 * Time: 22:36
 */

use Doctrine\ORM\Tools\Console\ConsoleRunner;


require_once 'bootstrap.php';



// replace with file to your own project bootstrap


// replace with mechanism to retrieve EntityManager in your app
$entityManager = getEntityManager();

return ConsoleRunner::createHelperSet($entityManager);
