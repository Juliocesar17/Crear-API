<?php

require_once "conexion.php";

class ModeloCoordinador{

	/*============================================
	Mostrar todos los coordinadores
	============================================*/

	static public function index($tabla, $cantidad, $desde){

		if ($cantidad != null) {
			
			$stmt = Conexion::conectar()->prepare("SELECT $tabla.ID_ROL, $tabla.ID_CARRERA, $tabla.ID_USUARIO FROM $tabla LIMIT $desde, $cantidad");

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT $tabla.ID_ROL, $tabla.ID_CARRERA, $tabla.ID_USUARIO FROM $tabla");

		}

		$stmt -> execute();
		return $stmt -> fetchAll(PDO::FETCH_CLASS);
		$stmt -> close();
		$stmt = null;
	}

	/*============================================
	Creacion de un coordinador
	============================================*/

	static public function create($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(ID_ROL, ID_CARRERA, ID_USUARIO) VALUES (:ID_ROL, :ID_CARRERA, :ID_USUARIO)");

		$stmt -> bindParam(":ID_ROL", $datos["ID_ROL"], PDO::PARAM_STR);
		$stmt -> bindParam(":ID_CARRERA", $datos["ID_CARRERA"], PDO::PARAM_STR);
		$stmt -> bindParam(":ID_USUARIO", $datos["ID_USUARIO"], PDO::PARAM_STR);
		
		if ($stmt -> execute()) {
			
			return "ok";

		}else{

			print_r(Conexion::conectar()->errorInfo());

		}

		$stmt-> close();
		$stmt= null;

	}
	/*============================================
	Mostrar un solo coordinador
	============================================*/

	static public function show($tabla, $id){

		$stmt = Conexion::conectar()->prepare("SELECT $tabla.ID_ROL, $tabla.ID_CARRERA, $tabla.ID_USUARIO FROM $tabla WHERE $tabla.ID_ROL =:ID_ROL");
		
		$stmt -> bindParam(":ID_ROL", $id, PDO::PARAM_INT);

		$stmt -> execute();
		return $stmt -> fetchAll(PDO::FETCH_CLASS);
		$stmt -> close();
		$stmt = null;
	}

	/*============================================
	Actualizacion de un coordinador
	============================================*/

	static public function update($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET ID_ROL=:ID_ROL, ID_CARRERA=:ID_CARRERA, ID_USUARIO=:ID_USUARIO WHERE ID_ROL = :ID_ROL");

		$stmt -> bindParam(":ID_ROL", $datos["ID_ROL"], PDO::PARAM_INT);
		$stmt -> bindParam(":ID_CARRERA", $datos["ID_CARRERA"], PDO::PARAM_STR);
		$stmt -> bindParam(":ID_USUARIO", $datos["ID_USUARIO"], PDO::PARAM_STR);

		if ($stmt -> execute()) {
			
			return "ok";

		}else{

			print_r(Conexion::conectar()->errorInfo());

		}

		$stmt-> close();
		$stmt= null;

	}
	/*============================================
	Borrar coordinador
	============================================*/

	static public function delete($tabla, $id){

		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE ID_ROL = :ID_ROL");

		$stmt -> bindParam(":ID_ROL", $id, PDO::PARAM_INT);

		if ($stmt -> execute()) {
			
			return "ok";

		}else{

			print_r(Conexion::conectar()->errorInfo());

		}

		$stmt-> close();
		$stmt= null;

	}
}