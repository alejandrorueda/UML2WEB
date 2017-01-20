<?php
use Base\Viaje as BaseViaje;
use Map\ViajeTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\Collection\Collection;
date_default_timezone_set('America/Los_Angeles');
/**
 * Skeleton subclass for representing a row from the 'Viaje' table.
 *
 *
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 */

class Viaje extends BaseViaje
{
   	public function add($idViaje , $nombreViaje
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
       $con = Propel::getWriteConnection(ViajeTableMap::DATABASE_NAME);

	   $con->beginTransaction();
		try {

	       $this->setIdViaje($idViaje);
	       $this->setEtiquetas($etiquetasViaje);
	       $this->setFechafinal($fechafinalViaje);
	       $this->setHospedaje($hospedajeViaje);
	       $this->setImagenes($imagenesViaje);
	       $this->setDestino($destinoViaje);
	       $this->setNombre($nombreViaje);
	       $this->setFechainicio(new DateTime($fechainicioViaje));
	       $this->setPrecio($precioViaje);
	       $this->setInformacion($informacionViaje);
	       $this->setTransporte($transporteViaje);
	       
           $this->save($con);
	       
	      $con->commit();
          return $this;
	      } catch (Exception $e) {
	        
			$con->rollback(); //en caso de que se produzca alguna excepcion la transacci�n ser� cancelada
			//throw $e;
            return false;
		  }
     }

     public function get($idViaje){
       $viaje = ViajeQuery::create()->filterByidViaje($idViaje)->findOne();
       //echo $viaje->toJSON();
       return $viaje;
     }
    public function exists($idViaje){
       return ViajeQuery::create()->filterByidViaje($idViaje)->find()->isEmpty();
     }
    public function deleteCascade(){
       try {
       $viaje = ViajeQuery::create()->filterByidViaje($this->getPrimaryKey())->findOne();
       if(!is_null($viaje)){
	       $query = $viaje->getUsuarios();
	       $viaje->setUsuarios(new Collection());
	       $viaje->save();
	       foreach($query as $element) {
	       $element->deleteCascade();
	       }     
	       $query = $viaje->getGrupos();
	       $viaje->setGrupos(new Collection());
	       $viaje->save();
	       foreach($query as $element) {
	       $element->deleteCascade();
	       }     
	       $query = $viaje->getMensajess();
	       $viaje->setMensajess(new Collection());
	       $viaje->save();
	       foreach($query as $element) {
	       $element->deleteCascade();
	       }     
	       
	       
	
	       $viaje->delete();
	       
       }
	   } catch (Exception $e) {
	
			throw $e;
		}
     }
    public function normalDelete($primarykey){
       try {
       $viaje = ViajeQuery::create()->filterByidViaje($primarykey)->findOne();
       $query = $viaje->getUsuarios();
       $viaje->setUsuarios(new Collection());
       $viaje->save();
       
       $query = $viaje->getGrupos();
       $viaje->setGrupos(new Collection());
       $viaje->save();
       
       $query = $viaje->getMensajess();
       $viaje->setMensajess(new Collection());
       $viaje->save();
       
       
       $viaje->delete();
        return true;
	   } catch (Exception $e) {
	    return false;
			throw $e;
		}
     }

     public function getAll(){
       $viajes = ViajeQuery::create()->find();
 
							   
		foreach($viajes as $viaje) {
		  $json[] = $viaje->toArray();
		}

        echo json_encode($json); 
     }
        
