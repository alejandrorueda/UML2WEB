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
        $b = $a->addGen("cadenaprueba"

,"cadenaprueba"
,null,"Esta es una cadena de prueba"
,"c"
,'2000-01-01'

,"cadenaprueba"
,"cadenaprueba"
,"cadenaprueba"
,"cadenaprueba"
,"c"

);

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
