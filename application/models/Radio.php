<?php
class Radio extends CI_Model
{
    function __construct()
    {
        parent::__construct(); //!invocar clase padre
        $this->load->database();
    }
    public function insertar($datos)
    {
        return $this->db->insert("radio",$datos);
    }
    //? funcion cosultar los datos de la tabla
    function obtenerTodos()
    {
        $this->db->order_by("id_dq", "asc");
        $radios=$this->db->get("radio");
        if ($radios->num_rows()>0) {//?Cuando existen clientes
            return $radios->result();
        } else {
            return false;//?Cuando no existen clientes
        }

    }
    public function eliminarPorId($id){
        $this->db->where("id_dq",$id);
        return $this->db->delete("radio");//eliminar informacion de la tabla
    }
    function obtenerUno($id)
    {
        $this->db->where("id_dq",$id);

       return $this->db->get("radio");

    }
}
