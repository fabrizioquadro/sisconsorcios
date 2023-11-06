<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ExportarController extends Controller
{
    public function exportar(Request $request){
        $dados = $request->get('dados');

        $arquivo = "Export - ".date('d.m.Y - H:i').'.xls';

        // Configurações header para forçar o download
        header ("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
        header ("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
        header ("Cache-Control: no-cache, must-revalidate");
        header ("Pragma: no-cache");
        header ("Content-type: application/x-msexcel");
        header ("Content-Disposition: attachment; filename=\"{$arquivo}\"" );
        header ("Content-Description: PHP Generated Data" );
        // Envia o conteúdo do arquivo
        echo $dados;
        exit();
    }
}
