<?php
header("Content-Type: text/html;charset=utf-8");

class A_PRO
{
    var $datos=array(); # contains field data
    var $campos=""; # contains field names
    var $arrDataNames = array();
    var $paginatorLinks = "";
    var $tableName = "";
    var $DBcon = "";
    var $lastId = "";
    var $tmpguid="";
    var $domain = "";
    /* Constructor: User passes in the name of the script where
        * form data is to be sent ($processor) and the value to show
        * on the submit button.
        */

    function __construct($arrData=array())
    {
        //inicializo
        $this->datos = $arrData;

        $this->tableName = "tproyectos";
        $this->domain = C_DOMAIN;
    }



    /***
     * Registro de un nuevo proyecto
     */
    function ins_proyecto($DBcon, $nombre, $sector, $estado, $idusuario)
    {
        $now = date("Y-m-d H:i:s");

        $query = "INSERT INTO ".$this->tableName." 
                    (idusuario, cname, csector1, cstate, cregdate) 
					VALUES
					('".$idusuario."', '".$nombre."','".$sector."','".$estado."','".$now."')";

        $stmt = $DBcon->prepare($query);

        // check for successfull registration
        if ( $stmt->execute() ) {

            // obtengo el ultimo ID
            $lastId = $DBcon->lastInsertId();
            //$this->set_lastId($DBcon->lastInsertId());

            $responseFiscales = $this->ins_datosFiscales($DBcon, $lastId);
            $responseBancarios = $this->ins_datosBancarios($DBcon, $lastId);
            $responseAvance = $this->ins_datosAvance($DBcon, $lastId); //para avance de seccion
            $responseAvance = $this->ins_avance($DBcon, $lastId);  //para avance de llenado de proyecto

            $response['status'] = 'success';
            $response['message'] = 'Registro exitoso, Gracias!';
            $response['debug'] = '-S-'.$query;
            $response['URL'] = 'project_edit.php?id='.$lastId;


        } else {
            $response['status'] = 'error'; // could not register
            $response['message'] = 'No se pudo registrar, intente nuevamente más tarde';
            $response['debug'] = '-E-'.$query;
        }

        return $response;
    }



    private function ins_datosFiscales($DBcon, $idProyecto)
    {
        $now = date("Y-m-d H:i:s");

        $query = "INSERT INTO  tfiscales
                    (idproyecto, cregdate) 
					VALUES
					('".$idProyecto."','".$now."')";

        $stmt = $DBcon->prepare($query);

        // check for successfull registration
        if ( $stmt->execute() ) {

            // obtengo el ultimo ID
            $this->set_lastId($DBcon->lastInsertId());

            $response['status'] = 'success';
            $response['message'] = 'Registro exitoso, Gracias!';
            $response['debug'] = '-S-'.$query;


        } else {
            $response['status'] = 'error'; // could not register
            $response['message'] = 'No se pudo registrar, intente nuevamente más tarde';
            $response['debug'] = '-E-'.$query;
        }

        return $response;
    }

    private function ins_datosAvance($DBcon, $idProyecto)
    {
        $query = "INSERT INTO  tp_avance
                    (idproyecto) 
					VALUES
					('".$idProyecto."')";

        $stmt = $DBcon->prepare($query);

        // check for successfull registration
        if ( $stmt->execute() ) {

            $response['status'] = 'success';
            $response['message'] = 'Registro exitoso, Gracias!';
            $response['debug'] = '-S-'.$query;

        } else {
            $response['status'] = 'error'; // could not register
            $response['message'] = 'No se pudo registrar, intente nuevamente más tarde';
            $response['debug'] = '-E-'.$query;
        }

        return $response;
    }


    private function ins_avance($DBcon, $idProyecto)
    {
        $query = "INSERT INTO  tavances
                    (idproyecto) 
					VALUES
					('".$idProyecto."')";

        $stmt = $DBcon->prepare($query);

        // check for successfull registration
        if ( $stmt->execute() ) {

            $response['status'] = 'success';
            $response['message'] = 'Registro exitoso, Gracias!';
            $response['debug'] = '-S-'.$query;

        } else {
            $response['status'] = 'error'; // could not register
            $response['message'] = 'No se pudo registrar, intente nuevamente más tarde';
            $response['debug'] = '-E-'.$query;
        }

        return $response;
    }



    private function ins_datosBancarios($DBcon, $idProyecto)
    {
        $now = date("Y-m-d H:i:s");

        $query = "INSERT INTO  tp_bancario
                    (idproyecto) 
					VALUES
					('".$idProyecto."')";

        $stmt = $DBcon->prepare($query);

        // check for successfull registration
        if ( $stmt->execute() ) {

            // obtengo el ultimo ID
            $this->set_lastId($DBcon->lastInsertId());

            $response['status'] = 'success';
            $response['message'] = 'Registro exitoso, Gracias!';
            $response['debug'] = '-S-'.$query;


        } else {
            $response['status'] = 'error'; // could not register
            $response['message'] = 'No se pudo registrar, intente nuevamente más tarde';
            $response['debug'] = '-E-'.$query;
        }

        return $response;
    }


