<?php
use PHPUnit\Framework\TestCase;
include "generated-conf/config.php";


class ViajeTest extends TestCase
{
    public function testCanBeAdd()
    {
        // Arrange
        $a = new Viaje();

        // Act
        $b = $a->add(null,"c"
        ,"Esta es una cadena de prueba"
        ,"Esta es una cadena de prueba"
        ,"Esta es una cadena de prueba"
        ,"cadenaprueba"
        ,new DateTime('2000-01-01')
        ,"c"
        ,10.45
        ,"c"
        ,"c"
        );

        // Assert
        $b->addUsuarioMany("cadenaprueba"
        ,null,"Esta es una cadena de prueba"
        ,"c"
        ,new DateTime('2000-01-01')
        
        ,"cadenaprueba"
        ,"cadenaprueba"
        ,"cadenaprueba"
        ,"cadenaprueba"
        ,"c"
        );   
        $b->addGrupoMany(null,"Esta es una cadena de prueba"
        ,"cadenaprueba"
        );   
        
        $query=$b->get($b->getPrimaryKey());
        $this->assertEquals(false,$query->getUsuarios()->isEmpty());      
        $this->assertEquals(false,$query->getGrupos()->isEmpty());      
        
        $this->assertEquals("c"
        ,$query->getNombre());
        $this->assertEquals("Esta es una cadena de prueba"
        ,$query->getInformacion());
        $this->assertEquals("Esta es una cadena de prueba"
        ,$query->getTransporte());
        $this->assertEquals("Esta es una cadena de prueba"
        ,$query->getHospedaje());
        $this->assertEquals("cadenaprueba"
        ,$query->getDestino());
        $this->assertEquals(new DateTime('2000-01-01')
        ,$query->getFechainicio());
        $this->assertEquals("c"
        ,$query->getFechafinal());
        $this->assertEquals(10.45
        ,$query->getPrecio());
        $this->assertEquals("c"
        ,$query->getImagenes());
        $this->assertEquals("c"
        ,$query->getEtiquetas());
        
        
       return $b;
    }
     /**
     * @depends testCanBeAdd
     */
    public function testCanBeDelete(Viaje $b)
    {
        // Arrange
       
        
        // Assert
        $primaryKey=$b->getPrimaryKey();
        $b->deleteCascade();
        $prueba = new Viaje();
        $this->assertTrue(true,$prueba->exists($primaryKey));
        
    }

}

?>
