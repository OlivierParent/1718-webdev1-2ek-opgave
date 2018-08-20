<?php

/**
* @param $route
* @param array $parameters
* @return string
*/
function isActive($route, $parameters = []) {
    $currentRoute = ($_SERVER['REQUEST_SCHEME'] ?? 'http') . '://' . ($_SERVER['HTTP_HOST'] ?? '')  . (($_SERVER['REQUEST_URI'] ?? '') === '/' ? '' : ($_SERVER['REQUEST_URI'] ?? ''));
    $route = route($route, $parameters);
    return $currentRoute == $route ? ' active' : '';
}