    /**
     * @param $DBcon
     * @param $idProyecto
     * @return mixed
     */
    public function ins_datosCompetencia($DBcon, $idProyecto, $competidor, $dif, $propuesta)
    {
        $now = date("Y-m-d H:i:s");

        $query = "INSERT INTO  tp_competencia
                    (idproyecto,cp_competidor, cp_diferenciador, cp_propuestav) 
					VALUES
					('".$idProyecto."','".$competidor."','".$dif."','".$propuesta."')";

        $stmt = $DBcon->prepare($query);

        // check for successfull registration
        if ( $stmt->execute() ) {

            // obtengo el ultimo ID
            $this->set_lastId($DBcon->lastInsertId());

            $response['status'] = 'success';
            $response['message'] = 'Registro exitoso, Gracias!';
            $response['debug'] = '-S-'.$query;


        } else {
            $response['status'] = 'error'; // could not register
            $response['message'] = 'No se pudo registrar, intente nuevamente más tarde';
            $response['debug'] = '-E-'.$query;
        }

        return $response;
    }


    /**
     * @param $DBcon
     * @param $idProyecto
     * @return mixed
     */
    public function ins_datosMercado($DBcon, $idProyecto, $cliente, $segmento, $mercado, $marketing, $ventas, $precio)
    {
        $now = date("Y-m-d H:i:s");

        $query = "INSERT INTO  tp_mercado
                    (idproyecto,cp_cliente, cp_segmento, cp_mercado, cp_marketing, cp_ventastot, cp_precio) 
					VALUES
					('".$idProyecto."','".$cliente."','".$segmento."','".$mercado."','".$marketing."','".$ventas."','".$precio."')";

        $stmt = $DBcon->prepare($query);

        // check for successfull registration
        if ( $stmt->execute() ) {

            // obtengo el ultimo ID
            $this->set_lastId($DBcon->lastInsertId());

            $response['status'] = 'success';
            $response['message'] = 'Registro exitoso, Gracias!';
            $response['debug'] = '-S-'.$query;


        } else {
            $response['status'] = 'error'; // could not register
            $response['message'] = 'No se pudo registrar, intente nuevamente más tarde';
            $response['debug'] = '-E-'.$query;
        }

        return $response;
    }



    /**
     * @param $DBcon
     * @param $idProyecto
     * @return mixed
     */
    public function ins_datosFuente($DBcon, $idProyecto, $descripcion, $valor)
    {
        $now = date("Y-m-d H:i:s");

        $query = "INSERT INTO  tp_fuente
                    (idproyecto,cp_descripcion, cvalor) 
					VALUES
					('".$idProyecto."','".$descripcion."','".$valor."')";

        $stmt = $DBcon->prepare($query);

        // check for successfull registration
        if ( $stmt->execute() ) {

            $response['status'] = 'success';
            $response['message'] = 'Registro exitoso, Gracias!';
            $response['debug'] = '-S-'.$query;


        } else {
            $response['status'] = 'error'; // could not register
            $response['message'] = 'No se pudo registrar, intente nuevamente más tarde';
            $response['debug'] = '-E-'.$query;
        }

        return $response;
    }

    /**
     * @param $DBcon
     * @param $idProyecto
     * @return mixed
     */
    public function ins_datosCostos($DBcon, $idProyecto, $descripcion, $valor)
    {

        $query = "INSERT INTO  tp_costos
                    (idproyecto,cp_descripcion, cvalor) 
					VALUES
					('".$idProyecto."','".$descripcion."','".$valor."')";

        $stmt = $DBcon->prepare($query);

        // check for successfull registration
        if ( $stmt->execute() ) {

            $response['status'] = 'success';
            $response['message'] = 'Registro exitoso, Gracias!';
            $response['debug'] = '-S-'.$query;


        } else {
            $response['status'] = 'error'; // could not register
            $response['message'] = 'No se pudo registrar, intente nuevamente más tarde';
            $response['debug'] = '-E-'.$query;
        }

        return $response;
    }


    /**
     * @param $DBcon
     * @param $idProyecto
     * @return mixed
     */
    public function ins_datosHistoria($DBcon, $idProyecto, $descripcion)
    {

        $query = "INSERT INTO  tp_historia
                    (idproyecto,cp_desc) 
					VALUES
					('".$idProyecto."','".$descripcion."')";

        $stmt = $DBcon->prepare($query);

        // check for successfull registration
        if ( $stmt->execute() ) {

            $response['status'] = 'success';
            $response['message'] = 'Registro exitoso, Gracias!';
            $response['debug'] = '-S-'.$query;


        } else {
            $response['status'] = 'error'; // could not register
            $response['message'] = 'No se pudo registrar, intente nuevamente más tarde';
            $response['debug'] = '-E-'.$query;
        }

        return $response;
    }


    /**
     * @param $DBcon
     * @param $idProyecto
     * @return mixed
     */
    public function ins_datosEquipo($DBcon, $idProyecto, $nombre, $puesto)
    {

        $query = "INSERT INTO  tp_equipo
                    (idproyecto,cp_nombre, cp_puesto ) 
					VALUES
					('".$idProyecto."','".$nombre."','".$puesto."')";

        $stmt = $DBcon->prepare($query);

        // check for successfull registration
        if ( $stmt->execute() ) {

            $response['status'] = 'success';
            $response['message'] = 'Registro exitoso, Gracias!';
            $response['debug'] = '-S-'.$query;


        } else {
            $response['status'] = 'error'; // could not register
            $response['message'] = 'No se pudo registrar, intente nuevamente más tarde';
            $response['debug'] = '-E-'.$query;
        }

        return $response;
    }


