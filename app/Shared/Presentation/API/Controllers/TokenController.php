<?php

declare(strict_types=1);

namespace App\Shared\Presentation\API\Controllers;

use App\Http\Controllers\Controller;
use App\Shared\Infrastructure\Logging\Constants\LogChannels;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class TokenController extends Controller
{
    public static function AuthToken(Request $request)
    {
        try {
            if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
                $user = Auth::user();
                $token = $user->createToken('web-token', [$user->is_admin ? 'manage' : 'read'],);
                return ['success' => true, 'message' => 'Token generated', 'token' => $token->plainTextToken];
            } else {
                return ['success' => false,  'message' => 'Invalid username or password'];
            }
        } catch (\Exception $e) {
            Log::channel(LogChannels::ERROR)->error('fail to generating API token', [
                'error' => $e->getMessage(),
                'error_source' => "Line : " . __LINE__ . " , in file : " . __FILE__,
            ]);
            return ['success' => false, 'message' => 'Internal server error , please contact support team !'];
        }
    }
}
