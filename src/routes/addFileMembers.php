<?php
$app->post('/api/Dropbox/addFileMembers', function ($request, $response, $args) {
    $settings = $this->settings;

    //checking properly formed json
    $checkRequest = $this->validation;
    $validateRes = $checkRequest->validate($request, ['accessToken', 'fileId', 'membersList']);
    if (!empty($validateRes) && isset($validateRes['callback']) && $validateRes['callback'] == 'error') {
        return $response->withHeader('Content-type', 'application/json')->withStatus(200)->withJson($validateRes);
    } else {
        $post_data = $validateRes;
    }
    //forming request to vendor API
    $query_str = $settings['api_url'] . "2/sharing/add_file_member";
    $body = array();

    //requesting remote API
    $client = new GuzzleHttp\Client();
    $body['file'] = $post_data['args']['fileId'];
    $body['members'] = $post_data['args']['membersList'];
    if (isset($post_data['args']['customMessage']) && strlen($post_data['args']['customMessage']) > 0) {
        $body['custom_message'] = $post_data['args']['customMessage'];
    }
    if (isset($post_data['args']['quiet']) && strlen($post_data['args']['quiet']) > 0) {
        $body['quiet'] = $post_data['args']['quiet'] == "true" ? true : false;
    }
    if (isset($post_data['args']['accessLevel']) && strlen($post_data['args']['accessLevel']) > 0) {
        $body['access_level'] = $post_data['args']['accessLevel'];
    }
    if (isset($post_data['args']['addMessageAsComment']) && strlen($post_data['args']['addMessageAsComment']) > 0) {
        $body['add_message_as_comment'] = $post_data['args']['addMessageAsComment'] == "true" ? true : false;

    }

    try {

        $resp = $client->request('POST', $query_str, [
            'headers' => [
                "Authorization" => "Bearer " . $post_data['args']['accessToken']
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