<?php
    $requestMethod = $_SERVER['REQUEST_METHOD'];
    function getNote( $f ) {
        $myfile      = fopen( $f, "r" ) or die("Unable to open file!");
        $content     = fread( $myfile, filesize( $f ) );
        $lastUpdated = date("m.d.y H:i:s", filemtime( $f ));
        $data        = array( "content"=>$content, "lastUpdated"=>$lastUpdated );
        fclose( $myfile );
        return json_encode( $data );
    }
    // Unencrypted files may render html instead of displaying the tags. Encrypt the file before entering html entities or use textarea tags to display html tags.
    function writeNote( $f, $c ): void {
        $myfile = fopen( $f, "w" ) or die("Unable to open file!");
        fwrite( $myfile, $c );
        fclose( $myfile );
        header("Refresh:0");
    }
    switch ( $requestMethod ) {
        case 'POST':
            $file    = $_POST['url'];
            $content = $_POST['content'];
            writeNote( $file, $content );
            echo "url = ".$file.". ";
            echo "content = ".$content.". ";
            break;
        case 'GET':
            $url      = $_GET['url'];
            $fileData = getNote( $url );
            echo $fileData;
            break;
        default:
            echo "Request method unknown.";
    }