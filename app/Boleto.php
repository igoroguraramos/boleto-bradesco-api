<?php

namespace BradescoBoleto;

class Boleto{
    public $nuCPFCNPJ;
    public $filialCPFCNPJ;
    public $ctrlCPFCNPJ;
    public $cdTipoAcesso = "2";
    public $clubBanco = "2269651";
    public $cdTipoContrato = "48";
    public $nuSequenciaContrato = "0";
    public $idProduto = "09";
    public $nuNegociacao;
    public $cdBanco = "237";
    public $eNuSequenciaContrato = "0";
    public $tpRegistro = "1";
    public $cdProduto = "0";
    public $nuTitulo = "0";
    public $nuCliente = "0";
    public $dtEmissaoTitulo = "";
    public $dtVencimentoTitulo = "";
    public $tpVencimento = "0";
    public $vlNominalTitulo = "0";
    public $cdEspecieTitulo = "99";
    public $tpProtestoAutomaticoNegativacao = "0";
    public $prazoProtestoAutomaticoNegativacao = "0";
    public $controleParticipante = "";
    public $cdPagamentoParcial = "";
    public $qtdePagamentoParcial = "0";
    public $percentualJuros = "0";
    public $vlJuros = "0";
    public $qtdeDiasJuros = "0";
    public $percentualMulta = "0";
    public $vlMulta = "0";
    public $qtdeDiasMulta = "0";
    public $percentualDesconto1 = "0";
    public $vlDesconto1 = "0";
    public $dataLimiteDesconto1 = "";
    public $percentualDesconto2 = "0";
    public $vlDesconto2 = "0";
    public $dataLimiteDesconto2 = "";
    public $percentualDesconto3 = "0";
    public $vlDesconto3 = "0";
    public $dataLimiteDesconto3 = "";
    public $prazoBonificacao = "0";
    public $percentualBonificacao = "0";
    public $vlBonificacao = "0";
    public $dtLimiteBonificacao = "";
    public $vlAbatimento = "0";
    public $vlIOF = "0";
    public $nomePagador = "";
    public $logradouroPagador = "";
    public $nuLogradouroPagador = "";
    public $complementoLogradouroPagador = "";
    public $cepPagador = "0";
    public $complementoCepPagador = "0";
    public $bairroPagador = "";
    public $municipioPagador = "";
    public $ufPagador = "";
    public $cdIndCpfcnpjPagador = "0";
    public $nuCpfcnpjPagador = "0";
    public $endEletronicoPagador = "";
    public $nomeSacadorAvalista = "";
    public $logradouroSacadorAvalista = "";
    public $nuLogradouroSacadorAvalista = "";
    public $complementoLogradouroSacadorAvalista = "";
    public $cepSacadorAvalista = "0";
    public $complementoCepSacadorAvalista = "0";
    public $bairroSacadorAvalista = "";
    public $municipioSacadorAvalista = "";
    public $ufSacadorAvalista = "";
    public $cdIndCpfcnpjSacadorAvalista = "0";
    public $nuCpfcnpjSacadorAvalista = "0";
    public $endEletronicoSacadorAvalista = "";

    public function __construct()
    {
        $config = \BradescoBoleto\Config::getConfig();
        $this->nuCPFCNPJ = substr($config["cnpj_beneficiario"],0,8);
        $this->filialCPFCNPJ = substr($config["cnpj_beneficiario"],8,4);
        $this->ctrlCPFCNPJ = substr($config["cnpj_beneficiario"],12,2);
        $contaLength = strlen($config["conta_beneficiario"]);
        $conta = $config["conta_beneficiario"];
        for($i=0;$i<(7-$contaLength);$i++){
            $conta = "0" . $conta;
        }
        $this->nuNegociacao = $config["agencia_beneficiario"] . "0000000" . $conta;
    }
    
}