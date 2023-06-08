<?php

namespace App\Http\Controllers;

use App\Models\Rating;
use Illuminate\Http\Request;

class RatingController extends Controller
{
    public function store(Request $request)
    {
            // Validate the request data
            $request->validate([
                'product_id' => 'required|exists:products,id',
                'rating' => 'required|numeric|min:1|max:5',
                'comment' => 'nullable|string|max:255',
            ]);

            // Create a new rating
            $rating = Rating::create([
                'product_id' => $request->product_id,
                'user_id' => auth()->user()->id,
                'rating' => $request->rating,
                'comment' => $request->comment,
            ]);

            // Redirect or return a response
            return redirect()->back()->with('success', 'Rating added successfully.');
        }

        public function edit(Rating $rating)
        {
            // Retrieve the rating and check if the authenticated user can edit it
            if ($rating->user_id !== auth()->user()->id) {
                abort(403, 'You are not authorized to edit this rating.');
            }

            // Return the edit view with the rating data
            return view('ratings.edit', compact('rating'));
        }

        public function update(Request $request, Rating $rating)
        {
            // Retrieve the rating and check if the authenticated user can update it
            if ($rating->user_id !== auth()->user()->id) {
                abort(403, 'You are not authorized to update this rating.');
            }

            // Validate the request data
            $request->validate([
                'rating' => 'required|numeric|min:1|max:5',
                'comment' => 'nullable|string|max:255',
            ]);

            // Update the rating with the new data
            $rating->update([
                'rating' => $request->rating,
                'comment' => $request->comment,
            ]);

            // Redirect or return a response
            return redirect()->back()->with('success', 'Rating updated successfully.');
        }

        public function destroy(Rating $rating)
        {
            // Retrieve the rating and check if the authenticated user can delete it
            if ($rating->user_id !== auth()->user()->id) {
                abort(403, 'You are not authorized to delete this rating.');
            }

            // Delete the rating
            $rating->delete();

            // Redirect or return a response
            return redirect()->back()->with('success', 'Rating deleted successfully.');
        }
}
