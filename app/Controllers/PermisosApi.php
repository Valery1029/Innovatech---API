<?php

namespace App\Controllers;

use App\Models\PermisosModel;
use CodeIgniter\Controller;
use CodeIgniter\HTTP\ResponseInterface;

class PermisosApi extends Controller {
  private $primaryKey;
  private $PermisosModel;
  private $data;
  private $model;

  // Constructor
  public function __construct() {
    $this->primaryKey = "id";
    $this->PermisosModel = new PermisosModel();
    $this->data = [];
    $this->model = "PermisosModel";
  }

  // Método index: Obtener todos los permisos
  public function index() {
    $this->data["title"] = "PERMISOS";
    $this->data[$this->model] = $this->PermisosModel->orderBy($this->primaryKey, "ASC")->findAll();
    return view("permisos/permisos_view", $this->data);
  }

  // Método create: Crear un nuevo permiso
  public function create() {
    if ($this->request->isAJAX()) {
      $dataModel = $this->getDataModel();
      if ($this->PermisosModel->insert($dataModel)) {
        $data["message"] = "success";
        $data["response"] = ResponseInterface::HTTP_OK;
        $data["data"] = $dataModel;
        $data["csrf"] = csrf_hash();
      } else {
        $data["message"] = "Error creando permiso";
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

  // Método singlePermiso: Obtener un permiso por ID
  public function singlePermiso($id = null) {
    if ($this->request->isAJAX()) {
      if ($data[$this->model] = $this->PermisosModel->where($this->primaryKey, $id)->first()) {
        $data["message"] = "success";
        $data["response"] = ResponseInterface::HTTP_OK;
        $data["csrf"] = csrf_hash();
      } else {
        $data["message"] = "Error obteniendo permiso";
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

  // Método update: Actualizar un permiso
  public function update() {
    if ($this->request->isAJAX()) {
      $today = date("Y-m-d H:i:s");
      $id = $this->request->getVar($this->primaryKey);
      $dataModel = [
        "nombre" => $this->request->getVar("nombre"),
        "updated_at" => $today
      ];
      if ($this->PermisosModel->update($id, $dataModel)) {
        $data["message"] = "success";
        $data["response"] = ResponseInterface::HTTP_OK;
        $data["data"] = $dataModel;
        $data["csrf"] = csrf_hash();
      } else {
        $data["message"] = "Error actualizando permiso";
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

  // Método delete: Eliminar un permiso
  public function delete($id = null) {
    try {
      if ($this->PermisosModel->where($this->primaryKey, $id)->delete($id)) {
        $data["message"] = "success";
        $data["response"] = ResponseInterface::HTTP_OK;
        $data["data"] = "OK";
        $data["csrf"] = csrf_hash();
      } else {
        $data["message"] = "Error eliminando permiso";
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

  // Método getDataModel: Obtener datos del permiso desde la solicitud
  public function getDataModel() {
    $data = [
      "id" => $this->request->getVar("id"),
      "nombre" => $this->request->getVar("nombre"),
      "updated_at" => $this->request->getVar("updated_at")
    ];
    return $data;
  }
}
