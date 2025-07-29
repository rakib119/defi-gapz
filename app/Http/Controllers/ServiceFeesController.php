<?php

namespace App\Http\Controllers;

use App\Models\AccountStatement;
use App\Models\AccountTransaction;
use App\Models\EarnFromInvestment;
use App\Models\FixedDepositeProfit;
use App\Models\ServiceFees;
use App\Models\TeamIncome;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ServiceFeesController extends Controller
{
    public function service_fees_list()
    {
        return view('backend.service_fees.index', [
            'service_fees' => ServiceFees::all()
        ]);
    }
    public function edit(ServiceFees $service_fee)
    {
        return view('backend.service_fees.edit', compact('service_fee'));
    }
    public function update(Request $request, ServiceFees $service_fee)
    {
        $service_fee->fees = $request->fees;
        $service_fee->save();
        return redirect()->route('service_fees')->with('success', 'Success');
    }
    // fixed depost management
    public function fixed_deposit()
    {
        return view('backend.fixed_deposit.index', [
            'fixed_deposits' => FixedDepositeProfit::all()
        ]);
    }
    public function edit_fixed_deposit(FixedDepositeProfit $fixed_deposit)
    {
        return view('backend.fixed_deposit.edit', compact('fixed_deposit'));
    }
    public function update_fixed_deposit(Request $request, FixedDepositeProfit $fixed_deposit)
    {
        $request->validate([
            'days' => 'required|integer|between:1,30',
            'profit' => 'required|numeric|between:0.00,100',
        ], [
            'days.integer' => 'Please enter a number'
        ]);
        $fixed_deposit->days = $request->days;
        $fixed_deposit->profit = $request->profit;
        $fixed_deposit->save();
        return redirect()->route('fixed_deposit')->with('success', 'updated successfully');
    }
    public function fixed_deposit_list()
    {
        return view('backend.fixed_deposit.list', [
            'investments' => EarnFromInvestment::where('status', 0)->get()
        ]);
    }
}
