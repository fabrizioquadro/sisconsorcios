<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use LifenPag\Asaas\V3\Client;
use LifenPag\Asaas\V3\Domains\Customer as CustomerDomain;
use LifenPag\Asaas\V3\Domains\Payment as PaymentDomain;
use LifenPag\Asaas\V3\Entities\Customer as CustomerEntity;
use LifenPag\Asaas\V3\Collections\Customer as CustomerCollection;
use LifenPag\Asaas\V3\Entities\Payment as PaymentEntity;
use App\Models\Parcela;

class NotificacaoController extends Controller
{
    public function index(Request $request){
        $json = file_get_contents('php://input'); // Recebo o Json
        $arr = json_decode($json, true); // Transformo para Array

        if($arr){
            $event      = $arr['event'];
            if($event == "PAYMENT_RECEIVED"){

                $vlRecebido   = $arr['payment']['value'];
                $pay_asaas  = $arr['payment']['id'];
                $dtRecebimento   = $arr['payment']['confirmedDate'];
                $cobranca   = $arr['payment']['billingType'];
                $invoicenum = $arr['payment']['invoiceNumber'];
                $data = $arr['payment']['dueDate'];
                $custon_id = $arr['payment']['customer'];


                //vamos buscar os dados do pagamento da parcela
                $parcela = Parcela::where('idPagamento', $pay_asaas)->first();

                if($parcela){
                    $parcela->stParcela = "Paga";
                    $parcela->dtPagamento = $dtRecebimento;
                    $parcela->vlPagamento = $vlRecebido;

                    $parcela->save();
                }
            }
        }
    }
}
