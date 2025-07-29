<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function referral_report ($num=10)
    {
        // get top ref uid
        $top_ref = DB::table('users')
        ->where('reference','!=',null)
        ->select('reference', DB::raw('COUNT(reference) as total_ref'))
        ->groupBy('reference')
        ->orderByDesc('total_ref')
        ->take($num)
        ->get();

        $top_ref_arr = array();
        $top_ref_uid = array();
        $i=0;
        foreach ($top_ref as $v) {
            $top_ref_arr[$v->reference]['total_ref'] = $v->total_ref;
            $top_ref_uid[$i++] = "$v->reference";
        }

        // Get Referral information
        $ref_info = DB::table('users','a')
        ->join('account_statements as b','b.uid','=','a.uid')
        ->whereIn('a.uid', $top_ref_uid)
        ->select('a.name','a.email','a.uid','b.total_deposite')
        ->get();

        foreach ($ref_info as $v) {
            $top_ref_arr[$v->uid]['uid'] = $v->uid;
            $top_ref_arr[$v->uid]['name'] = $v->name;
            $top_ref_arr[$v->uid]['email'] = $v->email;
            $top_ref_arr[$v->uid]['deposite'] = $v->total_deposite;
        }


        // Get Referral Amount
        $ref_amount = DB::table('users','a')
            ->join('account_statements as b','b.uid','=','a.uid')
            ->whereIn('a.reference', $top_ref_uid)
            ->select('a.reference',DB::raw('sum(b.total_deposite) as ref_amount'))
            ->groupBy('a.reference')
            ->get();

        foreach ($ref_amount as $v) {
            $top_ref_arr[$v->reference]['ref_amount'] = $v->ref_amount;
        }

        // Sort Data
        usort($top_ref_arr, function ($a, $b) {
            return $b['ref_amount'] <=> $a['ref_amount'];
        });
        // return $top_ref_arr;

        return view('backend.report.referral',compact('top_ref_arr','num'));
    }
}
