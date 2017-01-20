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
	       $this->setInformacion($informacionGrupo);
	       $this->setNombre($nombreGrupo);
	       
           $this->save($con);
	       
	      $con->commit();
          return $this;
	      } catch (Exception $e) {
	        
			$con->rollback(); //en caso de que se produzca alguna excepcion la transacci�n ser� cancelada
			//throw $e;
            return false;
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
       if(!is_null($grupo)){
	       $query = $grupo->getViajes();
	       $grupo->setViajes(new Collection());
	       $grupo->save();
	       foreach($query as $element) {
	       $element->deleteCascade();
	       }     
	       $query = $grupo->getUsuarios();
	       $grupo->setUsuarios(new Collection());
	       $grupo->save();
	       foreach($query as $element) {
	       $element->deleteCascade();
	       }     
	       
	       
	
	       $grupo->delete();
	       
       }
	   } catch (Exception $e) {
	
			throw $e;
		}
     }
    public function normalDelete($primarykey){
       try {
       $grupo = GrupoQuery::create()->filterByidGrupo($primarykey)->findOne();
       $query = $grupo->getViajes();
       $grupo->setViajes(new Collection());
       $grupo->save();
       
       $query = $grupo->getUsuarios();
       $grupo->setUsuarios(new Collection());
       $grupo->save();
       
       
       $grupo->delete();
        return true;
	   } catch (Exception $e) {
	    return false;
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
          // Start of user code Grupo function
   	   // file contents 
          $con = Propel::getWriteConnection(GrupoTableMap::DATABASE_NAME);
   
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
               $query1 = GrupoViajeQuery::create()->filterByIdgrupo($this->getPrimaryKey())->filterByIdviaje($relacionviaje)->findOne();
   			$query1->delete();
               return true;
   
            }catch (Exception $e) {
   	
   		 $con->rollback(); //en caso de que se produzca alguna excepcion la transacci�n ser� cancelada
   		 //throw $e;
            return false;
   		}
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
               $query1 = UsuarioGruposQuery::create()->filterByIdgrupo($this->getPrimaryKey())->filterByIdusuario($relacionusuario)->findOne();
   			$query1->delete();
               return true;
   
            }catch (Exception $e) {
   	
   		 $con->rollback(); //en caso de que se produzca alguna excepcion la transacci�n ser� cancelada
   		 //throw $e;
            return false;
   		}
   	  }
        
   
     public function Operation1(){
          // Start of user code Operation1 function
   	   // file contents 
   	   // End of user code
     }
   
}

?>
