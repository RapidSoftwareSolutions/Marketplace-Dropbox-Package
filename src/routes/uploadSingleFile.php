<?php
$app->post('/api/Dropbox/uploadSingleFile', function ($request, $response, $args) {
    $settings = $this->settings;

    //checking properly formed json
    $checkRequest = $this->validation;
    $validateRes = $checkRequest->validate($request, ['accessToken', 'filePath', 'file']);
    if (!empty($validateRes) && isset($validateRes['callback']) && $validateRes['callback'] == 'error') {
        return $response->withHeader('Content-type', 'application/json')->withStatus(200)->withJson($validateRes);
    } else {
        $post_data = $validateRes;
    }
    //forming request to vendor API
    $query_str = "https://content.dropboxapi.com/2/files/upload";
    $body = array();
    $body['path'] = $post_data['args']['filePath'];
    $file[] = [
        'name'     => 'file',
        'contents' => fopen($post_data['args']['file'], 'r')
    ];

    if (isset($post_data['args']['uploadMode']) && strlen($post_data['args']['uploadMode']) > 0){
        $body['mode'] = $post_data['args']['uploadMode'];
    }
    if (isset($post_data['args']['autoRename']) && strlen($post_data['args']['autoRename']) > 0){
        $body['autorename'] = $post_data['args']['autoRename'] == "true" ? true : false;
    }
    if (isset($post_data['args']['clientModified']) && strlen($post_data['args']['clientModified']) > 0){
        $dateTime = new DateTime($post_data['args']['clientModified']);
        $body['client_modified'] = $dateTime->format('Y-m-d\TH:i:s\Z');
    }
    if (isset($post_data['args']['mute']) && strlen($post_data['args']['mute']) > 0){
        $body['mute'] = $post_data['args']['mute'] == "true" ? true : false;
    }
    //requesting remote API
    $client = new GuzzleHttp\Client();

    try {

        $resp = $client->request('POST', $query_str, [
            'headers'=>[
                "Authorization" => "Bearer ". $post_data['args']['accessToken'],
                "Dropbox-API-Arg" => json_encode($body),
                "Content-Type" => "application/octet-stream"
            ],
            'multipart' => $file
        ]);

        $responseBody = $resp->getBody()->getContents();
        $rawBody = json_decode($resp->getBody());

        $all_data[] = $rawBody;
        if ($response->getStatusCode() == '200') {
            $result['callback'] = 'success';
            $result['contextWrites']['to'] = is_array($all_data) ? $all_data : json_decode($all_data);
        } else {
            $result['callback'] = 'error';
            $result['contextWrites']['to']['status_code'] = 'API_ERROR';
            $result['contextWrites']['to']['status_msg'] = is_array($responseBody) ? $responseBody : json_decode($responseBody);
        }

    } catch (\GuzzleHttp\Exception\ClientException $exception) {
        $responseBody = $exception->getResponse()->getReasonPhrase();
        $result['callback'] = 'error';
        $result['contextWrites']['to']['status_code'] = 'API_ERROR';
        $result['contextWrites']['to']['status_msg'] = $responseBody;

    } catch (GuzzleHttp\Exception\ServerException $exception) {

        $responseBody = $exception->getResponse()->getBody(true);
        $result['callback'] = 'error';
        $result['contextWrites']['to'] = json_decode($responseBody);

    } catch (GuzzleHttp\Exception\BadResponseException $exception) {

        $responseBody = $exception->getResponse()->getBody(true);
        $result['callback'] = 'error';
        $result['contextWrites']['to'] = json_decode($responseBody);

    }


    return $response->withHeader('Content-type', 'application/json')->withStatus(200)->withJson($result);

});