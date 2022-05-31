<?php
    include_once '../model/Juego/Juego/JuegoModel.php';
    
    Class JuegoController{
        
        public function getCrear(){
            $objConnection=new JuegoModel();
            $sql="select * from juego";
            $sqlPla="select * from plataforma";
            $sqlGen="select * from genero";
            $sqlPai="select * from Pais";
            $sqlIdi="select * from idioma";
            $sqlCasa="select * from casa_desarrolladora";
            $juego=$objConnection->consultar($sql);
            $plataforma=$objConnection->consultar($sqlPla);
            $genero=$objConnection->consultar($sqlGen);
            $pais=$objConnection->consultar($sqlPai);
            $idioma=$objConnection->consultar($sqlIdi);
            $casa_desarrolladora=$objConnection->consultar($sqlCasa);
            $jue=$objConnection->lastInsertId("juego","jue_id");
            include_once '../view/juego/juego/crear.php';
        }
        public function postCrear(){
            $objConnection=new JuegoModel();
            $link=$objConnection->getConnect();
            $nombre=$_POST['nombre'];
            $pais=$_POST['pais'];
            $precio=$_POST['precio'];
            $cantidad=$_POST['cantidad'];
            $imagen=$_FILES['imagen']['name'];
            $año=$_POST['año'];
            $jugadores=$_POST['jugadores'];
            $descripcion=$_POST['descripcion'];
            $plataforma=$_POST['plataforma'];
            $casa_desarrolladora=$_POST['casa_desarrolladora'];
            $idioma=$_POST['idioma'];
            $genero=$_POST['genero'];

            $ruta="juegos/$imagen";

            move_uploaded_file($_FILES['imagen']['tmp_name'],$ruta);

            $sql="insert into juego values(null,'".omitir($link,$nombre)."','$año','$ruta','$precio','$cantidad','$descripcion',$pais,'$jugadores','5')";
            $ejecucion=$objConnection->insertar($sql);
            $id=$objConnection->lastInsertId("juego", "jue_id");
            
            foreach ($plataforma as $pla){
                $sql="insert into plataforma_juego values (null,$pla,$id)";
                $ejecucion=$objConnection->insertar($sql);
                if(!$ejecucion){
                    echo mysqli_error($ejecucion);
                }
            }
            foreach ($genero as $gen){
                $sql="insert into genero_juego values (null,$gen,$id)";
                $ejecucion=$objConnection->insertar($sql);
                if(!$ejecucion){
                    echo mysqli_error($ejecucion);
                }
            }
            foreach ($idioma as $idi){
                $sql="insert into idioma_juego values (null,$idi,$id)";
                $ejecucion=$objConnection->insertar($sql);
                if(!$ejecucion){
                    echo mysqli_error($ejecucion);
                }
            }
            foreach ($casa_desarrolladora as $casa){
                $sql="insert into plataforma_juego values (null,$casa,$id)";
                $ejecucion=$objConnection->insertar($sql);
                if(!$ejecucion){
                    echo mysqli_error($ejecucion);
                }
            }
            redirect(getUrl("Juego/Juego", "juego", "listar"));
        }
        function getEditar(){
            $juego_id=$_GET['jue_id'];
            $objConnection=new JuegoModel();
            $sql="select * from juego where jue_id=$juego_id";
            $sqlPla="select * from plataforma";
            $sqlIdio_Juego="select * from idioma_juego";
            $sqlPla_Juego="select * from plataforma_juego";
            $casita="select * from casa_desarrolladora c, casa_desarrolladora_juego ca";
            $sqlIdi="select * from idioma";
            $sqlCasa="select * from casa_desarrolladora_juego";
            $sqlGen_jue="select * from genero_juego";
            $pai="select * from pais";
            
            $pais=$objConnection->consultar($pai);
            $idi_jue=$objConnection->consultar($sqlIdio_Juego);
            $pla_jue=$objConnection->consultar($sqlPla_Juego);
            $gen_jue=$objConnection->consultar($sqlGen_jue);
            $cas_des=$objConnection->consultar($sqlCasa);
            $sqlGen="select * from genero";
            $genero=$objConnection->consultar($sqlGen);
            $juego=$objConnection->consultar($sql);
            $plataforma=$objConnection->consultar($sqlPla);
            $casa_desarrolladora=$objConnection->consultar($casita);
            $idioma=$objConnection->consultar($sqlIdi);
            include_once '../view/juego/juego/editar.php';
            
        }
        function postEditar(){
            echo "<pre>";
            echo die(print_r($_POST));
        }
        function listar(){
            $objConnection=new JuegoModel();
            $sql="select j.jue_nombre, j.jue_id, j.jue_imagen, j.jue_cantidad, j.jue_precio, g.gen_descripcion from juego j, genero g, genero_juego gj "
                    . "where g.gen_id=gj.gen_id and j.jue_id=gj.jue_id";
            $juego=$objConnection->consultar($sql);
            include_once '../view/juego/juego/listar.php';
        }
        
    }
    
?>
