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
$shortOpts = "h:w:h";
$longOpts = array(
    "hash:",
    "wordlist:",
    "help"
);

$options = getopt($shortOpts, $longOpts);

if (isset($options['help'])) {
    echo "Usage: php your_script.php [OPTIONS]\n";
    echo "Crack an MD5 hash using a wordlist.\n";
    echo "\n";
    echo "Options:\n";
    echo "  -h, --hash         MD5 hash to crack (required)\n";
    echo "  -w, --wordlist     Path to the wordlist file (required)\n";
    echo "  --help             Show this help message and exit\n";
    exit(0);
}

if (isset($options['h'])) {
    $hashToCrack = $options['h'];
} elseif (isset($options['hash'])) {
    $hashToCrack = $options['hash'];
} else {
    die("Error: Missing required argument -h/--hash for MD5 hash. Use --help for usage information.\n");
}

if (isset($options['w'])) {
    $wordlistPath = $options['w'];
} elseif (isset($options['wordlist'])) {
    $wordlistPath = $options['wordlist'];
} else {
    die("Error: Missing required argument -w/--wordlist for wordlist path. Use --help for usage information.\n");
}

$result = crackMd5Hash($hashToCrack, $wordlistPath);

if ($result !== false) {
    echo "Password found: " . $result;
} else {
    echo "Password not found in the wordlist.";
}
?>
