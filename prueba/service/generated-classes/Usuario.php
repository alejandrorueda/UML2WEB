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
	       $this->setPassword($passwordUsuario);
	       $this->setEmail($emailUsuario);
	       $this->setAvatar($avatarUsuario);
	       $this->setNombre($nombreUsuario);
	       $this->setApellidos($apellidosUsuario);
	       
           $this->save($con);
	       
	      $con->commit();
          return $this;
	      } catch (Exception $e) {
	
			$con->rollback(); //en caso de que se produzca alguna excepcion la transacci�n ser� cancelada
			throw $e;
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
       $query1 = AmigosQuery::create()->filterByIdUsuario($this->getPrimaryKey())->find();
       foreach($query1 as $element) {
       $element->delete();
       }    
       $query2 = AmigosQuery::create()->filterByRelacionusuario($this->getPrimaryKey())->find();
       foreach($query2 as $element) {
       $element->delete();
       } 
       
       $perfil = new Perfil();
       $perfil = $perfil->get($usuario->getFkPerfil());
       
       $usuario->delete();
       $perfil->deleteCascade();
       
       
	   } catch (Exception $e) {
	
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
      		throw $e;
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
      		throw $e;
      	}
     } 
   
     public function deleteAmigos($relacionusuario){
   		$query1 = AmigosQuery::create()->filterByIdUsuario($this->getPrimaryKey())->filterByRelacionusuario($relacionusuario)->findOne();
   		$query1->delete();
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
     public function registrar($idusuario,$nombre,$password,$apellidos,$avatar,$email){
          // Start of user code registrar function
   	   // file contents 
   	   // End of user code
     }
     public function datosUsuario($idusuario,$password){
          // Start of user code datosUsuario function
   	   // file contents 
   	   // End of user code
     }
   
}

?>
