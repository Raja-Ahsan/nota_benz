<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Enquiry;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class EnquiryController extends Controller
{
    public function index(): View
    {
        $enquiries = Enquiry::query()->latest()->paginate(15);

        return view('screens.admin.enquiries.index', compact('enquiries'));
    }

    public function show(Enquiry $enquiry): View
    {
        if ($enquiry->status === 'new') {
            $enquiry->update(['status' => 'read']);
        }

        return view('screens.admin.enquiries.show', compact('enquiry'));
    }

    public function updateStatus(Request $request, Enquiry $enquiry): JsonResponse
    {
        $validated = $request->validate([
            'status' => ['required', 'in:new,read,replied,archived'],
        ]);

        $enquiry->update(['status' => $validated['status']]);

        return response()->json([
            'success' => true,
            'message' => __('Enquiry status updated.'),
        ]);
    }

    public function destroy(Enquiry $enquiry): JsonResponse
    {
        $enquiry->delete();

        return response()->json([
            'success' => true,
            'message' => __('Enquiry deleted successfully.'),
        ]);
    }
}
