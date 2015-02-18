<?php
/**
 * User: mhightower
 * Date: 2/9/15
 */

namespace BroadwayDemo\Authentication;

interface Password
{
    public static function create($plainText);
    public function getPasswordHash();
    public function verify($plainText);
}