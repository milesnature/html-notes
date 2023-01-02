<?php

    $requestMethod = $_SERVER['REQUEST_METHOD'];

    // Unencrypted files may render html instead of displaying the tags.
    // Encrypt the file before entering html entities or use textarea tags to display html tags.

    /**
     * @throws Exception
     */
    function writeNote( $f, $c ): void {
        if( file_exists( $f ) === false ) {
            throw new Exception( "File does not exist." );
        } elseif ( is_writeable( $f ) === false ) {
            throw new Exception( "Cannot write to file." );
        } else {
            $myFile = fopen( $f, "w" ) or die( "Unable to open file!" );
            fwrite( $myFile, $c );
            fclose( $myFile );
            header("Refresh:0");
        }
    }

    switch ( $requestMethod ) {
        case 'POST':
            $file    = $_POST['url'];
            $content = $_POST['content'];
            try {
                writeNote( $file, $content );
            } catch ( Exception $e ) {
                echo "Exception = ".$e." URL = ".$file.". Content = ".$content.".";
            }
            break;
        default:
            echo "Request method unknown.";
    }