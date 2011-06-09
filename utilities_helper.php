<?php 
// ------------------------------------------------------------------------

/**
  * Genarate pagination
  *
  * @access		public
  *
  * @param		int		$total_rows
  * @param		string	$target
  * @param		int		$current_page
  * @param		int		$rows_per_page
  *
  * @return		mixed	$_pagination
  */
  
function get_pagination($total_rows, $target, $current_page, $rows_per_page = 10)
{	
	// Set total page
	$_total_page = ceil($total_rows / $rows_per_page);
	
	// Create previous button
	if($current_page > 1 )
	{
		$_pagination .= '<a href="'.$target.($current_page - 1).'" title="Previous">&nbsp;Prev&nbsp;</a>';
	}
	
	$loop = 1;
			
	// Create pageing button
	while($loop <= $_total_page) 
	{
		if($loop <= 3 || $loop > ($_total_page - 3))
		{
			$_pagination .= '<a href="'.$target.$loop.'" title="Page '.$loop.'" ';
			if($loop == $current_page)
			{
				$_pagination .= "class='current'"; 
			}
			$_pagination .= ">&nbsp;".$loop."&nbsp;</a>";
		}
		else if($loop == 4 && $current_page >= 8)
		{
			$_pagination .= " ... ";
		}
		else if($loop >= ($current_page - 3) && $loop <= ($current_page + 3) && $current_page > 3 && $current_page <= ($_total_page - 3))
		{
			$_pagination .= '<a href="'.$target.$loop.'" title="Page '.$loop.'" ';
			if($loop == $current_page)
			{
				$_pagination .= "class='current'"; 
			}
			$_pagination .= ">&nbsp;".$loop."&nbsp;</a>";
		}
		else if($loop == ($_total_page - 3) && $current_page < ($_total_page - 3))
		{
			$_pagination .= " ... ";
		}
		
		$loop++;
	}
	
	// Create next button
	if($current_page != $_total_page && $_total_page != 0)
	{
		$_pagination .= '<a href="'.$target.($current_page + 1).'" title="Next">&nbsp;Next&nbsp;</a>';
	}
	
	return $_pagination;
}

// ------------------------------------------------------------------------

/**
  * Calculate new size with original ratio
  *
  * @access		public
  *
  * @param		string	$image_uri
  * @param		int		$max_width
  * @param		int		$max_height
  *
  * @return		array	$_new_size
  */
  
function calc_image_size($image_uri, $max_width = 300, $max_height = 300)
{		
	// Get original size
	$_img_info	 = getimagesize($image_uri);
	$_img_width	 = $_img_info[0];
	$_img_height = $_img_info[1];
	
	// Set new width
	if($_img_width > $max_width)
	{
		$_new_width	= $max_width;
		$_new_height	= floor($_new_width * $_img_height / $_img_width);
	} 
	else 
	{
		$_new_width = $img_info[0];
	}	
	
	// Set new height
	if($_new_height > $max_height)
	{
		$_new_height = $max_width;
		$_new_width  = floor($_new_height * $_img_width / $_img_height);
	} 
	
	$_new_size['width'] = $_new_width;
	$_new_size['height'] = $_new_height;
	
	return $_new_size;
}

// ------------------------------------------------------------------------

/**
  * Genarate image tag with preview size
  *
  * @access		public
  *
  * @param		string	$image_uri
  * @param		int		$max_width
  * @param		int		$max_height
  *
  * @return		mixed	$_previewer
  */
  
function get_image_preview($image_uri, $max_width = 300, $max_height = 300)
{		
	$_new_size	 = calc_image_size($image_uri, $max_width, $max_height);
	$_new_width = $_new_size['width'];
	$_new_height = $_new_size['height'];
	
	$_description = 'Click to view enlarge image';
	
	$_previewer = '<a href="'.$image_uri.'" target="_blank"><img src="'.$image_uri.'" width="'.$_new_width.'" height="'.$_new_height.'" alt="'.$_description.'" title="'.$_description.'"></a>';
	
	return $_previewer;
}

// ------------------------------------------------------------------------

/**
  * Genarate image tag with preview size for CRUD 
  *
  * @access		public
  *
  * @param		string	$image_uri
  * @param		string	$label
  * @param		int		$max_width
  * @param		int		$max_height
  *
  * @return		mixed	$_previewer
  */
  
function get_crud_image_preview($image_uri, $label, $max_width = 300, $max_height = 300)
{
	$_new_size	 = calc_image_size($image_uri, $max_width, $max_height);
	$_new_width = $_new_size['width'];
	$_new_height = $_new_size['height'];
	
	$_description = 'Click to view enlarge image';
	
	$_previewer = '<label><a href="'.$image_uri.'" target="_blank"><img src="'.$image_uri.'" width="'.$_new_width.'" height="'.$_new_height.'" alt="'.$_description.'" title="'.$_description.'"></a></label>';
	$_previewer .= '<label class="normal">Original size: '.$_img_width.' x '.$_img_height.'</label>';
	$_previewer .= '<label><input type="checkbox" name="delete_'.$label.'" value="1"> Delete this image</label>';
	
	return $_previewer;
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

function iic_query($sql)
{
	$_query = mysql_query($sql);
	
	if(! $_query)
	{
		// report
		$url_target = '';
		$title = 'Error in: iic_query()';
		$message = '<h5>MySql Error: ' . mysql_errno() . '</h5>';
		$message .= '<p class="red">' . mysql_error() . '</p>';
		$message .= '<h5>Your SQL syntax is:</h5>';
		$message .= '<p><pre>' . $sql . '</pre></p>';
		
		require_once("iic_notification.php");
		exit();
	}
	else
	{
		return $_query;
	}
}

// ------------------------------------------------------------------------

function check_query_error($query, $sql = NULL)
{
	if(!$query)
	{
		echo "<p>";
		echo $sql;
		echo "<hr />";
		echo (mysql_errno() ? "Error no. " . mysql_errno() . " : " : "") . mysql_error();
		echo "</p>";
		exit();
	}
	else
	{
		return $query;
	}
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
	
function change_date_time_format($date_time)
{	
	list($_date, $_time) = explode(" ", $date_time);
	$_new_date = change_date_format($_date);
	$_new_date_time = $_new_date . ' ' . substr($_time, 0, 5);
	
	return $_new_date_time;
}

// ------------------------------------------------------------------------
  
function print_array($arr)
{
	echo '<pre>';
	print_r($arr);
	echo '</pre>';
	exit();
}

// ------------------------------------------------------------------------
  
function comma_to_array($text)
{
	return explode(',', $text);
}

// ------------------------------------------------------------------------
  
function array_to_comma($arr)
{
	return implode(',', $arr);
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
/* Location: ./iic_tools/utilities_helper.php */