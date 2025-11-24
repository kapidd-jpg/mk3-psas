<?php

namespace App\Http\Controllers;

use App\Models\Guest;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class GuestController extends Controller
{
    public function show($code)
    {
        $guest = Guest::where('code', $code)->firstOrFail();
        
        // Generate QR Code
        $qrCode = QrCode::size(300)->generate(route('guest.show', $code));
        
        return view('invitation', compact('guest', 'qrCode'));
    }

    public function showQr($code)
    {
        $guest = Guest::where('code', $code)->firstOrFail();
        $qrCode = QrCode::size(400)->generate(route('checkin.scan', $code));
        
        return view('qr-code', compact('guest', 'qrCode'));
    }
}