<?php
header("Content-Type: text/html;charset=utf-8");

class A_USR
{
    var $datos=array(); # contains field data
    var $campos=""; # contains field names
    var $arrDataNames = array();
    var $paginatorLinks = "";
    var $tableName = "";
    var $DBcon = "";
    var $lastId = "";
    var $tmpguid="";
    /* Constructor: User passes in the name of the script where
        * form data is to be sent ($processor) and the value to show
        * on the submit button.
        */

    function __construct($arrData=array())
    {
        //inicializo
        $this->datos = $arrData;

        $this->tableName = "tusuarios";
        require_once(C_P_CLASES.'utils/tables.names.php');

        //inicializo nombres de campos de tabla
        $instabla = new A_TABLENAMES("");
        $instabla->set_tusuarios();

        $this->campos = $instabla->get_tusuarios();
    }


    /**
     * Almacena los datos generales del usuario
     */
    function add_data($id,$user,$nombre,$email,$bdate,$nation,$curp,$passport,$www,$fb,$tw,$ins,$linkedin,$photo1,$photo2,$pass,$uuid,$status,$regdate)
    {
        $this->datos['d0'] = $id;
        $this->datos['d1'] = $user;
        $this->datos['d2'] = $nombre;
        $this->datos['d3'] = $email;
        $this->datos['d4'] = $bdate;
        $this->datos['d5'] = $nation;
        $this->datos['d6'] = $curp;
        $this->datos['d7'] = $passport;
        $this->datos['d8'] = $www;
        $this->datos['d9'] = $fb;
        $this->datos['d10'] = $tw;
        $this->datos['d11'] = $ins;
        $this->datos['d12'] = $linkedin;
        $this->datos['d13'] = $photo1;
        $this->datos['d14'] = $photo2;
        $this->datos['d15'] = $pass;
        $this->datos['d16'] = $uuid;
        $this->datos['d17'] = $status;
        $this->datos['d18'] = $regdate;
    }

    function get_data()
    {
        return $this->datos;
    }


    /***
     * Registro de usuarios
     */
    function ins_user($DBcon)
    {
        $now = date("Y-m-d H:i:s");

        //create guid for user confirm
        require_once(C_P_CLASES.'utils/string.functions.php');
        $STR = new STRFN();

        // genero UUID para mandarlo por el correo para poder confirmar
        $guid = $STR->gen_uuid();
        $this->set_tmpguid($guid);

        $query = "INSERT INTO ".$this->tableName." 
                    (".$this->campos['d1'].",".$this->campos['d2'].",".$this->campos['d15']."
					,".$this->campos['d16'].",".$this->campos['d18'].") 
					VALUES
					(
					'" . $this->datos['d1'] ."','". $this->datos['d2'] . "'
                    ,'" . $this->datos['d15'] ."','" . $guid ."','". $now . "'
					)";

        $stmt = $DBcon->prepare($query);

        // check for successfull registration
        if ( $stmt->execute() ) {

            $this->set_lastId($DBcon->lastInsertId());

            //establecer permisos
            //$respuesta = $this->ins_permisos($DBcon,$userId,$this->data['data3']);

            // envia correo de registro
            //$this->send_regMail('info@jadecapitalflow.com',$this->data['data1'],$guid);

            $response['status'] = 'success';
            $response['message'] = 'Registro exitoso, Gracias!';
            $response['debug'] = '-S-';

        } else {
            $response['status'] = 'error'; // could not register
            $response['message'] = 'No se pudo registrar, intente nuevamente más tarde';
            $response['debug'] = '-E-'.$query;
        }

        return $response;
    }

    /***
     * Verifica si existe un usuario
     */
    function user_exist($DBcon, $mail)
    {
        $query = "SELECT ".$this->campos['d3']." FROM ".$this->tableName." 
                  WHERE ".$this->campos['d3']."= '".$mail."'";

        $stmt = $DBcon->prepare($query);
        $stmt->execute();

        if ($stmt->rowCount() == 1) {
            $response['status'] = 'error'; // could not register
            $response['message'] = 'Usuario existente';
            $response['debug'] = '-S-';

        } else {
            $response['status'] = 'success'; // could not register
            $response['message'] = 'Usuario inexistente';
            $response['debug'] = '-E-';
        }

        return $response;
    }


