<?php

namespace BradescoBoleto;

use App\BradescoBoleto;

class API{
    public function execute($vars){
        $encryptBody = $this->encryptBody($vars);
        $request = $this->requestBradesco($encryptBody);
        return $request;
    }  

    public function requestBradesco($vars){
        $config = \BradescoBoleto\Config::getConfig();
        if($config["sandbox"]){
            $url = "https://cobranca.bradesconetempresa.b.br/ibpjregistrotitulows/registrotitulohomologacao";
        }
        else{
            $url = "https://cobranca.bradesconetempresa.b.br/ibpjregistrotitulows/registrotitulo";
        }       

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $vars);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json'
        ));
        
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        
        $result = curl_exec($ch);
        
        curl_close ($ch);

        $dom = new \DOMDocument();
        $dom->loadXML($result);
        $return = $dom->textContent;
        $obj = json_decode($return);
        return $obj;
    }

    private function encryptBody($vars){
        $config = \BradescoBoleto\Config::getConfig();
        $pkcs12 = file_get_contents($config["cert_path"]);
        openssl_pkcs12_read($pkcs12, $certificates, $config["cert_password"]);
        $certificate = openssl_x509_read($certificates['cert']);
        $private_key = openssl_pkey_get_private($certificates['pkey'], $config["cert_password"]);
        $file = fopen(__DIR__ . '/temp.json', 'w');
        fwrite($file, json_encode($vars,JSON_UNESCAPED_UNICODE));
        $input_filename = __DIR__ . "/temp.json";
        $output_filename = __DIR__ . "/signed.json";
        openssl_pkcs7_sign($input_filename, $output_filename, $certificate, $private_key, [], PKCS7_BINARY | PKCS7_TEXT);
        $signature = file_get_contents($output_filename);
        $parts = preg_split("#\n\s*\n#Uis", $signature);
        unlink($input_filename);
        unlink($output_filename);
        $signedMessageBase64 = $parts[1];
        return $signedMessageBase64;
    }   


}