    /**
     * @param $DBcon
     * @param $idProyecto
     * @return mixed
     */
    public function ins_datosRiesgos($DBcon, $idProyecto, $indicador, $exp)
    {

        $query = "INSERT INTO  tp_riesgos
                    (idproyecto,cp_indicador, cp_explicacion ) 
					VALUES
					('".$idProyecto."','".$indicador."','".$exp."')";

        $stmt = $DBcon->prepare($query);

        // check for successfull registration
        if ( $stmt->execute() ) {

            $response['status'] = 'success';
            $response['message'] = 'Registro exitoso, Gracias!';
            $response['debug'] = '-S-'.$query;


        } else {
            $response['status'] = 'error'; // could not register
            $response['message'] = 'No se pudo registrar, intente nuevamente más tarde';
            $response['debug'] = '-E-'.$query;
        }

        return $response;
    }

    /**
     * @param $DBcon
     * @param $idProyecto
     * @return mixed
     */
    public function ins_datosPlan($DBcon, $idProyecto, $porcentaje, $exp)
    {

        $query = "INSERT INTO  tp_plan
                    (idproyecto,cp_detalle, cp_porcentaje ) 
					VALUES
					('".$idProyecto."','".$exp."','".$porcentaje."')";

        $stmt = $DBcon->prepare($query);

        // check for successfull registration
        if ( $stmt->execute() ) {

            $response['status'] = 'success';
            $response['message'] = 'Registro exitoso, Gracias!';
            $response['debug'] = '-S-'.$query;


        } else {
            $response['status'] = 'error'; // could not register
            $response['message'] = 'No se pudo registrar, intente nuevamente más tarde';
            $response['debug'] = '-E-'.$query;
        }

        return $response;
    }


    /***
     * Obtains a user general data
     */
    function get_datosproyecto($DBcon, $id)
    {
        $query= "SELECT * FROM ".$this->tableName." WHERE id = '".$id."'";
        $stmt = $DBcon->prepare($query);
        $stmt->execute();
        $obj = $stmt->fetchObject();
        // regresa un solo registro
        return $obj;
    }



    /***
     * Obtains a user general data
     */
    function get_datosfiscales($DBcon, $id)
    {
        $query= "SELECT * FROM tfiscales WHERE idproyecto = '".$id."'";
        $stmt = $DBcon->prepare($query);
        $stmt->execute();
        $obj = $stmt->fetchObject();
        // regresa un solo registro
        return $obj;
    }


    /***
     * Obtains a bancarios
     */
    function get_datosbancarios($DBcon, $id)
    {
        $query= "SELECT * FROM tp_bancario WHERE idproyecto = '".$id."'";
        $stmt = $DBcon->prepare($query);
        $stmt->execute();
        $obj = $stmt->fetchObject();
        // regresa un solo registro
        return $obj;
    }


    /***
     * Obtains a user general data
     */
    function get_datoscompetencia($DBcon, $id)
    {
        $sql= "SELECT cp_competidor AS Competidor, cp_diferenciador AS Diferenciador, cp_propuestav AS Propuesta FROM tp_competencia WHERE idProyecto = '".$id."'";

        $data = $DBcon->query($sql)->fetchAll(PDO::FETCH_ASSOC);

        return $data;
    }

    /***
     * Obtains a user general data
     */
    function get_datosmercado($DBcon, $id)
    {
        $sql= "SELECT cp_cliente AS Cliente, cp_segmento AS Segmento, cp_mercado AS Mercado, cp_marketing as Marketing, cp_ventastot AS Ventas, cp_precio AS Precio 
        FROM tp_mercado WHERE idProyecto = '".$id."'";

        $data = $DBcon->query($sql)->fetchAll(PDO::FETCH_ASSOC);

        return $data;
    }

    /***
     * Obtains a user general data
     */
    function get_datosfuente($DBcon, $id)
    {
        $sql= "SELECT cp_descripcion AS Descripcion, cvalor AS Valor  
        FROM tp_fuente WHERE idProyecto = '".$id."'";

        $data = $DBcon->query($sql)->fetchAll(PDO::FETCH_ASSOC);

        return $data;
    }

    /***
     * Obtains a user general data
     */
    function get_datoscostos($DBcon, $id)
    {
        $sql= "SELECT cp_descripcion AS Descripcion, cvalor AS Valor  
        FROM tp_costos WHERE idProyecto = '".$id."'";

        $data = $DBcon->query($sql)->fetchAll(PDO::FETCH_ASSOC);

        return $data;
    }


    /***
     * Obtains a user general data
     */
    function get_datoshistoria($DBcon, $id)
    {
        $sql= "SELECT cp_desc AS Descripcion 
        FROM tp_historia WHERE idProyecto = '".$id."'";

        $data = $DBcon->query($sql)->fetchAll(PDO::FETCH_ASSOC);

        return $data;
    }


    /***
     * Obtains a user general data
     */
    function get_datosequipo($DBcon, $id)
    {
        $sql= "SELECT cp_nombre AS Nombre, cp_puesto AS Puesto  
        FROM tp_equipo WHERE idProyecto = '".$id."'";

        $data = $DBcon->query($sql)->fetchAll(PDO::FETCH_ASSOC);

        return $data;
    }

