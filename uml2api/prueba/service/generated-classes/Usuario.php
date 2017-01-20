<?php
use Base\Usuario as BaseUsuario;
use Map\UsuarioTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\Collection\Collection;
date_default_timezone_set('America/Los_Angeles');
/**
 * Skeleton subclass for representing a row from the 'Usuario' table.
 *
 *
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 */

class Usuario extends BaseUsuario
{
   	public function add($idusuario,$idPerfil , $informacionPerfil
   	 , $gustosPerfil
   	 , $nacimientoPerfil
   	
   	 , $passwordUsuario
   	 , $nombreUsuario
   	 , $apellidosUsuario
   	 , $avatarUsuario
   	 , $emailUsuario
   	){
       $con = Propel::getWriteConnection(UsuarioTableMap::DATABASE_NAME);

	   $con->beginTransaction();
		try {

	       $this->setIdusuario($idusuario);
	       $this->setEmail($emailUsuario);
	       $perfil = new Perfil();
	       if(!$perfil->exists($idPerfil)){
	       $row = $perfil->get($idPerfil);
	       $this->setFkPerfil($row->getPrimaryKey());
	       }
	       else{
	       $perfil->add($idPerfil , $informacionPerfil
	        , $gustosPerfil
	        , $nacimientoPerfil
	       );
	       $this->setFkPerfil($perfil->getPrimaryKey());
	       }
	       $this->setAvatar($avatarUsuario);
	       $this->setApellidos($apellidosUsuario);
	       $this->setPassword($passwordUsuario);
	       $this->setNombre($nombreUsuario);
	       
           $this->save($con);
	       
	      $con->commit();
          return $this;
	      } catch (Exception $e) {
	        
			$con->rollback(); //en caso de que se produzca alguna excepcion la transacci�n ser� cancelada
			//throw $e;
            return false;
		  }
     }

     public function get($idusuario){
       $usuario = UsuarioQuery::create()->filterByidusuario($idusuario)->findOne();
       //echo $usuario->toJSON();
       return $usuario;
     }
    public function exists($idusuario){
       return UsuarioQuery::create()->filterByidusuario($idusuario)->find()->isEmpty();
     }
    public function deleteCascade(){
       try {
       $usuario = UsuarioQuery::create()->filterByidusuario($this->getPrimaryKey())->findOne();
       if(!is_null($usuario)){
	       $query = $usuario->getViajes();
	       $usuario->setViajes(new Collection());
	       $usuario->save();
	       foreach($query as $element) {
	       $element->deleteCascade();
	       }     
	       $query1 = AmigosQuery::create()->filterByIdUsuario($this->getPrimaryKey())->find();
	       foreach($query1 as $element) {
	       $element->delete();
	       }    
	       $query2 = AmigosQuery::create()->filterByRelacionusuario($this->getPrimaryKey())->find();
	       foreach($query2 as $element) {
	       $element->delete();
	       } 
	       $query = $usuario->getInvitacions();
	       $usuario->setInvitacions(new Collection());
	       $usuario->save();
	       foreach($query as $element) {
	       $element->deleteCascade();
	       }     
	       $query = $usuario->getGrupos();
	       $usuario->setGrupos(new Collection());
	       $usuario->save();
	       foreach($query as $element) {
	       $element->deleteCascade();
	       }     
	       
	       $perfil = new Perfil();
	       $perfil = $perfil->get($usuario->getFkPerfil());
	       
	
	       $usuario->delete();
	       if(!is_null($perfil)){
	       $perfil->deleteCascade();
	       }
	       
       }
	   } catch (Exception $e) {
	
			throw $e;
		}
     }
    public function normalDelete($primarykey){
       try {
       $usuario = UsuarioQuery::create()->filterByidusuario($primarykey)->findOne();
       $query = $usuario->getViajes();
       $usuario->setViajes(new Collection());
       $usuario->save();
       
       $query1 = AmigosQuery::create()->filterByIdUsuario($this->getPrimaryKey())->find();
       foreach($query1 as $element) {
       $element->delete();
       }    
       $query2 = AmigosQuery::create()->filterByRelacionusuario($this->getPrimaryKey())->find();
       foreach($query2 as $element) {
       $element->delete();
       } 
       $query = $usuario->getInvitacions();
       $usuario->setInvitacions(new Collection());
       $usuario->save();
       
       $query = $usuario->getGrupos();
       $usuario->setGrupos(new Collection());
       $usuario->save();
       
       
       $usuario->delete();
        return true;
	   } catch (Exception $e) {
	    return false;
			throw $e;
		}
     }