    /***
     * Envio de correo de liga de acceso al usuario recien registrado para actualizar su registro
     */
    function send_regMail($from, $to, $guid)
    {
        $subject = 'Bienvenido a Jade Capital Flow';

        $link = $this->domain.'tusuarios/confirm.php?';
        $link .= 'user='.$to.'&id='.$guid;


        $message = 'Por favor de click en la siguiente liga para complementar su registro: ';
        $message .= $link;


        $mail = mail($from, $subject, $message,
            "From: Jade-Capital-Flow <".$from.">\r\n"
            ."To: User<".$to.">\r\n"
            ."cc: Creator<dimaggiomx@gmail.com>\r\n"
            ."Reply-To: ".$from."\r\n"
            ."X-Mailer: PHP/" . phpversion());

        if($mail)
        {
            $response['status'] = 'success';
            $response['message'] = 'Mail de confirmacion enviado';
            $response['debug'] = '-S-';
        }
        else
        {
            $response['status'] = 'error'; // could not register
            $response['message'] = 'No se pudo enviar mail de confirmacion';
            $response['debug'] = '-S-';
        }

        return $response;
    }


    // inserta los permisos por perfil
    function ins_permisos($DBcon, $idusuario, $tipousuario)
    {

        $query = $this->set_profile($tipousuario,$idusuario);

        $stmt = $DBcon->prepare($query);

        // check for successfull registration
        if ( $stmt->execute() ) {
            $response['status'] = 'success';
            $response['message'] = 'Perfil Aplicado';
            $response['debug'] = '-S-';
        } else {
            $response['status'] = 'error'; // could not register
            $response['message'] = 'No se pudo aplicar el perfil';
            $response['debug'] = '-S-';
        }

        return $response;
    }

    // establece el perfil
    function set_profile($tipo, $idusuario)
    {
        //tipo: I=inversionista ,E=empresa
        $query = '';
        if($tipo == 'I')
        {
            /*
            $query = 'INSERT INTO permisos_usr (idpermiso, idusuario, cpermis) VALUES
            (1, '.$idusuario.', 1),
            (2, '.$idusuario.', 1),
            (3, '.$idusuario.', 1),
            (4, '.$idusuario.', 1),
            (5, '.$idusuario.', 1),
            (6, '.$idusuario.', 1),
            (7, '.$idusuario.', 0),
            (8, '.$idusuario.', 0),
            (9, '.$idusuario.', 1),
            (10, '.$idusuario.', 0),
            (11, '.$idusuario.', 0),
            (12, '.$idusuario.', 0),
            (13, '.$idusuario.', 1),
            (14, '.$idusuario.', 1),
            (15, '.$idusuario.', 0),
            (16, '.$idusuario.', 1),
            (17, '.$idusuario.', 0),
            (18, '.$idusuario.', 0),
            (19, '.$idusuario.', 0),
            (20, '.$idusuario.', 0),
            (21, '.$idusuario.', 0),
            (22, '.$idusuario.', 0),
            (23, '.$idusuario.', 0),
            (24, '.$idusuario.', 1),
            (25, '.$idusuario.', 0),
            (26, '.$idusuario.', 0),
            (27, '.$idusuario.', 0);';
            */
        }

        if($tipo == 'E')
        {
            /*
            $query = 'INSERT INTO permisos_usr (idpermiso, idusuario, cpermis) VALUES
            (1, '.$idusuario.', 1),
            (2, '.$idusuario.', 1),
            (3, '.$idusuario.', 1),
            (4, '.$idusuario.', 1),
            (5, '.$idusuario.', 1),
            (6, '.$idusuario.', 0),
            (7, '.$idusuario.', 1),
            (8, '.$idusuario.', 1),
            (9, '.$idusuario.', 1),
            (10, '.$idusuario.', 1),
            (11, '.$idusuario.', 0),
            (12, '.$idusuario.', 1),
            (13, '.$idusuario.', 0),
            (14, '.$idusuario.', 0),
            (15, '.$idusuario.', 1),
            (16, '.$idusuario.', 1),
            (17, '.$idusuario.', 1),
            (18, '.$idusuario.', 1),
            (19, '.$idusuario.', 0),
            (20, '.$idusuario.', 0),
            (21, '.$idusuario.', 0),
            (22, '.$idusuario.', 0),
            (23, '.$idusuario.', 0),
            (24, '.$idusuario.', 0),
            (25, '.$idusuario.', 1),
            (26, '.$idusuario.', 0),
            (27, '.$idusuario.', 0);';
            */
        }

        return $query;
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


}