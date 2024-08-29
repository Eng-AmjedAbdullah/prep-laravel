<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DataDeletionController extends Controller
{
    public function handleDeletionRequest(Request $request)
    {
        // Parse the signed request
        $signedRequest = $request->input('signed_request');
        $data = $this->parseSignedRequest($signedRequest);

        if (!$data) {
            return response()->json(['error' => 'Invalid signed request'], 400);
        }

        $userId = $data['user_id'];

        // Start data deletion logic
        // Here you would delete the user's data from your database
        // For example:
        // User::where('facebook_id', $userId)->delete();

        // Generate a status URL and a confirmation code
        $statusUrl = route('data.deletion.status', ['id' => 'abc123']);
        $confirmationCode = 'abc123'; // Generate a unique confirmation code

        // Respond with the status URL and confirmation code
        return response()->json([
            'url' => $statusUrl,
            'confirmation_code' => $confirmationCode
        ]);
    }

    private function parseSignedRequest($signedRequest)
    {
        list($encodedSig, $payload) = explode('.', $signedRequest, 2);

        $secret = env('FACEBOOK_APP_SECRET'); // Your app secret

        // Decode the data
        $sig = $this->base64UrlDecode($encodedSig);
        $data = json_decode($this->base64UrlDecode($payload), true);

        // Confirm the signature
        $expectedSig = hash_hmac('sha256', $payload, $secret, true);
        if ($sig !== $expectedSig) {
            return null;
        }

        return $data;
    }

    private function base64UrlDecode($input)
    {
        return base64_decode(strtr($input, '-_', '+/'));
    }
}