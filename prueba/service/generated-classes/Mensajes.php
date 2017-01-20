<?php
use Base\Mensajes as BaseMensajes;
use Map\MensajesTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\Collection\Collection;
date_default_timezone_set('America/Los_Angeles');
/**
 * Skeleton subclass for representing a row from the 'Mensajes' table.
 *
 *
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 */

class Mensajes extends BaseMensajes
{
   	public function add($idMensajes,$idpadre
   	 , $descripcionMensajes
   	 , $asuntoMensajes
   	,$idViaje
   	){
       $con = Propel::getWriteConnection(MensajesTableMap::DATABASE_NAME);

	   $con->beginTransaction();
		try {

	       $this->setIdMensajes($idMensajes);
	       if(!is_null($idpadre)){
	       $this->setFKpadre($idpadre);
	       }
	       $viaje = new Viaje();
	       if(!$viaje->exists($idViaje)){
	       $row = $viaje->get($idViaje);
	       $this->setFkViaje($row->getPrimaryKey());
	       }
	       $this->setAsunto($asuntoMensajes);
	       $this->setDescripcion($descripcionMensajes);
	       
           $this->save($con);
	       
	      $con->commit();
          return $this;
	      } catch (Exception $e) {
	
			$con->rollback(); //en caso de que se produzca alguna excepcion la transacci�n ser� cancelada
			throw $e;
		  }
     }

     public function get($idMensajes){
       $mensajes = MensajesQuery::create()->filterByidMensajes($idMensajes)->findOne();
       //echo $mensajes->toJSON();
       return $mensajes;
     }
    public function exists($idMensajes){
       return MensajesQuery::create()->filterByidMensajes($idMensajes)->find()->isEmpty();
     }
    public function deleteCascade(){
       try {
       $mensajes = MensajesQuery::create()->filterByidMensajes($this->getPrimaryKey())->findOne();
       
       
       $mensajes->delete();
       
       
	   } catch (Exception $e) {
	
			throw $e;
		}
     }

     public function getAll(){
       $mensajess = MensajesQuery::create()->find();
 
							   
		foreach($mensajess as $mensajes) {
		  $json[] = $mensajes->toArray();
		}

        echo json_encode($json); 
     }
        
        
        
     public function addRespuestas($idfather,$idMensajes,$idpadre
      , $descripcionMensajes
      , $asuntoMensajes
     ,$idViaje
     ){
          // Start of user code Mensajes function
   	   // file contents 
          $con = Propel::getWriteConnection(MensajesTableMap::DATABASE_NAME);
   	   $con->beginTransaction();
   
          try{
          
          $mensajes= new Mensajes();
          $child = $mensajes->add($idMensajes,$idpadre
           , $descripcionMensajes
           , $asuntoMensajes
          ,$idViaje
          );
          $father = $mensajes->get($idMensajes);
          $child->addFkpadre($father->getPrimaryKey());
          $child->save($con);
          $con->commit();
          return $this;
   	   }catch (Exception $e) {
   	
   		 $con->rollback(); //en caso de que se produzca alguna excepcion la transacci�n ser� cancelada
   		 throw $e;
   		}
   	   // End of user code
     } 
        
   
     public function escribirMensaje($descripcion,$asunto,$usuarioId,$password){
          // Start of user code escribirMensaje function
   	   // file contents 
   	   // End of user code
     }
     public function mensajes(){
          // Start of user code mensajes function
   	   // file contents 
   	   // End of user code
     }
   
}

?>
