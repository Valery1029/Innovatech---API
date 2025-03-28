<?php

namespace App\Controllers;

use App\Models\ProductosIngresoProductoModel;
use CodeIgniter\Controller;
use CodeIgniter\HTTP\ResponseInterface;

class ProductosIngresoProductoApi extends Controller {
  private $primaryKey;
  private $ProductosIngresoProductoModel;
  private $data;
  private $model;

  // Constructor
  public function __construct() {
    $this->primaryKey = "id";
    $this->ProductosIngresoProductoModel = new ProductosIngresoProductoModel();
    $this->data = [];
    $this->model = "ProductosIngresoProductoModel";
  }

  // Método index: Obtener todas las relaciones de productos con ingresos
  public function index() {
    $this->data["title"] = "PRODUCTOS INGRESO PRODUCTO";
    $this->data[$this->model] = $this->ProductosIngresoProductoModel->orderBy($this->primaryKey, "ASC")->findAll();
    return view("productos_ingreso_producto/productos_ingreso_producto_view", $this->data);
  }

  // Método create: Crear una nueva relación de producto con ingreso
  public function create() {
    if ($this->request->isAJAX()) {
      $dataModel = $this->getDataModel();
      if ($this->ProductosIngresoProductoModel->insert($dataModel)) {
        $data["message"] = "success";
        $data["response"] = ResponseInterface::HTTP_OK;
        $data["data"] = $dataModel;
        $data["csrf"] = csrf_hash();
      } else {
        $data["message"] = "Error creando relación";
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

  // Método single: Obtener una relación por ID
  public function single($id = null) {
    if ($this->request->isAJAX()) {
      if ($data[$this->model] = $this->ProductosIngresoProductoModel->where($this->primaryKey, $id)->first()) {
        $data["message"] = "success";
        $data["response"] = ResponseInterface::HTTP_OK;
        $data["csrf"] = csrf_hash();
      } else {
        $data["message"] = "Error obteniendo relación";
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

  // Método update: Actualizar una relación
  public function update() {
    if ($this->request->isAJAX()) {
      $today = date("Y-m-d H:i:s");
      $id = $this->request->getVar($this->primaryKey);
      $dataModel = [
        "cantidad" => $this->request->getVar("cantidad"),
        "updated_at" => $today
      ];
      if ($this->ProductosIngresoProductoModel->update($id, $dataModel)) {
        $data["message"] = "success";
        $data["response"] = ResponseInterface::HTTP_OK;
        $data["data"] = $dataModel;
        $data["csrf"] = csrf_hash();
      } else {
        $data["message"] = "Error actualizando relación";
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

  // Método delete: Eliminar una relación
  public function delete($id = null) {
    try {
      if ($this->ProductosIngresoProductoModel->where($this->primaryKey, $id)->delete($id)) {
        $data["message"] = "success";
        $data["response"] = ResponseInterface::HTTP_OK;
        $data["data"] = "OK";
        $data["csrf"] = csrf_hash();
      } else {
        $data["message"] = "Error eliminando relación";
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
