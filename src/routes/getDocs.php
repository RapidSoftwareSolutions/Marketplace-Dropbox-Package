<?php
$app->post('/api/Dropbox/getDocs', function ($request, $response, $args) {
    $settings = $this->settings;

    //checking properly formed json
    $checkRequest = $this->validation;
    $validateRes = $checkRequest->validate($request, ['accessToken']);
    if (!empty($validateRes) && isset($validateRes['callback']) && $validateRes['callback'] == 'error') {
        return $response->withHeader('Content-type', 'application/json')->withStatus(200)->withJson($validateRes);
    } else {
        $post_data = $validateRes;
    }
    //forming request to vendor API
    $query_str = $settings['api_url'] ."2/paper/docs/list";
    $body = array();

    if (isset($post_data['args']['filterBy']) && strlen($post_data['args']['filterBy']) > 0){
        $body['filter_by'] = $post_data['args']['filterBy'];
    } else {
        $body['filter_by'] = "docs_accessed";
    }

    if (isset($post_data['args']['sortBy']) && strlen($post_data['args']['sortBy']) > 0){
        $body['sort_by'] = $post_data['args']['sortBy'];
    } else {
        $body['sort_by'] = "accessed";
    }

    if (isset($post_data['args']['sortOrder']) && strlen($post_data['args']['sortOrder']) > 0){
        $body['sort_order'] = $post_data['args']['sortOrder'];
    } else {
        $body['sort_order'] = "ascending";
    }

    if (isset($post_data['args']['limit']) && strlen($post_data['args']['limit']) > 0){
        $body['limit'] =(int) $post_data['args']['limit'];
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