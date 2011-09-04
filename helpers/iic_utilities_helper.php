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
		$_attr .= ' ' . $key . '="' . $value . '"';
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

/**
  * Change date format
  *
  * @access		public
  *
  * @param		string	$date
  * @param		string	$old_separator
  * @param		string	$old_format		Separate date with (-), y = Year, m = mouth, d = date Example: y-m-d or d-m-y or m-d-y
  * @param		string	$new_separator
  * @param		string	$new_format		Separate date with (-), y = Year, m = mouth, d = date Example: y-m-d or d-m-y or m-d-y
  *
  * @return		string	
  */
	
function change_date_format($date, $old_separator = "-", $old_format = 'y-m-d', $new_separator = " / ", $new_format = "d-m-y")
{	
	// Get old format
	list($_old_format_path1, $_old_format_path2, $_old_format_path3) = explode('-', $old_format);
	
	// Indendify date path
	list($_date_path[$_old_format_path1], $_date_path[$_old_format_path2], $_date_path[$_old_format_path3]) = explode($old_separator, $date);
	
	// Get new format
	list($_new_format_path1, $_new_format_path2, $_new_format_path3) = explode('-', $new_format);
	
	// Set new format
	$_new_date = $_date_path[$_new_format_path1].$new_separator.$_date_path[$_new_format_path2].$new_separator.$_date_path[$_new_format_path3];
	
	return $_new_date;
}


// ------------------------------------------------------------------------

function remove_comma($number, $decimal = 0) 
{
	list($_int, $_dot) = explode ('.', $number);
	
	if(($_dot == '' && $decimal > 0) || ($_dot != '')) 
	{
		while(strlen ($_dot) < 2) 
		{
			$_dot = '0'.$_dot;
		}
		$_dot = '.'.$_dot;
	}
	
	$_int = explode (',', $_int);
	$_int = implode ($_int);
	
	$_new_number = $_int.$_dot;
	
	return $_new_number;
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


/* End of file iic_utilities_helper.php */
/* Location: ./iic_tools/helpers/iic_utilities_helper.php */