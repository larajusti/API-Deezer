<?php

if (isset($_POST['artist'])) {
    $search = filterInput($_POST['artist']);
    $artist = getArtist($search);

    if ($search == '') {
        $artist = setValuesEmpty();
        $artistName = 'Por favor, digite o nome de um artista.';
        $artistImage = $artist->empty;
        $trackList = $artist->empty;
        $tracks = $artist->empty;
    }
    elseif ($artist->data == []) {
        $artist = setValuesEmpty();
        $artistName = 'Não encontrado...';
        $artistImage = $artist->empty;
        $trackList = $artist->empty;
        $tracks = $artist->empty;
    }
    
    else {
        $artistName = getArtistName($artist);
        $artistImage = getArtistImage($artist);
        $artistId = getArtistId($artist);
        $trackList = getTracklist($artistId);
        $tracks = getTracks($trackList);
    }
} else {
    $artist = setValuesEmpty();
    $artistName = $artist->empty;
    $artistImage = $artist->empty;
    $trackList = $artist->empty;
    $tracks = $artist->empty;
}

function setValuesEmpty()
{
    return (object) [
        'empty' => ''
    ];
}

function getArtistName(object $artist)
{
    return $artist->data[0]->artist->name;
};

function getArtistImage(object $artist)
{
    return $artist->data[0]->artist->picture_big;
};

function getArtistId(object $artist)
{
    return $artist->data[0]->artist->id;
};

function getTracks(object $trackList)
{
    $tracks = '<h2 class="display-5 text-left">As mais ouvidas:</h2><br>';
    for ($i = 0; $i < 20; $i++) {
        $tracks = $tracks . "<li><a href=" . $trackList->data[$i]->preview . ">" . $trackList->data[$i]->title . "<a></li>";
    }
    return $tracks;
}

function filterInput(string $param): string
{
    return preg_replace('/[ ]/', '%20', $param);
}

function getArtist(string $search)
{
    $url = "https://api.deezer.com/search?q=artist:%22{$search}%22";

    return json_decode(file_get_contents($url));
};

function getTracklist(string $artistId)
{
    $url = "https://api.deezer.com/artist/{$artistId}/top?limit=20";

    return json_decode(file_get_contents($url));
};