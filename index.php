<?php
/*
* Kelompok 1 Penyebaran Covid Banjarmasin WebGIS
* Kelas 4N Reguler Pogi
*/
if (PHP_VERSION < 7.1) {
    exit('Mohon Maaf Anda Harus Mengunakan php versi Terbaru 7.1 Keatas');
}

require 'vendor/autoload.php';
require 'helpers.php';

$guzzle = new GuzzleHttp\Client();

$results = [];

try {
    $resp = $guzzle->get('https://corona.banjarmasinkota.go.id/');

    $dom = new \PHPHtmlParser\Dom();
    $dom->load($resp->getBody());
    $rows = [];

    $table = $dom->find('#data-terkini table > tbody > tr');

    foreach ($table as $row) {
        array_push($results, [
            'kelurahan' => $row->find('td')[1]->innerHtml,
            'dirawat' => $row->find('td')[2]->innerHtml,
            'sembuh' => $row->find('td')[3]->innerHtml,
            'meninggal' => $row->find('td')[4]->innerHtml,
        ]);
    }

    preg_match('/var result = (.*);/', $resp->getBody(), $match);

    $mapsArray = json_decode($match[1], true);

    $results = mergeMapsAndLocation($mapsArray, $results);

    file_put_contents(__DIR__ . '/temp.txt', json_encode($results));
} catch (\GuzzleHttp\Exception\GuzzleException $e) {
    if (!file_exists(__DIR__ . '/temp.txt')) {
        exit('Silahkan Aktifkan Internet Anda Terlebih dahulu');
    }

    $results = json_decode(file_get_contents(__DIR__ . '/temp.txt'), true);
}

require __DIR__ . '/views/home.php';