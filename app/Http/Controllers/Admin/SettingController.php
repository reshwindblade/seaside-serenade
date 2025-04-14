<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\File;

class SettingsController extends Controller
{
    /**
     * Display the site settings.
     */
    public function index()
    {
        $settings = [
            'site_name' => config('app.name'),
            'site_description' => config('app.description', 'A magical girl portal for players and game masters'),
            'disable_registration' => config('app.disable_registration', false),
            'admin_email' => config('mail.from.address'),
            'enable_social_login' => config('app.social_login.enabled', false),
        ];
        
        return response()->json(['settings' => $settings]);
    }

    /**
     * Update the site settings.
     */
    public function update(Request $request)
    {
        $validated = $request->validate([
            'site_name' => 'sometimes|required|string|max:255',
            'site_description' => 'sometimes|required|string|max:500',
            'disable_registration' => 'sometimes|boolean',
            'admin_email' => 'sometimes|required|email',
            'enable_social_login' => 'sometimes|boolean',
        ]);
        
        // Update settings in .env file
        if (isset($validated['site_name'])) {
            $this->updateEnvVariable('APP_NAME', $validated['site_name']);
        }
        
        if (isset($validated['site_description'])) {
            $this->updateEnvVariable('APP_DESCRIPTION', $validated['site_description']);
        }
        
        if (isset($validated['disable_registration'])) {
            $this->updateEnvVariable('DISABLE_REGISTRATION', $validated['disable_registration'] ? 'true' : 'false');
        }
        
        if (isset($validated['admin_email'])) {
            $this->updateEnvVariable('MAIL_FROM_ADDRESS', $validated['admin_email']);
        }
        
        if (isset($validated['enable_social_login'])) {
            $this->updateEnvVariable('SOCIAL_LOGIN_ENABLED', $validated['enable_social_login'] ? 'true' : 'false');
        }
        
        // Clear configuration cache
        Cache::forget('config.app');
        
        return response()->json([
            'message' => 'Settings updated successfully',
            'settings' => $this->index()->original['settings']
        ]);
    }
    
    /**
     * Update an environment variable in the .env file.
     */
    private function updateEnvVariable($key, $value)
    {
        $path = base_path('.env');
        
        if (File::exists($path)) {
            // If value contains spaces, wrap in quotes
            if (strpos($value, ' ') !== false && !str_starts_with($value, '"') && !str_ends_with($value, '"')) {
                $value = '"' . $value . '"';
            }
            
            // Replace or add the environment variable
            $envContent = File::get($path);
            
            // Check if the key exists
            if (strpos($envContent, "{$key}=") !== false) {
                // Replace existing key
                $envContent = preg_replace("/{$key}=(.*)/", "{$key}={$value}", $envContent);
            } else {
                // Add new key
                $envContent .= "\n{$key}={$value}";
            }
            
            File::put($path, $envContent);
        }
    }
}