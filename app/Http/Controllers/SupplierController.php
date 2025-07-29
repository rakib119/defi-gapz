<?php

namespace App\Http\Controllers;

use App\Models\AccountStatement;
use App\Models\AccountTransaction;
use App\Models\EarnFromInvestment;
use App\Models\supplier;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    public function index()
    {
        return view('backend.supplier.index', [
            'suppliers' => supplier::all()
        ]);
    }
    public function create()
    {
        return view('backend.supplier.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'supplier_name' => 'required|max:255',
            'region' => 'required|max:255',
            'min_market_price' => 'required|numeric|lt:max_market_price',
            'max_market_price' => 'required|numeric|gt:min_market_price',
            'min_transaction_price' => 'required|numeric|lt:max_transaction_price|gt:max_market_price',
            'max_transaction_price' => 'required|numeric|gt:min_transaction_price|gt:max_market_price',
            'currency' => 'required|max:10',
        ]);
        supplier::insert([
            'supplier_name' =>  $request->supplier_name,
            'region' => $request->region,
            'min_market_price' => $request->min_market_price,
            'max_market_price' => $request->max_market_price,
            'min_transaction_price' => $request->min_transaction_price,
            'max_transaction_price' => $request->max_transaction_price,
            'currency' => $request->currency,
            'created_at' => Carbon::now(),
        ]);
        return redirect()->route('supplier.index')->with('success', 'success');
    }
    public function edit(supplier $supplier)
    {
        return view('backend.supplier.edit', compact('supplier'));
    }
    public function update(Request $request, supplier $supplier)
    {
        $request->validate([
            'supplier_name' => 'required|max:255',
            'region' => 'required|max:255',
            'min_market_price' => 'required|numeric|lt:max_market_price',
            'max_market_price' => 'required|numeric|gt:min_market_price',
            'min_transaction_price' => 'required|numeric|lt:max_transaction_price|gt:max_market_price',
            'max_transaction_price' => 'required|numeric|gt:min_transaction_price|gt:max_market_price',
            'currency' => 'required|max:10',
        ]);
        $supplier->supplier_name =  $request->supplier_name;
        $supplier->region =  $request->region;
        $supplier->min_market_price =  $request->min_market_price;
        $supplier->max_market_price =  $request->max_market_price;
        $supplier->min_transaction_price =  $request->min_transaction_price;
        $supplier->max_transaction_price =  $request->max_transaction_price;
        $supplier->currency =  $request->currency;
        $supplier->save();
        return redirect()->route('supplier.index')->with('success', 'success');
    }
    public function post_money(EarnFromInvestment $investment)
    {
        $user_info = User::where('uid', $investment->uid)->first();
        $balance = $user_info->account_statement->balance;
        $AccountStatement =  AccountStatement::where('uid', $investment->uid)->first();
        AccountTransaction::insert([
            'uid' => $investment->uid,
            'old_balance' => $balance,
            'transaction_type' => 4,
            'transaction_id' => $investment->transaction_id,
            'transaction_amount' => $investment->investment_amount,
            'profit' => $investment->total_profit,
            'subtotal' => $investment->sub_total,
            'current_balance' => $balance + $investment->sub_total,
            'created_at' => Carbon::now(),
        ]);
        $AccountStatement->balance = $balance + $investment->sub_total;
        $AccountStatement->total_investment = $AccountStatement->total_investment + $investment->sub_total;
        $AccountStatement->save();
        $investment->status = 1;
        $investment->save();
        return back()->with('success', 'success');
    }
}
