<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use App\Models\User;

class EnsureUserIsVerified
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
{
    $user = Auth::user();
        
        if ($user) {
            if (!$user->is_verified) {
                return response()->json(['error' => 'Your account is not verified.'], 403);
            }
        } else {
            
            $user = User::where('email', $request->email)->first();
            if (!$user) {
                return response()->json(['error' => 'User not found.'], 404);
            }
            if (!$user->is_verified) {
                return response()->json(['error' => 'Your account is not verified.'], 403);
            }
        }

        return $next($request);
}

}
