<?php
use Base\Colaborador as BaseColaborador;
use Map\ColaboradorTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\Collection\Collection;
date_default_timezone_set('America/Los_Angeles');
/**
 * Skeleton subclass for representing a row from the 'Colaborador' table.
 *
 *
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 */

class Colaborador extends BaseColaborador
{
   	public function add($idColaborador2 , $mensajeColaborador
   	 , $pruebaColaborador
   	){
       $con = Propel::getWriteConnection(ColaboradorTableMap::DATABASE_NAME);

	   $con->beginTransaction();
		try {

	       $this->setIdColaborador2($idColaborador2);
	       $this->setPrueba($pruebaColaborador);
	       $this->setMensaje($mensajeColaborador);
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

     public function get($idColaborador2){
       $colaborador = ColaboradorQuery::create()->filterByidColaborador2($idColaborador2)->findOne();
       //echo $colaborador->toJSON();
       return $colaborador;
     }
    public function exists($idColaborador2){
       return ColaboradorQuery::create()->filterByidColaborador2($idColaborador2)->find()->isEmpty();
     }
    public function deleteCascade(){
       try {
       $colaborador = ColaboradorQuery::create()->filterByidColaborador2($this->getPrimaryKey())->findOne();
       
       $perfil = new Perfil();
       $perfil = $perfil->get($usuario->getFkPerfil());
       
       $colaborador->delete();
       $perfil->deleteCascade();
       
       
	   } catch (Exception $e) {
	
			throw $e;
		}
     }

     public function getAll(){
       $colaboradors = ColaboradorQuery::create()->find();
 
							   
		foreach($colaboradors as $colaborador) {
		  $json[] = $colaborador->toArray();
		}

        echo json_encode($json); 
     }
   
     public function obtenerInformacion($idusuario){
          // Start of user code obtenerInformacion function
   	   // file contents 
   	   // End of user code
     }
   
}

?>
