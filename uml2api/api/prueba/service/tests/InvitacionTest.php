<?php
use PHPUnit\Framework\TestCase;
include "generated-conf/config.php";


class InvitacionTest extends TestCase
{
    public function testCanBeAdd()
    {
        // Arrange
        $a = new Invitacion();

        // Act
        $b = $a->add(null

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

        // Assert
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
        $this->assertEquals(false,is_null($query->getUsuario()));   
        
        $this->assertEquals($query->getFkUsuario(),$b->getFkUsuario());
        $this->assertEquals("c"
        ,$query->getCodigo());
        $this->assertEquals(true
        ,$query->getActivo());
        
        
       return $b;
    }
     /**
     * @depends testCanBeAdd
     */
    public function testCanBeDelete(Invitacion $b)
    {
        // Arrange
       
        
        // Assert
        $primaryKey=$b->getPrimaryKey();
        $b->deleteCascade();
        $prueba = new Invitacion();
        $this->assertTrue(true,$prueba->exists($primaryKey));
        
    }

}

?>
