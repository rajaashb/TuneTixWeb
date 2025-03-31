<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TicketController extends Controller
{
    // Show all tickets for a specific concert
    public function index($concertId)
    {
        $concert = Concert::findOrFail($concertId);
        $tickets = Ticket::where('concert_id', $concertId)->get();

        return view('tickets.index', compact('concert', 'tickets'));
    }

    // Show details of a specific ticket
    public function show(Ticket $ticket) // Route model binding
    {
        return view('tickets.show', compact('ticket'));
    }

    // Store a new ticket (Admin function)
    public function store(Request $request)
    {
        $validated = $request->validate([
            'concert_id' => 'required|exists:concerts,id',
            'type' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:1'
        ]);

        Ticket::create($validated);
        return redirect()->route('tickets.index', $request->concert_id)->with('success', 'Ticket added successfully.');
    }

    // Delete a ticket (Admin function)
    public function destroy($id)
    {
        $ticket = Ticket::findOrFail($id);
        $concertId = $ticket->concert_id;
        $ticket->delete();

        return redirect()->route('tickets.index', $concertId)->with('success', 'Ticket deleted successfully.');
    }
}
