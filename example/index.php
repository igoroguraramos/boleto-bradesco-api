<?php

include("../vendor/autoload.php");

use \BradescoBoleto\Boleto;
use \BradescoBoleto\API;

$config = [
    "sandbox" => true,
    "cert_path" => "",
    "cert_password" => "",
    "cnpj_beneficiario" => "",
    "agencia_beneficiario" => "",
    "conta_beneficiario" => ""
];

\BradescoBoleto\Config::setConfig($config);

$boleto = new Boleto();
$boleto->dtEmissaoTitulo = "26/05/2021";
$boleto->dtVencimentoTitulo = "31/05/2021";
$boleto->valor = "2.000,00";
$boleto->nomePagador = "Cliente";
$boleto->logradouroPagador = "Rua";
$boleto->cep = "37120-000";
$boleto->nuLogradouroPagador = "0";
$boleto->bairroPagador = "Centro";
$boleto->ufPagador = "MG";
$boleto->CPFCNPJ = "000.000.000-00";

$format = \BradescoBoleto\Format::execute($boleto);

$api = new API;
$return = $api->execute($format);
