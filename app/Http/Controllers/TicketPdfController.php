<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Mail;

class TicketPdfController extends Controller
{
    public function generateTicket(Event $event){
        $pdf = PDF::loadView('ticket', ['event' => $event]);
        return $pdf->download('ticket.pdf');
        return redirect()->route('event.show')->with('success', 'Your reservation has been sent successfully.');

    }



}
