<?php
$autoloader = require_once dirname(__DIR__).'/service/vendor/autoload.php';
$autoloader->add('', __DIR__ . '/generated-classes/');
require './generated-conf/config.php';
use Propel\Runtime\Propel;
switch ($_POST["type"]) {
      case "addUsuario":
          $usuario = new Usuario();
  		  $usuario->add($_POST["idusuario"]$_POST["idUsuario"] ,$_POST["informacion"]
  		   ,$_POST["gustos"]
  		   ,$_POST["nacimiento"]
  		  
  		   ,$_POST["password"]
  		   ,$_POST["nombre"]
  		   ,$_POST["apellidos"]
  		   ,$_POST["avatar"]
  		   ,$_POST["email"]
  		  );
          break;
  	case "getUsuario":
          $usuario = new Usuario();
  		  $usuario->get($_POST["idusuario"]);
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
  		  $mensajes->add($_POST["idMensajes"],$_POST["padre"]
  		   ,$_POST["descripcion"]
  		   ,$_POST["asunto"]
  		  
  		  );
          break;
  	case "getMensajes":
          $mensajes = new Mensajes();
  		  $mensajes->get($_POST["idMensajes"]);
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
  		  $grupo->add($_POST["idGrupo"] ,$_POST["informacion"]
  		   ,$_POST["nombre"]
  		  );
          break;
  	case "getGrupo":
          $grupo = new Grupo();
  		  $grupo->get($_POST["idGrupo"]);
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
  		  $viaje->add($_POST["idViaje"] ,$_POST["nombre"]
  		   ,$_POST["informacion"]
  		   ,$_POST["transporte"]
  		   ,$_POST["hospedaje"]
  		   ,$_POST["destino"]
  		   ,$_POST["fechainicio"]
  		   ,$_POST["fechafinal"]
  		   ,$_POST["precio"]
  		   ,$_POST["imagenes"]
  		   ,$_POST["etiquetas"]
  		  );
          break;
  	case "getViaje":
          $viaje = new Viaje();
  		  $viaje->get($_POST["idViaje"]);
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
  		  $perfil->add($_POST["idPerfil"] ,$_POST["informacion"]
  		   ,$_POST["gustos"]
  		   ,$_POST["nacimiento"]
  		  );
          break;
  	case "getPerfil":
          $perfil = new Perfil();
  		  $perfil->get($_POST["idPerfil"]);
          break;
  	case "deletePerfil":
          $perfil = new Perfil();
  		  $perfil->delete($_POST["idPerfil"]);
          break;
      
      
      case "addInvitacion":
          $invitacion = new Invitacion();
  		  $invitacion->add($_POST["idInvitacion"]$_POST["idInvitacion"]$_POST["idUsuario"] ,$_POST["informacion"]
  		   ,$_POST["gustos"]
  		   ,$_POST["nacimiento"]
  		  
  		   ,$_POST["password"]
  		   ,$_POST["nombre"]
  		   ,$_POST["apellidos"]
  		   ,$_POST["avatar"]
  		   ,$_POST["email"]
  		  
  		   ,$_POST["codigo"]
  		   ,$_POST["activo"]
  		  );
          break;
  	case "getInvitacion":
          $invitacion = new Invitacion();
  		  $invitacion->get($_POST["idInvitacion"]);
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
  	case "deleteAdministrador":
          $administrador = new Administrador();
  		  $administrador->delete($_POST["idAdministrador"]);
          break;
      
      
      case "addColaborador":
          $colaborador = new Colaborador();
  		  $colaborador->add($_POST["idColaborador2"] ,$_POST["mensaje"]
  		   ,$_POST["prueba"]
  		  );
          break;
  	case "getColaborador":
          $colaborador = new Colaborador();
  		  $colaborador->get($_POST["idColaborador2"]);
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
