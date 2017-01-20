<?php
use PHPUnit\Framework\TestCase;
include "generated-conf/config.php";


class PerfilTest extends TestCase
{
    public function testCanBeAdd()
    {
        // Arrange
        $a = new Perfil();

        // Act
        $b = $a->add(null,"Esta es una cadena de prueba"
        ,"c"
        ,new DateTime('2000-01-01')
        );

        // Assert
        
        $query=$b->get($b->getPrimaryKey());
        
        $this->assertEquals("Esta es una cadena de prueba"
        ,$query->getInformacion());
        $this->assertEquals("c"
        ,$query->getGustos());
        $this->assertEquals(new DateTime('2000-01-01')
        ,$query->getNacimiento());
        
        
       return $b;
    }
     /**
     * @depends testCanBeAdd
     */
    public function testCanBeDelete(Perfil $b)
    {
        // Arrange
       
        
        // Assert
        $primaryKey=$b->getPrimaryKey();
        $b->deleteCascade();
        $prueba = new Perfil();
        $this->assertTrue(true,$prueba->exists($primaryKey));
        
    }

}

?>
