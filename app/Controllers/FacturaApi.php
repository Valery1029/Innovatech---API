<?php

namespace App\Controllers;

use App\Models\FacturaModel;
use CodeIgniter\Controller;
use CodeIgniter\HTTP\ResponseInterface;

class FacturaApi extends Controller {
  private $primaryKey;
  private $FacturaModel;
  private $data;
  private $model;

  // Constructor
  public function __construct() {
    $this->primaryKey = "id";
    $this->FacturaModel = new FacturaModel();
    $this->data = [];
    $this->model = "FacturaModel";
  }

  // Método index: Obtener todas las facturas
  public function index() {
    $this->data["title"] = "FACTURA";
    $this->data[$this->model] = $this->FacturaModel->orderBy($this->primaryKey, "ASC")->findAll();
    return view("factura/factura_view", $this->data);
  }

  // Método create: Crear una nueva factura
  public function create() {
    if ($this->request->isAJAX()) {
      $dataModel = $this->getDataModel();
      if ($this->FacturaModel->insert($dataModel)) {
        $data["message"] = "success";
        $data["response"] = ResponseInterface::HTTP_OK;
        $data["data"] = $dataModel;
        $data["csrf"] = csrf_hash();
      } else {
        $data["message"] = "Error creando factura";
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

  // Método single: Obtener una factura por ID
  public function single($id = null) {
    if ($this->request->isAJAX()) {
      if ($data[$this->model] = $this->FacturaModel->where($this->primaryKey, $id)->first()) {
        $data["message"] = "success";
        $data["response"] = ResponseInterface::HTTP_OK;
        $data["csrf"] = csrf_hash();
      } else {
        $data["message"] = "Error obteniendo factura";
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

  // Método update: Actualizar una factura
  public function update() {
    if ($this->request->isAJAX()) {
      $today = date("Y-m-d H:i:s");
      $id = $this->request->getVar($this->primaryKey);
      $dataModel = [
        "total" => $this->request->getVar("total"),
        "updated_at" => $today
      ];
      if ($this->FacturaModel->update($id, $dataModel)) {
        $data["message"] = "success";
        $data["response"] = ResponseInterface::HTTP_OK;
        $data["data"] = $dataModel;
        $data["csrf"] = csrf_hash();
      } else {
        $data["message"] = "Error actualizando factura";
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

  // Método delete: Eliminar una factura
  public function delete($id = null) {
    try {
      if ($this->FacturaModel->where($this->primaryKey, $id)->delete($id)) {
        $data["message"] = "success";
        $data["response"] = ResponseInterface::HTTP_OK;
        $data["data"] = "OK";
        $data["csrf"] = csrf_hash();
      } else {
        $data["message"] = "Error eliminando factura";
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

  // Método getDataModel: Obtener datos desde la solicitud
  public function getDataModel() {
    $data = [
      "id" => $this->request->getVar("id"),
      "total" => $this->request->getVar("total"),
      "updated_at" => $this->request->getVar("updated_at")
    ];
    return $data;
  }
}
