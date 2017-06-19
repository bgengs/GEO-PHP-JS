<?php require 'init.php';?> 
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>GEO Code</title>

<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.3/jquery.min.js"></script>
<script src="cookie.js"></script>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

</head>
<body>

<div class="container">

<div class="col-md-6 col-md-offset-3">
	<img id="cityImg" class="img-responsive">
	<h1 id="cityTxt"></h1>
</div>

<div class="col-md-6 col-md-offset-3">
	<img id="stateImg" class="img-responsive">
	<h1 id="stateTxt"></h1>
</div>

<div class="col-md-6 col-md-offset-3">
	<img id="countryImg" class="img-responsive">
	<h1 id="countryTxt"></h1>
</div>
<div class="col-md-6 col-md-offset-3">
	<div id="map"></div>
</div>



</div>





<script> 

if(Cookies.get('geo')) {
	// We have the cookie 

	var geo = $.parseJSON(Cookies.get('geo'));

	var city = geo.city; 

	var state = geo.state; 

	var stateName = geo.stateName; 

	var country = geo.country; 

	var latitude = geo.latitude; 

	var longitude = geo.longitude; 

	// Set Text 

	$('#stateTxt').html(stateName + ' ('+ state +')'); 

	$('#cityTxt').html(city);

	$('#countryTxt').html(country); 


	// Fetch Photos 

	$.getJSON("http://api.flickr.com/services/feeds/photos_public.gne?jsoncallback=?", { tags: city, tagmode: "any",format: "json"},
        function(data) {
            var rnd = Math.floor(Math.random() * data.items.length);
            var image_src = data.items[rnd]['media']['m'].replace("_m", "_b");
            $("#cityImg").attr("src", image_src);
     });

	$.getJSON("http://api.flickr.com/services/feeds/photos_public.gne?jsoncallback=?", { tags: stateName, tagmode: "any",format: "json"},
        function(data) {
            var rnd = Math.floor(Math.random() * data.items.length);
            var image_src = data.items[rnd]['media']['m'].replace("_m", "_b");
            $("#stateImg").attr("src", image_src);
     });

	$.getJSON("http://api.flickr.com/services/feeds/photos_public.gne?jsoncallback=?", { tags: country, tagmode: "any",format: "json"},
        function(data) {
            var rnd = Math.floor(Math.random() * data.items.length);
            var image_src = data.items[rnd]['media']['m'].replace("_m", "_b");
            $("#countryImg").attr("src", image_src);
     });
 
} else {
	// cookie wasnt set correctly 
	alert('Shalom World, their was a problem setting a cookie, this might be because the cookie monster ate the cookie prior to being set in the cookie jar.');  
}


</script> 
</body>
</html>