    /***
     * Obtains a user general data
     */
    function get_datosplan($DBcon, $id)
    {
        $sql= "SELECT cp_detalle AS Detalle, cp_porcentaje AS Porcentaje  
        FROM tp_plan WHERE idProyecto = '".$id."'";

        $data = $DBcon->query($sql)->fetchAll(PDO::FETCH_ASSOC);

        return $data;
    }

    /***
     * Obtains a user general data
     */
    function get_datosriesgos($DBcon, $id)
    {
        $sql= "SELECT cp_explicacion AS Explicacion, cp_indicador AS Indicador  
        FROM tp_riesgos WHERE idProyecto = '".$id."'";

        $data = $DBcon->query($sql)->fetchAll(PDO::FETCH_ASSOC);

        return $data;
    }

    /***
     * Obtains a user general data
     */
    function get_datossubasta($DBcon, $id)
    {
        $query= "SELECT * FROM tp_subasta WHERE idproyecto = '".$id."'";
        $stmt = $DBcon->prepare($query);
        $stmt->execute();
        $obj = $stmt->fetchObject();
        // regresa un solo registro
        return $obj;
    }

    /***
     * Actualiza los datos generales
     */
    public function upd_generales($DBcon, $idProyecto, $nombre, $sector, $video, $www, $fb, $tw, $insta, $linkedin )
    {
        $query = "UPDATE ".$this->tableName." SET 
                 cname  = '".$nombre."',
                  csector1  = '".$sector."',
                  cvideo  = '".$video."',
                  cwww  = '".$www."',
                  cfb  = '".$fb."',
                  ctw  = '".$tw."',
                  cins  = '".$insta."',
                  clinkedin  = '".$linkedin."'
                 WHERE  id = '".$idProyecto."' 
				 ";

        $stmt = $DBcon->prepare($query);
        $stmt->execute();

        // check for successfull registration
        if ( $stmt->execute() ) {
            $response['status'] = 'success';
            $response['message'] = 'Registro actualizado';
            $response['debug'] = '-S-'.$query;
        } else {
            $response['status'] = 'error'; // could not register
            $response['message'] = 'No se pudo actualizar, favor de intentar nuevamente';
            $response['debug'] = '-E-'.$query;
        }


        return $response;
    }


    /***
     * Actualiza los datos generales
     */
    public function upd_statusproject($DBcon, $idProyecto, $status )
    {
        $query = "UPDATE ".$this->tableName." SET 
                 cstatus  = '".$status."' 
                 WHERE  id = '".$idProyecto."' 
				 ";

        $stmt = $DBcon->prepare($query);
        $stmt->execute();

        // check for successfull registration
        if ( $stmt->execute() ) {
            $response['status'] = 'success';
            $response['message'] = 'Estatus actualizado';
            $response['URL'] = 'desktop.php';
        } else {
            $response['status'] = 'error'; // could not register
            $response['message'] = 'No se pudo actualizar, favor de intentar nuevamente';
            //$response['debug'] = '-E-'.$query;
        }


        return $response;
    }


    /***
     * Actualiza los datos generales
     */
    public function upd_tavance($DBcon, $idProyecto, $seccion, $valor )
    {
        $query = "UPDATE tavances SET 
                 ".$seccion."  = '".$valor."'  
                 WHERE  idproyecto = '".$idProyecto."' 
				 ";

        $stmt = $DBcon->prepare($query);
        $stmt->execute();

        // check for successfull registration
        if ( $stmt->execute() ) {
            $response['status'] = 'success';
            $response['message'] = 'Registro actualizado';
            $response['debug'] = '-S-'.$query;
        } else {
            $response['status'] = 'error'; // could not register
            $response['message'] = 'No se pudo actualizar, favor de intentar nuevamente';
            $response['debug'] = '-E-'.$query;
        }


        return $response;
    }


    /***
     * Actualiza los datos de negocio
     */
    public function upd_negocio($DBcon, $idProyecto, $supuesto, $modelo, $vendidas, $precio, $ingresos, $costos, $capex, $ventas, $eeff, $utilidad )
    {
        $query = "UPDATE ".$this->tableName." SET 
                 csupuestosclave  = '".$supuesto."',
                  cmodeloingresos  = '".$modelo."',
                  cunidades  = '".$vendidas."',
                  cprecio  = '".$precio."',
                  cingreso  = '".$ingresos."',
                  ccostos  = '".$costos."',
                  ccapex  = '".$capex."',
                  cventas  = '".$ventas."',
                  ceeff  = '".$eeff."',
                  cutilidad  = '".$utilidad."' 
                 WHERE  id = '".$idProyecto."' 
				 ";

        $stmt = $DBcon->prepare($query);
        $stmt->execute();

        // check for successfull registration
        if ( $stmt->execute() ) {
            $response['status'] = 'success';
            $response['message'] = 'Registro actualizado';
            $response['debug'] = '-S-'.$query;
        } else {
            $response['status'] = 'error'; // could not register
            $response['message'] = 'No se pudo actualizar, favor de intentar nuevamente';
            $response['debug'] = '-E-'.$query;
        }


        return $response;
    }


