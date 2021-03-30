<?php

use Illuminate\Support\Facades\Redis;

function getRedis($name) {
    return \Illuminate\Support\Facades\Redis::get($name);
}

function setRedis($name, $data) {
    $ttlRedisKey = Redis::exists($name);
    if(! $ttlRedisKey ) {
        Redis::set($name, $data);
        Redis::expire($name, 100);
    }
    return Redis::get($name);
}

function delRedis($name) {
    return Redis::del( $name );
}

function delsRedis($name) {
    foreach (keysRedis($name) as $key => $value) {
        Redis::del( $value );
    }
}

function keysRedis($name) {
    return Redis::keys($name);
}