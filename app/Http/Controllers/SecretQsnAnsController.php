<?php

namespace App\Http\Controllers;

use App\Models\SecretQsnAns;
use Carbon\Carbon;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SecretQsnAnsController extends Controller
{
    private function make_ans_array($request,$for_judge = false)
    {
        $ans_arr = array();
        $uid = auth_uid();
        foreach ($request as $key => $ans)
        {
            // make ans array
            $ans = trim($ans);
            if($key != '_token' && $ans!=null && $ans!=""){
                $index = explode('**',$key);
                $id = end($index);
                if ($for_judge) {
                    $ans_arr[$id] = [
                        'qsn_id'=> $id,
                        'answare'=> strtolower(trim($ans))
                    ];
                }else{
                    $ans_arr[$id] = [
                        'uid'=> $uid,
                        'qsn_id'=> $id,
                        'answare'=> strtolower(trim($ans)),
                        'created_at'=> Carbon::now(),
                    ];
                }

            }

        }
        return $ans_arr;
    }
    public function set_trans_pass() {
        if(auth()->user()->transaction_password){
            return back()->with('error','Access Restricted');
        }else{
            return view('frontend.mine.trans_pass.trans_pass_conditional_form');
        }
    }
    public function update_trans_pass () {
        if(auth()->user()->transaction_password){
            return view('frontend.mine.trans_pass.update_trans_pass');
        }else{
            return back()->with('error','Access Restricted');
        }

    }
    public function judge_ans ()
    {
        $ans_arr =$this->make_ans_array($_POST,true) ;
        $previous_ans = DB::table('secret_qsn_ans')->select(['qsn_id','answare'])->where('uid',auth_uid())->get();
        $correct_ans = 0;
        foreach ($ans_arr as  $cu_a) {
            foreach ($previous_ans as  $pv_a) {
                if ($cu_a['qsn_id'] == $pv_a->qsn_id && $cu_a['answare'] == $pv_a->answare) {
                    // increment the counter variable if there is a match
                    $correct_ans++;
                }
            }
        }

        if($correct_ans > 1){
            session()->put('correct_ans', $correct_ans);
            return back()->with('success','Now you are able to modify your transaction password ');
        }else{
            return back()->with('error','Your security answers are not matching. try again !');
        }
    }
    public function create(){
        $ans_arr =$this->make_ans_array($_POST) ;
        $status = DB::table('secret_qsn_ans')->insert($ans_arr);
        $total_ans = DB::table('secret_qsn_ans')->where('uid',auth_uid())->count();
        if ($status) {
            if( $total_ans == 1 ){
                return back()->with('error','At least one more answer needed');
            }else{
                return back()->with('success','Now you are able to set your transaction password ');
            }
        }
    }


}
