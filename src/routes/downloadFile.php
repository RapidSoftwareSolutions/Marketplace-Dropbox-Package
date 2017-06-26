<?php

$app->post('/api/Dropbox/downloadFile', function ($request, $response, $args) {

    $settings = $this->settings;

    //checking properly formed json
    $checkRequest = $this->validation;
    $validateRes = $checkRequest->validate($request, ['accessToken', 'filePath']);
    if (!empty($validateRes) && isset($validateRes['callback']) && $validateRes['callback'] == 'error') {
        return $response->withHeader('Content-type', 'application/json')->withStatus(200)->withJson($validateRes);
    } else {
        $post_data = $validateRes;
    }
    //forming request to vendor API
    $query_str = "https://content.dropboxapi.com/2/files/download";
    $body = array();
    $body['path'] = $post_data['args']['filePath'];
    //requesting remote API
    $client = new GuzzleHttp\Client();

    try {

        $resp = $client->post($query_str, [
                'headers' =>     [
                    "Authorization" => "Bearer " . $post_data['args']['accessToken'],
                    "Dropbox-API-Arg" => json_encode($body)
                ]
        ]);

        $responseBody = $resp->getBody();

        if ($resp->getStatusCode() == 200) {
            $size = $resp->getHeader('Content-Length')[0];

            $uploadServiceResponse = $client->post($settings['uploadServiceUrl'], [
                'multipart' => [
                    [
                        'name' => 'length',
                        'contents' => $size
                    ],
                    [
                        "name" => "file",
                        "filename" => md5($post_data['args']['filePath']),
                        "contents" => $responseBody
                    ]
                ]
            ]);
            $uploadServiceResponseBody = $uploadServiceResponse->getBody()->getContents();
            if ($uploadServiceResponse->getStatusCode() == 200) {
                $result['callback'] = 'success';
                $result['contextWrites']['to'] = json_decode($uploadServiceResponse->getBody());
            }
            else {
                $result['callback'] = 'error';
                $result['contextWrites']['to']['status_code'] = 'API_ERROR';
                $result['contextWrites']['to']['status_msg'] = is_array($uploadServiceResponseBody) ? $uploadServiceResponseBody : json_decode($uploadServiceResponseBody);
            }
        } else {
            $result['callback'] = 'error';
            $result['contextWrites']['to']['status_code'] = 'API_ERROR';
            $result['contextWrites']['to']['status_msg'] = is_array($responseBody) ? $responseBody : json_decode($responseBody);
        }
    } catch (\GuzzleHttp\Exception\BadResponseException $exception) {
        $result['callback'] = 'error';
        $result['contextWrites']['to']['status_code'] = 'API_ERROR';
        $result['contextWrites']['to']['status_msg'] = json_decode($exception->getResponse()->getBody());
    }
    return $response->withHeader('Content-type', 'application/json')->withStatus(200)->withJson($result);

});