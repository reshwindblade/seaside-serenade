<?php

namespace App\Helpers;

class ApiDocsHelper
{
    /**
     * Get the entire API documentation configuration
     * 
     * @return array
     */
    public static function getConfig(): array
    {
        return config('api-docs', []);
    }

    /**
     * Get authentication endpoint details
     * 
     * @return array
     */
    public static function getAuthenticationDetails(): array
    {
        return config('api-docs.authentication', []);
    }

    /**
     * Get standard error response structures
     * 
     * @return array
     */
    public static function getErrorResponses(): array
    {
        return config('api-docs.error_responses', []);
    }

    /**
     * Format an API parameter description
     * 
     * @param array $param
     * @return string
     */
    public static function formatParameterDescription(array $param): string
    {
        $description = $param['description'] ?? 'No description provided';
        $type = $param['type'] ?? 'mixed';
        $required = $param['required'] ?? false;

        return sprintf(
            "%s (%s) - %s",
            $type,
            $required ? 'required' : 'optional',
            $description
        );
    }

    /**
     * Generate cURL command for a specific endpoint
     * 
     * @param string $method
     * @param string $endpoint
     * @param array $data
     * @return string
     */
    public static function generateCurlCommand(string $method, string $endpoint, array $data = []): string
    {
        $baseUrl = config('app.url', 'https://example.com');
        $method = strtoupper($method);
        
        $curlCommand = "curl -X {$method} \"{$baseUrl}{$endpoint}\" \\\n";
        $curlCommand .= "     -H \"Content-Type: application/json\" \\\n";
        $curlCommand .= "     -H \"Accept: application/json\" \\\n";
        $curlCommand .= "     -H \"Authorization: Bearer {your_api_token}\" \\\n";
        
        if (!empty($data)) {
            $jsonData = json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
            $curlCommand .= "     -d '{$jsonData}'";
        }
        
        return $curlCommand;
    }
}