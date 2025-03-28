<?php

namespace App\Controllers;

use App\Models\AlmacenamientoModel;
use CodeIgniter\Controller;
use CodeIgniter\HTTP\ResponseInterface;

class AlmacenamientoAleatorioApi extends Controller {
  private $primaryKey;
  private $AlmacenamientoModel;
  private $data;
  private $model;

  // Constructor
  public function __construct() {
    $this->primaryKey = "id";
    $this->AlmacenamientoModel = new AlmacenamientoModel();
    $this->data = [];
    $this->model = "AlmacenamientoModel";
  }

  // Método index: Lista todos los registros de almacenamiento
  public function index() {
    $this->data["title"] = "ALMACENAMIENTO";
    $this->data[$this->model] = $this->AlmacenamientoModel->orderBy($this->primaryKey, "ASC")->findAll();
    return view("almacenamiento/almacenamiento_view", $this->data);
  }

  // Método create: Inserta un nuevo registro
  public function create() {
    if ($this->request->isAJAX()) {
      $dataModel = $this->getDataModel();
      if ($this->AlmacenamientoModel->insert($dataModel)) {
        $data["message"] = "success";
        $data["response"] = ResponseInterface::HTTP_OK;
        $data["data"] = $dataModel;
        $data["csrf"] = csrf_hash();
      } else {
        $data["message"] = "Error al crear el registro";
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

  // Método singleAlmacenamiento: Obtiene un registro por ID
  public function singleAlmacenamiento($id = null) {
    if ($this->request->isAJAX()) {
      if ($data[$this->model] = $this->AlmacenamientoModel->where($this->primaryKey, $id)->first()) {
        $data["message"] = "success";
        $data["response"] = ResponseInterface::HTTP_OK;
        $data["csrf"] = csrf_hash();
      } else {
        $data["message"] = "Registro no encontrado";
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

  // Método update: Actualiza un registro existente
  public function update() {
    if ($this->request->isAJAX()) {
      $today = date("Y-m-d H:i:s");
      $id = $this->request->getVar($this->primaryKey);
      $dataModel = [
        "num" => $this->request->getVar("num"),
        "unidadestandar" => $this->request->getVar("unidadestandar"),
        "updated_at" => $today
      ];
      if ($this->AlmacenamientoModel->update($id, $dataModel)) {
        $data["message"] = "success";
        $data["response"] = ResponseInterface::HTTP_OK;
        $data["data"] = $dataModel;
        $data["csrf"] = csrf_hash();
      } else {
        $data["message"] = "Error al actualizar el registro";
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

  // Método delete: Elimina un registro por ID
  public function delete($id = null) {
    try {
      if ($this->AlmacenamientoModel->where($this->primaryKey, $id)->delete($id)) {
        $data["message"] = "success";
        $data["response"] = ResponseInterface::HTTP_OK;
        $data["data"] = "OK";
        $data["csrf"] = csrf_hash();
      } else {
        $data["message"] = "Error al eliminar el registro";
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

  // Método getDataModel: Obtiene los datos del request
  public function getDataModel() {
    $data = [
      "id" => $this->request->getVar("id"),
      "num" => $this->request->getVar("num"),
      "unidadestandar" => $this->request->getVar("unidadestandar"),
      "updated_at" => $this->request->getVar("updated_at")
    ];
    return $data;
  }
}
