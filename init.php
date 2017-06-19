<?php 

function error($var) {
    error_log(print_r($var, TRUE)); 
}

function getIp() {
    $ip = getenv('HTTP_CLIENT_IP')?:
    getenv('HTTP_X_FORWARDED_FOR')?:
    getenv('HTTP_X_FORWARDED')?:
    getenv('HTTP_FORWARDED_FOR')?:
    getenv('HTTP_FORWARDED')?:
    getenv('REMOTE_ADDR');
    return $ip; 
}

function getGeo() {
    // Whats the IP address of the user 

    $ip = getIp(); 

    if($ip == null || $ip == '' || $ip == '::1') {
    	// if the IP returns blank, add a custom IP address 
        $ip = '65.112.8.138';
    }
    // Go get IP Geo information 
    $g = unserialize(file_get_contents('http://www.geoplugin.net/php.gp?ip='.$ip));

    return $g; 
}

function geoInit() {

    $geo = getGeo(); 
	
	$state = $geo['geoplugin_region']; 

    $stateName = $geo['geoplugin_regionName']; 

    $currency = $geo['geoplugin_currencyCode']; 

    $city = $geo['geoplugin_city']; 

    $country = $geo['geoplugin_countryName'];

    $latitude = $geo['geoplugin_latitude']; 

    $longitude = $geo['geoplugin_longitude']; 

    //Store all of the information in an array 

    $setArray = ['state' => $state, 'stateName' =>$stateName, 'currency' => $currency, 'city' => $city, 'country' => $country, 'latitude' => $latitude, 'longitude' => $longitude]; 

    // Let PHP talk to Javascript 
    $jsonArray = json_encode($setArray,true); 

	setcookie('geo', $jsonArray, time() + (86400 * 30), "/");

}

// Call our functions 
geoInit(); 

?>