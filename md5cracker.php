<?php

function crackMd5Hash($hash, $wordlistPath) {
    $wordlist = file($wordlistPath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    
    foreach ($wordlist as $password) {
        $hashedPassword = md5($password);
        if ($hashedPassword === $hash) {
            return $password;
        }
    }
    
    return false; 
}

$hashToCrack = "5d41402abc4b2a76b9719d911017c592";
$wordlistPath = "path/to/wordlist.txt";
$result = crackMd5Hash($hashToCrack, $wordlistPath);

if ($result !== false) {
    echo "Password found: " . $result;
} else {
    echo "Password not found in the wordlist.";
}
