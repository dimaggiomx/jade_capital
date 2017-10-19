<?php
header("Content-Type: text/html;charset=utf-8");

class A_VAL
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
    var $stmt = "";
    var $queryResult="";
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

    public function get_pendingproject($DBcon,$page,$noRowsDisplay)
    {
        require_once(C_P_CLASES.'utils/paginator.php');
        $now = date("Y-m-d H:i:s");

        $query = "SELECT P.id, P.cname AS Nombre, P.csector1 AS Industria, F.cnombre AS Empresa, P.cstatus AS estado FROM 
                    tproyectos AS P 
                     INNER JOIN tfiscales AS F
                     ON P.id = F.idproyecto WHERE
                     P.cstatus = 2";



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

    function disp_pendingPage()
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

        $encabezados = '<tr><th>Proyecto</th><th>Industria</th><th>Empresa</th><th>Estatus</th><th>Accion</th></tr>';
        $headerTable .= '<thead>'.$encabezados.'</thead>';
        $footerTable .= '<tfoot>'.$encabezados.'</tfoot>';


        while ($row = $stmt->fetchObject()) {

            $id = $row->id;
            $nameEmpresa = $row->Empresa;
            $estatus = $this->label_status($row->estado);
            $proyecto = $row->Nombre;
            $industria = $row->Industria;

            $acciones .= '<td>
                         <a href="project_edit.php?id='.$id.'" data-toggle="tooltip" data-original-title="Edit"> <i class="fa fa-pencil text-inverse m-r-10"></i> </a> 
                         <a href="project_ficha.php?id='.$id.'" data-toggle="tooltip" data-original-title="Detalle"> <i class="fa fa-plus-square text-inverse m-r-10"></i> </a>
                         </td>';

            $dataTable.='<tr><td>'.$proyecto.'</td><td>'.$industria.'</td><td>'.$nameEmpresa.'</td><td>'.$estatus.'</td>'.$acciones.'</tr>';

            $cont++;
        }

        $displinks.=$this->get_paginatorLinks();

        $disp .= '<table id="tpendingdisp" class="table display">'.$headerTable.$footerTable.'<tbody>'.$dataTable.'</tbody></table>'.$displinks;

        //error_log($disp,0);
        return $disp;

    }


    public function get_aprovedproject($DBcon,$page,$noRowsDisplay)
    {
        require_once(C_P_CLASES.'utils/paginator.php');
        $now = date("Y-m-d H:i:s");

        $query = "SELECT P.id, P.cname AS Nombre, P.csector1 AS Industria, F.cnombre AS Empresa, P.cstatus AS estado FROM 
                    tproyectos AS P 
                     INNER JOIN tfiscales AS F
                     ON P.id = F.idproyecto WHERE
                     P.cstatus = 4";



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

    function disp_aprovedPage()
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

        $encabezados = '<tr><th>Proyecto</th><th>Industria</th><th>Empresa</th><th>Estatus</th><th>Accion</th></tr>';
        $headerTable .= '<thead>'.$encabezados.'</thead>';
        $footerTable .= '<tfoot>'.$encabezados.'</tfoot>';


        while ($row = $stmt->fetchObject()) {

            $id = $row->id;
            $nameEmpresa = $row->Empresa;
            $estatus = $this->label_status($row->estado);
            $proyecto = $row->Nombre;
            $industria = $row->Industria;

            $acciones = '<td>
                         <a href="project_ficha.php?id='.$id.'" data-toggle="tooltip" data-original-title="Edit"> <i class="fa fa-pencil text-inverse m-r-10"></i> </a> 
                         <a href="#" data-toggle="modal" data-target="#responsive-modal" data-original-title="Close"  onclick="setIdProyecto(\''.$id.'\')"> <i class="fa fa-check-square text-danger"></i> </a>
                         </td>';

            $dataTable.='<tr><td>'.$proyecto.'</td><td>'.$industria.'</td><td>'.$nameEmpresa.'</td><td>'.$estatus.'</td>'.$acciones.'</tr>';

            $cont++;
        }

        $displinks.=$this->get_paginatorLinks();

        $disp .= '<table id="tpendingdisp" class="table display">'.$headerTable.$footerTable.'<tbody>'.$dataTable.'</tbody></table>'.$displinks;

        //error_log($disp,0);
        return $disp;

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


    /**
     * @param $DBcon
     * @param $idProyecto
     * @return mixed
     */
    public function ins_datosSubasta($DBcon, $idProyecto, $inicio, $fin, $monto)
    {

        $query = "INSERT INTO  tp_subasta
                    (idproyecto,cinicio, cfin, cmonto ) 
					VALUES
					('".$idProyecto."','".$inicio."','".$fin."','".$monto."')";

        $stmt = $DBcon->prepare($query);

        //error_log($query,0);
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
?>