<?php
use Base\Administrador as BaseAdministrador;
use Map\AdministradorTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\Collection\Collection;
date_default_timezone_set('America/Los_Angeles');
/**
 * Skeleton subclass for representing a row from the 'Administrador' table.
 *
 *
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 */

class Administrador extends BaseAdministrador
{
   	public function add($idAdministrador){
       $con = Propel::getWriteConnection(AdministradorTableMap::DATABASE_NAME);

	   $con->beginTransaction();
		try {

	       $this->setIdAdministrador($idAdministrador);
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

     public function get($idAdministrador){
       $administrador = AdministradorQuery::create()->filterByidAdministrador($idAdministrador)->findOne();
       //echo $administrador->toJSON();
       return $administrador;
     }
    public function exists($idAdministrador){
       return AdministradorQuery::create()->filterByidAdministrador($idAdministrador)->find()->isEmpty();
     }
    public function deleteCascade(){
       try {
       $administrador = AdministradorQuery::create()->filterByidAdministrador($this->getPrimaryKey())->findOne();
       
       $perfil = new Perfil();
       $perfil = $perfil->get($usuario->getFkPerfil());
       
       $administrador->delete();
       $perfil->deleteCascade();
       
       
	   } catch (Exception $e) {
	
			throw $e;
		}
     }

     public function getAll(){
       $administradors = AdministradorQuery::create()->find();
 
							   
		foreach($administradors as $administrador) {
		  $json[] = $administrador->toArray();
		}

        echo json_encode($json); 
     }
   
   
}

?>
