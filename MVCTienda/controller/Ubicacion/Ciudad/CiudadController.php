<?php
    
    include_once '../model/Ubicacion/Ciudad/CiudadModel.php';
    
    class CiudadController{
        
        public function getCrear() {
            $objConnection= new CiudadModel();
            $sqlDep="select * from departamento";
            $sqlPai="select * from pais";
            $departamento=$objConnection->consultar($sqlDep);
            $pais=$objConnection->consultar($sqlPai);
            include_once '../view/ubicacion/ciudad/crear.php';
        }
        
        public function postCrear(){
            $objConnection=new CiudadModel();
            
            $ciu_descripcion=$_POST['ciu_descripcion'];
            $dep_id=$_POST['dep_id'];
            
            $sql="insert into pais values(null,'$ciu_descripcion',$dep_id)";
            $ejecucion=$objConnection->insertar($sql);
            redirect(getUrl("Ubicacion/Ciudad", "Ciudad", "listar"));
        }
        
        public function getEditar(){
            $objConnection=new CiudadModel();
            $ciu_id=$_GET['ciu_id'];
            
            $sql="select c.ciu_descripcion,d.dep_descripcion,p.pai_descripcion from pais p, departamento d, ciudad c "
                    . "where c.dep_id=d.dep_id and p.pai_id=d.pai_id and c.ciu_id=$ciu_id";
            
            $consultar=$objConnection->consultar($sql);
            include_once '../view/ubicacion/editar.php';
        }
        public function postEditar() {
            $objConnection=new CiudadModel();
            $ciu_id=$_POST['ciu_id'];
            $ciu_descripcion=$_POST['ciu_descripcion'];
            $sql="update ciudad set ciu_descripcion='$ciu_descripcion' where ciu_id=$ciu_id";
            $editar=$objConnection->editar($sql);
            redirect(getUrl("Ubicacion/Ciudad", "Ciudad", "listar"));
        }
        public function getEliminar() {
            $objConnection=new CiudadModel();
            $ciu_id=$_GET['ciu_id'];
            
            $sql="select c.ciu_descripcion,d.dep_descripcion,p.pai_descripcion from pais p, departamento d, ciudad c "
                    . "where c.dep_id=d.dep_id and p.pai_id=d.pai_id and c.ciu_id=$ciu_id";
            
            $consultar=$objConnection->consultar($sql);
            include_once '../view/ubicacion/eliminar.php';
        }
        public function postEliminar(){
             $objConnection=new CiudadModel();
             $ciu_id=$_POST['ciu_id'];
             
             $sql="delete from ciudad where ciu_id=$ciu_id";
             $eliminar=$objConnection->eliminar($sql);
             redirect(getUrl("Ubicacion/Ciudad", "Ciudad", "listar"));
        }
        public function listar(){
            $objConnection=new CiudadModel();
            $sql="select * from ciudad";
            $consultar=$objConnection->consultar($sql);
            include_once '../view/ubicacion/ciudad/listar.php';
        }
    }

?>
