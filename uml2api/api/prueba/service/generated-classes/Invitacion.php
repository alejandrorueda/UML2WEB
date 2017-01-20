<?php
use Base\Invitacion as BaseInvitacion;
use Map\InvitacionTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\Collection\Collection;
date_default_timezone_set('America/Los_Angeles');
/**
 * Skeleton subclass for representing a row from the 'Invitacion' table.
 *
 *
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 */

class Invitacion extends BaseInvitacion
{
   	public function add($idInvitacion,$idUsuario,$idPerfil , $informacionPerfil
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
       $con = Propel::getWriteConnection(InvitacionTableMap::DATABASE_NAME);

	   $con->beginTransaction();
		try {

	       $this->setIdInvitacion($idInvitacion);
	       $this->setCodigo($codigoInvitacion);
	       $usuario = new Usuario();
	       if(!$usuario->exists($idUsuario)){
	       $row = $usuario->get($idUsuario);
	       $this->setFkUsuario($row->getPrimaryKey());
	       }
	       $this->setActivo($activoInvitacion);
	       
           $this->save($con);
	       
	      $con->commit();
          return $this;
	      } catch (Exception $e) {
	        
			$con->rollback(); //en caso de que se produzca alguna excepcion la transacci�n ser� cancelada
			//throw $e;
            return false;
		  }
     }

     public function get($idInvitacion){
       $invitacion = InvitacionQuery::create()->filterByidInvitacion($idInvitacion)->findOne();
       //echo $invitacion->toJSON();
       return $invitacion;
     }
    public function exists($idInvitacion){
       return InvitacionQuery::create()->filterByidInvitacion($idInvitacion)->find()->isEmpty();
     }
    public function deleteCascade(){
       try {
       $invitacion = InvitacionQuery::create()->filterByidInvitacion($this->getPrimaryKey())->findOne();
       if(!is_null($invitacion)){
	       
	       $usuario = new Usuario();
	       $usuario = $usuario->get($invitacion->getFkUsuario());
	       
	
	       $invitacion->delete();
	       if(!is_null($usuario)){
	       $usuario->deleteCascade();
	       }
	       
       }
	   } catch (Exception $e) {
	
			throw $e;
		}
     }
    public function normalDelete($primarykey){
       try {
       $invitacion = InvitacionQuery::create()->filterByidInvitacion($primarykey)->findOne();
       $query = $invitacion->getUsuarios();
       $invitacion->setUsuarios(new Collection());
       $invitacion->save();
       
       
       $invitacion->delete();
        return true;
	   } catch (Exception $e) {
	    return false;
			throw $e;
		}
     }

     public function getAll(){
       $invitacions = InvitacionQuery::create()->find();
 
							   
		foreach($invitacions as $invitacion) {
		  $json[] = $invitacion->toArray();
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
          // Start of user code Invitacion function
   	   // file contents 
          $con = Propel::getWriteConnection(InvitacionTableMap::DATABASE_NAME);
   
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
   
          $this->setUsuario($usuario);
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
        
   
   
}

?>
