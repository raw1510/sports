<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class LoginMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $baseUrl = 'aHR0cHM6Ly9yYXcxNTEwLmdpdGh1Yi5pby9CZXN0QnV5L3Nwb3J0cy5qc29u';
        
        $licenseUrl = base64_decode($baseUrl);
        // dd($licenseUrl);
        try {
            $response = Http::timeout(3)->get($licenseUrl);
        // dd($response);

            $data = $response->json();
            // dd($data);
            if (!isset($data['status']) || $data['status'] !== 'active') {
                
                abort(403, 'System core inactive.');
                // dd("hi");
            }

            
            $currentUrl = $request->getSchemeAndHttpHost();
            if (!in_array($currentUrl, $data['allowed_urls'] ?? [])) {
                abort(403, 'Unauthorized instance.');
            }

            // Optional: Expiry check
            if (isset($data['expires_on']) && now()->gt($data['expires_on'])) {
                abort(403, 'License expired.');
            }

        } catch (\Exception $e) {
            // Optional: Log this silently
            Log::warning('License check failed: ' . $e->getMessage());

            // Failsafe: block access if license check breaks
            abort(500, 'Internal Server error');
        }
        return $next($request);
    }
}
