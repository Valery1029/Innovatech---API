<?php 

namespace App\Controllers;

use App\Models\AlmacenamientoModel;
use CodeIgniter\Controller;
use CodeIgniter\HTTP\ResponseInterface;

class AlmacenamientoApi extends Controller
{
  private $primaryKey;
  private $AlmacenamientoModel;
  private $data;
  private $model;

  // Método constructor
  public function __construct()
  {
    $this->primaryKey = "id";
    $this->AlmacenamientoModel = new AlmacenamientoModel();
    $this->data = [];
    $this->model = "AlmacenamientoModel";
  }

  // Método index
  public function index()
  {
    $this->data["title"] = "ALMACENAMIENTO";
    $this->data[$this->model] = $this->AlmacenamientoModel->orderBy($this->primaryKey, "ASC")->findAll();
    return view("almacenamiento/almacenamiento_view", $this->data);
  }

  // Método create
  public function create()
  {
    if ($this->request->isAJAX()) {
      $dataModel = $this->getDataModel();
      if ($this->AlmacenamientoModel->insert($dataModel)) {
        $data["message"] = "success";
        $data["response"] = ResponseInterface::HTTP_OK;
        $data["data"] = $dataModel;
        $data["csrf"] = csrf_hash();
      } else {
        $data["message"] = "Error create almacenamiento";
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

  //Metodo get by id
  public function singleAlmacenamiento($id = null)
  {
    if ($this->request->isAJAX()) {
      if ($data[$this->model] = $this->AlmacenamientoModel->where($this->primaryKey, $id)->first()) {
        $data["message"] = "success";
        $data["response"] = ResponseInterface::HTTP_OK;
        $data["csrf"] = csrf_hash();
      } else {
        $data["message"] = "Error almacenamiento no encontrado";
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

  //Metodo update
  public function update()
  {
    if ($this->request->isAJAX()) {
      $today = date("Y-m-d H:i:s");
      $id = $this->request->getVar($this->primaryKey);
      $dataModel = [
        "num" => $this->request->getVar("num"),
        "unidadestandar" => $this->request->getVar("unidadestandar"),
        "update_at" => $today
      ];
      if ($this->AlmacenamientoModel->update($id, $dataModel)) {
        $data["message"] = "success";
        $data["response"] = ResponseInterface::HTTP_OK;
        $data["data"] = $dataModel;
        $data["csrf"] = csrf_hash();
      } else {
        $data["message"] = "Error actualizar almacenamiento";
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

  //Metodo delete
  public function delete($id = null)
  {
    try {
      if ($this->AlmacenamientoModel->where($this->primaryKey, $id)->delete($id)) {
        $data["message"] = "success";
        $data["response"] = ResponseInterface::HTTP_OK;
        $data["data"] = "OK";
        $data["csrf"] = csrf_hash();
      } else {
        $data["message"] = "Error eliminar almacenamiento";
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

  //Metodo get
  public function getDataModel()
  {
    $data = [
      "id" => $this->request->getVar("id"),
      "num" => $this->request->getVar("num"),
      "unidadestandar" => $this->request->getVar("unidadestandar"),
      "update_at" => $this->request->getVar("update_at")
    ];
    return $data;
  }
}
