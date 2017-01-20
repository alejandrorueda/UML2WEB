<?php
$autoloader = require_once dirname(__DIR__).'/service/vendor/autoload.php';
$autoloader->add('', __DIR__ . '/generated-classes/');
require './generated-conf/config.php';
use Propel\Runtime\Propel;
if (empty($_POST["type"])) {
     $type=$_GET["type"];
}
else{
	 $type=$_POST["type"];
}
switch ($type) {
      case "addUsuario":
          $usuario = new Usuario();
  		  if(!$usuario->add($_POST["idusuario"],$_POST["idPerfil"] ,$_POST["informacion"]
  		   ,$_POST["gustos"]
  		   ,$_POST["nacimiento"]
  		  
  		   ,$_POST["password"]
  		   ,$_POST["nombre"]
  		   ,$_POST["apellidos"]
  		   ,$_POST["avatar"]
  		   ,$_POST["email"]
  		  )){
              echo json_encode(["success"=> false] );
  		  }
  		 else{
             echo json_encode(["success"=> true] );
  		 }
  
          break;
  	case "getUsuario":
          $usuario = new Usuario();
  		 echo $usuario->get($_GET["idusuario"])->toJSON();
          break;
      case "getAllUsuario":
          $usuario = new Usuario();
  		  $usuario->getAll();
          break;
  	case "deleteUsuario":
          $usuario = new Usuario();
  		 check($usuario->normalDelete($_POST["idusuario"]));
          break;
  	case "updateUsuario":
          $usuario = new Usuario();
          $usuario = $usuario->get($_POST["idusuario"]);
  		check($usuario->add($_POST["idusuario"],$_POST["idPerfil"] ,$_POST["informacion"]
  		 ,$_POST["gustos"]
  		 ,$_POST["nacimiento"]
  		
  		 ,$_POST["password"]
  		 ,$_POST["nombre"]
  		 ,$_POST["apellidos"]
  		 ,$_POST["avatar"]
  		 ,$_POST["email"]
  		));
          break;
      case "getUsuarioListUsuarios":
      	$usuario = new Usuario();
          $usuario = $usuario->get($_GET["idelement"]);
          $query = $usuario->getUsuarioRelatedByRelacionusuario();
          ArrayEcho($query);
        break;
       case "addUsuarioListUsuarios":
      	$usuario = new Usuario();
          $usuario = $usuario->get($_POST["idelement"]);
          check(!$usuario->addAmigos($_POST["idusuario"]));
        break;
      case "getUsuarioViajes":
      	$usuario = new Usuario();
          $usuario = $usuario->get($_GET["idelement"]);
          $query = $usuario->getViajes();
          ArrayEcho($query);
        break;
      case "addUsuarioViajes":
      	$usuario = new Usuario();
          $usuario = $usuario->get($_POST["idelement"]);
          check($usuario->addViajeMany($_POST["idViaje"] ,$_POST["nombre"]
           ,$_POST["informacion"]
           ,$_POST["transporte"]
           ,$_POST["hospedaje"]
           ,$_POST["destino"]
           ,$_POST["fechainicio"]
           ,$_POST["fechafinal"]
           ,$_POST["precio"]
           ,$_POST["imagenes"]
           ,$_POST["etiquetas"]
          ));
      
        break;
      case "getUsuarioInvitacionChilds":
      	$usuario = new Usuario();
          $usuario = $usuario->get($_GET["idelement"]);
          $query = $usuario->getInvitacions();
          ArrayEcho($query);
        break;
      case "addUsuarioInvitacionChilds":
      	$usuario = new Usuario();
          $usuario = $usuario->get($_POST["idelement"]);
          check($usuario->addInvitacionManyChild($_POST["idInvitacion"],$_POST["idUsuario"],$_POST["idPerfil"] ,$_POST["informacion"]
           ,$_POST["gustos"]
           ,$_POST["nacimiento"]
          
           ,$_POST["password"]
           ,$_POST["nombre"]
           ,$_POST["apellidos"]
           ,$_POST["avatar"]
           ,$_POST["email"]
          
           ,$_POST["codigo"]
           ,$_POST["activo"]
          ));
      
        break;
      
      case "getUsuarioGrupos":
      	$usuario = new Usuario();
          $usuario = $usuario->get($_GET["idelement"]);
          $query = $usuario->getGrupos();
          ArrayEcho($query);
        break;
      case "addUsuarioGrupos":
      	$usuario = new Usuario();
          $usuario = $usuario->get($_POST["idelement"]);
          check($usuario->addGrupoMany($_POST["idGrupo"] ,$_POST["informacion"]
           ,$_POST["nombre"]
          ));
      
        break;
      
      case "informacionPerfil":
          $usuario = new Usuario();
          $usuario->informacionPerfil($_POST["idusuario"],$_POST["password"]);
        break;
      case "iniciarSesion":
          $usuario = new Usuario();
          $usuario->iniciarSesion($_POST["idusuario"],$_POST["password"]);
        break;
      case "registrar":
          $usuario = new Usuario();
          $usuario->registrar($_POST["idusuario"],$_POST["nombre"],$_POST["password"],$_POST["apellidos"],$_POST["avatar"],$_POST["email"]);
        break;
      case "datosUsuario":
          $usuario = new Usuario();
          $usuario->datosUsuario($_POST["idusuario"],$_POST["password"]);
        break;
      
      
      case "addMensajes":
          $mensajes = new Mensajes();
  		  if(!$mensajes->add($_POST["idMensajes"],$_POST["idelement"]
  		   ,$_POST["descripcion"]
  		   ,$_POST["asunto"]
  		  
  		  )){
              echo json_encode(["success"=> false] );
  		  }
  		 else{
             echo json_encode(["success"=> true] );
  		 }
  
          break;
  	case "getMensajes":
          $mensajes = new Mensajes();
  		 echo $mensajes->get($_GET["idMensajes"])->toJSON();
          break;
      case "getAllMensajes":
          $mensajes = new Mensajes();
  		  $mensajes->getAll();
          break;
  	case "deleteMensajes":
          $mensajes = new Mensajes();
  		 check($mensajes->normalDelete($_POST["idMensajes"]));
          break;
  	case "updateMensajes":
          $mensajes = new Mensajes();
          $mensajes = $mensajes->get($_POST["idMensajes"]);
  		check($mensajes->add($_POST["idMensajes"],$_POST["idelement"]
  		 ,$_POST["descripcion"]
  		 ,$_POST["asunto"]
  		
  		));
          break;
      case "getMensajesViajes":
      	$mensajes = new Mensajes();
          $mensajes = $mensajes->get($_GET["idelement"]);
          $query = $mensajes->getViajes();
          ArrayEcho($query);
        break;
      case "addMensajesViajes":
      	$mensajes = new Mensajes();
          $mensajes = $mensajes->get($_POST["idelement"]);
          check($mensajes->addViajeMany($_POST["idViaje"] ,$_POST["nombre"]
           ,$_POST["informacion"]
           ,$_POST["transporte"]
           ,$_POST["hospedaje"]
           ,$_POST["destino"]
           ,$_POST["fechainicio"]
           ,$_POST["fechafinal"]
           ,$_POST["precio"]
           ,$_POST["imagenes"]
           ,$_POST["etiquetas"]
          ));
      
        break;
      case "getMensajesMensajess":
      	$mensajes = new Mensajes();
          $mensajes = $mensajes->get($_GET["idelement"]);
          $query = $mensajes->getMensajess();
          ArrayEcho($query);
        break;
       case "addMensajesMensajess":
      	$mensajes = new Mensajes();
          $mensajes = $mensajes->get($_POST["idelement"]);
          check($mensajes->add($_POST["idMensajes"],$_POST["idelement"]
           ,$_POST["descripcion"]
           ,$_POST["asunto"]
          
          ));
      
      case "escribirMensaje":
          $mensajes = new Mensajes();
          $mensajes->escribirMensaje($_POST["descripcion"],$_POST["asunto"],$_POST["usuarioId"],$_POST["password"]);
        break;
      case "mensajes":
          $mensajes = new Mensajes();
          $mensajes->mensajes($_POST["invalid"]);
        break;
      
      
      case "addGrupo":
          $grupo = new Grupo();
  		  if(!$grupo->add($_POST["idGrupo"] ,$_POST["informacion"]
  		   ,$_POST["nombre"]
  		  )){
              echo json_encode(["success"=> false] );
  		  }
  		 else{
             echo json_encode(["success"=> true] );
  		 }
  
          break;
  	case "getGrupo":
          $grupo = new Grupo();
  		 echo $grupo->get($_GET["idGrupo"])->toJSON();
          break;
      case "getAllGrupo":
          $grupo = new Grupo();
  		  $grupo->getAll();
          break;
  	case "deleteGrupo":
          $grupo = new Grupo();
  		 check($grupo->normalDelete($_POST["idGrupo"]));
          break;
  	case "updateGrupo":
          $grupo = new Grupo();
          $grupo = $grupo->get($_POST["idGrupo"]);
  		check($grupo->add($_POST["idGrupo"] ,$_POST["informacion"]
  		 ,$_POST["nombre"]
  		));
          break;
      case "getGrupoViajes":
      	$grupo = new Grupo();
          $grupo = $grupo->get($_GET["idelement"]);
          $query = $grupo->getViajes();
          ArrayEcho($query);
        break;
      case "addGrupoViajes":
      	$grupo = new Grupo();
          $grupo = $grupo->get($_POST["idelement"]);
          check($grupo->addViajeMany($_POST["idViaje"] ,$_POST["nombre"]
           ,$_POST["informacion"]
           ,$_POST["transporte"]
           ,$_POST["hospedaje"]
           ,$_POST["destino"]
           ,$_POST["fechainicio"]
           ,$_POST["fechafinal"]
           ,$_POST["precio"]
           ,$_POST["imagenes"]
           ,$_POST["etiquetas"]
          ));
      
        break;
      case "getGrupoUsuarios":
      	$grupo = new Grupo();
          $grupo = $grupo->get($_GET["idelement"]);
          $query = $grupo->getUsuarios();
          ArrayEcho($query);
        break;
      case "addGrupoUsuarios":
      	$grupo = new Grupo();
          $grupo = $grupo->get($_POST["idelement"]);
          check($grupo->addUsuarioMany($_POST["idUsuario"],$_POST["idPerfil"] ,$_POST["informacion"]
           ,$_POST["gustos"]
           ,$_POST["nacimiento"]
          
           ,$_POST["password"]
           ,$_POST["nombre"]
           ,$_POST["apellidos"]
           ,$_POST["avatar"]
           ,$_POST["email"]
          ));
      
        break;
      
      case "Operation1":
          $grupo = new Grupo();
          $grupo->Operation1($_POST["invalid"]);
        break;
      
      
      case "addViaje":
          $viaje = new Viaje();
  		  if(!$viaje->add($_POST["idViaje"] ,$_POST["nombre"]
  		   ,$_POST["informacion"]
  		   ,$_POST["transporte"]
  		   ,$_POST["hospedaje"]
  		   ,$_POST["destino"]
  		   ,$_POST["fechainicio"]
  		   ,$_POST["fechafinal"]
  		   ,$_POST["precio"]
  		   ,$_POST["imagenes"]
  		   ,$_POST["etiquetas"]
  		  )){
              echo json_encode(["success"=> false] );
  		  }
  		 else{
             echo json_encode(["success"=> true] );
  		 }
  
          break;
  	case "getViaje":
          $viaje = new Viaje();
  		 echo $viaje->get($_GET["idViaje"])->toJSON();
          break;
      case "getAllViaje":
          $viaje = new Viaje();
  		  $viaje->getAll();
          break;
  	case "deleteViaje":
          $viaje = new Viaje();
  		 check($viaje->normalDelete($_POST["idViaje"]));
          break;
  	case "updateViaje":
          $viaje = new Viaje();
          $viaje = $viaje->get($_POST["idViaje"]);
  		check($viaje->add($_POST["idViaje"] ,$_POST["nombre"]
  		 ,$_POST["informacion"]
  		 ,$_POST["transporte"]
  		 ,$_POST["hospedaje"]
  		 ,$_POST["destino"]
  		 ,$_POST["fechainicio"]
  		 ,$_POST["fechafinal"]
  		 ,$_POST["precio"]
  		 ,$_POST["imagenes"]
  		 ,$_POST["etiquetas"]
  		));
          break;
      case "getViajeUsuarios":
      	$viaje = new Viaje();
          $viaje = $viaje->get($_GET["idelement"]);
          $query = $viaje->getUsuarios();
          ArrayEcho($query);
        break;
      case "addViajeUsuarios":
      	$viaje = new Viaje();
          $viaje = $viaje->get($_POST["idelement"]);
          check($viaje->addUsuarioMany($_POST["idUsuario"],$_POST["idPerfil"] ,$_POST["informacion"]
           ,$_POST["gustos"]
           ,$_POST["nacimiento"]
          
           ,$_POST["password"]
           ,$_POST["nombre"]
           ,$_POST["apellidos"]
           ,$_POST["avatar"]
           ,$_POST["email"]
          ));
      
        break;
      case "getViajeMensajesChilds":
      	$viaje = new Viaje();
          $viaje = $viaje->get($_GET["idelement"]);
          $query = $viaje->getMensajess();
          ArrayEcho($query);
        break;
      case "addViajeMensajesChilds":
      	$viaje = new Viaje();
          $viaje = $viaje->get($_POST["idelement"]);
          check($viaje->addMensajesManyChild($_POST["idMensajes"],$_POST["idelement"]
           ,$_POST["descripcion"]
           ,$_POST["asunto"]
          
          ));
      
        break;
      
      case "getViajeGrupos":
      	$viaje = new Viaje();
          $viaje = $viaje->get($_GET["idelement"]);
          $query = $viaje->getGrupos();
          ArrayEcho($query);
        break;
      case "addViajeGrupos":
      	$viaje = new Viaje();
          $viaje = $viaje->get($_POST["idelement"]);
          check($viaje->addGrupoMany($_POST["idGrupo"] ,$_POST["informacion"]
           ,$_POST["nombre"]
          ));
      
        break;
      
      case "misViajes":
          $viaje = new Viaje();
          $viaje->misViajes($_POST["idusuario"],$_POST["password"]);
        break;
      case "mensajes":
          $viaje = new Viaje();
          $viaje->mensajes($_POST["idviaje"]);
        break;
      case "añadirParticipante":
          $viaje = new Viaje();
          $viaje->añadirParticipante($_POST["idviaje"],$_POST["idusuario"],$_POST["password"]);
        break;
      case "escribirMensaje":
          $viaje = new Viaje();
          $viaje->escribirMensaje($_POST["descripcion"],$_POST["asunto"],$_POST["idviaje"],$_POST["usuarioId"],$_POST["password"]);
        break;
      case "viajeInformacion":
          $viaje = new Viaje();
          $viaje->viajeInformacion($_POST["idviaje"],$_POST["usuarioId"],$_POST["password"]);
        break;
      case "eliminarParticipante":
          $viaje = new Viaje();
          $viaje->eliminarParticipante($_POST["idviaje"],$_POST["idusuario"],$_POST["password"]);
        break;
      case "viajes":
          $viaje = new Viaje();
          $viaje->viajes($_POST["invalid"]);
        break;
      case "usuarioApuntado":
          $viaje = new Viaje();
          $viaje->usuarioApuntado($_POST["usuarioId"],$_POST["password"]);
        break;
      case "nuevoViaje":
          $viaje = new Viaje();
          $viaje->nuevoViaje($_POST["nombre"],$_POST["informacion"],$_POST["destino"],$_POST["precio"],$_POST["fecha_inicio"],$_POST["fecha_final"],$_POST["usuarioId"],$_POST["password"]);
        break;
      
      
      case "addPerfil":
          $perfil = new Perfil();
  		  if(!$perfil->add($_POST["idPerfil"] ,$_POST["informacion"]
  		   ,$_POST["gustos"]
  		   ,$_POST["nacimiento"]
  		  )){
              echo json_encode(["success"=> false] );
  		  }
  		 else{
             echo json_encode(["success"=> true] );
  		 }
  
          break;
  	case "getPerfil":
          $perfil = new Perfil();
  		 echo $perfil->get($_GET["idPerfil"])->toJSON();
          break;
      case "getAllPerfil":
          $perfil = new Perfil();
  		  $perfil->getAll();
          break;
  	case "deletePerfil":
          $perfil = new Perfil();
  		 check($perfil->normalDelete($_POST["idPerfil"]));
          break;
  	case "updatePerfil":
          $perfil = new Perfil();
          $perfil = $perfil->get($_POST["idPerfil"]);
  		check($perfil->add($_POST["idPerfil"] ,$_POST["informacion"]
  		 ,$_POST["gustos"]
  		 ,$_POST["nacimiento"]
  		));
          break;
      
      
      
      case "addInvitacion":
          $invitacion = new Invitacion();
  		  if(!$invitacion->add($_POST["idInvitacion"],$_POST["idUsuario"],$_POST["idPerfil"] ,$_POST["informacion"]
  		   ,$_POST["gustos"]
  		   ,$_POST["nacimiento"]
  		  
  		   ,$_POST["password"]
  		   ,$_POST["nombre"]
  		   ,$_POST["apellidos"]
  		   ,$_POST["avatar"]
  		   ,$_POST["email"]
  		  
  		   ,$_POST["codigo"]
  		   ,$_POST["activo"]
  		  )){
              echo json_encode(["success"=> false] );
  		  }
  		 else{
             echo json_encode(["success"=> true] );
  		 }
  
          break;
  	case "getInvitacion":
          $invitacion = new Invitacion();
  		 echo $invitacion->get($_GET["idInvitacion"])->toJSON();
          break;
      case "getAllInvitacion":
          $invitacion = new Invitacion();
  		  $invitacion->getAll();
          break;
  	case "deleteInvitacion":
          $invitacion = new Invitacion();
  		 check($invitacion->normalDelete($_POST["idInvitacion"]));
          break;
  	case "updateInvitacion":
          $invitacion = new Invitacion();
          $invitacion = $invitacion->get($_POST["idInvitacion"]);
  		check($invitacion->add($_POST["idInvitacion"],$_POST["idUsuario"],$_POST["idPerfil"] ,$_POST["informacion"]
  		 ,$_POST["gustos"]
  		 ,$_POST["nacimiento"]
  		
  		 ,$_POST["password"]
  		 ,$_POST["nombre"]
  		 ,$_POST["apellidos"]
  		 ,$_POST["avatar"]
  		 ,$_POST["email"]
  		
  		 ,$_POST["codigo"]
  		 ,$_POST["activo"]
  		));
          break;
      case "getInvitacionUsuarios":
      	$invitacion = new Invitacion();
          $invitacion = $invitacion->get($_GET["idelement"]);
          $query = $invitacion->getUsuarios();
          ArrayEcho($query);
        break;
      case "addInvitacionUsuarios":
      	$invitacion = new Invitacion();
          $invitacion = $invitacion->get($_POST["idelement"]);
          check($invitacion->addUsuarioMany($_POST["idUsuario"],$_POST["idPerfil"] ,$_POST["informacion"]
           ,$_POST["gustos"]
           ,$_POST["nacimiento"]
          
           ,$_POST["password"]
           ,$_POST["nombre"]
           ,$_POST["apellidos"]
           ,$_POST["avatar"]
           ,$_POST["email"]
          ));
      
        break;
      
      
      
      case "addAdministrador":
          $administrador = new Administrador();
  		  if(!$administrador->add($_POST["idAdministrador"])){
              echo json_encode(["success"=> false] );
  		  }
  		 else{
             echo json_encode(["success"=> true] );
  		 }
  
          break;
  	case "getAdministrador":
          $administrador = new Administrador();
  		 echo $administrador->get($_GET["idAdministrador"])->toJSON();
          break;
      case "getAllAdministrador":
          $administrador = new Administrador();
  		  $administrador->getAll();
          break;
  	case "deleteAdministrador":
          $administrador = new Administrador();
  		 check($administrador->normalDelete($_POST["idAdministrador"]));
          break;
  	case "updateAdministrador":
          $administrador = new Administrador();
          $administrador = $administrador->get($_POST["idAdministrador"]);
  		check($administrador->add($_POST["idAdministrador"]));
          break;
      
      
      
      case "addColaborador":
          $colaborador = new Colaborador();
  		  if(!$colaborador->add($_POST["idColaborador2"] ,$_POST["mensaje"]
  		   ,$_POST["prueba"]
  		  )){
              echo json_encode(["success"=> false] );
  		  }
  		 else{
             echo json_encode(["success"=> true] );
  		 }
  
          break;
  	case "getColaborador":
          $colaborador = new Colaborador();
  		 echo $colaborador->get($_GET["idColaborador2"])->toJSON();
          break;
      case "getAllColaborador":
          $colaborador = new Colaborador();
  		  $colaborador->getAll();
          break;
  	case "deleteColaborador":
          $colaborador = new Colaborador();
  		 check($colaborador->normalDelete($_POST["idColaborador2"]));
          break;
  	case "updateColaborador":
          $colaborador = new Colaborador();
          $colaborador = $colaborador->get($_POST["idColaborador2"]);
  		check($colaborador->add($_POST["idColaborador2"] ,$_POST["mensaje"]
  		 ,$_POST["prueba"]
  		));
          break;
      
      case "obtenerInformacion":
          $colaborador = new Colaborador();
          $colaborador->obtenerInformacion($_POST["idusuario"]);
        break;
      
      
  
}

function ArrayEcho($query){
 foreach($query as $element) {
	$json[]  = $element->toArray();
}
		
echo json_encode($json); 
}

function check($boolean){
	if(!$boolean){
       echo json_encode(["success"=> false] );
	}
	else{
        echo json_encode(["success"=> true] );
	}
}

?>
