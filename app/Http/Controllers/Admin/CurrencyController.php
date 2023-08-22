<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Currency;
use Illuminate\Http\Request;

class CurrencyController extends Controller
{
    public function maanIndex()
    {
        $currencies = Currency::orderBy('id')->orderBy('status', 'DESC')
                        ->when(request('search'), function($q) {
                            $q->where('name', 'like', '%'.request('search').'%')
                            ->orWhere('iso_code', 'like', '%'.request('search').'%')
                            ->orWhere('symbol', 'like', '%'.request('search').'%');
                        })
                        ->paginate(10);

        return view('back-end.pages.currency.index', compact('currencies'));
    }

    public function maanStore(Request $request)
    {
        $request->validate([
            'symbol'    => 'required|string|max:100',
            'iso_code'  => 'required|string|max:100',
            'name'      => 'required|string|min:2|max:1000',
        ]);

        // data store ...
        $currencies = new Currency();
        $currencies->name = $request->name;
        $currencies->iso_code = $request->iso_code;
        $currencies->symbol = $request->symbol;
        $currencies->status = $request->status;
        $currencies->save();

        return response()->json([
            'message' => __('Currency created successfully.'),
            'redirect' => route('currency.index'),
        ]);
    }

    public function maanEdit(Currency $currency)
    {
        return view('back-end.pages.currency.edit', [
                'currency' => $currency
            ]
        );
    }

    public function maanUpdate(Request $request, Currency $currency)
    {
        // data validation ...
        $request->validate([
            'symbol'    => 'required|string|max:100',
            'iso_code'  => 'required|string|max:100',
            'name'      => 'required|string|min:2|max:1000',
        ]);

        //data update ...
        $currency->name       = $request->name;
        $currency->iso_code   = $request->iso_code;
        $currency->symbol     = $request->symbol;
        $currency->status     = $request->status;
        $currency->save();

        return response()->json([
            'message' => __('Currency updated successfully.'),
            'redirect' => route('currency.index'),
        ]);
    }

    public function maanDestroy(Currency $currency)
    {
        $currency->delete();
        return response()->json([
            'message' => __('Currency deleted successfully.'),
            'redirect' => route('currency.index'),
        ]);
    }
}
