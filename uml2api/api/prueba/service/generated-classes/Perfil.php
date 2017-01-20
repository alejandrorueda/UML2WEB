<?php
use Base\Perfil as BasePerfil;
use Map\PerfilTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\Collection\Collection;
date_default_timezone_set('America/Los_Angeles');
/**
 * Skeleton subclass for representing a row from the 'Perfil' table.
 *
 *
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 */

class Perfil extends BasePerfil
{
   	public function add($idPerfil , $informacionPerfil
   	 , $gustosPerfil
   	 , $nacimientoPerfil
   	){
       $con = Propel::getWriteConnection(PerfilTableMap::DATABASE_NAME);

	   $con->beginTransaction();
		try {

	       $this->setIdPerfil($idPerfil);
	       $this->setInformacion($informacionPerfil);
	       $this->setGustos($gustosPerfil);
	       $this->setNacimiento(new DateTime($nacimientoPerfil));
	       
           $this->save($con);
	       
	      $con->commit();
          return $this;
	      } catch (Exception $e) {
	        
			$con->rollback(); //en caso de que se produzca alguna excepcion la transacci�n ser� cancelada
			//throw $e;
            return false;
		  }
     }

     public function get($idPerfil){
       $perfil = PerfilQuery::create()->filterByidPerfil($idPerfil)->findOne();
       //echo $perfil->toJSON();
       return $perfil;
     }
    public function exists($idPerfil){
       return PerfilQuery::create()->filterByidPerfil($idPerfil)->find()->isEmpty();
     }
    public function deleteCascade(){
       try {
       $perfil = PerfilQuery::create()->filterByidPerfil($this->getPrimaryKey())->findOne();
       if(!is_null($perfil)){
	       $query = $perfil->getUsuarios();
	       $perfil->setUsuarios(new Collection());
	       $perfil->save();
	       foreach($query as $element) {
	       $element->deleteCascade();
	       }     
	       
	       
	
	       $perfil->delete();
	       
       }
	   } catch (Exception $e) {
	
			throw $e;
		}
     }
    public function normalDelete($primarykey){
       try {
       $perfil = PerfilQuery::create()->filterByidPerfil($primarykey)->findOne();
       
       $perfil->delete();
        return true;
	   } catch (Exception $e) {
	    return false;
			throw $e;
		}
     }

     public function getAll(){
       $perfils = PerfilQuery::create()->find();
 
							   
		foreach($perfils as $perfil) {
		  $json[] = $perfil->toArray();
		}

        echo json_encode($json); 
     }
        
        
   
   
}

?>
