<?php
function get_http($url) {
	echo "<h2>TCP/IP Connection</h2>\n";
	/* Getting the port for the WWW service. */
	$service_port = getservbyname('www', 'tcp');
	/* Getting the IP address for the target host. */
	$address = gethostbyname($url);
	/* Creating a TCP/IP socket. */
	$socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
	if ($socket === false) {
	    echo "socket_create() failed: reason: " . socket_strerror(socket_last_error()) . "\n";
	} 
	else {
	    echo "OK.\n";
	}
	echo "Attempting to connect to '$address' on port '$service_port'...";
	$result = socket_connect($socket, $address, $service_port);
	if ($result === false) {
	    echo "socket_connect() failed.\nReason: ($result) " . socket_strerror(socket_last_error($socket)) . "\n";
	}
	 else {
	    echo "OK.\n";
	}
	$in = "GET / HTTP/1.1\r\n";
	$in .= "Host: $url\r\n";
	$in .= "Connection: Close\r\n\r\n";
	$out = '';
	echo "Sending HTTP GET request...";
	socket_write($socket, $in, strlen($in));
	echo "OK.\n";
	echo "Reading response:\n\n";
	
	$result = [];
	while ($response = socket_read($socket, 2048)) {
	    list($header, $body) = preg_split("/\R\R/", $response, 2);
        $result['body'] = $body;
        $headerLines = explode("\n",$header);

        $headers['status']=$headerLines[0];

        array_shift($headerLines);

        foreach($headerLines as $headerLine){
            $headerParts = explode(":", $headerLine);
            $headers[trim($headerParts[0])] = trim($headerParts[1]);
        }
        $result['headers'] = $headers;
	}

	echo "Closing socket...";
	socket_close($socket);
	echo "OK.\n\n";
	
	return $result;

}	
 $result = get_http('google.bg');
 print_r($result);

// $response = get_http($domain);
// echo $response['headers']['Content-Type'];
// echo $response['body'];