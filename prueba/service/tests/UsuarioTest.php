<?php
use PHPUnit\Framework\TestCase;
include "generated-conf/config.php";


class UsuarioTest extends TestCase
{
    public function testCanBeAdd()
    {
        // Arrange
        $a = new Usuario();

        // Act
        $b = $a->add("cadenaprueba"
,null,"Esta es una cadena de prueba"
,"c"
,new DateTime('2000-01-01')

,"cadenaprueba"
,"cadenaprueba"
,"cadenaprueba"
,"cadenaprueba"
,"c"
);

        // Assert
        $b->addAmigos($b->getPrimaryKey());   
        
        $query=$b->get($b->getPrimaryKey());
        $this->assertEquals(false,$query->getUsuariosRelatedByIdusuario()->isEmpty());    
        
        $this->assertEquals($query->getFkPerfil(),$b->getFkPerfil());
        $this->assertEquals("cadenaprueba"
        ,$query->getPassword());
        $this->assertEquals("cadenaprueba"
        ,$query->getNombre());
        $this->assertEquals("cadenaprueba"
        ,$query->getApellidos());
        $this->assertEquals("cadenaprueba"
        ,$query->getAvatar());
        $this->assertEquals("c"
        ,$query->getEmail());
        
        
       return $b;
    }
     /**
     * @depends testCanBeAdd
     */
    public function testCanBeDelete(Usuario $b)
    {
        // Arrange
       
        
        // Assert
        $primaryKey=$b->getPrimaryKey();
        $b->deleteCascade();
        $prueba = new Usuario();
        $this->assertTrue(true,$prueba->exists($primaryKey));
        
    }

}

?>
