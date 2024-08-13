<?php

namespace App\Services;

use App\Contracts\Services\RankServiceInterface;
use GuzzleHttp\Client;

class RankService implements RankServiceInterface
{
    protected $_model;

    private function setModel(string $model)
    {
        $this->_model = app()->make($model);
    }

    protected $client;

    public function __construct()
    {
        $this->client = new Client();
    }

    public function getGoogleRank($query, $targetUrl, $numResults = 100)
    {
        $crawler = $this->client->request('GET', 'https://www.google.com/search', [
            'q' => $query,
            'num' => $numResults
        ]);

        $results = $crawler->filter('.g')->each(function ($node, $index) use ($targetUrl) {
            $link = $node->filter('a')->attr('href');
            if (strpos($link, $targetUrl) !== false) {
                return $index + 1;
            }
            return null;
        });

        // Lọc và lấy vị trí đầu tiên nếu URL xuất hiện
        return array_filter($results)[0] ?? null;
    }

}
