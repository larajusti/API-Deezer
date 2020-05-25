<?php
//ini_set('display_errors', 'on');

if (isset($_POST['artist'])) {
    $search = filterInput($_POST['artist']);
    $artist = getArtist($search);

    if ($search == '') {
        $artist = trackListEmpty();
        $artistName = $artist->empty;
        $artistImage = $artist->empty;
        $trackList = $artist->empty;
    }
    else {
        $artistName = getArtistName($artist);
        $artistImage = getArtistImage($artist);
        $artistId = getArtistId($artist);
        $trackList = getTracklist($artistId);
    }
}

function trackListEmpty()
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
    echo '<h2 class="display-5 text-center">As mais ouvidas:</h2><br>';
    for ($i = 0; $i < 10; $i++) {
        echo "<li><a href=" . $trackList->data[$i]->preview . "class='list-group-item' >" . $trackList->data[$i]->title . "<a></li>";
    }
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
    $url = "https://api.deezer.com/artist/{$artistId}/top?limit=10";

    return json_decode(file_get_contents($url));
};
