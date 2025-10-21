<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use App\Services\FcmService;

class NotificationController extends Controller
{
    protected $fcmService;

    public function __construct(FcmService $fcmService)
    {
        $this->fcmService = $fcmService;
    }

    // POST /api/notifications/test
    public function testNotification(Request $request)
    {
        try {
            // Manual validation catch block
            try {
                $validated = $request->validate([
                    'token' => 'required|string',
                    'title' => 'required|string',
                    'body'  => 'required|string',
                    'type'  => 'nullable|string|in:reward,route_update,admin_alert'
                ]);
            } catch (ValidationException $e) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validation failed',
                    'errors'  => $e->errors(),
                ], 422);
            }

            // Send notification using FCM service
            $response = $this->fcmService->sendNotification(
                $validated['token'],
                $validated['title'],
                $validated['body'],
                ['type' => $validated['type'] ?? 'reward']
            );

            return response()->json([
                'success' => true,
                'message' => 'Notification sent successfully!',
                'response' => $response,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to send notification.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
