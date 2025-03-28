<?php

namespace App\Controllers;

use App\Models\EstadoFacturaModel;
use CodeIgniter\Controller;
use CodeIgniter\HTTP\ResponseInterface;

class EstadoFacturaApi extends Controller {
  private $primaryKey;
  private $EstadoFacturaModel;
  private $data;
  private $model;

  // Constructor
  public function __construct() {
    $this->primaryKey = "id";
    $this->EstadoFacturaModel = new EstadoFacturaModel();
    $this->data = [];
    $this->model = "EstadoFacturaModel";
  }

  // Método index: Obtener todos los estados de factura
  public function index() {
    $this->data["title"] = "ESTADO FACTURA";
    $this->data[$this->model] = $this->EstadoFacturaModel->orderBy($this->primaryKey, "ASC")->findAll();
    return view("estado_factura/estado_factura_view", $this->data);
  }

  // Método create: Crear un nuevo estado de factura
  public function create() {
    if ($this->request->isAJAX()) {
      $dataModel = $this->getDataModel();
      if ($this->EstadoFacturaModel->insert($dataModel)) {
        $data["message"] = "success";
        $data["response"] = ResponseInterface::HTTP_OK;
        $data["data"] = $dataModel;
        $data["csrf"] = csrf_hash();
      } else {
        $data["message"] = "Error creando estado de factura";
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

  // Método singleEstadoFactura: Obtener un estado de factura por ID
  public function singleEstadoFactura($id = null) {
    if ($this->request->isAJAX()) {
      if ($data[$this->model] = $this->EstadoFacturaModel->where($this->primaryKey, $id)->first()) {
        $data["message"] = "success";
        $data["response"] = ResponseInterface::HTTP_OK;
        $data["csrf"] = csrf_hash();
      } else {
        $data["message"] = "Error obteniendo estado de factura";
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

  // Método update: Actualizar un estado de factura
  public function update() {
    if ($this->request->isAJAX()) {
      $today = date("Y-m-d H:i:s");
      $id = $this->request->getVar($this->primaryKey);
      $dataModel = [
        "estado" => $this->request->getVar("estado"),
        "updated_at" => $today
      ];
      if ($this->EstadoFacturaModel->update($id, $dataModel)) {
        $data["message"] = "success";
        $data["response"] = ResponseInterface::HTTP_OK;
        $data["data"] = $dataModel;
        $data["csrf"] = csrf_hash();
      } else {
        $data["message"] = "Error actualizando estado de factura";
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

  // Método delete: Eliminar un estado de factura
  public function delete($id = null) {
    try {
      if ($this->EstadoFacturaModel->where($this->primaryKey, $id)->delete($id)) {
        $data["message"] = "success";
        $data["response"] = ResponseInterface::HTTP_OK;
        $data["data"] = "OK";
        $data["csrf"] = csrf_hash();
      } else {
        $data["message"] = "Error eliminando estado de factura";
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
