<?php

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class SupabaseService
{
    protected $client;
    protected $baseUrl;
    protected $apiKey;

    public function __construct()
    {
        $this->client = new Client();
        $this->baseUrl = env('VITE_SUPABASE_URL'); // Ensure this is set correctly in .env
        $this->apiKey = env('VITE_SUPABASE_ANON_KEY'); // Ensure this is set correctly in .env
    }

    /**
     * Sign up a new user in Supabase
     */
    public function signUpUser($email, $password, $firstName = '', $lastName = '')
    {
        try {
            $response = $this->client->post($this->baseUrl . '/auth/v1/signup', [
                'headers' => [
                    'apikey' => $this->apiKey,
                    'Content-Type' => 'application/json',
                ],
                'json' => [
                    'email' => $email,
                    'password' => $password,
                    'data' => [
                        'first_name' => $firstName,
                        'last_name' => $lastName
                    ]
                ],
            ]);

            return json_decode($response->getBody(), true);
        } catch (RequestException $e) {
            return [
                'error' => [
                    'message' => 'Failed to sign up user: ' . $e->getMessage()
                ]
            ];
        }
    }

    /**
     * Sign in a user using Supabase
     */
    public function signInUser($email, $password)
    {
        try {
            $response = $this->client->post($this->baseUrl . '/auth/v1/token', [
                'headers' => [
                    'apikey' => $this->apiKey,
                    'Content-Type' => 'application/json',
                ],
                'json' => [
                    'grant_type' => 'password', // This is correct for password-based login
                    'email' => $email,
                    'password' => $password,
                ],
            ]);

            return json_decode($response->getBody(), true);
        } catch (RequestException $e) {
            return [
                'error' => [
                    'message' => 'Failed to sign in: ' . $e->getMessage()
                ]
            ];
        }
    }

    /**
     * Retrieve user profile data from Supabase
     */
    public function getUserProfile($userId)
    {
        try {
            $response = $this->client->get($this->baseUrl . '/rest/v1/profiles', [
                'headers' => [
                    'apikey' => $this->apiKey,
                    'Authorization' => 'Bearer ' . $this->apiKey,
                    'Content-Type' => 'application/json',
                ],
                'query' => ['user_id' => $userId],
            ]);

            return json_decode($response->getBody(), true);
        } catch (RequestException $e) {
            return [
                'error' => [
                    'message' => 'Failed to retrieve user profile: ' . $e->getMessage()
                ]
            ];
        }
    }

    /**
     * Update user profile in Supabase
     */
    public function updateUserProfile($userId, array $data)
    {
        try {
            $response = $this->client->patch($this->baseUrl . '/rest/v1/profiles?user_id=eq.' . $userId, [
                'headers' => [
                    'apikey' => $this->apiKey,
                    'Authorization' => 'Bearer ' . $this->apiKey,
                    'Content-Type' => 'application/json',
                ],
                'json' => $data,
            ]);

            return json_decode($response->getBody(), true);
        } catch (RequestException $e) {
            return [
                'error' => [
                    'message' => 'Failed to update user profile: ' . $e->getMessage()
                ]
            ];
        }
    }

    /**
     * Get user by email from Supabase
     */
    public function getUserByEmail($email)
    {
        try {
            $response = $this->client->get($this->baseUrl . '/rest/v1/users', [
                'headers' => [
                    'apikey' => $this->apiKey,
                    'Authorization' => 'Bearer ' . $this->apiKey,
                    'Content-Type' => 'application/json',
                ],
                'query' => ['email' => $email],
            ]);

            return json_decode($response->getBody(), true);
        } catch (RequestException $e) {
            return [
                'error' => [
                    'message' => 'Failed to get user by email: ' . $e->getMessage()
                ]
            ];
        }
    }
}