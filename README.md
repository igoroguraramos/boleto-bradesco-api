# Boleto Bradesco API
API para Registrar os Boletos no Banco Bradesco

Conforme Manual:

[Layout_Registro_Online_Boleto_VPort_05-06-2020.pdf](https://github.com/igoroguraramos/boleto-bradesco-api/blob/main/Layout_Registro_Online_Boleto_VPort_05-06-2020.pdf)


## Instalação


```bash
composer require igoroguraramos/boleto-bradesco-api
```

## Requisitos
- Possuir contrato com o Bradesco e com o Webservice ativado
- Mesmo em ambiente de teste os dados devem ser reais para funcionar
- Necessário o certificado A1 no formato .p12 ou .pfx

### Array de Configuração
```php
$config = [
    "sandbox" => true,
    "cert_path" => "",
    "cert_password" => "",
    "cnpj_beneficiario" => "",
    "agencia_beneficiario" => "",
    "conta_beneficiario" => ""
];
```
- sandbox = true (para homologação) e false (para produção)
- cert_path = caminho absoluto do certificado e extensão .p12 ou .pfx
- cert_password = senha do certificado digital
- cnpj_beneficiario = CNPJ do beneficiario sem caracteres especiais ex: 12345678000190
- agencia_beneficiario = agência do beneficiario sem o digito verificador
- conta_beneficiario = numero da conta com o digito verificador


## Exemplo

```php
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

print_r($return);
//echo json_encode($return);

```
