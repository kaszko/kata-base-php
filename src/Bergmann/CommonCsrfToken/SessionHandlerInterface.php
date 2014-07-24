<?php

namespace Kata\Bergmann\CommonCsrfToken;

interface SessionHandlerInterface
{
    public function get($key);
    public function set($key, $value);
    public function write();
}
