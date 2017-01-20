<?php
use PHPUnit\Framework\TestCase;
include "generated-conf/config.php";


class GrupoTest extends TestCase
{
    public function testCanBeAdd()
    {
        // Arrange
        $a = new Grupo();

        // Act
        $b = $a->add(null

,"Esta es una cadena de prueba"
,"cadenaprueba"
);

        // Assert
        $b->addViajeMany(null
        ,"c"
        ,"Esta es una cadena de prueba"
        ,"Esta es una cadena de prueba"
        ,"Esta es una cadena de prueba"
        ,"cadenaprueba"
        ,'2000-01-01'
        ,"c"
        ,10.45
        ,"c"
        ,"c"
        );   
        $b->addUsuarioMany("cadenaprueba"
        
        ,null,"Esta es una cadena de prueba"
        ,"c"
        ,'2000-01-01'
        
        ,"cadenaprueba"
        ,"cadenaprueba"
        ,"cadenaprueba"
        ,"cadenaprueba"
        ,"c"
        );   
        
        $query=$b->get($b->getPrimaryKey());
        $this->assertEquals(false,$query->getViajes()->isEmpty());   
        $this->assertEquals(false,$query->getUsuarios()->isEmpty());   
        
        $this->assertEquals("Esta es una cadena de prueba"
        ,$query->getInformacion());
        $this->assertEquals("cadenaprueba"
        ,$query->getNombre());
        
        
       return $b;
    }
     /**
     * @depends testCanBeAdd
     */
    public function testCanBeDelete(Grupo $b)
    {
        // Arrange
       
        
        // Assert
        $primaryKey=$b->getPrimaryKey();
        $b->deleteCascade();
        $prueba = new Grupo();
        $this->assertTrue(true,$prueba->exists($primaryKey));
        
    }

}

?>
