<?php 

# library to call 3rd party API 
class api{ 
	public $curl;

	function __construct(){
		$this->curl = curl_init();
	}

	function call($method, $url, $data = false){
		$curl = curl_init();

		switch ($method)
    {
      case "POST":
        curl_setopt($curl, CURLOPT_POST, 1);

        if ($data)
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        break;
      case "PUT":
        curl_setopt($curl, CURLOPT_PUT, 1);
        break;
      default:
        if ($data)
            $url = sprintf("%s?%s", $url, http_build_query($data));
    }

    $header = array();
		$header[] = 'Content-type: application/json';
		$header[] = 'Authorization: '.API_AUTH;

		curl_setopt($curl, CURLOPT_HTTPHEADER,$header);
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

    $result = curl_exec($curl);

    curl_close($curl);

    return $result;
	}
} 