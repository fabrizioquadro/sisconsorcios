<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use App\Models\Venda;
use App\Models\Grupo;
use App\Models\Chamada;
use App\Models\Configuracao;

if(!function_exists('calculaParcelasGrupo')){
  function calculaParcelasGrupo($parcelasTotais, $dtInicioGrupo, $dtVenda){
      $dtControle = $dtInicioGrupo;
      while(strtotime($dtControle) < strtotime($dtVenda)){
          $parcelasTotais--;
          $dtControle = date('Y-m-d', strtotime('+1 month', strtotime($dtControle)));
      }


      $retorno['inicioPagamento'] = $dtControle;
      $retorno['parcelasTotais'] = $parcelasTotais;

      return $retorno;
  }
}

if(!function_exists('createPassword')){
    function createPassword($tamanho, $maiusculas, $minusculas, $numeros, $simbolos){
        $senha = "";
        $ma = "ABCDEFGHIJKLMNOPQRSTUVYXWZ"; // $ma contem as letras maiúsculas
        $mi = "abcdefghijklmnopqrstuvyxwz"; // $mi contem as letras minusculas
        $nu = "0123456789"; // $nu contem os números
        $si = "!@#$%¨&*()_+="; // $si contem os símbolos

        if ($maiusculas){
            // se $maiusculas for "true", a variável $ma é embaralhada e adicionada para a variável $senha
            $senha .= str_shuffle($ma);
        }

        if ($minusculas){
            // se $minusculas for "true", a variável $mi é embaralhada e adicionada para a variável $senha
            $senha .= str_shuffle($mi);
        }

        if ($numeros){
            // se $numeros for "true", a variável $nu é embaralhada e adicionada para a variável $senha
            $senha .= str_shuffle($nu);
        }

        if ($simbolos){
            // se $simbolos for "true", a variável $si é embaralhada e adicionada para a variável $senha
            $senha .= str_shuffle($si);
        }

        // retorna a senha embaralhada com "str_shuffle" com o tamanho definido pela variável $tamanho
        return substr(str_shuffle($senha),0,$tamanho);

    }
}


if(!function_exists('dataDbForm')){
    function dataDbForm($data){
        $data = explode("-", $data);
        $data = $data[2]."/".$data[1]."/".$data[0];
        return $data;
    }
}


if(!function_exists('valorFormDb')){
    function valorFormDb($valor){
        //vamos procurar se foi digitado a ,
        $virgula = strpos($valor, ',');

        if($virgula === false){
            $valor = str_replace(".","",$valor);
            $valor = $valor.".00";
            return $valor;
        }

        $var = explode(',', $valor);
        $variavel = $var[1];
        $var = str_replace('.', '', $var[0]);
        $valor = $var.'.'.$variavel[0].$variavel[1];
        return $valor;
    }
}


if(!function_exists('valorDbForm')){
    function valorDbForm($valor){
        return number_format($valor,2,",",".");
    }
}


if(!function_exists('enviarMail')){
    function enviarMail($destinatario, $assunto, $mensagem){
        $mail = new PHPMailer(true);
        try {
            //Server settings
            $mail->setLanguage('br');
            $mail->CharSet = "utf8";
            $mail->SMTPDebug = 0;
            $mail->isSMTP();
            $mail->Host = 'smtp.hostinger.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'tiojoca@webpel.dev.br';
            $mail->Password = 'P&dr0Quadr0';
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;
            $mail->FromName = "Consórcios";
            $mail->From = "tiojoca@webpel.dev.br";
            $mail->IsHTML(true);
            $mail->Subject = $assunto;
            $mail->Body = $mensagem;
            $mail->AddAddress($destinatario);
            $mail->Send();
        }
        catch (Exception $e) {
            $this->errorInfo = $mail->ErrorInfo;
        }
    }
}


if(!function_exists('createPassword')){
    function createPassword($tamanho, $maiusculas, $minusculas, $numeros, $simbolos){
        $senha = "";
        $ma = "ABCDEFGHIJKLMNOPQRSTUVYXWZ"; // $ma contem as letras maiúsculas
        $mi = "abcdefghijklmnopqrstuvyxwz"; // $mi contem as letras minusculas
        $nu = "0123456789"; // $nu contem os números
        $si = "!@#$%¨&*()_+="; // $si contem os símbolos
        if ($maiusculas){
            // se $maiusculas for "true", a variável $ma é embaralhada e adicionada para a variável $senha
            $senha .= str_shuffle($ma);
        }
        if ($minusculas){
            // se $minusculas for "true", a variável $mi é embaralhada e adicionada para a variável $senha
            $senha .= str_shuffle($mi);
        }
        if ($numeros){
            // se $numeros for "true", a variável $nu é embaralhada e adicionada para a variável $senha
            $senha .= str_shuffle($nu);
        }
        if ($simbolos){
            // se $simbolos for "true", a variável $si é embaralhada e adicionada para a variável $senha
            $senha .= str_shuffle($si);
        }
        // retorna a senha embaralhada com "str_shuffle" com o tamanho definido pela variável $tamanho
        return substr(str_shuffle($senha),0,$tamanho);
    }
}


if(!function_exists('getBancoNrGrupoVenda')){
    function getBancoNrGrupoVenda($id_venda){
        $venda = Venda::find($id_venda);

        $grupo = Grupo::find($venda->id_grupo);

        return $grupo->nmBanco." - ".$grupo->nrGrupo;
    }
}


if(!function_exists('testaProximoAniversarioGrupo')){
    function testaProximoAniversarioGrupo($id_grupo){
        $grupo = Grupo::where('id', $id_grupo)->first();

        $dtFimGrupo = date('Y-m-d', strtotime("+$grupo->nrPrazo months", strtotime($grupo->dtInicio)));

        if(strtotime($grupo->dtProxAniversario) < strtotime($dtFimGrupo)){
            return true;
        }
        else{
            return false;
        }
    }
}


if(!function_exists('testaChamadaNaoVisualizadaCliente')){
    function testaChamadaNaoVisualizadaCliente($id_cliente){
        $conta = Chamada::where('id_cliente', $id_cliente)
            ->where('dsVisualizarCliente', 'Não')
            ->count();

        if($conta > 0){
            return true;
        }
        else{
            return false;
        }
    }
}


if(!function_exists('testaChamadaNaoVisualizadaAdmin')){
    function testaChamadaNaoVisualizadaAdmin(){
        $conta = Chamada::where('dsVisualizarAdmin', 'Não')
            ->count();

        if($conta > 0){
            return true;
        }
        else{
            return false;
        }
    }
}

if(!function_exists('buscaDadosConfig')){
    function buscaDadosConfig(){
        return Configuracao::where('id','1')->first();
    }
}



?>
