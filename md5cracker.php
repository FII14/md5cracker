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

// Parse command-line arguments
$shortOpts = "h:w:";
$longOpts = array(
    "hash:",
    "wordlist:"
);

$options = getopt($shortOpts, $longOpts);

if (isset($options['h'])) {
    $hashToCrack = $options['h'];
} elseif (isset($options['hash'])) {
    $hashToCrack = $options['hash'];
} else {
    die("Error: Missing required argument -h/--hash for MD5 hash.");
}

if (isset($options['w'])) {
    $wordlistPath = $options['w'];
} elseif (isset($options['wordlist'])) {
    $wordlistPath = $options['wordlist'];
} else {
    die("Error: Missing required argument -w/--wordlist for wordlist path.");
}

$result = crackMd5Hash($hashToCrack, $wordlistPath);

if ($result !== false) {
    echo "Password found: " . $result;
} else {
    echo "Password not found in the wordlist.";
}
?>
