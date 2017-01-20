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
	       $this->setDescripcion($descripcionMensajes);
	       $this->setAsunto($asuntoMensajes);
	       $viaje = new Viaje();
	       if(!$viaje->exists($idViaje)){
	       $row = $viaje->get($idViaje);
	       $this->setFkViaje($row->getPrimaryKey());
	       }
	       if(!is_null($idpadre)){
	       $this->setFKpadre($idpadre);
	       }
	       
           $this->save($con);
	       
	      $con->commit();
          return $this;
	      } catch (Exception $e) {
	        
			$con->rollback(); //en caso de que se produzca alguna excepcion la transacci�n ser� cancelada
			//throw $e;
            return false;
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
       if(!is_null($mensajes)){
	       $query = $mensajes->getMensajessRelatedByIdmensajes();
	       $mensajes->setMensajessRelatedByIdmensajes(new Collection());
	       $mensajes->save();
	       foreach($query as $element) {
	       $element->deleteCascade();
	       }     
	       
	       $viaje = new Viaje();
	       $viaje = $viaje->get($mensajes->getFkViaje());
	       
	
	       $mensajes->delete();
	       if(!is_null($viaje)){
	       $viaje->deleteCascade();
	       }
	       
       }
	   } catch (Exception $e) {
	
			throw $e;
		}
     }
    public function normalDelete($primarykey){
       try {
       $mensajes = MensajesQuery::create()->filterByidMensajes($primarykey)->findOne();
       
       $query = $mensajes->getViajes();
       $mensajes->setViajes(new Collection());
       $mensajes->save();
       
       
       $mensajes->delete();
        return true;
	   } catch (Exception $e) {
	    return false;
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
        
     public function addRespuestas($idMensajes,$idpadre
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
   		// throw $e; 
           return false;
   		}
   	   // End of user code
     } 
        
        
     public function addViajeMany($idViaje , $nombreViaje
      , $informacionViaje
      , $transporteViaje
      , $hospedajeViaje
      , $destinoViaje
      , $fechainicioViaje
      , $fechafinalViaje
      , $precioViaje
      , $imagenesViaje
      , $etiquetasViaje
     ){
          // Start of user code Mensajes function
   	   // file contents 
          $con = Propel::getWriteConnection(MensajesTableMap::DATABASE_NAME);
   
   	   $con->beginTransaction();
   
          try{
          $viaje = new Viaje(); 
          if(!$viaje->exists($idViaje) && !is_null ($idViaje)){
            $viaje = $viaje ->get($idViaje);
   	   }
          else{
            
            $viaje= $viaje->add($idViaje , $nombreViaje
             , $informacionViaje
             , $transporteViaje
             , $hospedajeViaje
             , $destinoViaje
             , $fechainicioViaje
             , $fechafinalViaje
             , $precioViaje
             , $imagenesViaje
             , $etiquetasViaje
            );
           }
   
          $this->setViaje($viaje);
          $this->save($con);
          $con->commit();
          return $this;
   	   }catch (Exception $e) {
   	
   		 $con->rollback(); //en caso de que se produzca alguna excepcion la transacci�n ser� cancelada
   		 //throw $e;
            return false;
   		}
   	   // End of user code
     }
        
   
     public function mensajes(){
          // Start of user code mensajes function
   	   // file contents 
   	   // End of user code
     }
     public function escribirMensaje($descripcion,$asunto,$usuarioId,$password){
          // Start of user code escribirMensaje function
   	   // file contents 
   	   // End of user code
     }
   
}

?>
