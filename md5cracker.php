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
$parser = new argparse\ArgumentParser();
$parser->addArgument('-h', '--hash', ['required' => true, 'help' => 'MD5 hash to crack']);
$parser->addArgument('-w', '--wordlist', ['required' => true, 'help' => 'Path to the wordlist file']);
$args = $parser->parseArgs();

$hashToCrack = $args->hash;
$wordlistPath = $args->wordlist;
$result = crackMd5Hash($hashToCrack, $wordlistPath);

if ($result !== false) {
    echo "Password found: " . $result;
} else {
    echo "Password not found in the wordlist.";
}
?>
