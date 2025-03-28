<?php

namespace App\Controllers;

use App\Models\EstadoUsuarioModel;
use CodeIgniter\Controller;
use CodeIgniter\HTTP\ResponseInterface;

class EstadoUsuarioApi extends Controller {
  private $primaryKey;
  private $EstadoUsuarioModel;
  private $data;
  private $model;

  // Constructor
  public function __construct() {
    $this->primaryKey = "id";
    $this->EstadoUsuarioModel = new EstadoUsuarioModel();
    $this->data = [];
    $this->model = "EstadoUsuarioModel";
  }

  // Método index: Obtener todos los estados de usuario
  public function index() {
    $this->data["title"] = "ESTADO USUARIO";
    $this->data[$this->model] = $this->EstadoUsuarioModel->orderBy($this->primaryKey, "ASC")->findAll();
    return view("estado_usuario/estado_usuario_view", $this->data);
  }

  // Método create: Crear un nuevo estado de usuario
  public function create() {
    if ($this->request->isAJAX()) {
      $dataModel = $this->getDataModel();
      if ($this->EstadoUsuarioModel->insert($dataModel)) {
        $data["message"] = "success";
        $data["response"] = ResponseInterface::HTTP_OK;
        $data["data"] = $dataModel;
        $data["csrf"] = csrf_hash();
      } else {
        $data["message"] = "Error creando estado de usuario";
        $data["response"] = ResponseInterface::HTTP_NO_CONTENT;
        $data["data"] = "";
      }
    } else {
      $data["message"] = "Error Ajax";
      $data["response"] = ResponseInterface::HTTP_CONFLICT;
      $data["data"] = "";
    }
    echo json_encode($data);
  }

  // Método singleEstadoUsuario: Obtener un estado de usuario por ID
  public function singleEstadoUsuario($id = null) {
    if ($this->request->isAJAX()) {
      if ($data[$this->model] = $this->EstadoUsuarioModel->where($this->primaryKey, $id)->first()) {
        $data["message"] = "success";
        $data["response"] = ResponseInterface::HTTP_OK;
        $data["csrf"] = csrf_hash();
      } else {
        $data["message"] = "Error obteniendo estado de usuario";
        $data["response"] = ResponseInterface::HTTP_NO_CONTENT;
        $data["data"] = "";
      }
    } else {
      $data["message"] = "Error Ajax";
      $data["response"] = ResponseInterface::HTTP_CONFLICT;
      $data["data"] = "";
    }
    echo json_encode($data);
  }

  // Método update: Actualizar un estado de usuario
  public function update() {
    if ($this->request->isAJAX()) {
      $today = date("Y-m-d H:i:s");
      $id = $this->request->getVar($this->primaryKey);
      $dataModel = [
        "estado" => $this->request->getVar("estado"),
        "updated_at" => $today
      ];
      if ($this->EstadoUsuarioModel->update($id, $dataModel)) {
        $data["message"] = "success";
        $data["response"] = ResponseInterface::HTTP_OK;
        $data["data"] = $dataModel;
        $data["csrf"] = csrf_hash();
      } else {
        $data["message"] = "Error actualizando estado de usuario";
        $data["response"] = ResponseInterface::HTTP_NO_CONTENT;
        $data["data"] = "";
      }
    } else {
      $data["message"] = "Error Ajax";
      $data["response"] = ResponseInterface::HTTP_CONFLICT;
      $data["data"] = "";
    }
    echo json_encode($data);
  }

  // Método delete: Eliminar un estado de usuario
  public function delete($id = null) {
    try {
      if ($this->EstadoUsuarioModel->where($this->primaryKey, $id)->delete($id)) {
        $data["message"] = "success";
        $data["response"] = ResponseInterface::HTTP_OK;
        $data["data"] = "OK";
        $data["csrf"] = csrf_hash();
      } else {
        $data["message"] = "Error eliminando estado de usuario";
        $data["response"] = ResponseInterface::HTTP_NO_CONTENT;
        $data["data"] = "error";
      }
    } catch (\Exception $e) {
      $data["message"] = $e->getMessage();
      $data["response"] = ResponseInterface::HTTP_CONFLICT;
      $data["data"] = "Error";
    }
    echo json_encode($data);
  }

  // Método getDataModel: Obtener datos del modelo desde la solicitud
  public function getDataModel() {
    $data = [
      "id" => $this->request->getVar("id"),
      "estado" => $this->request->getVar("estado"),
      "updated_at" => $this->request->getVar("updated_at")
    ];
    return $data;
  }
}
