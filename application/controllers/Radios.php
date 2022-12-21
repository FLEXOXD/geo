<?php

class Radios extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('radio');
    }


    public function index()
    {
        $data["listadoRadios"] = $this->radio->obtenerTodos();
        //print_r($listadoClientes->result());
        $this->load->view("radio/index", $data);
    }
    public function individual($id_rd)
    {
        $data["radioIndividual"] = $this->radio->obtenerUno($id_rd);
        $this->load->view("radio/individual", $data);
    }

    public function guardar()
    {
        $punto1 = $this->input->post('latitud_dq');
        $punto2 = $this->input->post('longitud_dq');
        $datos = array(
            "nombre_dq" => $this->input->post("nombre_dq"),
            "ubicacion_dq" => '{"lat":' . $punto1 . ',"lng":' . $punto2 . '}',
            "rango_dq" => $this->input->post("rango_dq"),
            "color_dq" => $this->input->post("color_dq")
        );
        if ($this->radio->insertar($datos)) {
            redirect("radios/index");
        } else {
            echo "error al insertar";
        }
    }
    public function borrar($id_dq)
    {
        if ($this->radio->eliminarPorId($id_dq)) {
            redirect('radios/index');
        } else {
            echo "Error al eliminar";
        }
    }
}
