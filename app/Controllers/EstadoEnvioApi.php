<?php

namespace App\Controllers;

use App\Models\EstadoEnvioModel;
use CodeIgniter\Controller;
use CodeIgniter\HTTP\ResponseInterface;

class EstadoEnvioApi extends Controller {
  private $primaryKey;
  private $EstadoEnvioModel;
  private $data;
  private $model;

  // Constructor
  public function __construct() {
    $this->primaryKey = "id";
    $this->EstadoEnvioModel = new EstadoEnvioModel();
    $this->data = [];
    $this->model = "EstadoEnvioModel";
  }

  // Método index: Obtener todos los estados de envío
  public function index() {
    $this->data["title"] = "ESTADO ENVÍO";
    $this->data[$this->model] = $this->EstadoEnvioModel->orderBy($this->primaryKey, "ASC")->findAll();
    return view("estado_envio/estado_envio_view", $this->data);
  }

  // Método create: Crear un nuevo estado de envío
  public function create() {
    if ($this->request->isAJAX()) {
      $dataModel = $this->getDataModel();
      if ($this->EstadoEnvioModel->insert($dataModel)) {
        $data["message"] = "success";
        $data["response"] = ResponseInterface::HTTP_OK;
        $data["data"] = $dataModel;
        $data["csrf"] = csrf_hash();
      } else {
        $data["message"] = "Error creando estado de envío";
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

  // Método singleEstadoEnvio: Obtener un estado de envío por ID
  public function singleEstadoEnvio($id = null) {
    if ($this->request->isAJAX()) {
      if ($data[$this->model] = $this->EstadoEnvioModel->where($this->primaryKey, $id)->first()) {
        $data["message"] = "success";
        $data["response"] = ResponseInterface::HTTP_OK;
        $data["csrf"] = csrf_hash();
      } else {
        $data["message"] = "Error obteniendo estado de envío";
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

  // Método update: Actualizar un estado de envío
  public function update() {
    if ($this->request->isAJAX()) {
      $today = date("Y-m-d H:i:s");
      $id = $this->request->getVar($this->primaryKey);
      $dataModel = [
        "estado" => $this->request->getVar("estado"),
        "updated_at" => $today
      ];
      if ($this->EstadoEnvioModel->update($id, $dataModel)) {
        $data["message"] = "success";
        $data["response"] = ResponseInterface::HTTP_OK;
        $data["data"] = $dataModel;
        $data["csrf"] = csrf_hash();
      } else {
        $data["message"] = "Error actualizando estado de envío";
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

  // Método delete: Eliminar un estado de envío
  public function delete($id = null) {
    try {
      if ($this->EstadoEnvioModel->where($this->primaryKey, $id)->delete($id)) {
        $data["message"] = "success";
        $data["response"] = ResponseInterface::HTTP_OK;
        $data["data"] = "OK";
        $data["csrf"] = csrf_hash();
      } else {
        $data["message"] = "Error eliminando estado de envío";
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
