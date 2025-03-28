<?php

namespace App\Controllers;

use App\Models\CategoriaModel;
use CodeIgniter\Controller;
use CodeIgniter\HTTP\ResponseInterface;

class CategoriaApi extends Controller {
  private $primaryKey;
  private $CategoriaModel;
  private $data;
  private $model;

  // Constructor
  public function __construct() {
    $this->primaryKey = "id";
    $this->CategoriaModel = new CategoriaModel();
    $this->data = [];
    $this->model = "CategoriaModel";
  }

  // Método index: Obtener todas las categorías
  public function index() {
    $this->data["title"] = "CATEGORIA";
    $this->data[$this->model] = $this->CategoriaModel->orderBy($this->primaryKey, "ASC")->findAll();
    return view("categoria/categoria_view", $this->data);
  }

  // Método create: Crear una nueva categoría
  public function create() {
    if ($this->request->isAJAX()) {
      $dataModel = $this->getDataModel();
      if ($this->CategoriaModel->insert($dataModel)) {
        $data["message"] = "success";
        $data["response"] = ResponseInterface::HTTP_OK;
        $data["data"] = $dataModel;
        $data["csrf"] = csrf_hash();
      } else {
        $data["message"] = "Error al crear la categoría";
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

  // Método singleCategoria: Obtener una sola categoría por ID
  public function singleCategoria($id = null) {
    if ($this->request->isAJAX()) {
      if ($data[$this->model] = $this->CategoriaModel->where($this->primaryKey, $id)->first()) {
        $data["message"] = "success";
        $data["response"] = ResponseInterface::HTTP_OK;
        $data["csrf"] = csrf_hash();
      } else {
        $data["message"] = "Error al obtener la categoría";
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

  // Método update: Actualizar una categoría
  public function update() {
    if ($this->request->isAJAX()) {
      $today = date("Y-m-d H:i:s");
      $id = $this->request->getVar($this->primaryKey);
      $dataModel = [
        "nombre" => $this->request->getVar("nombre"),
        "updated_at" => $today
      ];
      if ($this->CategoriaModel->update($id, $dataModel)) {
        $data["message"] = "success";
        $data["response"] = ResponseInterface::HTTP_OK;
        $data["data"] = $dataModel;
        $data["csrf"] = csrf_hash();
      } else {
        $data["message"] = "Error al actualizar la categoría";
        $data["response"] = ResponseInterface::HTTP_NO_CONTENT;
        $data["data"] = "";
      }
    } else {
      $data["message"] = "Error Ajax";
      $data["response"] = ResponseInterface::HTTP_CONFLICT;
      $data["data"] = "";
    }
    echo json_encode($dataModel);
  }

  // Método delete: Eliminar una categoría por ID
  public function delete($id = null) {
    try {
      if ($this->CategoriaModel->where($this->primaryKey, $id)->delete($id)) {
        $data["message"] = "success";
        $data["response"] = ResponseInterface::HTTP_OK;
        $data["data"] = "OK";
        $data["csrf"] = csrf_hash();
      } else {
        $data["message"] = "Error al eliminar la categoría";
        $data["response"] = ResponseInterface::HTTP_NO_CONTENT;
        $data["data"] = "error";
      }
    } catch (\Exception $e) {
      $data["message"] = $e;
      $data["response"] = ResponseInterface::HTTP_CONFLICT;
      $data["data"] = "Error";
    }
    echo json_encode($data);
  }

  // Método getDataModel: Obtener datos desde la solicitud
  public function getDataModel() {
    $data = [
      "id" => $this->request->getVar("id"),
      "nombre" => $this->request->getVar("nombre"),
      "updated_at" => $this->request->getVar("updated_at")
    ];
    return $data;
  }
}
