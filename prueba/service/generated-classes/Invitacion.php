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
			throw $e;
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
       
       
       $invitacion->delete();
       
       
	   } catch (Exception $e) {
	
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
        
        
   
   
}

?>
