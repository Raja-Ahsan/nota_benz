<?php

namespace App\Http\Controllers;

use App\Models\NewsletterSubscriber;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class NewsletterController extends Controller
{
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'email' => ['required', 'email', 'max:255'],
        ]);

        $email = strtolower(trim($validated['email']));

        $existing = NewsletterSubscriber::query()->where('email', $email)->first();

        if ($existing) {
            if ($existing->status !== 'active') {
                $existing->update(['status' => 'active']);
            }

            return response()->json([
                'success' => true,
                'message' => __('You\'re already on the list — welcome back.'),
            ]);
        }

        NewsletterSubscriber::create([
            'email' => $email,
            'status' => 'active',
        ]);

        return response()->json([
            'success' => true,
            'message' => __('You\'re in — welcome to the Inner Circle.'),
        ]);
    }
}
