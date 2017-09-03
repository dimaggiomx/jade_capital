<?php
header("Content-Type: text/html;charset=utf-8");
CLASS STRFN
{
    function __construct()
    {

    }

    public function STRFN()
    {

    }


    /***
     * Agrega un elemento al row del titulo a pintar
     * @param varchar $dato   // default = ""
     * @param varchar $align  // default = left;
     * @param varchar $class  // class or id to dsiplay
     * @param varchar $colspan// default = ""
     * @return varchar $result // with TD format
     */
    public function add_titleRowCel($dato,$align="center",$class="",$colspan="",$otherClass="")
    {
        $openTD = '<TD align="'.$align.'" ';
        $endTd = '</TD>';
        if($colspan!="")
        {
            $openTD.=' colspan="'.$colspan.'" ';
        }
        if($class!="")
        {
            $openTD.=' '.$class.' ';
        }
        $openTD.='>';

        if($otherClass == "")
            //$openTD.='<div id="tituloTablaLeft">&nbsp;</div><label>'.$dato.'</label><div id="tituloTablaRight">&nbsp;</div>'.$endTd; 
			//<a class="a_demo_four" href="#">Click me!</a>
			$openTD.='<a class="a_demo_one" href="#">'.$dato.'</a>'.$endTd;
        else
            $openTD.='<span class="'.$otherClass.'">'.$dato.'</span>'.$endTd;
        return $openTD;
    }

     /***
     * Agrega el TR del title de cada row
     * @param varchar $tds //tds que contiene el row del titulo
     * @return varchar $result
     */
    public function add_titleRowTr($tds)
    {
        $result = '<tr>'.$tds.'</tr>';
        return $result;
    }


    /***
     * Agrega un elemento al row a pintar
     * @param varchar $dato   // default = ""
     * @param varchar $type   // _STR_ = string, _MON_ = Money, _SDAT_ = short date, _CDAT_ = datetime
     * @param varchar $align  // default = left;
     * @param varchar $class  // class or id to dsiplay
     * @param varchar $link   // default = ""
     * @param varchar $colspan// default = ""
     * @return varchar $result // with TD format
     */
    public function add_rowCel($dato,$type="_STR_",$align="left",$class="",$link="",$colspan="")
    {
        $openTD = '<TD align="'.$align.'" ';
        $endTd = '</TD>';
        if($colspan!="")
        {
            $openTD.=' colspan="'.$colspan.'" ';
        }
        if($class!="")
        {
            $openTD.=' '.$class.' ';
        }
        $openTD.='>';
        if($link!="")
        {
            $openTD.=$link.$this->format_data($dato, $type).'</a> ';
        }
        else
        {
            $openTD.=$this->format_data($dato, $type);
        }

        $openTD.=$endTd;
        return $openTD;
    }


    /***
     * Agrega el TR de cada row
     * @param varchar $rowcolor
     * @param varchar $mover //bg color on mouse over
     * @param varchar $moverTxt //txt color on mouse over
     * @param varchar $mout //bg color on mouse out
     * @param varchar $moutTxt //txt color on mouse out
     * @return varchar $result
     */
    public function add_rowTrOpen($rowcolor,$mover,$moverTxt,$mout,$moutTxt)
    {
        $result = '<tr bgcolor="'.$rowcolor.'"
            onMouseover="this.style.backgroundColor=\''.$mover.'\'; this.style.color=\''.$moverTxt.'\';"
            onMouseout="this.style.backgroundColor=\''.$mout.'\'; this.style.color=\''.$moutTxt.'\'; ">';
        return $result;
    }

     /***
     * Agrega el TABLE 
     * @param varchar
     * @param varchar $class //The class Name
     * @param varchar $width //width size 
     * @param varchar $border //1 = yes, 0 = no
     * @param int $cellPad 
     * @param int $celSpc 
     * @return varchar $result  // the complete table
     */
    public function add_table($tableInfo,$class = "",$width="98%",$border=0,$cellPad = 0, $celSpc = 0)
    {
        $result = '
                    <form name="listForm" id="listForm" action="<?php echo $PHP_SELF?>" target="_self" method="post">
                    <table width="'.$width.'" border="'.$border.'" cellpadding="'.$cellPad.'" cellspacing="'.$celSpc.'" class="'.$class.'">';
        $result .= $tableInfo.'</table></form>';
        return $result;
    }


    /***
     * Agrega el cierre del TR de cada row
     */
    public function add_rowTrClose()
    {
        return '</tr>';
    }



    /***
     * Regresa un formato especifico del dato enviado
     * @param varchar $dato
     * @param varchar $type
     * @return varchar $result // data formateado
     */
    public function format_data($dato,$type)
    {
        if($dato=="")
        {
           return '-';
        }
        else {
            if($type=='_STR_' || $type == '_MON_' || $type  == '_SDAT_' || $type == '_CDAT_')
            {
               if($type == '_STR_')
                {
                    // es de tipo string
                    return $dato;
                }

                if($type == '_MON_')
                {
                    // es de tipo moneda
                    return money_format('%=*(#10.2n', $dato);
                }
                if($type  == '_SDAT_')
                {
                    // only date
                    return date("Y-m-d",$dato);
                }
                if($type == '_CDAT_')
                {
                    // datetime
                    return date("Y-m-d H:m:s",$dato);
                }
            }
            else
            {
                // if no right format, then default = string
                return $dato;
            }
        }
        
    }
    

    /**
	 * Realiza la validacion de que un dato venga bien codificado para mostrarse
	 * @param varchar $dato
	 * @return varchar $dato //modificado
     */
    public function fixString($dato,$ins=0)
    {
		if($ins==0)
		{
			if($dato != "")
			{
				$frase_original  = strip_tags(stripslashes(utf8_decode($dato)));
				//$frase_original  = utf8_encode($dato);
				//$dato=utf8_encode($dato);
				return $frase_original;
			}
			else{
				return $dato;
			}
		}
		else
		{
			return $dato;	
		}
    }


    /***
     * valida campo vacio en busquedas para concatenar al query de busqueda
     * @param varchar $dato
     * @param varchar $fieldName
     * @param varchar $comando
     * @return varchar $resultado
     */
    public function val_searchParam($dato,$fieldName,$comando)
    {
        $sub_query = "";
        if ($dato != ""){
            $sub_query .= " AND (".$fieldName." ".$comando." ";
            if($comando == 'LIKE')
            {
                $sub_query .= "'%".$dato."%')";
            }
            else
            {
                $sub_query .= "'".$dato."')";
            }   
       }

       return $sub_query;
    }
	
	public function val_seleccionarWord($data)
	{
		if($data == 'Seleccionar...')
			$data = '';
		return $data;
		}
	
	
    /***
     * valida campo vacio en fechas para concatenar al query de busqueda
     * @param varchar $fieldName1
	 * @param varchar $fecha1
     * @param varchar $fecha2
     * @return varchar $resultado
     */
    public function val_searchFechas($fieldName1,$fecha1,$fecha2)
    {
        $sub_query = "";
        if ($fecha1 != "")
		{
           if($fecha2 != "")
		   {
			   $sub_query .= " AND (".$fieldName1." BETWEEN '".$fecha1."' AND '".$fecha2."') ";
		   }
		   else
		   {
		        $sub_query .= " AND (".$fieldName." LIKE '%".$fecha1."%') ";
		   }
   
       }

       return $sub_query;
    }


    /***
     * Genera la liga de detalle para un listado
     * @param varchar $link   // liga que abrira
     * @param varchar $displayValue // valor a desplegar
     * @param varchar $target // target
     * @return varchar $result // string con liga formada
     */
    public  function make_detailLink($link,$displayValue,$target="")
    {
        if($target=="")
            return '<a href="'.$link.'">'.$displayValue.'</a>';
        else
            return '<a href="'.$link.'" target="'.$target.'">'.$displayValue.'</a>';
    }



     /***
     * Genera la liga de detalle para un listado
     * @param varchar $link   // liga que abrira formada desde al <a href y lo que se necesite, la funcion cierra el </a>
     * @param varchar $displayValue // valor a desplegar
     * @return varchar $result // string con liga formada
     */
    public  function make_personilizedLink($link,$displayValue)
    {
       return $link.$displayValue.'</a>';
    }


    /***
     * Serializa un valor para mandarlo a traves del _GET
     * @param varchar $valor   // valor a serializar
     * @return varchar $result // valor serializado
     */
    public  function make_encryptGet($valor)
    {
        return urlencode(base64_encode(serialize($valor)));
    }


    /***
     * Serializa un valor para mandarlo a traves del _GET
     * @param varchar $valor   // valor a serializar
     * @return varchar $result // valor serializado
     */
    public  function make_decryptGet($valor)
    {
       return unserialize(base64_decode($valor));
    }

    
    /***
     * Pinta un div para mostrar los msg de Error, Warning, Ok
     * @param varchar $msg // datmensajeos a mostrar
     * @param varchar $tipo: 1=ok, 2=err, 3=warning // Tipo del mensaje
     * @return varchar $div // datos formateados
     */
    public function setMsgStyle($msg, $tipo=1)
    {
        $glypicon = "";
        if($tipo == 1)
        {
            $glypicon = "glyphicon-ok";
        }

        if($tipo == 2)
        {
            $glypicon = "glyphicon-remove";
        }

        if($tipo == 3)
        {
            $glypicon = "glyphicon-info-sign";
        }

        $div = '<span class="glyphicon '.$glypicon.'"></span>'.$msg.'</div>';
        return $div;
    }



    /***
     * Genera el html para mostrar un tooltip de algun texto o imagen indicado
     * @param varchar $dato // datos a desplegar que on Mouse over mostrara tooltip
     * @param varchar $tooltipInfo // info a desplegar dentro del tooltip
     */
    public function make_tooltip($dato, $tooltipInfo)
    {
        return "<span class=\"hotspot\" onmouseover=\"tooltip.show('".$tooltipInfo."');\" onmouseout=\"tooltip.hide();\">".$dato."</span>";
    }


     /**
     * StartsWith
     * Tests if a text starts with an given string.
     *
     * @param     string
     * @param     string
     * @return    bool
     */
    function StartsWith($Haystack, $Needle){
        // Recommended version, using strpos
        return strpos($Haystack, $Needle) === 0;
    }
    
	
	/***
	**/
	function set_encodingForms($dato){
			$user_agent = $_SERVER['HTTP_USER_AGENT']; 
			
			
			if (preg_match('/Firefox/i', $user_agent)) { 
				$dato=utf8_encode($dato);
			}else
			
			if (preg_match('/Chrome/i', $user_agent)) { 
				$dato=$dato;
			}else
			
			if (preg_match('/Safari/i', $user_agent)) { 
				$dato=$dato;
			}else
			{
				$dato=utf8_encode($dato);
			}
			
			
			
			return $dato;
	}
	
	
	function gen_uuid() {
    return sprintf( '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
        // 32 bits for "time_low"
        mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ),

        // 16 bits for "time_mid"
        mt_rand( 0, 0xffff ),

        // 16 bits for "time_hi_and_version",
        // four most significant bits holds version number 4
        mt_rand( 0, 0x0fff ) | 0x4000,

        // 16 bits, 8 bits for "clk_seq_hi_res",
        // 8 bits for "clk_seq_low",
        // two most significant bits holds zero and one for variant DCE1.1
        mt_rand( 0, 0x3fff ) | 0x8000,

        // 48 bits for "node"
        mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff )
    );
	}
	
    /***
     * Genera la liga de detalle para un listado
     * @param varchar $link   // liga que abrira formada desde al <a href y lo que se necesite, la funcion cierra el </a>
     * @param varchar $displayValue // valor a desplegar
     * @return varchar $result // string con liga formada
     */
    public  function checkDatetime($fecha, $tipoSeparador='/')
    {	   
	   $sp1 = explode(" ",$fecha);
	   $date = $sp1[0];
	   $hora = $sp1[1];
	   
	   $sp2 = explode($tipoSeparador,$date);

        if($tipoSeparador != '/') {
            $anio = $sp2[0];
            $mes = $sp2[1];
            $dia = $sp2[2];
        }
        else{
            $anio = $sp2[2];
            $mes = $sp2[0];
            $dia = $sp2[1];
        }

	   if(strlen($mes)<2){
		   $mes = "0".$mes;
		}
		
		if(strlen($dia)<2){
		   $dia = "0".$dia;
		}
		
		$hora = "00:00:00";
		
		$newDateTime = $anio."-".$mes."-".$dia."T".$hora;
	   
	   return $newDateTime;
    }


    /***
     * 2017 Genera la fecha en formato generico YYYY-MM-DD
     * @param varchar $fecha   //fecha en formato MM/DD/YYYY
     * @param varchar $tipoSeparador // char que separa
     */
    public  function checkDate($fecha, $tipoSeparador='/')
    {
        $sp2 = explode($tipoSeparador,$fecha);

        $anio = trim($sp2[2]);
        $mes = trim($sp2[0]);
        $dia = trim($sp2[1]);

        if(strlen($mes)<2){
            $mes = "0".$mes;
        }

        if(strlen($dia)<2){
            $dia = "0".$dia;
        }

        $hora = "00:00:00";

        $newDateTime = $anio."-".$mes."-".$dia."T".$hora;

        return $newDateTime;
    }
	
}	
?>