<?php

namespace App\Controllers;

use App\Models\DepartamentoModel;
use CodeIgniter\Controller;
use CodeIgniter\HTTP\ResponseInterface;

class DepartamentoController extends Controller
{
    private $primaryKey;
    private $DepartamentoModel;
    private $data;
    private $model;

    //Metodo constructor
    public function __construct()
    {
        $this->primaryKey = "id";
        $this->DepartamentoModel = new DepartamentoModel();
        $this->data = [];
        $this->model = "DepartamentoModel";
    }

    //Metodo index
    public function index()
    {
        $this->data["title"] = "DEPARTAMENTO";
        $this->data[$this->model] = $this->DepartamentoModel->orderBy($this->primaryKey, "ASC")->findAll();
        return view("departamento/departamento_view", $this->data);
    }

    //Metodo create
    public function create()
    {
        if ($this->request->isAJAX()) {
            $dataModel = $this->getDataModel();
            if ($this->DepartamentoModel->insert($dataModel)) {
                $data["message"] = "success";
                $data["response"] = ResponseInterface::HTTP_OK;
                $data["data"] = $dataModel;
                $data["csrf"] = $csrf_hash();
            } else {
                $data["message"] = "Error create user";
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

    public function singleDepartamento($id = null)
    {
        if ($this->request->isAJAX()) {
            if ($data[$this->model] = $this->DepartamentoModel->where($this->primaryKey, $id)->first()) {
                $data["message"] = "success";
                $data["response"] = ResponseInterface::HTTP_OK;
                $data["csrf"] = csrf_hash();
            } else {
                $data["message"] = "Error create user";
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

    public function update()
    {
        if ($this->request->isAJAX()) {
            $today = date("Y-m-d H:i:s");
            $id = $this->request->getVar($this->primaryKey);
            $dataModel = [
                "nom" => $this->request->getVar("nom"),
                "update_at" => $today
            ];
            if ($this->DepartamentoModel->update($id, $dataModel)) {
                $data["message"] = "success";
                $data["response"] = ResponseInterface::HTTP_OK;
                $data["data"] = $dataModel;
                $data["csrf"] = $csrf_hash();
            } else {
                $data["message"] = "Error create user";
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

    public function delete($id = null)
    {
        try {
            if ($this->DepartamentoModel->where($this->primaryKey, $id)->delete($id)) {
                $data["message"] = "success";
                $data["response"] = ResponseInterface::HTTP_OK;
                $data["data"] = "OK";
                $data["csrf"] = $csrf_hash();
            } else {
                $data["message"] = "Error create user";
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

    public function getDataModel()
    {
        $data = [
            "id" => $this->request->getVar("id"),
            "nom" => $this->request->getVar("nom"),
            "update_at" => $this->request->getVar("update_at")
        ];
        return $data;
    }
}