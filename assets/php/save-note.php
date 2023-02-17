<?php

    $requestMethod = $_SERVER['REQUEST_METHOD'];

    // Unencrypted files may render html instead of displaying the tags.
    // Encrypt the file before entering html entities or use textarea tags to display html tags.

    /**
     * @throws Exception
     */
    function saveNote( $f, $c ): void {
        if ( file_exists( $f ) === false ) {
            http_response_code(404);
            throw new Exception( "File does not exist." );
        } elseif ( is_writeable( $f ) === false ) {
            http_response_code(500);
            throw new Exception("Cannot write to file.");
        } elseif ( !str_ends_with($f, ".html") && !str_ends_with($f, ".txt")) {
            http_response_code(415);
            throw new Exception("Supported file formats are '.html' or '.txt'");
        } else {
            $myFile = fopen( $f, "w" ) or die ( "Unable to open file!" );
            fwrite( $myFile, $c );
            fclose( $myFile );
            header("Refresh:0");
            echo json_encode([ 'Response' => 'Success', 'Payload' => [ 'Url' => $f, 'Content' => $c ] ]);
        }
    }

    switch ( $requestMethod ) {
        case 'POST':
            $file    = '../../'.$_POST['url'];
            $content = $_POST['content'];
            try {
                saveNote( $file, $content );
            } catch ( Exception $e ) {
                echo json_encode([ 'Response' => strval($e), 'Payload' => [ 'Url' => $file, 'Content' => $content ] ]);
            }
            break;
        default:
            echo "Request method unknown.";
    }
