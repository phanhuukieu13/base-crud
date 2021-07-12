<?php

namespace App\Http\Controllers;

use App\Mail\FirstEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{
    public function sendEmail() {

        $to_email = "kieuphph07378@fpt.edu.vn";

        Mail::to($to_email)->send(new FirstEmail);

        return "<p> Success! Your E-mail has been sent.</p>";

    }
}
