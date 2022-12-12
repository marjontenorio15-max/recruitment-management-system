<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactFormRequest;
use App\Models\Recipient;
use App\Notifications\ContactFormMessage;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    //
    public function show()
    {
        return view('pages.contacts');
    }
    public function mailContactForm(ContactFormRequest $message, Recipient $recipient)
    {
        $recipient->notify(new ContactFormMessage($message));

        return redirect()->back()->with('message', 'Thanks for your message! We will get back to you soon!');
    }
}
