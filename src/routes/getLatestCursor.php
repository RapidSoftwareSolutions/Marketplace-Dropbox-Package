<?php
$app->post('/api/Dropbox/getLatestCursor', function ($request, $response, $args) {
    $settings = $this->settings;

    //checking properly formed json
    $checkRequest = $this->validation;
    $validateRes = $checkRequest->validate($request, ['accessToken', 'folderPath']);
    if (!empty($validateRes) && isset($validateRes['callback']) && $validateRes['callback'] == 'error') {
        return $response->withHeader('Content-type', 'application/json')->withStatus(200)->withJson($validateRes);
    } else {
        $post_data = $validateRes;
    }
    //forming request to vendor API
    $query_str = $settings['api_url'] . "2/files/list_folder/get_latest_cursor";
    $body = array();
    $body['path'] = $post_data['args']['folderPath'];

    if (isset($post_data['args']['recursive']) && strlen($post_data['args']['recursive']) > 0){
        $body['recursive'] = $post_data['args']['recursive'] == "true" ? true : false;
    }

    if (isset($post_data['args']['includeMediaInfo']) && strlen($post_data['args']['includeMediaInfo']) > 0){
        $body['include_media_info'] = $post_data['args']['includeMediaInfo'] == "true" ? true : false;
    }
    if (isset($post_data['args']['includeDeleted']) && strlen($post_data['args']['includeDeleted']) > 0){
        $body['include_deleted'] = $post_data['args']['includeDeleted'] == "true" ? true : false;
    }
    if (isset($post_data['args']['includeHasExplicitSharedMembers']) && strlen($post_data['args']['includeHasExplicitSharedMembers']) > 0){
        $body['include_has_explicit_shared_members'] = $post_data['args']['includeHasExplicitSharedMembers'] == "true" ? true : false;
    }

    //requesting remote API
    $client = new GuzzleHttp\Client();

    try {

        $resp = $client->request('POST', $query_str, [
            'headers'=>[
                "Authorization" => "Bearer ". $post_data['args']['accessToken']
            ],
            'json' => $body
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