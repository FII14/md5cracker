// @ md5cracker
// @ by: fii14

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

$hashToCrack = "5d41402abc4b2a76b9719d911017c592"; // Replace this with the hash you want to crack
$wordlistPath = "path/to/wordlist.txt"; // Replace this with the path to your wordlist file

$result = crackMd5Hash($hashToCrack, $wordlistPath);

if ($result !== false) {
    echo "Password successfully cracked: " . $result;
} else {
    echo "Password not found in the wordlist.";
}