    /***
     * Actualiza los datos fiscales de rep legal
     */
    public function upd_fiscales1($DBcon, $idProyecto, $replegal, $curp, $tel )
    {
        $query = "UPDATE tfiscales SET 
                 creplegal  = '".$replegal."',
                  creplegalcurp  = '".$curp."',
                  creplegaltel  = '".$tel."'
                 WHERE  idProyecto = '".$idProyecto."' 
				 ";

        $stmt = $DBcon->prepare($query);
        $stmt->execute();

        // check for successfull registration
        if ( $stmt->execute() ) {
            $response['status'] = 'success';
            $response['message'] = 'Registro actualizado';
            $response['debug'] = '-S-'.$query;
        } else {
            $response['status'] = 'error'; // could not register
            $response['message'] = 'No se pudo actualizar, favor de intentar nuevamente';
            $response['debug'] = '-E-'.$query;
        }

        return $response;
    }

    /***
     * para avance de seccion
     */
    public function upd_avance($DBcon, $idProyecto, $valor )
    {
        $query = "UPDATE tp_avance SET 
                avance  = '".$valor."'   
                 WHERE  idProyecto = '".$idProyecto."' 
				 ";

        $stmt = $DBcon->prepare($query);
        $stmt->execute();

        // check for successfull registration
        if ( $stmt->execute() ) {
            $response['status'] = 'success';
            $response['message'] = 'Registro actualizado';
            $response['debug'] = '-S-'.$query;
        } else {
            $response['status'] = 'error'; // could not register
            $response['message'] = 'No se pudo actualizar, favor de intentar nuevamente';
            $response['debug'] = '-E-'.$query;
        }

        return $response;
    }


    /***
     * Obtains avance de seccion
     */
    function get_datosavance($DBcon, $id)
    {
        $query= "SELECT avance FROM tp_avance WHERE idproyecto = '".$id."'";
        $stmt = $DBcon->prepare($query);
        $stmt->execute();
        $obj = $stmt->fetchObject();

        // regresa un solo registro
        return $obj->avance;
    }


    /***
     * Obtains avance
     */
    function get_datostavance($DBcon, $id, $seccion)
    {
        $query= "SELECT ".$seccion." FROM tavance WHERE idproyecto = '".$id."'";
        $stmt = $DBcon->prepare($query);
        $stmt->execute();
        $obj = $stmt->fetchObject();

        $arrAvance = array();
        $arrAvance["seccion"] = $obj->$seccion;
        $arrAvance["total"] = $obj->total;

        // regresa un solo registro
        return $arrAvance;
    }


    /***
     * Obtains avance
     */
    function get_totaldatostavance($DBcon, $id)
    {
        $query= "SELECT  (cs1+cs2+cs3+cs4+cs5+cs6+cs7+cs8+cs9+cs10+cs11+cs12+cs13+cs14+cs15+cs16+cs17+cs18+cs19)TOT FROM tavances  WHERE idproyecto = '".$id."'";
        $stmt = $DBcon->prepare($query);
        $stmt->execute();
        $obj = $stmt->fetchObject();

        // regresa un solo registro
        return $obj->TOT;
    }


    /***
     * Actualiza los datos fiscales de rep legal
     */
    public function upd_fiscales2($DBcon, $idProyecto, $rfc, $nombre, $pais, $estado, $calle, $noext, $noint, $colonia, $municipio, $cp, $regDate)
    {
        $query = "UPDATE tfiscales SET 
                 crfc  = '".$rfc."',
                  cnombre  = '".$nombre."',
                  cpais  = '".$pais."',
                  cestado  = '".$estado."',
                  ccalle  = '".$calle."',
                  cnoext  = '".$noext."',
                  cnoint  = '".$noint."',
                  ccolonia  = '".$colonia."',
                  cmunicipio  = '".$municipio."',
                  ccp  = '".$cp."',
                  cfecharegistro  = '".$regDate."'
                 WHERE  idProyecto = '".$idProyecto."' 
				 ";

        $stmt = $DBcon->prepare($query);
        $stmt->execute();

        // check for successfull registration
        if ( $stmt->execute() ) {
            $response['status'] = 'success';
            $response['message'] = 'Registro actualizado';
            $response['debug'] = '-S-'.$query;
        } else {
            $response['status'] = 'error'; // could not register
            $response['message'] = 'No se pudo actualizar, favor de intentar nuevamente';
            $response['debug'] = '-E-'.$query;
        }

        return $response;
    }



    /***
     * Actualiza los datos de inversion en tproyecto
     */
    public function upd_inversion($DBcon, $idProyecto, $monto, $fin, $startup, $duracion )
    {
        $query = "UPDATE ".$this->tableName." SET 
                 cmetamin  = '".$monto."',
                  cfinrecursos  = '".$fin."',
                  cstartup  = '".$startup."',
                  cmeses  = '".$duracion."'  
                 WHERE  id = '".$idProyecto."' 
				 ";

        $stmt = $DBcon->prepare($query);
        $stmt->execute();

        // check for successfull registration
        if ( $stmt->execute() ) {
            $response['status'] = 'success';
            $response['message'] = 'Registro actualizado';
            $response['debug'] = '-S-'.$query;
        } else {
            $response['status'] = 'error'; // could not register
            $response['message'] = 'No se pudo actualizar, favor de intentar nuevamente';
            $response['debug'] = '-E-'.$query;
        }


        return $response;
    }


