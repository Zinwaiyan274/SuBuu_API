<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Currency;
use App\Models\CurrencyConvert;
use Illuminate\Http\Request;

class CurrencyConvertController extends Controller
{
    public function maanIndex()
    {
        $currencies = Currency::where('status',1)->get();
        $currencyConverts = CurrencyConvert::with('currency')
                                ->when(request('search'), function($q) {
                                    $q->where('par_currency', 'like', '%'.request('search').'%')
                                    ->orWhere('coin', 'like', '%'.request('search').'%');
                                })
                                ->orWhereHas('currency', function($query) {
                                    $query->where('name', 'like', '%'.request('search').'%');
                                })
                                ->latest()
                                ->paginate(10);

        return view('back-end.pages.currency-convert.index',compact('currencyConverts','currencies'));
    }

    public function maanStore (Request $request)
    {
        $this->validate($request,[
            'coin' =>  'required|integer|max:9000000',
            'par_currency' =>  'required|integer|max:9000000',
            'currency_id' =>  'required|exists:currencies,id|unique:currency_converts',
        ]);

        $data = $request->only('currency_id','par_currency','coin') ;
        CurrencyConvert::create($data) ;

        return response()->json([
            'message' => __('Currency convert created successfully.'),
            'redirect' => route('currency-convert.index'),
        ]);
    }

    public function maanUpdate (Request $request, CurrencyConvert $currencyConvert)
    {
        $this->validate($request,[
            'coin' =>  'required|integer|max:9000000',
            'par_currency' =>  'required|integer|max:9000000',
            'currency_id'   =>  'required|exists:currencies,id|unique:currency_converts,currency_id,'.$currencyConvert->id,
        ]);

        $data = $request->only('currency_id','par_currency','coin') ;

        $currencyConvert->update($data) ;
        return response()->json([
            'message' => __('Currency convert updated successfully.'),
            'redirect' => route('currency-convert.index'),
        ]);
    }

    public function maanDestroy(CurrencyConvert $currencyConvert)
    {
        $currencyConvert->delete();
        return response()->json([
            'message' => __('Currency convert deleted successfully.'),
            'redirect' => route('currency-convert.index'),
        ]);
    }
}
