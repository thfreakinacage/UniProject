<?php
function checkHTTPstatus($url)
{
	
	// must set $url first. Duh...
	$http = curl_init($url);
	curl_setopt($http, CURLOPT_HEADER, 0);
	curl_setopt($http, CURLOPT_RETURNTRANSFER, true);
	//curl_setopt($http, CURLOPT_FOLLOWLOCATION , true);
	// do your curl thing here
	$result = curl_exec($http);
	$http_status = curl_getinfo($http, CURLINFO_HTTP_CODE);
	
	return $http_status;
	
	curl_close($http);
	
	
	/*
	$furl = false;
   
    // First check response headers
    $headers = get_headers($url);
   
    // Test for 301 or 302
    if(preg_match('/^HTTP\/\d\.\d\s+(301|302)/',$headers[0]))
    {
        foreach($headers as $value)
        {
            if(substr(strtolower($value), 0, 9) == "location:")
            {
                $furl = trim(substr($value, 9, strlen($value)));
            }
        }
    }
    // Set final URL
    $furl = ($furl) ? $furl : $url;

    return $furl;
	*/
}
?>