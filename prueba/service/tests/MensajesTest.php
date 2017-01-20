<?php
use PHPUnit\Framework\TestCase;
include "generated-conf/config.php";


class MensajesTest extends TestCase
{
    public function testCanBeAdd()
    {
        // Arrange
        $a = new Mensajes();

        // Act
        $b = $a->add(null,null
        ,"Esta es una cadena de prueba"
        ,"cadenaprueba"
        ,null
        );

        // Assert
        
        $query=$b->get($b->getPrimaryKey());
        
        $this->assertEquals("Esta es una cadena de prueba"
        ,$query->getDescripcion());
        $this->assertEquals("cadenaprueba"
        ,$query->getAsunto());
        
        
       return $b;
    }
     /**
     * @depends testCanBeAdd
     */
    public function testCanBeDelete(Mensajes $b)
    {
        // Arrange
       
        
        // Assert
        $primaryKey=$b->getPrimaryKey();
        $b->deleteCascade();
        $prueba = new Mensajes();
        $this->assertTrue(true,$prueba->exists($primaryKey));
        
    }

}

?>
