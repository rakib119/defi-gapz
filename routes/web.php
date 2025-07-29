<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\BlockchainPaymentController;
use App\Http\Controllers\CompetitionController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\EarnController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\MineController;
use App\Http\Controllers\NoticeController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\SecretQsnAnsController;
use App\Http\Controllers\ServiceFeesController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\TransactionHistoryController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Schema;

Auth::routes(['verify' => true]);
//
// Front end
Route::get('/', [FrontendController::class, 'index'])->name('index');
Route::get('about-us', [FrontendController::class, 'about_us'])->name('about-us');
Route::get('contact-us', [FrontendController::class, 'contact_us'])->name('contact-us');
Route::get('privacy/policy', [FrontendController::class, 'privacy_policy'])->name('privacy_policy');
Route::get('download/center', [FrontendController::class, 'download_center'])->name('download_center');
Route::get('t&c', [FrontendController::class, 'terms_and_cond'])->name('t&c');
Route::post('contact-post', [ContactController::class, 'contact_post'])->name('contact-post');
Route::get('clr',[ScheduleController::class,'teamIncomeScheduler']);
Route::get('s', [FrontendController::class, 's'])->name('s');
Route::post('test', [FrontendController::class, 'test'])->name('test');
Route::middleware(['auth' ])->group(function () { //,'verified'
    Route::get('send-mail', [MailController::class, 'index'])->name('send_mail_view');
    Route::post('send-mail-post', [MailController::class, 'send_mail'])->name('send_mail_post');
    Route::get('profile', [FrontendController::class, 'profile'])->name('profile');
    Route::get('deposit', [TransactionController::class, 'deposit_view'])->name('deposit_view');
    Route::post('make/deposit/request', [TransactionController::class, 'make_deposit_request'])->name('make_deposit_request');
    Route::get('trade', [FrontendController::class, 'transaction_hall'])->name('transactionHall');
    Route::get('roi', [FrontendController::class, 'view_earn_page'])->name('earn');
    Route::get('mine', [FrontendController::class, 'view_mine_page'])->name('mine');
    Route::post('get/user/name', [FrontendController::class, 'get_user_name'])->name('get_user_name');
    Route::post('check/balance', [CompetitionController::class, 'check_balance'])->name('check_balance');
    Route::post('get/compitition/pricing', [CompetitionController::class, 'get_compitition_pricing'])->name('get_compitition_pricing');
    Route::post('/compitition/sell', [CompetitionController::class, 'compitition_sell'])->name('compitition_sell');
    Route::get('competition/statistics', [CompetitionController::class, 'competition_statistics'])->name('competition_statistics');
    // mine page
    Route::get('persoal-information', [MineController::class, 'persoal_information'])->name('persoal_information');
    Route::post('change/name', [MineController::class, 'change_name'])->name('change_name');
    Route::post('change/wallet/address', [MineController::class, 'change_wallet_address'])->name('change_wallet_address');
    Route::post('add/bank/details', [MineController::class, 'add_bank_details'])->name('add_bank_details');
    Route::get('deposit/records', [MineController::class, 'deposit_records'])->name('deposit_records');
    Route::get('withdrawal/records', [MineController::class, 'withdrawal_records'])->name('withdrawal_records');
    Route::get('withdraw/money', [MineController::class, 'withdraw_money'])->name('withdraw_money');
    Route::post('withdraw/otp', [MineController::class, 'withdraw_otp'])->name('withdraw_otp');
    Route::get('transfer', [MineController::class, 'transfer_money_form'])->name('transfer_money_form');
    Route::post('transfer/otp', [MineController::class, 'transfer_otp'])->name('transfer_otp');
    Route::post('transfer/money/into/account', [MineController::class, 'transfer_money_into_account'])->name('transfer_money_into_account');
    Route::get('transfer/history', [MineController::class, 'transfer_history'])->name('transfer_history');
    Route::post('send/withdraw/request', [MineController::class, 'send_withdraw_request'])->name('send_withdraw_request');
    Route::get('roi/purchase/{fixed_deposit}', [EarnController::class, 'immediate_purchase'])->name('immediate_purchase');
    Route::post('roi/otp/{fixed_deposit}', [EarnController::class, 'investment_otp'])->name('investment_otp');
    Route::post('roi/money/{fixed_deposit}', [EarnController::class, 'investment_money'])->name('investment_money');
    Route::get('identify/authenticate', [MineController::class, 'identify_authenticate'])->name('identify_authenticate');
    Route::post('identify/authenticate', [MineController::class, 'identify_authenticate_post'])->name('identify_authenticate_post');
    Route::get('my-team', [MineController::class, 'my_team'])->name('my_team');
    Route::get('ceo', [MineController::class, 'merchant_list'])->name('merchant_list');
    Route::get('team/income', [MineController::class, 'team_income_list'])->name('team_income');
    Route::get('cancle', [TransactionController::class, 'cancle'])->name('cancle');
    // transaction Password Create and update
    Route::get('set/trans/pass',[SecretQsnAnsController::class,'set_trans_pass'])->name('set_trans_pass');
    Route::get('update/trans/pass',[SecretQsnAnsController::class,'update_trans_pass'])->name('update_trans_pass');
    Route::post('set_ans', [SecretQsnAnsController::class, 'create'])->name('set_ans.create');
    Route::post('change/transaction/password', [MineController::class, 'change_transaction_password'])->name('change_transaction_password');
    Route::post('judge/ans',[SecretQsnAnsController::class,'judge_ans'])->name('judge_ans');

    // Blockchain Payments
    /* Route::post('/deposit-now', [BlockchainPaymentController::class, 'createPayment'])->name('payment.create');
    Route::post('/webhook/payment', [BlockchainPaymentController::class, 'handleWebhook'])->name('payment.webhook');
    Route::post('success-deposit', [BlockchainPaymentController::class, 'success_deposit'])->name('payment.success');
    Route::get('decline-deposit', [BlockchainPaymentController::class, 'decline_deposit'])->name('payment.cancel'); */

});
//backend
Route::middleware(['auth', 'admin'])->group(function () {//, 'verified'
    Route::get('/admin', [HomeController::class, 'index'])->name('admin');
    Route::put('/change/withdrawal/method/status/{method}', [HomeController::class, 'change_withdrawal_method_status'])->name('change_withdrawal_method_status');
    Route::post('get-users', [HomeController::class, 'get_users'])->name('get_users');
    // user management
    Route::get('users', [HomeController::class, 'users_list'])->name('users');
    Route::get('verify/request/list', [HomeController::class, 'verify_request_list'])->name('verify_request_list');
    Route::get('inbox', [ContactController::class, 'messages'])->name('inbox');
    Route::get('messages/detaills/{message}', [ContactController::class, 'messages_details'])->name('messages_details');
    Route::post('users/destroy/{user}', [HomeController::class, 'destroy'])->name('users.destroy');
    Route::delete('user/delete/permanently/{id}', [HomeController::class, 'user_delete_permanently'])->name('user_delete_permanently');
    Route::get('users/suspended/list', [HomeController::class, 'suspended_user_list'])->name('suspended_user_list');
    Route::get('cancle/suspenssion/{user}', [HomeController::class, 'cancle_suspenssion'])->name('cancle_suspenssion');
    Route::get('user/details/{user}', [HomeController::class, 'user_details'])->name('user_details');
    Route::put('user/update/{user}', [HomeController::class, 'update_user'])->name('user.update');
    Route::put('user/status/update/{user}', [HomeController::class, 'user_status_update'])->name('user_status_update');
    Route::put('user/telegram/update/{user}', [HomeController::class, 'user_telegram_update'])->name('user_telegram_update');
    Route::put('user/verify/{user}', [HomeController::class, 'user_verify'])->name('user_verify');
    Route::get('deposit/request/list', [TransactionController::class, 'deposit_request_list'])->name('deposit_request_list');
    Route::get('withdrawal/request/list', [TransactionController::class, 'withdrawal_request_list'])->name('withdrawal_request_list');
    Route::post('withdrawal/success/{withdraw}', [TransactionController::class, 'withdrawal_success'])->name('withdrawal_success');
    Route::post('withdrawal/decline/{withdraw}', [TransactionController::class, 'withdrawal_decline'])->name('withdrawal_decline');
    Route::post('success-deposit/{inTransaction}', [TransactionController::class, 'success_deposit'])->name('success_deposit');
    Route::get('decline-deposit/{inTransaction}', [TransactionController::class, 'decline_deposit'])->name('decline_deposit');
    Route::post('add-fund', [TransactionController::class, 'add_fund'])->name('add_fund');

    Route::get('service-fees', [ServiceFeesController::class, 'service_fees_list'])->name('service_fees');
    Route::get('edit-service-fees/{service_fee}', [ServiceFeesController::class, 'edit'])->name('service_fees_edit');
    Route::put('update-service-fees/{service_fee}', [ServiceFeesController::class, 'update'])->name('service_fees_update');
    Route::get('fixed-deposit/list', [ServiceFeesController::class, 'fixed_deposit_list'])->name('fixed_deposit_list');
    Route::get('post/money/{investment}', [SupplierController::class, 'post_money'])->name('post_money');
    Route::get('fixed-deposit', [ServiceFeesController::class, 'fixed_deposit'])->name('fixed_deposit');
    Route::get('fixed-deposit/edit/{fixed_deposit}', [ServiceFeesController::class, 'edit_fixed_deposit'])->name('edit_fixed_deposit');
    Route::put('fixed-deposit/update/{fixed_deposit}', [ServiceFeesController::class, 'update_fixed_deposit'])->name('update_fixed_deposit');
    Route::get('Supplier/management', [SupplierController::class, 'index'])->name('supplier_management');
    Route::post('Supplier/store', [SupplierController::class, 'store'])->name('store_supplier');
    Route::resource('supplier', SupplierController::class);
    Route::get('about/edit', [AboutController::class, 'edit'])->name('about.edit');
    Route::put('about/update', [AboutController::class, 'update'])->name('about.update');
    Route::resource('notice', NoticeController::class)->except('show');
    Route::get('transactions/history', [TransactionHistoryController::class, 'transactions_history'])->name('history.transactions');
    Route::get('get/transactions_history', [TransactionHistoryController::class, 'get_transactions_history'])->name('get_transactions_history');
    Route::get('edit/balance/satement/{user}', [HomeController::class, 'edit_blance_statement_form'])->name('edit_blance_statement_form');
    Route::put('edit/balance/satement/{user}', [HomeController::class, 'edit_blance_statement_post'])->name('edit_blance_statement_post');
    Route::get('deduct/balance/{user}', [HomeController::class, 'deduct_blance_form'])->name('deduct_blance_form');
    Route::put('deduct/balance/{user}', [HomeController::class, 'deduct_blance_post'])->name('deduct_blance_post');
    Route::get('team/incomes', [TransactionHistoryController::class, 'team_income_history'])->name('history.team');
    Route::get('history/deposit/{uid}', [TransactionHistoryController::class, 'user_deposit_history'])->name('history.user_deposit');
    Route::get('history/withdrawal/{uid}', [TransactionHistoryController::class, 'user_withdrawal_history'])->name('history.user_withdrawal');
    Route::get('history/transfer/{uid}', [TransactionHistoryController::class, 'user_transfer_history'])->name('history.user_transfer');
    Route::get('history/transfer/received/{uid}', [TransactionHistoryController::class, 'user_transfer_history_received'])->name('history.user_transfer_received');
    Route::get('history/trade/{uid}', [TransactionHistoryController::class, 'user_trade_history'])->name('history.user_trade');
    Route::get('history/team-income/{uid}', [TransactionHistoryController::class, 'user_team_income_history'])->name('history.user_team_income');
    // Report
    Route::get('report/referral/{num?}', [ReportController::class, 'referral_report'])->name('report.referral');

});
Route::get('/test', function () {

    // return  Schema::getColumnListing('users');
    $query_str = 555;
    return  User::Where('role', '!=', '1')
        ->where(function ($query) use ($query_str) {
            $query->orWhere(function ($query) use ($query_str) {
                $except =  ['id', 'role', 'identification_image', 'identification_request_time', 'identification_status', 'identification_time', 'email_verified_at', 'mobile_verified_at', 'password', 'transaction_password', 'telegram', 'remember_token', 'created_at', 'updated_at', 'deleted_at'];
                foreach (Schema::getColumnListing('users') as $value) {
                    if (!in_array($value, $except)) {
                        $query->orWhere($value, 'like', '%' . $query_str . '%');
                    }
                }
            });
        })->take(10)->get();
});
