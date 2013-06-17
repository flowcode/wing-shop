<?php

use flowcode\orm\builder\MapperBuilder;
use flowcode\orm\domain\Mapper;

require_once (__DIR__ . '/../mvc/Autoloader.php');

if (count($argv) < 2) {
    fwrite(STDOUT, "Ingrese el nombre de la entidad, ejemplo: noticia \n");
    die();
}

$name = $argv[2];
$module = $argv[1];
fwrite(STDOUT, "Obteniendo mapper para: $name \n");

/* obtengo el mapper */
$mappingFilePath = dirname(__FILE__) . "/../../../../orm-mapping.xml";
$mapping = simplexml_load_file($mappingFilePath);
$mapper = MapperBuilder::buildFromName($mapping, $name);

fwrite(STDOUT, "Mapper obtenido. \n");

/* construyo el dao */
$fileDao = __DIR__ . "/../../$module/dao/" . ucfirst($mapper->getName()) . "Dao.php";

fwrite(STDOUT, "Creando archivo: $fileDao \n");

$fp = fopen($fileDao, "w+");
if ($fp == false) {
    die("No se ha podido crear el archivo.");
}
$daoFileString = getDaoFileString($mapper);
fwrite($fp, $daoFileString);
fclose($fp);

/* construyo el service */
$fileService = __DIR__ . "/../../$module/service/" . ucfirst($mapper->getName()) . "Service.php";

fwrite(STDOUT, "Creando archivo: $fileService \n");

$fp = fopen($fileService, "w+");
if ($fp == false) {
    die("No se ha podido crear el archivo.");
}
$serviceFileString = getServiceFileString($mapper);
fwrite($fp, $serviceFileString);
fclose($fp);

/**
 * 
 * @param \flowcode\orm\domain\Mapper $mapper
 * @return string
 */
function getDaoFileString(Mapper $mapper) {
    $fileString = '<?php

namespace flowcode\blog\dao;

use ' . $mapper->getClass() . ';
use flowcode\orm\EntityManager;

/**
 * Description of TagDao
 *
 * @author juanma
 */
class ' . ucfirst($mapper->getName()) . 'Dao {

    public function __construct() {
        
    }

    public function save(' . ucfirst($mapper->getName()) . ' $' . $mapper->getName() . ') {
        EntityManager::getInstance()->save($' . $mapper->getName() . ');
    }

    public function findAll() {
        return EntityManager::getInstance()->findAll("' . $mapper->getName() . '");
    }

    public function delete(' . ucfirst($mapper->getName()) . ' $' . $mapper->getName() . ') {
        EntityManager::getInstance()->delete($' . $mapper->getName() . ');
    }

    public function findById($id) {
        return EntityManager::getInstance()->findById("' . $mapper->getName() . '", $id);
    }

    public function findByFilter($filter = null, $page = 1) {
        $em = EntityManager::getInstance();
        $pager = $em->findByGenericFilter("' . $mapper->getName() . '", $filter, $page);
        return $pager;
    }

}

?>';
    return $fileString;
}

/**
 * 
 * @param \flowcode\orm\domain\Mapper $mapper
 * @return string
 */
function getServiceFileString(Mapper $mapper) {
    $fileString = '<?php

namespace flowcode\blog\dao;

use ' . $mapper->getClass() . ';
use flowcode\orm\EntityManager;

/**
 * Description of TagDao
 *
 * @author juanma
 */
class ' . ucfirst($mapper->getName()) . 'Dao {

    public function __construct() {
        
    }

    public function save(' . ucfirst($mapper->getName()) . ' $tag) {
        EntityManager::getInstance()->save($' . $mapper->getName() . ');
    }

    public function findAll() {
        return EntityManager::getInstance()->findAll("' . $mapper->getName() . '");
    }

    public function delete(' . ucfirst($mapper->getName()) . ' $' . $mapper->getName() . ') {
        EntityManager::getInstance()->delete($' . $mapper->getName() . ');
    }

    public function findById($id) {
        return EntityManager::getInstance()->findById("' . $mapper->getName() . '", $id);
    }

    public function findByFilter($filter = null, $page = 1) {
        $em = EntityManager::getInstance();
        $pager = $em->findByGenericFilter("' . $mapper->getName() . '", $filter, $page);
        return $pager;
    }

}

?>';
    return $fileString;
}

?>
