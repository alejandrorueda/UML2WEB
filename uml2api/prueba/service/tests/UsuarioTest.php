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
,'2000-01-01'

,"cadenaprueba"
,"cadenaprueba"
,"cadenaprueba"
,"cadenaprueba"
,"c"
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
        $b->addAmigos($b->getPrimaryKey());   
        $b->addInvitacionManyChild(null
        ,"cadenaprueba"
        ,null,"Esta es una cadena de prueba"
        ,"c"
        ,'2000-01-01'
        
        ,"cadenaprueba"
        ,"cadenaprueba"
        ,"cadenaprueba"
        ,"cadenaprueba"
        ,"c"
        
        ,"c"
        ,true
        );   
        $b->addGrupoMany(null
        ,"Esta es una cadena de prueba"
        ,"cadenaprueba"
        );   
        
        $query=$b->get($b->getPrimaryKey());
        $this->assertEquals(false,$query->getViajes()->isEmpty());   
        $this->assertEquals(false,$query->getUsuariosRelatedByIdusuario()->isEmpty());    
        $this->assertEquals(false,$query->getInvitacions()->isEmpty());   
        $this->assertEquals(false,$query->getGrupos()->isEmpty());   
        
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
