<?php
use Base\Grupo as BaseGrupo;
use Map\GrupoTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\Collection\Collection;
date_default_timezone_set('America/Los_Angeles');
/**
 * Skeleton subclass for representing a row from the 'Grupo' table.
 *
 *
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 */

class Grupo extends BaseGrupo
{
   	public function add($idGrupo , $informacionGrupo
   	 , $nombreGrupo
   	){
       $con = Propel::getWriteConnection(GrupoTableMap::DATABASE_NAME);

	   $con->beginTransaction();
		try {

	       $this->setIdGrupo($idGrupo);
	       $this->setNombre($nombreGrupo);
	       $this->setInformacion($informacionGrupo);
	       
           $this->save($con);
	       
	      $con->commit();
          return $this;
	      } catch (Exception $e) {
	
			$con->rollback(); //en caso de que se produzca alguna excepcion la transacci�n ser� cancelada
			throw $e;
		  }
     }

     public function get($idGrupo){
       $grupo = GrupoQuery::create()->filterByidGrupo($idGrupo)->findOne();
       //echo $grupo->toJSON();
       return $grupo;
     }
    public function exists($idGrupo){
       return GrupoQuery::create()->filterByidGrupo($idGrupo)->find()->isEmpty();
     }
    public function deleteCascade(){
       try {
       $grupo = GrupoQuery::create()->filterByidGrupo($this->getPrimaryKey())->findOne();
       $query = $grupo->getUsuarios();
       $grupo->setUsuarios(new Collection());
       $grupo->save();
       foreach($query as $element) {
       $element->deleteCascade();
       }     
       
       
       $grupo->delete();
       
       
	   } catch (Exception $e) {
	
			throw $e;
		}
     }

     public function getAll(){
       $grupos = GrupoQuery::create()->find();
 
							   
		foreach($grupos as $grupo) {
		  $json[] = $grupo->toArray();
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
          // Start of user code Grupo function
   	   // file contents 
          $con = Propel::getWriteConnection(GrupoTableMap::DATABASE_NAME);
   
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
        
   
     public function Operation1(){
          // Start of user code Operation1 function
   	   // file contents 
   	   // End of user code
     }
   
}

?>
