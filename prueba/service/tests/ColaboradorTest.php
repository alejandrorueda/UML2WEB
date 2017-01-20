<?php
use PHPUnit\Framework\TestCase;
include "generated-conf/config.php";


class ColaboradorTest extends TestCase
{
    public function testCanBeAdd()
    {
        // Arrange
        $a = new Colaborador();

        // Act
        $b = $a->add("cadenaprueba"
,1000
,100000
);

        // Assert
        
        $query=$b->get($b->getPrimaryKey());
        
        $this->assertEquals(1000
        ,$query->getMensaje());
        $this->assertEquals(100000
        ,$query->getPrueba());
        
        
       return $b;
    }
     /**
     * @depends testCanBeAdd
     */
    public function testCanBeDelete(Colaborador $b)
    {
        // Arrange
       
        
        // Assert
        $primaryKey=$b->getPrimaryKey();
        $b->deleteCascade();
        $prueba = new Colaborador();
        $this->assertTrue(true,$prueba->exists($primaryKey));
        
    }

}

?>