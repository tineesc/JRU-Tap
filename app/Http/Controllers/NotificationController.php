<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function clear()
    {
        Auth::user()
            ->notifications()
            ->delete();

        return back()->with('success', 'Notifications cleared successfully.');
    }
}
