<?php
    include_once '../model/Ubicacion/Departamento/DepartamentoModel.php';
    
    class DepartamentoController{
        
        public function getCrear(){
            $objConnection=new DepartamentoModel();
            $sql="select * from pais";
            $pais=$objConnection->consultar($sql);
            include_once '../view/ubicacion/departamento/crear.php';
        }
        public function postCrear(){
             $objConnection=new DepartamentoModel();
             $pai_id=$_POST['pai_id'];
             $dep_descripcion=$_POST['dep_descripcion'];
             $sql="insert into departamento values(null,'$dep_descripcion',$pai_id)";
             $ejecucion=$objConnection->insertar($sql);
             redirect(getUrl("Ubicacion/Departamento", "Departamento", "listar"));
        }
        public function getEditar(){
            $objConnection=new DepartamentoModel();
            $dep_id=$_GET['dep_id'];
            $sql="select * from departamento where dep_id=$dep_id";
            $departamento=$objConnection->consultar($sql);
            include_once '../view/ubicacion/departamento/editar.php';
        }
        public function postEditar(){
             $objConnection=new DepartamentoModel();
             $dep_id=$_POST['dep_id'];
             $dep_descripcion=$_POST['dep_descripcion'];
             $sql="update departamento set dep_descripcion='$dep_descripcion' where dep_id=$dep_id";
             $ejecucion=$objConnection->editar($sql);
             redirect(getUrl("Ubicacion/Departamento", "Departamento", "listar"));
        }
        public function getEliminar(){
            $objConnection=new DepartamentoModel();
            $dep_id=$_GET['dep_id'];
            $sql="select * from departamento where dep_id=$dep_id";
            $pais=$objConnection->consultar($sql);
            include_once '../view/ubicacion/departamento/eliminar.php';
        }
        public function postEliminar(){
            $objConnection=new DepartamentoModel();
            $dep_id=$_POST['dep_id'];
            $sql="delete from departamento where dep_id=$dep_id";
            $ejecucion=$objConnection->eliminar($sql);
        }
        public function listar(){
            $objConnection=new DepartamentoModel();
            $sql="select d.*, p.pai_descripcion from pais p, departamento d where d.pai_id=p.pai_id";
            $departamento=$objConnection->consultar($sql);
            include_once '../view/ubicacion/departamento/listar.php';
        }
        
    }
?>