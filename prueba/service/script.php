<?php
$autoloader = require_once dirname(__DIR__).'/service/vendor/autoload.php';
$autoloader->add('', __DIR__ . '/generated-classes/');
require './generated-conf/config.php';
use Propel\Runtime\Propel;
switch ($_POST["type"]) {
      case "addUsuario":
          $usuario = new Usuario();
  		  $usuario->add($_POST["idusuario"],$_POST1["idUsuario"] ,$_POST1["informacion"]
  		   ,$_POST1["gustos"]
  		   ,$_POST1["nacimiento"]
  		  
  		   ,$_POST1["password"]
  		   ,$_POST1["nombre"]
  		   ,$_POST1["apellidos"]
  		   ,$_POST1["avatar"]
  		   ,$_POST1["email"]
  		  );
          break;
  	case "getUsuario":
          $usuario = new Usuario();
  		  $usuario->get($_POST["idusuario"]);
          break;
      case "getAllUsuario":
          $usuario = new Usuario();
  		  $usuario->getAll();
          break;
  	case "deleteUsuario":
          $usuario = new Usuario();
  		  $usuario->delete($_POST["idusuario"]);
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
  		  $mensajes->add($_POST["idMensajes"],$_POST1["padre"]
  		   ,$_POST1["descripcion"]
  		   ,$_POST1["asunto"]
  		  
  		  );
          break;
  	case "getMensajes":
          $mensajes = new Mensajes();
  		  $mensajes->get($_POST["idMensajes"]);
          break;
      case "getAllMensajes":
          $mensajes = new Mensajes();
  		  $mensajes->getAll();
          break;
  	case "deleteMensajes":
          $mensajes = new Mensajes();
  		  $mensajes->delete($_POST["idMensajes"]);
          break;
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
  		  $grupo->add($_POST["idGrupo"] ,$_POST1["informacion"]
  		   ,$_POST1["nombre"]
  		  );
          break;
  	case "getGrupo":
          $grupo = new Grupo();
  		  $grupo->get($_POST["idGrupo"]);
          break;
      case "getAllGrupo":
          $grupo = new Grupo();
  		  $grupo->getAll();
          break;
  	case "deleteGrupo":
          $grupo = new Grupo();
  		  $grupo->delete($_POST["idGrupo"]);
          break;
      case "Operation1":
          $grupo = new Grupo();
          $grupo->Operation1($_POST["invalid"]);
        break;
      
      
      case "addViaje":
          $viaje = new Viaje();
  		  $viaje->add($_POST["idViaje"] ,$_POST1["nombre"]
  		   ,$_POST1["informacion"]
  		   ,$_POST1["transporte"]
  		   ,$_POST1["hospedaje"]
  		   ,$_POST1["destino"]
  		   ,$_POST1["fechainicio"]
  		   ,$_POST1["fechafinal"]
  		   ,$_POST1["precio"]
  		   ,$_POST1["imagenes"]
  		   ,$_POST1["etiquetas"]
  		  );
          break;
  	case "getViaje":
          $viaje = new Viaje();
  		  $viaje->get($_POST["idViaje"]);
          break;
      case "getAllViaje":
          $viaje = new Viaje();
  		  $viaje->getAll();
          break;
  	case "deleteViaje":
          $viaje = new Viaje();
  		  $viaje->delete($_POST["idViaje"]);
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
  		  $perfil->add($_POST["idPerfil"] ,$_POST1["informacion"]
  		   ,$_POST1["gustos"]
  		   ,$_POST1["nacimiento"]
  		  );
          break;
  	case "getPerfil":
          $perfil = new Perfil();
  		  $perfil->get($_POST["idPerfil"]);
          break;
      case "getAllPerfil":
          $perfil = new Perfil();
  		  $perfil->getAll();
          break;
  	case "deletePerfil":
          $perfil = new Perfil();
  		  $perfil->delete($_POST["idPerfil"]);
          break;
      
      
      case "addInvitacion":
          $invitacion = new Invitacion();
  		  $invitacion->add($_POST["idInvitacion"],$_POST1["idInvitacion"],$_POST1["idUsuario"] ,$_POST1["informacion"]
  		   ,$_POST1["gustos"]
  		   ,$_POST1["nacimiento"]
  		  
  		   ,$_POST1["password"]
  		   ,$_POST1["nombre"]
  		   ,$_POST1["apellidos"]
  		   ,$_POST1["avatar"]
  		   ,$_POST1["email"]
  		  
  		   ,$_POST1["codigo"]
  		   ,$_POST1["activo"]
  		  );
          break;
  	case "getInvitacion":
          $invitacion = new Invitacion();
  		  $invitacion->get($_POST["idInvitacion"]);
          break;
      case "getAllInvitacion":
          $invitacion = new Invitacion();
  		  $invitacion->getAll();
          break;
  	case "deleteInvitacion":
          $invitacion = new Invitacion();
  		  $invitacion->delete($_POST["idInvitacion"]);
          break;
      
      
      case "addAdministrador":
          $administrador = new Administrador();
  		  $administrador->add($_POST["idAdministrador"]);
          break;
  	case "getAdministrador":
          $administrador = new Administrador();
  		  $administrador->get($_POST["idAdministrador"]);
          break;
      case "getAllAdministrador":
          $administrador = new Administrador();
  		  $administrador->getAll();
          break;
  	case "deleteAdministrador":
          $administrador = new Administrador();
  		  $administrador->delete($_POST["idAdministrador"]);
          break;
      
      
      case "addColaborador":
          $colaborador = new Colaborador();
  		  $colaborador->add($_POST["idColaborador2"] ,$_POST1["mensaje"]
  		   ,$_POST1["prueba"]
  		  );
          break;
  	case "getColaborador":
          $colaborador = new Colaborador();
  		  $colaborador->get($_POST["idColaborador2"]);
          break;
      case "getAllColaborador":
          $colaborador = new Colaborador();
  		  $colaborador->getAll();
          break;
  	case "deleteColaborador":
          $colaborador = new Colaborador();
  		  $colaborador->delete($_POST["idColaborador2"]);
          break;
      case "obtenerInformacion":
          $colaborador = new Colaborador();
          $colaborador->obtenerInformacion($_POST["idusuario"]);
        break;
      
      
  
}

?>
