<?php

$requestMethod = $_SERVER['REQUEST_METHOD'];

/**
 * @throws Exception
 */
function getNote( $f ): void
{
    if( file_exists( $f ) === false ) {
        http_response_code(404);
        throw new Exception( 'File does not exist.' );
    } elseif ( is_readable( $f ) === false ) {
        http_response_code(415);
        throw new Exception( 'Cannot read file.' );
    } else {
        if ( filesize( $f ) > 0 ) {
            $myFile = fopen( $f, 'r' ) or die ( 'Unable to open file!' );
            $content = fread( $myFile, filesize( $f ) );
            $lastUpdated = date('m.d.y H:i:s', filemtime( $f ) );
            $data = array( 'content' => $content, 'lastUpdated' => $lastUpdated );
            fclose( $myFile );
            echo json_encode( $data );
        } else {
            echo json_encode( array('content' => '', 'lastUpdated' => '') );
        }
    }
}
// Unencrypted files may render html instead of displaying the tags.
// Encrypt the file before entering html entities or use textarea tags to display html tags.

switch ( $requestMethod ) {
    case 'GET':
        $url = '../../'.$_GET['url'];
        try {
            getNote( $url );
            echo json_encode( array(
                'code'    => 200,
                'data'    => '',
                'message' => 'Successful'
            ));
        } catch ( Exception $e ) {
            echo json_encode( array(
                'code'    => 500,
                'data'    => $e,
                'message' => 'Exception'
            ));
        }
        break;
    default:
        echo json_encode( array(
            'code'    => 405,
            'data'    => '',
            'message' => 'Method not allowed.'
        ));
}