    /***
     * Actualiza el logo del proyecto
     */
    function upd_logoproyecto($DBcon, $idProyecto, $photoPath)
    {
        $query = "UPDATE tproyectos SET clogo = '".$photoPath."' 
                    WHERE id  = '".$idProyecto."' 
					";

        $stmt = $DBcon->prepare($query);
        $stmt->execute();

        // check for successfull registration
        if ( $stmt->execute() ) {
            $response['status'] = 'success';
            $response['message'] = 'Logo establecido =)';
            $response['debug'] = '-S-'.$query;
        } else {
            $response['status'] = 'error'; // could not register
            $response['message'] = 'No se pudo establecer el logo';
            $response['debug'] = '-E-'.$query;
        }

        return $response;
    }


    /***
     * Actualiza la idea del proyecto
     */
    function upd_ideaproyecto($DBcon, $idProyecto, $problema, $solucion, $plan, $resultados)
    {
        $query = "UPDATE tproyectos SET 
              cproblema = '".$problema."', 
              csolucion = '".$solucion."',
              cplannegocios_st = '".$plan."',
              cresultados_st = '".$resultados."'
                    WHERE id  = '".$idProyecto."' 
					";

        $stmt = $DBcon->prepare($query);
        $stmt->execute();

        // check for successfull registration
        if ( $stmt->execute() ) {
            $response['status'] = 'success';
            $response['message'] = 'Registro exitoso =)';
            $response['debug'] = '-S-'.$query;
        } else {
            $response['status'] = 'error'; // could not register
            $response['message'] = 'No se pudo registrar...';
            $response['debug'] = '-E-'.$query;
        }

        return $response;
    }


    /***
     * Actualiza el producto del proyecto
     */
    function upd_productoproyecto($DBcon, $idProyecto, $producto, $tipo, $etapa, $patente)
    {
        $query = "UPDATE tproyectos SET 
              cproducto = '".$producto."', 
              ctipo = '".$tipo."',
              cetapa = '".$etapa."',
              cpatente = '".$patente."'
                    WHERE id  = '".$idProyecto."' 
					";

        $stmt = $DBcon->prepare($query);
        $stmt->execute();

        // check for successfull registration
        if ( $stmt->execute() ) {
            $response['status'] = 'success';
            $response['message'] = 'Registro exitoso =)';
            $response['debug'] = '-S-'.$query;
        } else {
            $response['status'] = 'error'; // could not register
            $response['message'] = 'No se pudo registrar...';
            $response['debug'] = '-E-'.$query;
        }

        return $response;
    }


    /***
     * Actualiza el INE de datos fiscales
     */
    function upd_identificacionfiscales($DBcon, $idProyecto, $photoPath)
    {
        $query = "UPDATE tfiscales SET cscanid = '".$photoPath."' 
                    WHERE idproyecto  = '".$idProyecto."' 
					";

        $stmt = $DBcon->prepare($query);
        $stmt->execute();

        // check for successfull registration
        if ( $stmt->execute() ) {
            $response['status'] = 'success';
            $response['message'] = 'Logo establecido =)';
            $response['debug'] = '-S-'.$query;
        } else {
            $response['status'] = 'error'; // could not register
            $response['message'] = 'No se pudo establecer el logo';
            $response['debug'] = '-E-'.$query;
        }

        return $response;
    }


    /***
     * Actualiza el logo del proyecto
     */
    function upd_bancoproyecto($DBcon, $idProyecto, $photoPath)
    {
        $query = "UPDATE tp_bancario SET cp_recibo = '".$photoPath."' 
                    WHERE id  = '".$idProyecto."' 
					";

        $stmt = $DBcon->prepare($query);
        $stmt->execute();

        // check for successfull registration
        if ( $stmt->execute() ) {
            $response['status'] = 'success';
            $response['message'] = 'Recibo establecido =)';
            $response['debug'] = '-S-'.$query;
        } else {
            $response['status'] = 'error'; // could not register
            $response['message'] = 'No se pudo establecer el recibo';
            $response['debug'] = '-E-'.$query;
        }

        return $response;
    }


    /***
     * Actualiza el INE de datos fiscales
     */
    function upd_bancarios($DBcon, $idProyecto, $banco, $email, $clabe, $titular, $rfc)
    {
        $query = "UPDATE tp_bancario SET 
                cp_nombre = '".$banco."',
                cp_email = '".$email."',
                cp_clabe = '".$clabe."',
                cp_titular = '".$titular."',
                cp_rfc = '".$rfc."'
                    WHERE idproyecto  = '".$idProyecto."' 
					";

        $stmt = $DBcon->prepare($query);
        $stmt->execute();

        // check for successfull registration
        if ( $stmt->execute() ) {
            $response['status'] = 'success';
            $response['message'] = 'Logo establecido =)';
            $response['debug'] = '-S-'.$query;
        } else {
            $response['status'] = 'error'; // could not register
            $response['message'] = 'No se pudo establecer el logo';
            $response['debug'] = '-E-'.$query;
        }

        return $response;
    }

