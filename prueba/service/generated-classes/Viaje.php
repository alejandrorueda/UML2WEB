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
	       $this->setTransporte($transporteViaje);
	       $this->setNombre($nombreViaje);
	       $this->setDestino($destinoViaje);
	       $this->setEtiquetas($etiquetasViaje);
	       $this->setHospedaje($hospedajeViaje);
	       $this->setFechainicio($fechainicioViaje);
	       $this->setFechafinal($fechafinalViaje);
	       $this->setInformacion($informacionViaje);
	       $this->setImagenes($imagenesViaje);
	       $this->setPrecio($precioViaje);
	       
           $this->save($con);
	       
	      $con->commit();
          return $this;
	      } catch (Exception $e) {
	
			$con->rollback(); //en caso de que se produzca alguna excepcion la transacci�n ser� cancelada
			throw $e;
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
       
       
       $viaje->delete();
       
       
	   } catch (Exception $e) {
	
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
          
          if(!$this->exists($idUsuario) && !is_null ($idUsuario)){
            $usuario = $this->get($idUsuario);
   	   }
          else{
            $usuario = new Usuario(); 
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
   		 throw $e;
   		}
   	   // End of user code
     } 
        
        
        
        
     public function addGrupoMany($idGrupo , $informacionGrupo
      , $nombreGrupo
     ){
          // Start of user code Viaje function
   	   // file contents 
          $con = Propel::getWriteConnection(ViajeTableMap::DATABASE_NAME);
   
   	   $con->beginTransaction();
   
          try{
          
          if(!$this->exists($idGrupo) && !is_null ($idGrupo)){
            $grupo = $this->get($idGrupo);
   	   }
          else{
            $grupo = new Grupo(); 
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
   		 throw $e;
   		}
   	   // End of user code
     } 
        
   
     public function misViajes($idusuario,$password){
          // Start of user code misViajes function
   	   // file contents 
   	   // End of user code
     }
     public function mensajes($idviaje){
          // Start of user code mensajes function
   	   // file contents 
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
     public function viajeInformacion($idviaje,$usuarioId,$password){
          // Start of user code viajeInformacion function
   	   // file contents 
   	   // End of user code
     }
     public function eliminarParticipante($idviaje,$idusuario,$password){
          // Start of user code eliminarParticipante function
   	   // file contents 
   	   // End of user code
     }
     public function viajes(){
          // Start of user code viajes function
   	   // file contents 
   	   // End of user code
     }
     public function usuarioApuntado($usuarioId,$password){
          // Start of user code usuarioApuntado function
   	   // file contents 
   	   // End of user code
     }
     public function nuevoViaje($nombre,$informacion,$destino,$precio,$fecha_inicio,$fecha_final,$usuarioId,$password){
          // Start of user code nuevoViaje function
   	   // file contents 
   	   // End of user code
     }
   
}

?>
