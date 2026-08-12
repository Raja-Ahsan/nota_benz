<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\NewsletterSubscriber;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;

class NewsletterSubscriberController extends Controller
{
    public function index(): View
    {
        $subscribers = NewsletterSubscriber::query()->latest()->paginate(20);

        return view('screens.admin.newsletter-subscribers.index', compact('subscribers'));
    }

    public function destroy(NewsletterSubscriber $newsletterSubscriber): JsonResponse
    {
        $newsletterSubscriber->delete();

        return response()->json([
            'success' => true,
            'message' => __('Subscriber removed.'),
        ]);
    }
}
