<?php
$app->post('/api/Dropbox/updateFolderPolicy', function ($request, $response, $args) {
    $settings = $this->settings;

    //checking properly formed json
    $checkRequest = $this->validation;
    $validateRes = $checkRequest->validate($request, ['accessToken', 'folderId']);
    if (!empty($validateRes) && isset($validateRes['callback']) && $validateRes['callback'] == 'error') {
        return $response->withHeader('Content-type', 'application/json')->withStatus(200)->withJson($validateRes);
    } else {
        $post_data = $validateRes;
    }
    //forming request to vendor API
    $query_str = $settings['api_url'] . "2/sharing/update_folder_policy";
    $body = array();

    //requesting remote API
    $client = new GuzzleHttp\Client();

    $body['shared_folder_id'] = $post_data['args']['folderId'];

    if(isset($post_data['args']['memberPolicy']) && strlen($post_data['args']['memberPolicy']) > 0){
        $body['member_policy'] = $post_data['args']['memberPolicy'];
    }

    if(isset($post_data['args']['aclUpdatePolicy']) && strlen($post_data['args']['aclUpdatePolicy']) > 0){
        $body['acl_update_policy'] = $post_data['args']['aclUpdatePolicy'];
    }
    if(isset($post_data['args']['sharedLinkPolicy']) && strlen($post_data['args']['sharedLinkPolicy']) > 0){
        $body['shared_link_policy'] = $post_data['args']['sharedLinkPolicy'];
    }
    if(isset($post_data['args']['forceAsync']) && strlen($post_data['args']['forceAsync']) > 0){
        $body['force_async'] = $post_data['args']['forceAsync'];
    }
    if(isset($post_data['args']['actions']) && count($post_data['args']['actions']) > 0){
        $body['actions'] = $post_data['args']['actions'];
    }
    if(isset($post_data['args']['accessLevel']) && strlen($post_data['args']['accessLevel']) > 0){
        $body['link_settings']['access_level'] = $post_data['args']['accessLevel'];
    }
    if(isset($post_data['args']['linkAudience']) && strlen($post_data['args']['linkAudience']) > 0){
        $body['link_settings']['audience'] = $post_data['args']['linkAudience'];
    }
    if(isset($post_data['args']['linkExpiry']) && strlen($post_data['args']['linkExpiry']) > 0){
        $body['link_settings']['expiry'] = $post_data['args']['linkExpiry'];
    }
    if(isset($post_data['args']['linkPassword']) && strlen($post_data['args']['linkPassword']) > 0){
        $body['link_settings']['password'] = $post_data['args']['linkPassword'];
    }
    if(isset($post_data['args']['viewerInfoPolicy']) && strlen($post_data['args']['viewerInfoPolicy']) > 0){
        $body['viewer_info_policy'] = $post_data['args']['viewerInfoPolicy'];
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