<?php

header('Content-Type: text/javascript; charset=UTF-8');

$GLOBALS['notesDirectory'] = "../../notes/personal";

function getDirContents( $dir, &$results = array() ) {
    $files = scandir( $dir );
    foreach ( $files as $key => $value ) {
        $path = $dir . DIRECTORY_SEPARATOR . $value;
        if ( !is_dir( $path ) && str_contains($path, ".html") ) {
            $results[] = str_replace($GLOBALS['notesDirectory'], "", $path);
        } else if ( $value != "." && $value != ".." && $value != ".DS_Store" ) {
            getDirContents( $path, $results );
        }
    }
    return json_encode( $results, JSON_UNESCAPED_SLASHES );
}

echo "const useEncryption = true;\n";
echo "const isDemo = false;\n";
echo "const notesDirectory = \"notes/personal/\";\n";
echo "const scanDirNotes = ".getDirContents($GLOBALS['notesDirectory']);