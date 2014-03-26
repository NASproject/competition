<?php

	if(isset($_POST['user_id']))    $Name   = $_POST['user_id'];
	if(isset($_POST['password']))   $password   = $_POST['password'];
	function debug($str)
	{
//		echo($str);
	}
$Name   = '090921';
$password   = 'qazwsx1234';

	$headers = array (
	'User-Agent: Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.1) Gecko/20061204 Firefox/2.0.0.1',
	);	
	$host = "https://search.kh.usc.edu.tw";
	$path = "/TerSystem/Process.asp";
	$url = $host . $path;
	$post_data = "user_id=$Name&password=$password";
	
	debug('<pre>');
	$response = post_https($url, $post_data,$headers);
	debug($response);
	
/*把HTTP Request分成array*/
	$stack = array();
	$response_array = array();
	$str_response = str_replace("\r\n", ": ", $response); 
	$str_response = explode(": ",$str_response);
	foreach($str_response as $index=>$value){
		array_push($stack,$value);
	}
	$response_array['HTTP'] = $stack[0];
	
	for($i=1;$i < count($stack)-2;$i+=2){
		if($stack[$i] != ' '){
			$response_array[$stack[$i]] = $stack[$i+1];
		}
	}
	
	$url = $host . $response_array['Location'];
	$cookie = $response_array['Set-Cookie'];
	$headers = array (
	'User-Agent: Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.1) Gecko/20061204 Firefox/2.0.0.1',
	"Cookie: $cookie",
	"Cache-control: max-age=3600"
	);	
	debug($url . "\n"); 
	debug($cookie . "\n");
//	var_dump($headers);

	$response = get_https($url,$headers);
	debug($response);
	if( $response !=NULL)
		{
	/*把HTTP Request分成array*/
	$stack = array();
	$response_array = array();
	$str_response = str_replace("\r\n", ": ", $response); 
	$str_response = explode(": ",$str_response);
	foreach($str_response as $index=>$value){
		array_push($stack,$value);
	}
	$response_array['HTTP'] = $stack[0];
	
	for($i=1;$i < count($stack)-2;$i+=2){
		if($stack[$i] != ' '){
			$response_array[$stack[$i]] = $stack[$i+1];
		}
	}
	
	$url = $response_array['Location'];
	$cookie2 = $response_array['Set-Cookie'];
	$headers = array (
	'User-Agent: Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.1) Gecko/20061204 Firefox/2.0.0.1',
	"Cookie: $cookie; $cookie2",
	"Cache-control: no-cache"
	);	
	$response = get_https($url,$headers);
	debug($response);
	
	debug('\n</pre>\n');
	$auth = "success";
//	header("location: query2.php");	
		//header("location: https://search.kh.usc.edu.tw/stu/teacher1/map.asp?tid=094252&perdepid=49&pergrdno=4&perclsno=1");
	}
	else
		 echo "<script>alert ('Error!'); window.history.go(-1);</script>";
	function post_https($url, $post_data, $headers)
	{
		$ch = curl_init(); 

		curl_setopt($ch, CURLOPT_URL , $url);
		//The URL to fetch. You can also set this when initializing a session with curl_init().	
		
		curl_setopt($ch, CURLOPT_RETURNTRANSFER , 1); 
		//return web page
				
		curl_setopt($ch, CURLOPT_AUTOREFERER , true);
		// set referer on redirect
		
		curl_setopt($ch, CURLOPT_TIMEOUT , 80); 
		// timeout on response
		
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		//FALSE to stop cURL from verifying the peer's certificate. Alternate certificates to verify against can be specified with the CURLOPT_CAINFO option or a certificate directory can be specified with the CURLOPT_CAPATH option.
		
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		//may also need to be TRUE or FALSE if CURLOPT_SSL_VERIFYPEER is disabled (it defaults to 2).TRUE by default as of cURL 7.10. Default bundle installed as of cURL 7.10.

		curl_setopt($ch, CURLOPT_HEADER, true);	//return headers
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers); // Set headers to above array
		curl_setopt($ch, CURLOPT_VERBOSE, true); // Display communication with server
		
		
		curl_setopt($ch, CURLOPT_POST , 1); 
		//TRUE to do a regular HTTP POST. This POST is the normal application/x-www-form-urlencoded kind, most commonly used by HTML forms.
		
		curl_setopt($ch, CURLOPT_POSTFIELDS , $post_data ); 
		//The full data to post in a HTTP "POST" operation.
		
		$xml_response = curl_exec($ch); 
		
		curl_close($ch);
		return $xml_response;
	}
	
	function get_https($url, $headers)
	{
		$session = curl_init();
		curl_setopt($session, CURLOPT_URL, $url); // Oops - wrong URL for API
		curl_setopt($session, CURLOPT_HTTPHEADER, $headers); // Set headers to above array
		
		curl_setopt($session, CURLOPT_SSL_VERIFYPEER, 0);
		//FALSE to stop cURL from verifying the peer's certificate. Alternate certificates to verify against can be specified with the CURLOPT_CAINFO option or a certificate directory can be specified with the CURLOPT_CAPATH option.
		curl_setopt($session, CURLOPT_SSL_VERIFYHOST, 0);
		
		curl_setopt($session, CURLOPT_HEADER, true); // Display headers
		curl_setopt($session, CURLOPT_VERBOSE, true); // Display communication with server
		curl_setopt($session, CURLOPT_RETURNTRANSFER, true); // Return data instead of display to std out
		$xml_response = curl_exec($session);
		curl_close($session);
 
		return $xml_response;
	}
?>