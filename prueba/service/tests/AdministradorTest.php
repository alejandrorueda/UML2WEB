<?php
use PHPUnit\Framework\TestCase;
include "generated-conf/config.php";


class AdministradorTest extends TestCase
{
    public function testCanBeAdd()
    {
        // Arrange
        $a = new Administrador();

        // Act
        $b = $a->add(null);

        // Assert
        
        $query=$b->get($b->getPrimaryKey());
        
        
        
       return $b;
    }
     /**
     * @depends testCanBeAdd
     */
    public function testCanBeDelete(Administrador $b)
    {
        // Arrange
       
        
        // Assert
        $primaryKey=$b->getPrimaryKey();
        $b->deleteCascade();
        $prueba = new Administrador();
        $this->assertTrue(true,$prueba->exists($primaryKey));
        
    }

}

?>