     public function addUsuarioMany($idUsuario,$idPerfil , $informacionPerfil
      , $gustosPerfil
      , $nacimientoPerfil
     
      , $passwordUsuario
      , $nombreUsuario
      , $apellidosUsuario
      , $avatarUsuario
      , $emailUsuario
     ){
          // Start of user code Viaje function
   	   // file contents 
          $con = Propel::getWriteConnection(ViajeTableMap::DATABASE_NAME);
   
   	   $con->beginTransaction();
   
          try{
          $usuario = new Usuario(); 
          if(!$usuario->exists($idUsuario) && !is_null ($idUsuario)){
            $usuario = $usuario ->get($idUsuario);
   	   }
          else{
            
            $usuario= $usuario->add($idUsuario,$idPerfil , $informacionPerfil
             , $gustosPerfil
             , $nacimientoPerfil
            
             , $passwordUsuario
             , $nombreUsuario
             , $apellidosUsuario
             , $avatarUsuario
             , $emailUsuario
            );
           }
   
          $this->addUsuario($usuario);
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
   	  public function deleteUsuarioMany($relacionusuario){
   		try{	
               $query1 = ViajesQuery::create()->filterByIdviaje($this->getPrimaryKey())->filterByIdusuario($relacionusuario)->findOne();
   			$query1->delete();
               return true;
   
            }catch (Exception $e) {
   	
   		 $con->rollback(); //en caso de que se produzca alguna excepcion la transacci�n ser� cancelada
   		 //throw $e;
            return false;
   		}
   	  }
        
        
     public function addGrupoMany($idGrupo , $informacionGrupo
      , $nombreGrupo
     ){
          // Start of user code Viaje function
   	   // file contents 
          $con = Propel::getWriteConnection(ViajeTableMap::DATABASE_NAME);
   
   	   $con->beginTransaction();
   
          try{
          $grupo = new Grupo(); 
          if(!$grupo->exists($idGrupo) && !is_null ($idGrupo)){
            $grupo = $grupo ->get($idGrupo);
   	   }
          else{
            
            $grupo= $grupo->add($idGrupo , $informacionGrupo
             , $nombreGrupo
            );
           }
   
          $this->addGrupo($grupo);
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
   	  public function deleteGrupoMany($relaciongrupo){
   		try{	
               $query1 = GrupoViajeQuery::create()->filterByIdviaje($this->getPrimaryKey())->filterByIdgrupo($relaciongrupo)->findOne();
   			$query1->delete();
               return true;
   
            }catch (Exception $e) {
   	
   		 $con->rollback(); //en caso de que se produzca alguna excepcion la transacci�n ser� cancelada
   		 //throw $e;
            return false;
   		}
   	  }
        
        
     public function addMensajesManyChild($idMensajes,$idpadre
      , $descripcionMensajes
      , $asuntoMensajes
     ,$idViaje
     ){
          // Start of user code Viaje function
   	   // file contents 
          $con = Propel::getWriteConnection(ViajeTableMap::DATABASE_NAME);
   
   	   $con->beginTransaction();
   
          try{
          $mensajes = new Mensajes(); 
          if(!$mensajes->exists($idMensajes) && !is_null ($idMensajes)){
            $mensajes = $mensajes ->get($idMensajes);
   	   }
          else{
            
            $mensajes= $mensajes->add($idMensajes,$idpadre
             , $descripcionMensajes
             , $asuntoMensajes
            ,$idViaje
            );
           }
   
          $this->addMensajes($mensajes);
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
        
   
     public function añadirParticipante($idviaje,$idusuario,$password){
          // Start of user code añadirParticipante function
   	   // file contents 
   	   // End of user code
     }
     public function escribirMensaje($descripcion,$asunto,$idviaje,$usuarioId,$password){
          // Start of user code escribirMensaje function
   	   // file contents 
   	   // End of user code
     }
     public function usuarioApuntado($usuarioId,$password){
          // Start of user code usuarioApuntado function
   	   // file contents 
   	   // End of user code
     }
     public function eliminarParticipante($idviaje,$idusuario,$password){
          // Start of user code eliminarParticipante function
   	   // file contents 
   	   // End of user code
     }
     public function misViajes($idusuario,$password){
          // Start of user code misViajes function
   	   // file contents 
   	   // End of user code
     }
     public function nuevoViaje($nombre,$informacion,$destino,$precio,$fecha_inicio,$fecha_final,$usuarioId,$password){
          // Start of user code nuevoViaje function
   	   // file contents 
   	   // End of user code
     }
     public function viajes(){
          // Start of user code viajes function
   	   // file contents 
   	   // End of user code
     }
     public function mensajes($idviaje){
          // Start of user code mensajes function
   	   // file contents 
   	   // End of user code
     }
     public function viajeInformacion($idviaje,$usuarioId,$password){
          // Start of user code viajeInformacion function
   	   // file contents 
   	   // End of user code
     }
   
}

?>
