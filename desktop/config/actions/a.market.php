<?php
header("Content-Type: text/html;charset=utf-8");

class A_MARKET
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

    public function search_market($DBcon, $page, $noRowsDisplay)
    {
        require_once(C_P_CLASES.'utils/paginator.php');
        $now = date("Y-m-d H:i:s");

        //$query = 'SELECT * FROM tproyectos';
        $query = 'SELECT B.*, C.cinicio, C.cfin, C.cmonto FROM tproyectos AS B 
                  INNER JOIN tp_subasta AS C ON B.id = C.idproyecto 
                  WHERE (C.cinicio <= \''.$now.'\' AND C.cfin >= \''.$now.'\') AND B.cstatus = 5';

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
        //$stmt2->execute();
        //$total2 =  $stmt2->rowCount();
       // error_log($query,0);

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

    function disp_marketPage()
    {
        $stmt = $this->get_queryResult();
        $stmt->execute();
        $total = $stmt->rowCount();

        $disp1 = ''; //despliega el preview
        $displinks = '';

        $contLinea = 0;  //por cada 4 se reinicia para linea nueva
        $cont = 0; // contador general

        $starLinea = '<div class="row">';
        $endLinea = '</div>';



        //$disp1.=$starLinea;  //nuevo row
        while ($row = $stmt->fetchObject()) {

            if($contLinea == 0){
                $disp1.=$starLinea;  //nuevo row
            }

            $disp1 .= '<div class="col-md-3 col-xs-12 col-sm-6" style="background-color:#fff; border-right:5px solid darkgreen"> <img class="img-responsive" alt="user" src="../'.$row->clogo.'">
                    <div class="white-box">
                        <div class="text-muted"><span class="m-r-10">'.$row->cfin.'</span> <a class="text-muted m-l-10" href="#"><i class="fa fa-heart-o"></i></a></div>
                        <h3 class="m-t-20 m-b-20">'.$row->cname.'</h3>
                        <h4 class="m-t-20 m-b-20">Monto: $'.$row->cmonto.'</h4>
                        <p>'.substr($row->cproducto, 0, 30).'...</p>
                        <a href="project_ficha.php?id='.$row->id.'" class="btn btn-success btn-rounded waves-effect waves-light m-t-20" name="btn-detail">Ver más</a>
                      </div>
                    </div>';


            $contLinea++;
            $cont++;

            if($contLinea == 4 || $cont == $total-1) //reinicio contador de row
            {
                $contLinea = 0;
                $disp1.=$endLinea;  //termino row
            }
        }

        $displinks.=$this->get_paginatorLinks();

        $disp1 = $disp1.$displinks;

        return $disp1;

    }


    public function get_competencia($DBcon, $idproyecto)
    {
        //$query = 'SELECT * FROM tproyectos';
        $query = "SELECT * FROM tp_competencia  
                  WHERE idproyecto = '".$idproyecto."'";

        $stmt = $DBcon->prepare($query);
        $stmt->execute();
        $total = $stmt->rowCount();

        $stmt2 = $DBcon->prepare($query);

        // guardo el resultado
        $this->set_queryResult($stmt2);
    }

    function disp_competencia()
    {
        $stmt = $this->get_queryResult();
        $stmt->execute();
        $total = $stmt->rowCount();

        $disp1 = ''; //despliega el preview

        //$disp1.=$starLinea;  //nuevo row
        while ($row = $stmt->fetchObject()) {

            $disp1.='<div class="comment-body">
                        <div class="user-img"> <i class="fa fa-eye"></i></div>
                            <div class="mail-contnet">
                                 <h5>Competidor: '.$row->cp_competidor.' </h5>
                                 <span class="mail-desc">Propuesta: '.$row->cp_propuestav.' </span> 
                                 <span class="label label-rouded label-info">'.$row->cp_diferenciador.'</span>
                            </div>
                    </div>';

        }

        return $disp1;

    }


    public function get_mercado($DBcon, $idproyecto)
    {
        //$query = 'SELECT * FROM tproyectos';
        $query = "SELECT * FROM tp_mercado  
                  WHERE idproyecto = '".$idproyecto."'";

        $stmt = $DBcon->prepare($query);
        $stmt->execute();
        $total = $stmt->rowCount();

        $stmt2 = $DBcon->prepare($query);

        // guardo el resultado
        $this->set_queryResult($stmt2);
    }

    function disp_mercdo()
    {
        $stmt = $this->get_queryResult();
        $stmt->execute();
        $total = $stmt->rowCount();

        $disp1 = '<div class="table-responsive">
              <table class="table">
                <thead>
                  <tr>
                    <th>Cliente</th>
                    <th>Segmento</th>
                    <th>Mercado</th>
                    <th>Ventas</th>
                    <th>Precio</th>
                  </tr>
                </thead>
                <tbody>'; //despliega el preview

        //$disp1.=$starLinea;  //nuevo row
        while ($row = $stmt->fetchObject()) {

            $disp1.='
                  <tr>
                    <td>'.$row->cp_cliente.' </td>
                    <td class="txt-oflo">'.$row->cp_segmento.' </td>
                    <td><span class="label label-success label-rouded">'.$row->cp_mercado.' </span> </td>
                    <td class="txt-oflo">'.$row->cp_ventastot.' </td>
                    <td><span class="text-success">'.$row->cp_precio.' </span></td>
                  </tr>
                  <tr>
                    <td colspan="5"> <i class="fa fa-chevron-circle-right"></i> '.$row->cp_marketing.' </td>
                  </tr>';

        }

        $disp1 .= '</tbody>
              </table>';

        return $disp1;
    }

    public function get_ingresos($DBcon, $idproyecto)
    {
        //$query = 'SELECT * FROM tproyectos';
        $query = "SELECT * FROM tp_fuente  
                  WHERE idproyecto = '".$idproyecto."'";

        $stmt = $DBcon->prepare($query);
        $stmt->execute();
        $total = $stmt->rowCount();

        $stmt2 = $DBcon->prepare($query);

        // guardo el resultado
        $this->set_queryResult($stmt2);
    }

    function disp_ingresos()
    {
        $stmt = $this->get_queryResult();
        $stmt->execute();
        $total = $stmt->rowCount();

        $disp1 = ''; //despliega el preview

        //$disp1.=$starLinea;  //nuevo row
        while ($row = $stmt->fetchObject()) {

            $disp1.='<div class="col-in row">
                                <div class="col-md-6 col-sm-6 col-xs-6"> <i class="ti-money"></i>
                                    <h5 class="text-muted vb">'.$row->cp_descripcion.'</h5>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-6">
                                    <h3 class="counter text-right m-t-15 text-success">'.$row->cvalor.'</h3>
                                </div>
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="progress">
                                        <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%"> <span class="sr-only">40% Complete (success)</span> </div>
                                    </div>
                                </div>
                            </div>';

        }

        return $disp1;

    }


    public function get_costos($DBcon, $idproyecto)
    {
        //$query = 'SELECT * FROM tproyectos';
        $query = "SELECT * FROM tp_costos  
                  WHERE idproyecto = '".$idproyecto."'";

        $stmt = $DBcon->prepare($query);
        $stmt->execute();
        $total = $stmt->rowCount();

        $stmt2 = $DBcon->prepare($query);

        // guardo el resultado
        $this->set_queryResult($stmt2);
    }

    function disp_costos()
    {
        $stmt = $this->get_queryResult();
        $stmt->execute();
        $total = $stmt->rowCount();

        $disp1 = ''; //despliega el preview

        //$disp1.=$starLinea;  //nuevo row
        while ($row = $stmt->fetchObject()) {

            $disp1.='<div class="col-in row">
                                <div class="col-md-6 col-sm-6 col-xs-6"> <i class="ti-receipt"></i>
                                    <h5 class="text-muted vb">'.$row->cp_descripcion.'</h5>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-6">
                                    <h3 class="counter text-right m-t-15 text-warning">'.$row->cvalor.'</h3>
                                </div>
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="progress">
                                        <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%"> <span class="sr-only">40% Complete (success)</span> </div>
                                    </div>
                                </div>
                            </div>';

        }

        return $disp1;

    }


    public function get_historia($DBcon, $idproyecto)
    {
        //$query = 'SELECT * FROM tproyectos';
        $query = "SELECT * FROM tp_historia  
                  WHERE idproyecto = '".$idproyecto."'";

        $stmt = $DBcon->prepare($query);
        $stmt->execute();
        $total = $stmt->rowCount();

        $stmt2 = $DBcon->prepare($query);

        // guardo el resultado
        $this->set_queryResult($stmt2);
    }

    function disp_historia()
    {
        $stmt = $this->get_queryResult();
        $stmt->execute();
        $total = $stmt->rowCount();

        $disp1 = ''; //despliega el preview

        //$disp1.=$starLinea;  //nuevo row
        while ($row = $stmt->fetchObject()) {

            $disp1.='<a href="#">
                         <div class="user-img"> <i class="fa fa-user"></i>
                          <span class="profile-status online pull-right"></span> 
                          </div>
                             <div class="mail-contnet">
                                 <span class="mail-desc">'.$row->cp_desc.'</span> 
                                 <span class="time">'.$row->cp_regdate.'</span> 
                             </div>
                     </a> ';

        }

        return $disp1;
    }

    public function get_equipo($DBcon, $idproyecto)
    {
        //$query = 'SELECT * FROM tproyectos';
        $query = "SELECT * FROM tp_equipo  
                  WHERE idproyecto = '".$idproyecto."'";

        $stmt = $DBcon->prepare($query);
        $stmt->execute();
        $total = $stmt->rowCount();

        $stmt2 = $DBcon->prepare($query);

        // guardo el resultado
        $this->set_queryResult($stmt2);
    }

    function disp_equipo()
    {
        $stmt = $this->get_queryResult();
        $stmt->execute();
        $total = $stmt->rowCount();

        $disp1 = ''; //despliega el preview

        //$disp1.=$starLinea;  //nuevo row
        while ($row = $stmt->fetchObject()) {

            $disp1.='<a href="#">
                         <div class="user-img"> <img src="../plugins/images/users/pawandeep.jpg" alt="user" class="img-circle">
                          <span class="profile-status online pull-right"></span> 
                          </div>
                             <div class="mail-contnet">
                             <h5>'.$row->cp_nombre.'</h5>
                                 <span class="mail-desc">'.$row->cp_puesto.'</span> 
                             </div>
                     </a> ';

        }

        return $disp1;

    }


    public function get_riesgos($DBcon, $idproyecto)
    {
        //$query = 'SELECT * FROM tproyectos';
        $query = "SELECT * FROM tp_riesgos  
                  WHERE idproyecto = '".$idproyecto."'";

        $stmt = $DBcon->prepare($query);
        $stmt->execute();
        $total = $stmt->rowCount();

        $stmt2 = $DBcon->prepare($query);

        // guardo el resultado
        $this->set_queryResult($stmt2);
    }

    function disp_riesgos()
    {
        $stmt = $this->get_queryResult();
        $stmt->execute();
        $total = $stmt->rowCount();

        $disp1 = ''; //despliega el preview

        //$disp1.=$starLinea;  //nuevo row
        while ($row = $stmt->fetchObject()) {

            $disp1.='<div class="comment-body">
                        <div class="user-img"> <i class="fa fa-eye"></i></div>
                            <div class="mail-contnet">
                                 <span class="mail-desc">Propuesta: '.$row->cp_explicacion.' </span> 
                                 <span class="label label-rouded label-info">'.$row->cp_indicador.'</span>
                            </div>
                    </div>';

        }

        return $disp1;

    }


    public function get_plan($DBcon, $idproyecto)
    {
        //$query = 'SELECT * FROM tproyectos';
        $query = "SELECT * FROM tp_plan  
                  WHERE idproyecto = '".$idproyecto."'";

        $stmt = $DBcon->prepare($query);
        $stmt->execute();
        $total = $stmt->rowCount();

        $stmt2 = $DBcon->prepare($query);

        // guardo el resultado
        $this->set_queryResult($stmt2);
    }

    function disp_plan()
    {
        $stmt = $this->get_queryResult();
        $stmt->execute();
        $total = $stmt->rowCount();

        $disp1 = ''; //despliega el preview

        //$disp1.=$starLinea;  //nuevo row
        while ($row = $stmt->fetchObject()) {

            $disp1.='<div class="comment-body">
                        <div class="user-img"> <i class="fa fa-eye"></i></div>
                            <div class="mail-contnet">
                                 <span class="mail-desc">Propuesta: '.$row->cp_detalle.' </span> 
                                 <span class="label label-rouded label-info">'.$row->cp_porcentaje.'</span>
                            </div>
                    </div>';

        }

        return $disp1;

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