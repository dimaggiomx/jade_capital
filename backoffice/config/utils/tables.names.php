<?
header("Content-Type: text/html;charset=utf-8");
/* Class name: TABLAS
* Description: realiza funciones de las empresas del sistema
* Busqueda, Insercion, Actualizacion, Activar/desactivar usuario
*/
class A_TABLENAMES
{
    var $tusuarios=array(); # contains field names

    /* Constructor: User passes in the name of the script where
    * form data is to be sent ($processor) and the value to show
    * on the submit button.
    */
    function __construct($arrData=array())
    {
        // tusuarios
        $this->tusuarios = $arrData;
    }

    /**
     * Almacena los datos de la tabla tusuarios
     */
    function set_tusuarios()
    {
        $this->tusuarios['d0'] = 'id';
        $this->tusuarios['d1'] = 'cuser';
        $this->tusuarios['d2'] = 'cname';
        $this->tusuarios['d3'] = 'cemail';
        $this->tusuarios['d4'] = 'cbdate';
        $this->tusuarios['d5'] = 'cnation';
        $this->tusuarios['d6'] = 'ccurp';
        $this->tusuarios['d7'] = 'cpassport';
        $this->tusuarios['d8'] = 'cwww';
        $this->tusuarios['d9'] = 'cfb';
        $this->tusuarios['d10'] = 'ctw';
        $this->tusuarios['d11'] = 'cins';
        $this->tusuarios['d12'] = 'clinkedin';
        $this->tusuarios['d13'] = 'cphoto1';
        $this->tusuarios['d14'] = 'cphoto2';
        $this->tusuarios['d15'] = 'cpass';
        $this->tusuarios['d16'] = 'cuuid';
        $this->tusuarios['d17'] = 'cstatus';
        $this->tusuarios['d18'] = 'cregdate';
        $this->tusuarios['d19'] = 'ctipo';
        $this->tusuarios['d20'] = 'ctel';
        $this->tusuarios['d21'] = 'cdescripcion';
    }

    function get_tusuarios()
    {
        return $this->tusuarios;
    }

}
?>