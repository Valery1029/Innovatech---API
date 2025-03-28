<?php

namespace App\Controllers;

use App\Models\ProductosPedidoModel;
use CodeIgniter\Controller;
use CodeIgniter\HTTP\ResponseInterface;

class ProductosPedidoApi extends Controller {
  private $primaryKey;
  private $ProductosPedidoModel;
  private $data;
  private $model;

  // Constructor
  public function __construct() {
    $this->primaryKey = "id";
    $this->ProductosPedidoModel = new ProductosPedidoModel();
    $this->data = [];
    $this->model = "ProductosPedidoModel";
  }

  // Método index: Obtener todos los productos asociados a pedidos
  public function index() {
    $this->data["title"] = "PRODUCTOS PEDIDO";
    $this->data[$this->model] = $this->ProductosPedidoModel->orderBy($this->primaryKey, "ASC")->findAll();
    return view("productos_pedido/productos_pedido_view", $this->data);
  }

  // Método create: Crear una nueva relación de producto con pedido
  public function create() {
    if ($this->request->isAJAX()) {
      $dataModel = $this->getDataModel();
      if ($this->ProductosPedidoModel->insert($dataModel)) {
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
      if ($data[$this->model] = $this->ProductosPedidoModel->where($this->primaryKey, $id)->first()) {
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
      if ($this->ProductosPedidoModel->update($id, $dataModel)) {
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
      if ($this->ProductosPedidoModel->where($this->primaryKey, $id)->delete($id)) {
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
