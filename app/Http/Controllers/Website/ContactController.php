<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Mail\ContactEmail;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function contact()
    {
        $setting = Setting::first();
        return view('website.contact', compact('setting'));
    }

    public function sendMail(Request $request)
    {
        try {
            $details = [
                'title' => 'Mail from contact us',
                'message' => $request->message,
            ];
    
            if ($request->subject) {
                $details['subject'] = $request->subject;
            }
    
            $email = Setting::first()->email;
           
            Mail::to($email)->send(new ContactEmail($details));
            session()->flash('send-success');
            return redirect(route('website.contact'));
        } catch (\Exception $e) {
            return $e->getMessage();
            session()->flash('error');
            return redirect(route('website.contact'));
        }
    }
}
