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
        $this->accessToken = session('auth.spotify_token');
        $this->refreshToken = session('auth.spotify_refresh_token');
        $this->expiresIn = session('auth.spotify_expires_in');
    }

    /**
     * Get an access token from Spotify.
     * @throws RequestException
     */
    protected function getAccessToken(): string
    {
        if ($this->expiresIn->isPast()) {
            // TODO: use refresh token to get a new access token
        }

        return $this->accessToken;
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
