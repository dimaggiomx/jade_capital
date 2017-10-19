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
    var $domain = "";
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

        $this->domain = C_DOMAIN;
    }


    /**
     * Almacena los datos generales del usuario
     */
    function add_data($id,$user,$nombre,$email,$bdate,$nation,$curp,$passport,$www,$fb,$tw,$ins,$linkedin,$photo1,
                      $photo2,$pass,$uuid,$status,$regdate,$tipo,$tel,$desc)
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
        $this->datos['d19'] = $tipo;
        $this->datos['d20'] = $tel;
        $this->datos['d21'] = $desc;
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
					,".$this->campos['d16'].",".$this->campos['d18'].",".$this->campos['d19'].") 
					VALUES
					(
					'" . $this->datos['d1'] ."','". $this->datos['d2'] . "'
                    ,'" . $this->datos['d15'] ."','" . $guid ."','". $now . "','". $this->datos['d19'] . "'
					)";

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

    /***
     * Verifica si existe un usuario
     */
    function user_exist($DBcon, $mail, $subquery="")
    {
        $query = "SELECT ".$this->campos['d1']." FROM ".$this->tableName." 
                  WHERE ".$this->campos['d1']."= '".$mail."'";
        $query.=$subquery;

        $stmt = $DBcon->prepare($query);
        $stmt->execute();

        if ($stmt->rowCount() == 1) {
            $response['status'] = 'error'; // could not register
            $response['message'] = 'Usuario existente';
            $response['debug'] = '-E-'.$query;

        } else {
            $response['status'] = 'success'; // could not register
            $response['message'] = 'Usuario inexistente o ingreso equivocado';
            $response['debug'] = '-S-'.$query;
        }

        return $response;
    }


    /***
     * Envio de correo de liga de acceso al usuario recien registrado para actualizar su registro
     */
    function send_regMail($from, $to, $guid)
    {
        $subject = 'Bienvenido a Jade Capital Flow';

        $link = $this->domain.'confirm.php?';
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
            $response['debug'] = '-S-'.$link;
        }
        else
        {
            $response['status'] = 'error'; // could not register
            $response['message'] = 'No se pudo enviar mail de confirmacion';
            $response['debug'] = '-E-'.$link;
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
            $response['debug'] = '-S-'.$query;
        } else {
            $response['status'] = 'error'; // could not register
            $response['message'] = 'No se pudo aplicar el perfil';
            $response['debug'] = '-E-'.$query;
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
            $query = 'INSERT INTO tpermisos_usr (idpermiso, idusuario, cpermiso) VALUES
            (1, '.$idusuario.', 1),
            (2, '.$idusuario.', 1),
            (3, '.$idusuario.', 1),
            (4, '.$idusuario.', 1),
            (5, '.$idusuario.', 1),
            (6, '.$idusuario.', 1),
            (7, '.$idusuario.', 0),
            (8, '.$idusuario.', 0),
            (9, '.$idusuario.', 0),
            (10, '.$idusuario.', 0),
            (11, '.$idusuario.', 0),
            (12, '.$idusuario.', 0),
            (13, '.$idusuario.', 1),
            (14, '.$idusuario.', 1),
            (25, '.$idusuario.', 0),
            (26, '.$idusuario.', 0);';
        }

        if($tipo == 'E')
        {
            $query = 'INSERT INTO tpermisos_usr (idpermiso, idusuario, cpermiso) VALUES
            (1, '.$idusuario.', 1),
            (2, '.$idusuario.', 1),
            (3, '.$idusuario.', 1),
            (4, '.$idusuario.', 1),
            (5, '.$idusuario.', 1),
            (6, '.$idusuario.', 0),
            (7, '.$idusuario.', 1),
            (8, '.$idusuario.', 1),
            (9, '.$idusuario.', 1),
            (10, '.$idusuario.', 0),
            (11, '.$idusuario.', 0),
            (12, '.$idusuario.', 0),
            (13, '.$idusuario.', 0),
            (14, '.$idusuario.', 0),
            (25, '.$idusuario.', 1),
            (26, '.$idusuario.', 0);';
        }

        return $query;
    }

    /***
     * Obtains a user general data
     */
    function get_userdata($DBcon, $mail, $subquery="")
    {
        $query= "SELECT * FROM ".$this->tableName." WHERE ".$this->campos['d1']." = '".$mail."'";
        $query.=$subquery;
        $stmt = $DBcon->prepare($query);
        $stmt->execute();
        $obj = $stmt->fetchObject();
        // regresa un solo registro
        return $obj;
    }

    /***
     * Obtains a user permisos
     */
    function get_userpermisos($DBcon, $idUsuario)
    {
        $query= "SELECT * FROM tpermisos_usr WHERE idusuario = '".$idUsuario."'";
        $stmt = $DBcon->prepare($query);
        $stmt->execute();
        // regresa de 1 a n registros
        return $stmt;
    }

    /***
     * para confirmar usuario
     */
    function confirm_user($DBcon, $mail, $guid)
    {

        $query = "SELECT ".$this->campos['d1']." FROM ".$this->tableName." 
        WHERE ".$this->campos['d1']."= '".$mail."' 
        and ".$this->campos['d17']."='1' and ".$this->campos['d16']."='".$guid."'";

        $stmt = $DBcon->prepare($query);
        $stmt->execute();

        if ($stmt->rowCount() == 1) {
            // actualizar estatus de usuario a confirmado (estatus = 1)
            $response = $this->upd_userconfirm($DBcon,$mail,$guid);

        } else {
            $response['status'] = 'error'; // could not register
            $response['message'] = 'No se pudo confirmar, Usuario no existe, favor de registrarse';
            $response['debug'] = '-E-'.$query;
        }

        return $response;

    }


    /***
     * Actualiza el estatus de usuario a confirmado
     */
    private function upd_userconfirm($DBcon, $mail, $guid)
    {
        $query = "UPDATE ".$this->tableName." SET ".$this->campos['d17']." = '2' 
                    WHERE ".$this->campos['d1']."  = '".$mail."' 
                    AND ".$this->campos['d16']." = '".$guid."'
					";

        $stmt = $DBcon->prepare($query);
        $stmt->execute();

        // check for successfull registration
        if ( $stmt->execute() ) {
            $response['status'] = 'success';
            $response['message'] = 'Registro exitoso, Gracias! favor de iniciar sesion:';
            $response['debug'] = '-S-'.$query;
        } else {
            $response['status'] = 'error'; // could not register
            $response['message'] = 'No se pudo registrar, favor de registrarse: <br/>http://www.jadecapitalflow.com/';
            $response['debug'] = '-E-'.$query;
        }

        return $response;
    }

    /***
     * Actualiza datos de usuario (perfil)
     * cumple,curp,pasaporte,www,fb,tw,ins,about,pais
     */
    function upd_userperfil($DBcon, $id)
    {
        $query = "UPDATE ".$this->tableName." SET 
                    ".$this->campos['d4']." = '".$this->datos['d4'] ."',
                    ".$this->campos['d5']." = '".$this->datos['d5'] ."',
                    ".$this->campos['d6']." = '".$this->datos['d6'] ."',
                    ".$this->campos['d7']." = '".$this->datos['d7'] ."',
                    ".$this->campos['d8']." = '".$this->datos['d8'] ."',
                    ".$this->campos['d9']." = '".$this->datos['d9'] ."',
                    ".$this->campos['d10']." = '".$this->datos['d10'] ."',
                    ".$this->campos['d11']." = '".$this->datos['d11'] ."',
                    ".$this->campos['d21']." = '".$this->datos['d21'] ."'                      
                    WHERE ".$this->campos['d0']."  = '".$id."' 
                   ";

        $stmt = $DBcon->prepare($query);
        $stmt->execute();

        // check for successfull registration
        if ( $stmt->execute() ) {
            $response['status'] = 'success';
            $response['message'] = 'Perfil Actualizado exitosamente';
            $response['debug'] = '-S-'.$query;
        } else {
            $response['status'] = 'error'; // could not register
            $response['message'] = 'No se pudo actualizar el perfil';
            $response['debug'] = '-E-'.$query;
        }

        return $response;
    }


    /***
     * Actualiza datos de cuenta (perfil)
     * nombre, correo alternativo, tel
     */
    function upd_usercuenta($DBcon, $id)
    {
        $query = "UPDATE ".$this->tableName." SET 
                    ".$this->campos['d2']." = '".$this->datos['d2'] ."',
                    ".$this->campos['d3']." = '".$this->datos['d3'] ."',
                    ".$this->campos['d20']." = '".$this->datos['d20'] ."'                   
                    WHERE ".$this->campos['d0']."  = '".$id."' 
                   ";

        $stmt = $DBcon->prepare($query);
        $stmt->execute();

        // check for successfull registration
        if ( $stmt->execute() ) {
            $response['status'] = 'success';
            $response['message'] = 'Cuenta Actualizada exitosamente';
            $response['debug'] = '-S-'.$query;
        } else {
            $response['status'] = 'error'; // could not register
            $response['message'] = 'No se pudo actualizar la cuenta';
            $response['debug'] = '-E-'.$query;
        }

        return $response;
    }


    /***
     * Actualiza datos de password (perfil)
     * password
     */
    function upd_userpass($DBcon, $id)
    {
        $query = "UPDATE ".$this->tableName." SET 
                    ".$this->campos['d15']." = '".$this->datos['d15'] ."'                 
                    WHERE ".$this->campos['d0']."  = '".$id."' 
                   ";

        $stmt = $DBcon->prepare($query);
        $stmt->execute();

        // check for successfull registration
        if ( $stmt->execute() ) {
            $response['status'] = 'success';
            $response['message'] = 'Pasword Actualizado exitosamente';
            $response['debug'] = '-S-'.$query;
        } else {
            $response['status'] = 'error'; // could not register
            $response['message'] = 'No se pudo actualizar el password';
            $response['debug'] = '-E-'.$query;
        }

        return $response;
    }

    /***
     * Actualiza la foto 1 del usuario
     */
    function upd_userphoto1($DBcon, $id, $photoPath)
    {
        $query = "UPDATE ".$this->tableName." SET ".$this->campos['d13']." = '".$photoPath."' 
                    WHERE ".$this->campos['d0']."  = '".$id."' 
					";

        $stmt = $DBcon->prepare($query);
        $stmt->execute();

        // check for successfull registration
        if ( $stmt->execute() ) {
            $response['status'] = 'success';
            $response['message'] = 'Foto Actualizada =)';
            $response['debug'] = '-S-'.$query;
        } else {
            $response['status'] = 'error'; // could not register
            $response['message'] = 'No se pudo actualizar la foto';
            $response['debug'] = '-E-'.$query;
        }

        return $response;
    }


    /***
     * Actualiza la foto 2 del usuario
     */
    function upd_userphoto2($DBcon, $id, $photoPath)
    {
        $query = "UPDATE ".$this->tableName." SET ".$this->campos['d14']." = '".$photoPath."' 
                    WHERE ".$this->campos['d0']."  = '".$id."' 
					";

        $stmt = $DBcon->prepare($query);
        $stmt->execute();

        // check for successfull registration
        if ( $stmt->execute() ) {
            $response['status'] = 'success';
            $response['message'] = 'Foto Actualizada =)';
            $response['debug'] = '-S-'.$query;
        } else {
            $response['status'] = 'error'; // could not register
            $response['message'] = 'No se pudo actualizar la foto';
            $response['debug'] = '-E-'.$query;
        }

        return $response;
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