    /***
     * Verifica si existe un usuario
     */
    function get_rowsadded($DBcon, $table, $fields, $where)
    {
        $empty_count = 0;
        $columa = "";

        $query= "SELECT ".$fields." FROM ".$table." ".$where;

        $stmt = $DBcon->prepare($query);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            return 100;  //100 % con un solo registro

        } else {
           return 0;
        }

    }


    /***
     * selecciona campos NO vacios de una tabla
     */
    function get_rowsnotempty($DBcon, $table, $fields, $where)
    {
        $empty_count = 0;
        $columa = "";

        $query= "SELECT ".$fields." FROM ".$table." ".$where;

        $stmt =$DBcon->query($query);

        //error_log($query,0);

        $obj = $stmt->fetchObject();

        for ($i=0; $i<$stmt->columnCount(); $i++) {

            $columa = $stmt->getColumnMeta($i)['name'];
            if($obj->$columa == '' || $obj->$columa === 'NULL')
                $empty_count++;

            //echo $obj->$columa." - ";
            //echo $columa."<br />";
        }


        /*
        $result = mysql_query('SELECT * FROM `MyTable`');
        while($row = mysql_fetch_row($result)){
            $empty_count = 0;
            $count = count($row);
            for($i = 0; $i < $count; $i++)
                if($row[$i] === '' || $row[$i] === 'NULL')
                    $empty_count++;
            echo 'User '.$row[0].' = '.((int)(100*(1-$empty_count/($count-1)))).'% complete';
        }
        */

        return $empty_count;
    }


    /***
     * Calcula el porcentaje de avance de acuerdo a la cantidad de preguntas
     */
    function set_porcentajeAvance($nopreguntas, $contestadas)
    {
        $resultado = ($contestadas/$nopreguntas)*100;
        return round($resultado,2);
    }

    /****
     * @param $porcentaje
     * @return string
     */
    function set_displayAvanceDiv($porcentaje)
    {
        //danger
        //info
        //warning
        $color="success";
        if($porcentaje <= 25)
        {
            $color="danger";
        }

        if($porcentaje >25 && $porcentaje <= 50)
        {
            $color="warning";
        }

        if($porcentaje >50 && $porcentaje <= 99)
        {
            $color="info";
        }

        if($porcentaje == 100)
        {
            $color="success";
        }


        $disp = '<p> <strong>Avance:</strong> <span class="pull-right text-muted">'.$porcentaje.'% Complete</span> </p>
                            <div class="progress progress-striped active">
                                <div class="progress-bar progress-bar-'.$color.'" role="progressbar" aria-valuenow="'.$porcentaje.'" aria-valuemin="0" aria-valuemax="100" style="width: '.$porcentaje.'%"> <span class="sr-only">40% Complete (success)</span> </div>
                            </div>';

        return $disp;
    }

    public function get_listprojects($DBcon,$page,$noRowsDisplay,$where)
    {
        require_once(C_P_CLASES.'utils/paginator.php');
        $now = date("Y-m-d H:i:s");

        $query = "SELECT P.id, P.cname AS Nombre, P.cstatus AS paso FROM 
                    tproyectos AS P 
                     INNER JOIN tfiscales AS F
                     ON P.id = F.idproyecto ";
        $query.=$where;

        //error_log($query,0);
        $stmt = $DBcon->prepare($query);
        $stmt->execute();
        $total = $stmt->rowCount();

        $num_rows = $total;

        $a = new Paginator($page,$num_rows);


        $a->set_Limit($noRowsDisplay);
        $a->set_Links();
        $limit1 = $a->getRange1();
        $limit2 = $a->getRange2();
        $query .= " LIMIT $limit1 , $limit2 ";

        $stmt2 = $DBcon->prepare($query);

        // guardo el resultado
        $this->set_queryResult($stmt2);

        //Paginador
        if($a->getTotalPages()>1)
        {
            $paginatorLinks = $a->paintLinks('paginateMe',$a->getFirst(),$a->getLast(),$a->getLinkArr(),$a->getCurrent());
            //guardo el string del paginador
            $this->set_paginatorLinks($paginatorLinks);
        }

        return $query;
    }

    function disp_projectsPage()
    {
        $stmt = $this->get_queryResult();
        $stmt->execute();
        $total = $stmt->rowCount();

        $disp = '';
        $headerTable = '';  //nombres de columnas
        $footerTable = '';  // nombres de columnas
        $dataTable = '';    // info de la tabla
        $acciones = '';     // para borrar editar
        $displinks = '';    // pra mostrar las ligas de paginacion
        $cont = 0;          // contador general

        $encabezados = '<tr><th>Proyecto</th><th>En Creación</th><th>En Validación</th><th>Aprobado</th><th>En Subasta</th><th>Finalizado</th><th>Accion</th></tr>';
        $headerTable .= '<thead>'.$encabezados.'</thead>';
        $footerTable .= '<tfoot>'.$encabezados.'</tfoot>';


        while ($row = $stmt->fetchObject()) {

            $id = $row->id;
            $estatus = $this->label_status($row->paso);
            $proyecto = $row->Nombre;

            $valores = $this->set_pasoStatus($row->paso);
            $paso1 = $valores[1];
            $paso2 = $valores[2];
            $paso3 = $valores[3];
            $paso4 = $valores[4];
            $paso5 = $valores[5];
            $paso6 = $valores[6];

            $editar = '<a href="project_edit.php?id='.$id.'" data-toggle="tooltip" data-original-title="Edit"> <i class="fa fa-pencil text-inverse m-r-10"></i> </a>';
            $detalle = '<a href="project_ficha.php?id='.$id.'" data-toggle="tooltip" data-original-title="Detalle"> <i class="fa fa-plus-square text-inverse m-r-10"></i> </a>';

            if($row->paso == 1)
            {
                $detalle .= $editar;
            }
            $acciones = '<td>'.$detalle.'</td>';

            $dataTable.='<tr><td>'.$proyecto.'</td><td>'.$paso1.'</td><td>'.$paso2.'</td><td>'.$paso4.'</td><td>'.$paso5.'</td><td>'.$paso6.'</td>'.$acciones.'</tr>';

            $cont++;
        }

        $displinks.=$this->get_paginatorLinks();

        $disp .= '<table id="tpendingdisp" class="table display">'.$headerTable.$footerTable.'<tbody>'.$dataTable.'</tbody></table>'.$displinks;

        //error_log($disp,0);
        return $disp;

    }

    private function set_pasoStatus($status)
    {
        $listo = '<div class="progress progress-lg"><div class="progress-bar progress-bar-success" style="width: 100%;" role="progressbar">100%</div></div>';
        $onit = '<div class="progress progress-lg"><div class="progress-bar progress-bar-warning" style="width: 50%;" role="progressbar">En Proceso</div></div>';
        $pendiente = '<div class="progress progress-lg"><div class="progress-bar progress-bar-danger" style="width: 100%;" role="progressbar">Pendiente</div></div>';
        $comentarios = '<div class="progress progress-lg"><div class="progress-bar progress-bar-info" style="width: 50%;" role="progressbar">Regresado</div></div>';

        $paso1 =''; $paso2= ''; $paso3=''; $paso4=''; $paso5=''; $paso6='';
        //1 activo, 2=en validacion, 3=comentarios, 4=aprobado, 5=subasta, 6=finalizado
        switch ($status) {
            case 1:
                $paso1=$onit;
                $paso2=$pendiente;
                $paso3=$pendiente;
                $paso4=$pendiente;
                $paso5=$pendiente;
                $paso6=$pendiente;
                break;

            case 2:
                $paso1=$listo;
                $paso2=$onit;
                $paso3=$pendiente;
                $paso4=$pendiente;
                $paso5=$pendiente;
                $paso6=$pendiente;
                break;

            case 3:
                $paso1=$comentarios;
                $paso2=$pendiente;
                $paso3=$pendiente;
                $paso4=$pendiente;
                $paso5=$pendiente;
                $paso6=$pendiente;
                break;

            case 4:
                $paso1=$listo;
                $paso2=$listo;
                $paso3=$listo;
                $paso4=$listo;
                $paso5=$pendiente;
                $paso6=$pendiente;
                break;

            case 5:
                $paso1=$listo;
                $paso2=$listo;
                $paso3=$listo;
                $paso4=$listo;
                $paso5=$onit;
                $paso6=$pendiente;
                break;

            case 6:
                $paso1=$listo;
                $paso2=$listo;
                $paso3=$listo;
                $paso4=$listo;
                $paso5=$listo;
                $paso6=$listo;
                break;

            case 0:
                $paso1=$pendiente;
                $paso2=$pendiente;
                $paso3=$pendiente;
                $paso4=$pendiente;
                $paso5=$pendiente;
                $paso6=$pendiente;
                break;

            default:
                return 'Sin estatus';
        }

        $arrValores = array();
        $arrValores[1] = $paso1;
        $arrValores[2] = $paso2;
        $arrValores[3] = $paso3;
        $arrValores[4] = $paso4;
        $arrValores[5] = $paso5;
        $arrValores[6] = $paso6;

        return $arrValores;
    }

    public function label_status($status)
    {
        require_once(C_P_CLASES.'utils/string.functions.php');
        $mySTR = new STRFN();

        switch ($status) {
            case 0:
                return $mySTR->set_spanlabel('Inactivo','danger');
                break;
            case 1:
                return $mySTR->set_spanlabel('En Proceso','warning');
                break;
            case 2:
                return $mySTR->set_spanlabel('Validandose','primary');
                break;
            case 3:
                return $mySTR->set_spanlabel('Rechazado','danger');
                break;
            case 4:
                return $mySTR->set_spanlabel('Aprobado','info');
                break;
            case 5:
                return $mySTR->set_spanlabel('Subasta','info');
                break;
            case 6:
                return $mySTR->set_spanlabel('Finalizada','info');
                break;
            default:
                return 'Sin estatus';
        }
    }

    /****
     * @param $porcentaje
     * @return string
     */
    function set_displayAvanceTotalDiv($puntosTotales, $puntosCubiertos )
    {
        $porcentaje = ($puntosCubiertos/$puntosTotales)*100;
        $porcentaje = round($porcentaje,-1, PHP_ROUND_HALF_UP);
//        $porcentaje = ceil($porcentaje);
        $disp = '<div data-label="'.$porcentaje.'%" class="css-bar css-bar-'.$porcentaje.' css-bar-sm css-bar-default"></div>';
        return $disp;
    }

    private function set_lastId($lastId)
    {
        $this->lastId = $lastId;
    }

    function get_lastId()
    {
        return $this->lastId;
    }


    private function set_tmpguid($guid)
    {
        $this->tmpguid = $guid;
    }

    function get_tmpguid()
    {
        return $this->tmpguid;
    }

    private function set_stmt($recordset)
    {
        $this->stmt = $recordset;
    }

    public function get_stmt()
    {
        return $this->stmt;
    }

    function set_paginatorLinks($string)
    {
        $this->paginatorLinks = $string;
    }

    function get_paginatorLinks()
    {
        return $this->paginatorLinks;
    }

    function set_queryResult($query)
    {
        $this->queryResult = $query;
    }

    function get_queryResult()
    {
        return $this->queryResult;
    }


}