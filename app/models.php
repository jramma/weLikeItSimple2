<?php

/**
 * Theme setup.
 */

namespace App;

function loadModels()
{
    $models  = scandir(__DIR__ . '/Models');

    foreach ($models as $model) {
        if ($model === '.' || $model === '..') {
            continue;
        }
        $registeredModels[] = "/App/Models/" . $model;
        require_once __DIR__ . '/Models/' . $model;
    }
}
loadModels();

function getRegisteredModels()
{
    $registeredModels = [];
    $models  = scandir(__DIR__ . '/Models');
    foreach ($models as $model) {
        if ($model === '.' || $model === '..') {
            continue;
        }
        $registeredModels[] = "\App\Models\\" . basename($model, ".php");
    }
    return $registeredModels;
}
