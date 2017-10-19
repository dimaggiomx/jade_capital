<?
/* Class name: HTML
* Description: A class that creates HTML inputs
* containing only text input fields. The
* class has 3 methods.
*/
class HTML
{
	var $data=array(); # contains field names and labels
	var $inputName=""; # name of program to process form
	var $Nfields = 0; # number of fields added to the form
	var $tmpDebugg = '';
    var $CONN = '';
	/* Constructor: User passes in the name of the script where
	* form data is to be sent ($processor) and the value to show
	* on the submit button.
	*/
	function __construct($inputName="", $DBcon)
	{
		$this->inputName = $inputName;
        $this->CONN = $DBcon;
	}
	/* Fills an array from a query
	*/
	function fill_query($table, $filter, $orderBy, $fieldDisplay, $fieldValue)
	{
        $query= "SELECT * FROM ".$table." ";

        if ($filter != "")
            $query .= $filter." ";

        $query .= $orderBy;

        $stmt = $this->CONN->prepare($query);
        $stmt->execute();
        // regresa de 1 a n registros

        while ($row = $stmt->fetchObject()) {

            $this->addField($row->$fieldDisplay,$row->$fieldValue);
        }
	}


	function get_columns($tablename)
    {
        //The name of the table that we want the structure of.
        $tableToDescribe = $tablename;

        //Query MySQL with the PDO objecy.
        //The SQL statement is: DESCRIBE [INSERT TABLE NAME]
        $statement = $this->CONN->query('DESCRIBE ' . $tableToDescribe);

        //Fetch our result.
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);

        //The result should be an array of arrays,
        //with each array containing information about the columns
        //that the table has.
        //var_dump($result);

        //For the sake of this tutorial, I will loop through the result
        //and print out the column names and their types.
        //foreach($result as $column){
        //    echo $column['Field'] . ' - ' . $column['Type'], '<br>';
        //}
        return $result;
    }

	/* Fills the array with another array
	*/
	function fill_array($array)
	{
			for($z=0; $z <sizeof($array); $z++)
			{
				$this->addField($array[$z]['nombre'],$array[$z]['valor']);
			}
	}
	
	
	/* Fills the array with time settings (hora o minutos)
	*/
	function fill_hour($horaInicial=0, $horaFinal=24)
	{
		for($z=$horaInicial; $z < $horaFinal; $z++)
		{
			$valor = $z;
			if($z < 10)
				$valor = "0".$valor;
			
			$this->addField($valor,$valor);
		}
	}
	
	
		
	/* Fills the array with year settings 
	*/
	function fill_year($yearsBackwards)
	{
		$now = date("Y");
		for($z=0; $z < $yearsBackwards; $z++)
		{
			$this->addField($now,$now);
			$now = $now - 1;
		}
	}
	
	
	
	/* Fills the array with months of the year
	*/
	function fill_month()
	{
		$this->addField("Enero","01");
		$this->addField("Febrero","02");
		$this->addField("Marzo","03");
		$this->addField("Abril","04");
		$this->addField("Mayo","05");
		$this->addField("Junio","06");
		$this->addField("Julio","07");
		$this->addField("Agosto","08");
		$this->addField("Septiembre","09");
		$this->addField("Octubre","10");
		$this->addField("Noviembre","11");
		$this->addField("Diciembre","12");
	}
	
	
	/* Fills the array with time settings (hora o minutos)
	*/
	function fill_minute($minutoInicial=0, $minutoFinal=60)
	{
		for($z=$minutoInicial; $z < $minutoFinal; $z++)
		{
			$valor = $z;
			if($z < 10)
				$valor = "0".$valor;
			
			$this->addField($valor,$valor);
		}
	}
	
	
	
	/***
         * Genera un select Box con los datos ya almacenados en el array
         * @param varchar $selectedValue // Por si es en edicion ya tiene que traer un dato previamente seleccionado
         * @param int ¢returnType // 1 = pinta con echo, else regresa string
         */
	function set_selectBox($selectedValue, $returnType = 1, $class)
	{
		$display = '<select name="'.$this->inputName.'" id="'.$this->inputName.'" class="'.$class.'">';
		if($selectedValue == "")
		{
			$display .=  '<option selected="selected" value="">Seleccionar...</option>';
			for($i=0; $i<$this->Nfields; $i++)
		  	{	  		
	  			$display .= '<option value="'.$this->data[$i]['value'].'">'.$this->data[$i]['name'].'</option>';
		  	}
		}
		else 
		{
			$display .=  '<option value="">Seleccionar...</option>';
		  	for($i=0; $i<$this->Nfields; $i++)
		  	{
		  		
		  		if($selectedValue == $this->data[$i]['value'])
		  			$display .= '<option value="'.$this->data[$i]['value'].'" selected="selected">'.$this->data[$i]['name'].'</option>';
		  		else 
		  			$display .= '<option value="'.$this->data[$i]['value'].'">'.$this->data[$i]['name'].'</option>';
		  	} 
		}
		$display .='</select>';
		if($returnType == 1)
			echo $display;
		else
			return $display;
	}
	



	/* makes a select box with onChange Javascript function */
	function set_selectBoxJs($selectedValue, $functionName, $returnType = 1, $class)
	{
		$display = '<select name="'.$this->inputName.'" id="'.$this->inputName.'" onchange="'.$functionName.'" class="'.$class.'">';
		if($selectedValue == "")
		{
			$display .=  '<option selected="selected">Seleccionar...</option>';
			for($i=0; $i<$this->Nfields; $i++)
		  	{	  		
	  			$display .= '<option value="'.$this->data[$i]['value'].'">'.$this->data[$i]['name'].'</option>';
		  	}
		}
		else 
		{
			$display .=  '<option>Seleccionar...</option>';
		  	for($i=0; $i<$this->Nfields; $i++)
		  	{
		  		
		  		if($selectedValue == $this->data[$i]['value'])
		  			$display .= '<option value="'.$this->data[$i]['value'].'" selected="selected">'.$this->data[$i]['name'].'</option>';
		  		else 
		  			$display .= '<option value="'.$this->data[$i]['value'].'">'.$this->data[$i]['name'].'</option>';
		  	}
			
		  
		}
		  
		$display .='</select>';
		
		if($returnType == 1)
			echo $display;
		else
			return $display;
		
	}

	
	/* Function that adds a field to the form. The user needs to
	* send the name of the field and a label to be displayed.
	*/
	function addField($name,$value)
	{
		//echo $this->Nfields;
		$this->data[$this->Nfields]['name'] = $name;
		$this->data[$this->Nfields]['value'] = $value;
		$this->Nfields = $this->Nfields + 1;
	}
	
	
	/* simpleCheckBox */
	function set_checkBox($selectedValue, $value)
	{
		$display = "";
	
		if($selectedValue == "")
			$display .= '<input name="'.$this->inputName.'" type="checkbox" id="'.$this->inputName.'" value="'.$value.'" />';
		else 
			$display .= '<input name="'.$this->inputName.'" type="checkbox" id="'.$this->inputName.'" value="'.$value.'" checked="checked" />';
	}

	
	function set_leftZero($dato)
	{
		$tamano = strlen($dato);
		if($tamano < 5)
		{
			for($i=$tamano; $i<5; $i++)
			{
				$dato = "0" . $dato;
			}
		}
		
		return $dato;
	}
	
	function set_newInputName($inputName)
	{
		$this->inputName = $inputName;
		$this->Nfields = 0;
		unset($this->data);
	}
}
?>