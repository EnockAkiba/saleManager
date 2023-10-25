<?php 
function slug(string $prefixe){
    return $prefixe. substr(time(), 0, -4). mt_rand(1000, 9999). uniqid('',true);
}