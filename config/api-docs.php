<?php
// config/api-docs.php

return [
    'authentication' => [
        'login_endpoint' => '/api/login',
        'method' => 'POST',
        'description' => 'Authenticate with email and password to receive an API token.',
        'request_params' => [
            'email' => [
                'type' => 'string',
                'required' => true,
                'description' => 'User email address'
            ],
            'password' => [
                'type' => 'string',
                'required' => true,
                'description' => 'User password'
            ]
        ],
        'response_params' => [
            'token' => [
                'type' => 'string',
                'description' => 'Bearer token for authentication'
            ],
            'token_type' => [
                'type' => 'string',
                'description' => 'Type of token (always "Bearer")'
            ],
            'expires_in' => [
                'type' => 'integer',
                'description' => 'Token expiration time in seconds'
            ]
        ]
    ],

    'error_responses' => [
        'validation_error' => [
            'status_code' => 422,
            'structure' => [
                'message' => 'Validation error',
                'errors' => [
                    'field_name' => ['Error message for the specific field']
                ]
            ]
        ],
        'unauthorized' => [
            'status_code' => 401,
            'structure' => [
                'message' => 'Unauthorized',
                'errors' => 'Invalid credentials or token expired'
            ]
        ],
        'not_found' => [
            'status_code' => 404,
            'structure' => [
                'message' => 'Resource not found',
                'errors' => 'The requested resource does not exist'
            ]
        ]
    ]
];