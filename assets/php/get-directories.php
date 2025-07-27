<?php

$requestMethod = $_SERVER['REQUEST_METHOD'];
$dirPath = '../../notes';

function getDirContents( $dir, &$results = array() ): array
{
    $files = scandir( $dir );
    foreach ( $files as $key => $value ) {

        // Remove root/parent directories and hidden files.
        if ( str_starts_with( $value, '.' ) ) {
            unset ( $files[ $key ] );
            continue;
        }

        // Remove any file that doesn't end with .html or .txt
        if ( str_contains($value, '.') ) {
            if ( !str_ends_with($value, '.html') && !str_ends_with($value, '.txt') ) {
                unset($files[$key]);
                continue;
            }
        }

        $path = $dir . DIRECTORY_SEPARATOR . $value;

        if ( !is_dir( $path ) ) {
            $results[] = str_replace($GLOBALS['dirPath'], '', $path);
        } else {
            getDirContents( $path, $results );
        }

    }
    return $results;
}

switch ( $requestMethod )
{
    case 'GET':
        try {
            echo json_encode( array(
                'code'    => 200,
                'data'    => getDirContents($dirPath),
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