<?php

function atualiza_rd($data_array) {
    try {
        $api_url = "http://www.rdstation.com.br/api/1.3/conversions";
        $data_array["token_rdstation"] = 'TOKEN_RD';
        $data_array["identificador"] = 'IDENTIFICADOR_RD';
        $data_array["c_utmz"] = 'REMETENTE';
        $data_array["data_hora"] = date("D M j G:i:s T Y");

        $data_query = http_build_query($data_array);
        $ch = curl_init($api_url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_query);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4 ); 
        $response = curl_exec($ch);
        curl_close($ch);
        return $response;
    } catch (Exception $e) {
        
    }
}

function conversao_rd($identifier, $data_array) {
    try {
        $response = 0;
        $rdstation_token = 'TOKEN_RD';
        $api_url = "www.rdstation.com.br/api/1.3/conversions";
        if (empty($data_array["token_rdstation"]) && !empty($rdstation_token)) {
            $data_array["token_rdstation"] = $rdstation_token;
        }
        if (empty($data_array["identificador"]) && !empty($identifier)) {
            $data_array["identificador"] = $identifier;
        }
        $data_array["data_hora"] = date("D M j G:i:s T Y");
        $data_array["c_utmz"] = 'REMETENTE';

        if (!empty($data_array["token_rdstation"]) && !( empty($data_array["email"]) && empty($data_array["email_lead"]) )) {
            $data_query = http_build_query($data_array);
            
                $ch = curl_init($api_url);
                curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $data_query);
                curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4 ); 
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                $response = curl_exec($ch);                
                curl_close($ch);
           
        }        
    } catch (Exception $e) {
        
    }
}

function estado_rd($email, $data_array) {

    $url = "https://www.rdstation.com.br/api/1.3/leads/" . $email;
    try {
        $data_json = $data_array;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json', 'Content-Length: ' . strlen($data_json)));
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_json);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4 ); 
        $response = curl_exec($ch);
        curl_close($ch);
        return $response;
    } catch (Exception $e) {
        
    }
}
