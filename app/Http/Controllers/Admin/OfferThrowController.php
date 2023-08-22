<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\UserGain;
use App\Models\Wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class OfferThrowController extends Controller
{
    public function getOffer (Request $request)
    {
     if ($request->Amount) {
         $request->amount = $request->Amount ;
     }
     if ($request->OID) {
         $request->oid = $request->OID ;
     }

        $data['description'] = 'Coin add by Offer OID '.$request->oid;
        $data['amount'] = $request->amount ;
        $data['user_id'] = $request->user_id;
        $data['gain_status'] = 'Gain';

        UserGain::create($data);

        Wallet::addBalancePoint($data['user_id'],$data['amount']);
        //return$data;
        return 'Offer send success';
    }
}
