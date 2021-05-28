<?php

namespace BradescoBoleto;

use \BradescoBoleto\Boleto;

class Format{

    public static function execute(Boleto $vars){
        foreach($vars as $key=>$var){
            //Datas dd/mm/yyyy
            if(preg_match("/^[0-9]{1,2}\/[0-9]{1,2}\/[0-9]{4}$/",$var) == 1){
               $vars->$key = str_replace("/",".",$var);
            }
        }

        $vars->cepPagador = substr($vars->cep,0,5);
        $vars->complementoCepPagador = substr($vars->cep,6,3);
        $vars->vlNominalTitulo = str_replace(",","",str_replace(".","",$vars->valor));
        $formatedCPFCNPJ = preg_replace("/[^0-9]/", "", $vars->CPFCNPJ);
        $lenCPFCNPJ = strlen($formatedCPFCNPJ);
        if($lenCPFCNPJ == 11){
            $vars->cdIndCpfcnpjPagador = "1";
            $vars->nuCpfcnpjPagador = "000" . $formatedCPFCNPJ;
        }
        else{
            $vars->cdIndCpfcnpjPagador = "2";
            $vars->nuCpfcnpjPagador = $formatedCPFCNPJ;
        }


        return $vars;
    }
}