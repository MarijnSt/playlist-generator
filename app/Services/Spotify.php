<?php

namespace App\Services;

use Illuminate\Http\Client\Response;
use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class Spotify
{
    protected string $clientId;
    protected string $clientSecret;
    protected string $baseUrl;
    protected string $accessTokenCacheKey;

    public function __construct()
    {
        $this->clientId = config('services.spotify.client_id');
        $this->clientSecret = config('services.spotify.client_secret');
        $this->baseUrl = config('services.spotify.base_url');
        $this->accessTokenCacheKey = static::class . '|access_token';
    }

    /**
     * Get an access token from Spotify.
     * @throws RequestException
     */
    protected function getAccessToken(): string
    {
        // get token from cache
        if (Cache::has($this->accessTokenCacheKey)) {
            return Cache::get($this->accessTokenCacheKey);
        }

        // if there is no token in cache, get a new one
        $response = Http::asForm()
            ->post('https://accounts.spotify.com/api/token', [
                'grant_type' => 'client_credentials',
                'client_id' => $this->clientId,
                'client_secret' => $this->clientSecret,
            ]);

        if ($response->failed()) {
            $response->throw();
        }

        $accessToken = $response->json('access_token') ?? '';

        // store the token in cache for an hour (is the default access token expiration time of spotify)
        Cache::put($this->accessTokenCacheKey, $accessToken, 3600);

        return $accessToken;
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
