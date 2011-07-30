<?php 
// ------------------------------------------------------------------------

/**
  * Display array key => value
  *
  * @access		public
  * @param		array	$arr
  */
  
function print_array($arr)
{
	echo '<pre>';
	print_r($arr);
	echo '</pre>';
}

// ------------------------------------------------------------------------

/**
  * Convert multiple stirng seperate value with comma (not CSV format) to array
  *
  * @access		public
  * @param		stirng	$text
  * @return		array	
  */
  
function comma_to_array($text)
{
	return explode(',', $text);
}

// ------------------------------------------------------------------------

/**
  * Convert array to stirng seperate value with comma (not CSV format)
  *
  * @access		public
  * @param		array	$arr
  * @return		stirng	
  */
  
function array_to_comma($arr)
{
	return implode(',', $arr);
}

// ------------------------------------------------------------------------

/**
  * Put 0 to $data 
  *
  * @access		public
  * @param		integer	$lenght
  * @param		stirng	$data
  * @return		stirng	
  */
  
function zero_fill($lenght, $data)
{
	while(strlen($data) < $lenght)
	{
		$data = '0' . $data;
	}
	
	return $data;
}

// ------------------------------------------------------------------------

/**
  * Genarate numeric selectbox
  *
  * @access		public
  *
  * @param		int		$start
  * @param		int		$end
  * @param		int		$selected
  * @param		array	$attribute
  *
  * @return		mixed	$_selectbox
  */
  
function get_numeric_selectbox($start, $end, $selected, $attribute)
{		
	// Generate attribute
	$_attr = '';
	
	foreach($attribute as $key => $value)
	{
		$_attr .= ' ' . $key . ' = "' . $value . '"';
	}
	
	// Generate selectbox
	$_selectbox = '<select' . $_attr . '>';

	for($_loop = $start; $_loop <= $end; $_loop++)
	{
		// Check selected
		$_selected = ($selected == $_loop) ? 'selected = "selected"' : '';
		
		// Generate option value
		$_selectbox .= '<option value="' . $_loop . '" ' . $_selected . '>' . $_loop . '</option>';
	}
	
	$_selectbox .= '</select>';
	
	return $_selectbox;
}

// ------------------------------------------------------------------------
	
function change_date_time_format($date_time)
{	
	list($_date, $_time) = explode(" ", $date_time);
	$_new_date = change_date_format($_date);
	$_new_date_time = $_new_date . ' ' . substr($_time, 0, 5);
	
	return $_new_date_time;
}  

// ------------------------------------------------------------------------
	
function change_date_format($date, $separator = " / ", $format = "dd-mm-yyyy")
{	
	if($format == "dd-mm-yyyy")
	{
		$newDate = explode("-", $date);
		$newDate = array_reverse($newDate);
		$newDate = implode($separator, $newDate);
	}
	return $newDate;
}


// ------------------------------------------------------------------------

function remove_comma($number) 
{
	list($int, $dot) = explode (".", $number);
	
	if($dot == "") 
	{
		while(strlen ($dot) < 2) 
		{
			$dot = "0" . "$dot";
		}
	}
	
	$int = explode (",", $int);
	$int = implode ($int);
	$new_number = $int.$dot;
	
	return $new_number;
}

// ------------------------------------------------------------------------

function add_comma($number) 
{
	list($int, $dot) = explode (".", $number);
	
	$int = explode(",", $int);
	$int = implode($int);

	if(strlen($dot) > 0) 
	{		
		$dot = '.'.$dot;
	}
	
	if($int < 0) 
	{
		$sige = "-";
		$int = str_replace("-", "", $int);
	} 
	else 
	{
		$sige = "";
	}	
	
	
	if(strlen($int) > 9) 
	{
		$new_number = substr_replace($int, ",", -3, 0 );
		$new_number = substr_replace($new_number, ",", -7, 0 );
		$new_number = substr_replace($new_number, ",", -12, 0 ) . "$dot";
	} 
	else if(strlen($int) > 6) 
	{
		$new_number = substr_replace($int, ",", -3, 0 );
		$new_number = substr_replace($new_number, ",", -7, 0 ) . "$dot";
	} 
	else if(strlen($int) > 3) 
	{
		$new_number = substr_replace($int, ",", -3, 0 ) . "$dot";
	} 
	else 
	{
		$new_number = $sige.$int.$dot;
	}
	
	return $new_number;
}

// ------------------------------------------------------------------------


/* End of file utilities_helper.php */
/* Location: ./iic_tools/helpers/iic_utilities_helper.php */