     public function getAll(){
       $usuarios = UsuarioQuery::create()->find();
 
							   
		foreach($usuarios as $usuario) {
		  $json[] = $usuario->toArray();
		}

        echo json_encode($json); 
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
          // Start of user code Usuario function
   	   // file contents 
          $con = Propel::getWriteConnection(UsuarioTableMap::DATABASE_NAME);
   
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
   
          $this->addViaje($viaje);
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
   	  public function deleteViajeMany($relacionviaje){
   		try{	
               $query1 = ViajesQuery::create()->filterByIdusuario($this->getPrimaryKey())->filterByIdviaje($relacionviaje)->findOne();
   			$query1->delete();
               return true;
   
            }catch (Exception $e) {
   	
   		 $con->rollback(); //en caso de que se produzca alguna excepcion la transacci�n ser� cancelada
   		 //throw $e;
            return false;
   		}
   	  }
        
        
        
        
     public function addAmigos($relacionusuario){
      	/*$amigos = new Amigos();
      	$con = Propel::getWriteConnection(AmigosTableMap::DATABASE_NAME);
      	
      	$con->beginTransaction();
      	try {
      		$usuario = new Usuario();
      		if(!$usuario->exists($idusuario) && !$usuario->exists($relacionusuario)){
   	   		$amigos->setIdusuario($idusuario);
   	   		$amigos->setRelacionusuario($relacionusuario);
      		}
      	
      		$amigos->save($con);
      	
      		$con->commit();
      		return $this;
      	} catch (Exception $e) {
      	
      		$con->rollback(); //en caso de que se produzca alguna excepcion la transacci�n ser� cancelada
      		//throw $e;
           return false;
      	}*/
      	$con = Propel::getWriteConnection(UsuarioTableMap::DATABASE_NAME);
      	
      	$con->beginTransaction();
      	try {
   	   	$this->addUsuarioRelatedByIdusuario($this->get($relacionusuario));
      	
      		$this->save($con);
      	
      		$con->commit();
      		return $this;
      	} catch (Exception $e) {
      	
      		$con->rollback(); //en caso de que se produzca alguna excepcion la transacci�n ser� cancelada
      		//throw $e;
           return false;
      	}
     } 
   
     public function deleteAmigos($relacionusuario){
          try{
   		$query1 = AmigosQuery::create()->filterByIdusuario($this->getPrimaryKey())->filterByRelacionusuario($relacionusuario)->findOne();
   		$query1->delete();
           return true;
   
           }catch (Exception $e) {
   	
   		 $con->rollback(); //en caso de que se produzca alguna excepcion la transacci�n ser� cancelada
   		 //throw $e;
            return false;
   		}
     } 
        
        
     public function addInvitacionManyChild($idInvitacion,$idUsuario,$idPerfil , $informacionPerfil
      , $gustosPerfil
      , $nacimientoPerfil
     
      , $passwordUsuario
      , $nombreUsuario
      , $apellidosUsuario
      , $avatarUsuario
      , $emailUsuario
     
      , $codigoInvitacion
      , $activoInvitacion
     ){
          // Start of user code Usuario function
   	   // file contents 
          $con = Propel::getWriteConnection(UsuarioTableMap::DATABASE_NAME);
   
   	   $con->beginTransaction();
   
          try{
          $invitacion = new Invitacion(); 
          if(!$invitacion->exists($idInvitacion) && !is_null ($idInvitacion)){
            $invitacion = $invitacion ->get($idInvitacion);
   	   }
          else{
            
            $invitacion= $invitacion->add($idInvitacion,$idUsuario,$idPerfil , $informacionPerfil
             , $gustosPerfil
             , $nacimientoPerfil
            
             , $passwordUsuario
             , $nombreUsuario
             , $apellidosUsuario
             , $avatarUsuario
             , $emailUsuario
            
             , $codigoInvitacion
             , $activoInvitacion
            );
           }
   
          $this->addInvitacion($invitacion);
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
        
        
     public function addGrupoMany($idGrupo , $informacionGrupo
      , $nombreGrupo
     ){
          // Start of user code Usuario function
   	   // file contents 
          $con = Propel::getWriteConnection(UsuarioTableMap::DATABASE_NAME);
   
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
               $query1 = UsuarioGruposQuery::create()->filterByIdusuario($this->getPrimaryKey())->filterByIdgrupo($relaciongrupo)->findOne();
   			$query1->delete();
               return true;
   
            }catch (Exception $e) {
   	
   		 $con->rollback(); //en caso de que se produzca alguna excepcion la transacci�n ser� cancelada
   		 //throw $e;
            return false;
   		}
   	  }
        
   
     public function datosUsuario($idusuario,$password){
          // Start of user code datosUsuario function
   	   // file contents 
   	   // End of user code
     }
     public function registrar($idusuario,$nombre,$password,$apellidos,$avatar,$email){
          // Start of user code registrar function
   	   // file contents 
   	   // End of user code
     }
     public function informacionPerfil($idusuario,$password){
          // Start of user code informacionPerfil function
   	   // file contents 
   	   // End of user code
     }
     public function iniciarSesion($idusuario,$password){
          // Start of user code iniciarSesion function
   	   // file contents 
   	   // End of user code
     }
   
}

?>
