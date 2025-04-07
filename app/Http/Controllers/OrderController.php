<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    // Show all orders for the logged-in user
    public function index()
    {
        $orders = Order::with('ticket.concert')->where('user_id', Auth::id())->get();
        return view('orders.index', compact('orders'));
    }

    // Show details of a specific order
    public function show(Order $order) // Route model binding
    {
        if ($order->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        return view('orders.show', compact('order'));
    }

    // Store a new order
    public function store(Request $request)
    {
        $validated = $request->validate([
            'ticket_id' => 'required|exists:tickets,id',
            'quantity' => 'required|integer|min:1'
        ]);

        $ticket = Ticket::findOrFail($request->ticket_id);

        // Ensure enough tickets are available
        if ($ticket->quantity < $request->quantity) {
            return back()->with('error', 'Not enough tickets available.');
        }

        // Create the order
        $order = Order::create([
            'user_id' => Auth::id(),
            'ticket_id' => $ticket->id,
            'quantity' => $validated['quantity'],
            'total_price' => $validated['quantity'] * $ticket->price
        ]);

        // Reduce the ticket quantity
        $ticket->decrement('quantity', $validated['quantity']);

        return redirect()->route('orders.show', $order->id)->with('success', 'Order placed successfully.');
    }
}
