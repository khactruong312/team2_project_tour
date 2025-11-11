<?php
function url($path = '') {
    $base = '/';
    return $base . ltrim($path, '/');
}
