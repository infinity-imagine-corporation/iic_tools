/**
 * Remove comma from number 
 * 
 * @param string val
 * @param int dec
 */

function remove_comma(val, dec)
{    
    var newVal = 0, 
    	defaultVal = 0,		
    	dec = (dec || 2);

    if ( !val )
    	return defaultVal;

    val = val.toString().replace(/,/g, '');

    if ( !val )
    	return defaultVal;

    newVal = parseFloat(val);

    if ( isNaN(newVal) )
    	return defaultVal;

    newVal = +( newVal.toFixed(dec) );

    return ( newVal || defaultVal );
}

// ------------------------------------------------------------------------

/**
 * Add comma to number
 * @param string nStr
 */

function add_comma(nStr)
{
	nStr += '';
	x = nStr.split('.');
	x1 = x[0];
	x2 = x.length > 1 ? '.' + x[1] : '';
	var rgx = /(\d+)(\d{3})/;
	
	while (rgx.test(x1)) 
	{
		x1 = x1.replace(rgx, '$1' + ',' + '$2');
	}
	
	return x1 + x2;
}

// ------------------------------------------------------------------------

/**
 * Put 0 in front of number 
 *
 * @param		integer	$length
 * @param		stirng	$data
 * @return		stirng	
 */

function zero_fill(length, data)
{
	while(data.length < length)
	{
		data = '0' + data;
	}
	
	return data;
}

// ------------------------------------------------------------------------