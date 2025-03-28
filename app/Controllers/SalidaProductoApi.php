<?php

namespace App\Controllers;

use App\Models\SalidaProductoModel;
use CodeIgniter\Controller;
use CodeIgniter\HTTP\ResponseInterface;

class SalidaProductoApi extends Controller {
  private $primaryKey;
  private $SalidaProductoModel;
  private $data;
  private $model;

  // Constructor
  public function __construct() {
    $this->primaryKey = "id";
    $this->SalidaProductoModel = new SalidaProductoModel();
    $this->data = [];
    $this->model = "SalidaProductoModel";
  }

  // Método index: Obtener todas las salidas de producto
  public function index() {
    $this->data["title"] = "SALIDA PRODUCTO";
    $this->data[$this->model] = $this->SalidaProductoModel->orderBy($this->primaryKey, "ASC")->findAll();
    return view("salida_producto/salida_producto_view", $this->data);
  }

  // Método create: Crear una nueva salida de producto
  public function create() {
    if ($this->request->isAJAX()) {
      $dataModel = $this->getDataModel();
      if ($this->SalidaProductoModel->insert($dataModel)) {
        $data["message"] = "success";
        $data["response"] = ResponseInterface::HTTP_OK;
        $data["data"] = $dataModel;
        $data["csrf"] = csrf_hash();
      } else {
        $data["message"] = "Error creando salida de producto";
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

  // Método single: Obtener una salida de producto por ID
  public function single($id = null) {
    if ($this->request->isAJAX()) {
      if ($data[$this->model] = $this->SalidaProductoModel->where($this->primaryKey, $id)->first()) {
        $data["message"] = "success";
        $data["response"] = ResponseInterface::HTTP_OK;
        $data["csrf"] = csrf_hash();
      } else {
        $data["message"] = "Error obteniendo salida de producto";
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

  // Método update: Actualizar una salida de producto
  public function update() {
    if ($this->request->isAJAX()) {
      $today = date("Y-m-d H:i:s");
      $id = $this->request->getVar($this->primaryKey);
      $dataModel = [
        "cantidad" => $this->request->getVar("cantidad"),
        "updated_at" => $today
      ];
      if ($this->SalidaProductoModel->update($id, $dataModel)) {
        $data["message"] = "success";
        $data["response"] = ResponseInterface::HTTP_OK;
        $data["data"] = $dataModel;
        $data["csrf"] = csrf_hash();
      } else {
        $data["message"] = "Error actualizando salida de producto";
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

  // Método delete: Eliminar una salida de producto
  public function delete($id = null) {
    try {
      if ($this->SalidaProductoModel->where($this->primaryKey, $id)->delete($id)) {
        $data["message"] = "success";
        $data["response"] = ResponseInterface::HTTP_OK;
        $data["data"] = "OK";
        $data["csrf"] = csrf_hash();
      } else {
        $data["message"] = "Error eliminando salida de producto";
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
      "cantidad" => $this->request->getVar("cantidad"),
      "updated_at" => $this->request->getVar("updated_at")
    ];
    return $data;
  }
}
