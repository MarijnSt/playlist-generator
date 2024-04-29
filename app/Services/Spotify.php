<?php

namespace App\Services;

use Carbon\Carbon;
use Illuminate\Http\Client\Response;
use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class Spotify
{
    protected string $clientId;
    protected string $clientSecret;
    protected string $baseUrl;
    protected string $accessToken;
    protected string $refreshToken;
    protected Carbon $expiresIn;
    public function __construct()
    {
        $this->clientId = config('services.spotify.client_id');
        $this->clientSecret = config('services.spotify.client_secret');
        $this->baseUrl = config('services.spotify.base_url');
    }

    /**
     * Get an access token from Spotify.
     * @throws RequestException
     */
    protected function getAccessToken(): string
    {
        // get tokens from session
        $this->accessToken = session('auth.spotify_token');
        $this->refreshToken = session('auth.spotify_refresh_token');
        $this->expiresIn = session('auth.spotify_expires_in');

        // refresh token if it has expired
        if ($this->expiresIn->isPast()) {
            $this->useRefreshToken();
        }

        return $this->accessToken;
    }

    private function useRefreshToken(): void
    {
        $response = Http::withHeaders([
            'Authorization' => 'Basic ' . base64_encode($this->clientId . ':' . $this->clientSecret),
        ])->asForm()->post('https://accounts.spotify.com/api/token', [
            'grant_type' => 'refresh_token',
            'refresh_token' => $this->refreshToken,
        ]);

        if ($response->failed()) {
            $response->throw();
        }

        $data = $response->json();
        $this->accessToken = $data['access_token'];
        $this->expiresIn = now()->addSeconds($data['expires_in']);

        // update session
        session([
            'auth' => [
                'spotify_token' => $this->accessToken,
                'spotify_refresh_token' => $this->refreshToken,
                'spotify_expires_in' => $this->expiresIn,
            ]
        ]);
    }

    /**
     * Make a request to the Spotify API.
     * @throws RequestException
     */
    public function request(string $method, string $endpoint, array $data = null): Response
    {
        $response = Http::withToken($this->getAccessToken())
            ->baseUrl($this->baseUrl)
            ->$method($endpoint, $data);

        if ($response->failed()) {
            $response->throw();
        }

        return $response;
    }
}
