<?php

$searchRoot = __DIR__;
$searchName = 'test.txt';
$searchResult = [];

function searchFile($searchRoot, $searchName, &$searchResult)
{
    foreach (scandir($searchRoot) as $item) {
        if (is_dir($searchRoot . '/' . $item) && !($item == '.' || $item == '..')) {
            searchFile($searchRoot . '/' . $item, $searchName, $searchResult);
        } elseif ($item == $searchName) {
            $searchResult[] = $searchRoot . '/' . $item;
        }
    }
}

searchFile($searchRoot,  $searchName, $searchResult);

if (empty($searchResult)) {
    echo 'Файл не найден';
} else {
    $searchResult = array_filter($searchResult, fn ($item) => filesize($item) > 0);
    var_dump($searchResult);
}
