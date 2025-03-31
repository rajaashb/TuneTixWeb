<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ConcertController extends Controller
{
    // Display a list of concerts
    public function index()
    {
        $concerts = Concert::all();
        return view('concerts.index', compact('concerts'));
    }

    // Show a single concert with tickets
    public function show(Concert $concert) // Route model binding
    {
        $concert->load('tickets'); // Load related tickets
        return view('concerts.show', compact('concert'));
    }

    // Show the create form (Only for admin)
    public function create()
    {
        return view('concerts.create');
    }

    // Store a new concert
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'venue' => 'required|string|max:255',
            'date' => 'required|date',
            'time' => 'required|date_format:H:i', // Ensures correct time format (HH:MM)
            'price' => 'required|numeric|min:0',
        ]);

        // Store as separate date and time fields
        Concert::create([
            'name' => $validated['name'],
            'venue' => $validated['venue'],
            'date' => $validated['date'],  // Storing the date field separately
            'time' => $validated['time'],  // Storing the time field separately
            'price' => $validated['price'],
        ]);

        return redirect()->route('concerts.index')->with('success', 'Concert created successfully!');
    }

    // Delete a concert (Only for admin)
    public function destroy(Concert $concert)
    {
        $concert->delete();
        return redirect()->route('concerts.index')->with('success', 'Concert deleted successfully.');
    }
}
