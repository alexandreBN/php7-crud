<?php

class HashAlgorithm {
    
    private static $ALGORITHM = "sha512";

    public static function getHash($data) {
        return hash(self::$ALGORITHM, $data);
    }

}