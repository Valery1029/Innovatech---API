<?php

namespace App\Controllers;

use App\Models\ModelosModel;
use CodeIgniter\Controller;
use CodeIgniter\HTTP\ResponseInterface;

class ModelosApi extends Controller {
  private $primaryKey;
  private $ModelosModel;
  private $data;
  private $model;

  // Constructor
  public function __construct() {
    $this->primaryKey = "id";
    $this->ModelosModel = new ModelosModel();
    $this->data = [];
    $this->model = "ModelosModel";
  }

  // Método index: Obtener todos los modelos
  public function index() {
    $this->data["title"] = "MODELOS";
    $this->data[$this->model] = $this->ModelosModel->orderBy($this->primaryKey, "ASC")->findAll();
    return view("modelos/modelos_view", $this->data);
  }

  // Método create: Crear un nuevo modelo
  public function create() {
    if ($this->request->isAJAX()) {
      $dataModel = $this->getDataModel();
      if ($this->ModelosModel->insert($dataModel)) {
        $data["message"] = "success";
        $data["response"] = ResponseInterface::HTTP_OK;
        $data["data"] = $dataModel;
        $data["csrf"] = csrf_hash();
      } else {
        $data["message"] = "Error creando modelo";
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

  // Método singleModelo: Obtener un modelo por ID
  public function singleModelo($id = null) {
    if ($this->request->isAJAX()) {
      if ($data[$this->model] = $this->ModelosModel->where($this->primaryKey, $id)->first()) {
        $data["message"] = "success";
        $data["response"] = ResponseInterface::HTTP_OK;
        $data["csrf"] = csrf_hash();
      } else {
        $data["message"] = "Error obteniendo modelo";
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

  // Método update: Actualizar un modelo
  public function update() {
    if ($this->request->isAJAX()) {
      $today = date("Y-m-d H:i:s");
      $id = $this->request->getVar($this->primaryKey);
      $dataModel = [
        "nombre" => $this->request->getVar("nombre"),
        "updated_at" => $today
      ];
      if ($this->ModelosModel->update($id, $dataModel)) {
        $data["message"] = "success";
        $data["response"] = ResponseInterface::HTTP_OK;
        $data["data"] = $dataModel;
        $data["csrf"] = csrf_hash();
      } else {
        $data["message"] = "Error actualizando modelo";
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

  // Método delete: Eliminar un modelo
  public function delete($id = null) {
    try {
      if ($this->ModelosModel->where($this->primaryKey, $id)->delete($id)) {
        $data["message"] = "success";
        $data["response"] = ResponseInterface::HTTP_OK;
        $data["data"] = "OK";
        $data["csrf"] = csrf_hash();
      } else {
        $data["message"] = "Error eliminando modelo";
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
      "nombre" => $this->request->getVar("nombre"),
      "updated_at" => $this->request->getVar("updated_at")
    ];
    return $data;
  }
}
