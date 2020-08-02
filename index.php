<?php

$prefixData = $_POST['addressData'];
$service_url = 'https://us-autocomplete.api.smartystreets.com/suggest?auth-id=56d6f1b5-72a9-8f82-4d41-10c8a3a5a434&auth-token=UmZNXeJ3YlaVgWpnw57Z&prefix=5';
           $curl = curl_init($service_url);
           curl_setopt($curl, CURLOPT_HTTPHEADER, array("ovio-api-key: key"));
           curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
           curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
           curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
           $curl_response = curl_exec($curl);
		   var_dump($curl_response);
           curl_close($curl);
           return json_encode($curl_response);



?>