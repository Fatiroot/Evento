<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class TicketPdfController extends Controller
{
    public function generateTicket(Request $request,Event $event){
        $pdf = PDF::loadView('ticket', ['event' => $event]);
        return $pdf->download('ticket.pdf');
        return redirect()->route('event.show')->with('success', 'Your reservation has been sent successfully.');

    }
}
