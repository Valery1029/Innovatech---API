<?php

namespace App\Controllers;

use App\Models\IngresoProductoModel;
use CodeIgniter\Controller;
use CodeIgniter\HTTP\ResponseInterface;

class IngresoProductoApi extends Controller {
  private $primaryKey;
  private $IngresoProductoModel;
  private $data;
  private $model;

  // Constructor
  public function __construct() {
    $this->primaryKey = "id";
    $this->IngresoProductoModel = new IngresoProductoModel();
    $this->data = [];
    $this->model = "IngresoProductoModel";
  }

  // Método index: Obtener todos los ingresos de productos
  public function index() {
    $this->data["title"] = "INGRESO PRODUCTO";
    $this->data[$this->model] = $this->IngresoProductoModel->orderBy($this->primaryKey, "ASC")->findAll();
    return view("ingreso_producto/ingreso_producto_view", $this->data);
  }

  // Método create: Crear un nuevo ingreso de producto
  public function create() {
    if ($this->request->isAJAX()) {
      $dataModel = $this->getDataModel();
      if ($this->IngresoProductoModel->insert($dataModel)) {
        $data["message"] = "success";
        $data["response"] = ResponseInterface::HTTP_OK;
        $data["data"] = $dataModel;
        $data["csrf"] = csrf_hash();
      } else {
        $data["message"] = "Error creando ingreso de producto";
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

  // Método singleIngresoProducto: Obtener un ingreso de producto por ID
  public function singleIngresoProducto($id = null) {
    if ($this->request->isAJAX()) {
      if ($data[$this->model] = $this->IngresoProductoModel->where($this->primaryKey, $id)->first()) {
        $data["message"] = "success";
        $data["response"] = ResponseInterface::HTTP_OK;
        $data["csrf"] = csrf_hash();
      } else {
        $data["message"] = "Error obteniendo ingreso de producto";
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

  // Método update: Actualizar un ingreso de producto
  public function update() {
    if ($this->request->isAJAX()) {
      $today = date("Y-m-d H:i:s");
      $id = $this->request->getVar($this->primaryKey);
      $dataModel = [
        "cantidad" => $this->request->getVar("cantidad"),
        "updated_at" => $today
      ];
      if ($this->IngresoProductoModel->update($id, $dataModel)) {
        $data["message"] = "success";
        $data["response"] = ResponseInterface::HTTP_OK;
        $data["data"] = $dataModel;
        $data["csrf"] = csrf_hash();
      } else {
        $data["message"] = "Error actualizando ingreso de producto";
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

  // Método delete: Eliminar un ingreso de producto
  public function delete($id = null) {
    try {
      if ($this->IngresoProductoModel->where($this->primaryKey, $id)->delete($id)) {
        $data["message"] = "success";
        $data["response"] = ResponseInterface::HTTP_OK;
        $data["data"] = "OK";
        $data["csrf"] = csrf_hash();
      } else {
        $data["message"] = "Error eliminando ingreso de producto";
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

  // Método getDataModel: Obtener datos del ingreso de producto desde la solicitud
  public function getDataModel() {
    $data = [
      "id" => $this->request->getVar("id"),
      "cantidad" => $this->request->getVar("cantidad"),
      "updated_at" => $this->request->getVar("updated_at")
    ];
    return $data;
  }
}
