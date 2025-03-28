<?php

namespace App\Controllers;

use App\Models\SistemaOperativoModel;
use CodeIgniter\Controller;
use CodeIgniter\HTTP\ResponseInterface;

class SistemaOperativoApi extends Controller {
  private $primaryKey;
  private $SistemaOperativoModel;
  private $data;
  private $model;

  // Constructor
  public function __construct() {
    $this->primaryKey = "id";
    $this->SistemaOperativoModel = new SistemaOperativoModel();
    $this->data = [];
    $this->model = "SistemaOperativoModel";
  }

  // Método index: Obtener todos los sistemas operativos
  public function index() {
    $this->data["title"] = "SISTEMA OPERATIVO";
    $this->data[$this->model] = $this->SistemaOperativoModel->orderBy($this->primaryKey, "ASC")->findAll();
    return view("sistema_operativo/sistema_operativo_view", $this->data);
  }

  // Método create: Crear un nuevo sistema operativo
  public function create() {
    if ($this->request->isAJAX()) {
      $dataModel = $this->getDataModel();
      if ($this->SistemaOperativoModel->insert($dataModel)) {
        $data["message"] = "success";
        $data["response"] = ResponseInterface::HTTP_OK;
        $data["data"] = $dataModel;
        $data["csrf"] = csrf_hash();
      } else {
        $data["message"] = "Error creando sistema operativo";
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

  // Método singleSistemaOperativo: Obtener un sistema operativo por ID
  public function singleSistemaOperativo($id = null) {
    if ($this->request->isAJAX()) {
      if ($data[$this->model] = $this->SistemaOperativoModel->where($this->primaryKey, $id)->first()) {
        $data["message"] = "success";
        $data["response"] = ResponseInterface::HTTP_OK;
        $data["csrf"] = csrf_hash();
      } else {
        $data["message"] = "Error obteniendo sistema operativo";
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

  // Método update: Actualizar un sistema operativo
  public function update() {
    if ($this->request->isAJAX()) {
      $today = date("Y-m-d H:i:s");
      $id = $this->request->getVar($this->primaryKey);
      $dataModel = [
        "nombre" => $this->request->getVar("nombre"),
        "updated_at" => $today
      ];
      if ($this->SistemaOperativoModel->update($id, $dataModel)) {
        $data["message"] = "success";
        $data["response"] = ResponseInterface::HTTP_OK;
        $data["data"] = $dataModel;
        $data["csrf"] = csrf_hash();
      } else {
        $data["message"] = "Error actualizando sistema operativo";
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

  // Método delete: Eliminar un sistema operativo
  public function delete($id = null) {
    try {
      if ($this->SistemaOperativoModel->where($this->primaryKey, $id)->delete($id)) {
        $data["message"] = "success";
        $data["response"] = ResponseInterface::HTTP_OK;
        $data["data"] = "OK";
        $data["csrf"] = csrf_hash();
      } else {
        $data["message"] = "Error eliminando sistema operativo";
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

  // Método getDataModel: Obtener datos del sistema operativo desde la solicitud
  public function getDataModel() {
    $data = [
      "id" => $this->request->getVar("id"),
      "nombre" => $this->request->getVar("nombre"),
      "updated_at" => $this->request->getVar("updated_at")
    ];
    return $data;
  }
}
