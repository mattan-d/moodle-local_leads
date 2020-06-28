<?php
// This file is part of the Local zoom Moodle plugin
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

require_once('../../config.php');
require_once('lib.php');

$configs = get_config('local_leads');
$locallib = new local_leads();

/*
 *
https://bci1.or-bit.net/01412/ws/crmImport.asmx/LoginAndAddCrmPersonFullHttpGet?username=leads&password=M20tal20%%&firstname=dor&lastname=mattan&email=mattan.dor1@gmail.com&telephonePrefix=02&telephone=6731773&cellphoneprefix=09&cellphone=556658940&remark=string&entityCode=IL&referId=GORDON



 * */

function deliver_response($response)
{
    // Define HTTP responses
    $http_response_code = array(
        100 => 'Continue',
        101 => 'Switching Protocols',
        200 => 'OK',
        201 => 'Created',
        202 => 'Accepted',
        203 => 'Non-Authoritative Information',
        204 => 'No Content',
        205 => 'Reset Content',
        206 => 'Partial Content',
        300 => 'Multiple Choices',
        301 => 'Moved Permanently',
        302 => 'Found',
        303 => 'See Other',
        304 => 'Not Modified',
        305 => 'Use Proxy',
        306 => '(Unused)',
        307 => 'Temporary Redirect',
        400 => 'Bad Request',
        401 => 'Unauthorized',
        402 => 'Payment Required',
        403 => 'Forbidden',
        404 => 'Not Found',
        405 => 'Method Not Allowed',
        406 => 'Not Acceptable',
        407 => 'Proxy Authentication Required',
        408 => 'Request Timeout',
        409 => 'Conflict',
        410 => 'Gone',
        411 => 'Length Required',
        412 => 'Precondition Failed',
        413 => 'Request Entity Too Large',
        414 => 'Request-URI Too Long',
        415 => 'Unsupported Media Type',
        416 => 'Requested Range Not Satisfiable',
        417 => 'Expectation Failed',
        500 => 'Internal Server Error',
        501 => 'Not Implemented',
        502 => 'Bad Gateway',
        503 => 'Service Unavailable',
        504 => 'Gateway Timeout',
        505 => 'HTTP Version Not Supported'
    );

    // Set HTTP Response
    header('HTTP/1.1 ' . $response['status'] . ' ' . $http_response_code[$response['status']]);
    // Set HTTP Response Content Type
    header('Content-Type: application/json; charset=utf-8');
    // Format data into a JSON response
    $json_response = json_encode($response['data']);
    // Deliver formatted data
    echo $json_response;

    exit;
}

// Set default HTTP response of 'Not Found'
$response['status'] = 404;
$response['data'] = NULL;

$url_array = parse_url($_SERVER['REQUEST_URI']);
$method = $_SERVER['REQUEST_METHOD'];

parse_str($url_array['query'], $query);

require_once('lib.php');
if (strcasecmp($query['action'], 'add') == 0) {
    if ($method == 'POST') {

        // METHOD : POST api
        // get post from client
        $json = file_get_contents('php://input');
        $post = json_decode($json); // decode to object

        // check input completeness
        if (!$post) {
            $response['status'] = 400;
            $response['data'] = array('error' => 'Data tidak lengkap');
        } else {
            $data = new stdClass();
            $data->response = json_encode($json);
            $data->timecreated = time();

            $DB->insert_record('local_leads', $data);

            // send json to ORBIT
            $url = 'https://bci1.or-bit.net/01412/ws/crmImport.asmx/LoginAndAddCrmPersonFullHttpGet';
            $post->username = 'leads';
            $post->password = 'M20tal20%%';
            $post->firstname = 'Mattan';
            $post->lastname = 'test';
            $post->email = 'ma@ma.com';
            $post->telephonePrefix = '02';
            $post->telephone = '67317731';
            $post->cellphoneprefix = '055';
            $post->cellphone = '6658940';
            $post->remark = 'blas';
            $post->entityCode = '1';
            $post->referId = 'mattan';

            $params = http_build_query($post, null, '&', PHP_QUERY_RFC3986);
            $result = file_get_contents($url . '?' . $params);
            $result = simplexml_load_string($result);

            $response['status'] = 201;
            $response['data'] = array('success' => $result[0]);
        }
    }
}

// Return Response to browser
deliver_response($response);

?>
