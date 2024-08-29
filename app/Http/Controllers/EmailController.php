<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ParentNotificationMail;

class EmailController extends Controller
{
    public function sendParentNotification(Request $request)
    {
        $validated = $request->validate([
            'childEmail' => 'required|email',
            'childUsername' => 'required|string',
            'parentEmail' => 'required|email',
        ]);

        try {
            Mail::to($validated['parentEmail'])->send(new ParentNotificationMail($validated['childEmail'], $validated['childUsername']));
            return response()->json(['message' => 'Notification sent to parent.'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to send email.'], 500);
        }
    }
}
