<?php

    $requestMethod = $_SERVER['REQUEST_METHOD'];

    /**
     * @throws Exception
     */
    function getNote( $f ) {
        if( file_exists( $f ) === false ) {
            throw new Exception( "File does not exist." );
        } elseif ( is_readable( $f ) === false ) {
            throw new Exception( "Cannot read file." );
        } else {
            if ( filesize( $f ) > 0 ) {
                $myFile = fopen( $f, "r" ) or die( "Unable to open file!" );
                $content = fread( $myFile, filesize( $f ) );
                $lastUpdated = date("m.d.y H:i:s", filemtime( $f ) );
                $data = array( "content" => $content, "lastUpdated" => $lastUpdated );
                fclose( $myFile );
                echo json_encode( $data );
            } else {
                echo json_encode( array("content" => "", "lastUpdated" => "") );
            }
        }
    }
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
        case 'GET':
            $url = $_GET['url'];
            try {
                getNote( $url );
            } catch ( Exception $e ) {
                echo "Exception = ".$e." URL = ".$url.".";
            }
            break;
        default:
            echo "Request method unknown.";
    }