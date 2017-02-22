<?php


namespace MoxiworksPlatform;

use MoxiworksPlatform\Exception\RemoteRequestFailureException;


class Resource {

    public static function headers() {
        $headers = array (
            'Authorization' => static::authHeader(),
            'Accept' => static::acceptHeader(),
            'Content-Type' => static::contentTypeHeader(),
            'User-Agent' => static::userAgentHeader()
        );
        if(isset(Session::$cookie)) {
            $headers['Cookie'] = Session::$cookie;
        }

        return $headers;
    }

    public static function authHeader() {
        if (!Credentials::ready())
            throw new Exception\AuthorizationException('MoxiworksPlatform\Credentials must be set before using');
        $identifier = Credentials::identifier();
        $secret = Credentials::secret();
        $auth_string = base64_encode("$identifier:$secret");
        return "Basic $auth_string";
    }

    public static function acceptHeader() {
        return 'application/vnd.moxi-platform+json;version=1';

    }

    public static function contentTypeHeader() {
        return 'application/x-www-form-urlencoded';
    }

    public static function userAgentHeader() {
        return 'moxiworks_platform php client';
    }

    public static function apiConnection($method, $url, $attributes) {
        $client = new \GuzzleHttp\Client();
        $json = null;
        $type = ($method == 'GET') ? 'query' : 'form_params';
        $query = [
            $type => $attributes,
            'headers' =>  Resource::headers(),
            'debug' => Config::getDebug()
        ];
        $res = $client->request($method, $url, $query);
        $body = $res->getBody();
        if(!isset(Session::$cookie)) {
            Session::$cookie = $res->getHeader('Set-Cookie');
        }
        try {
            $json = json_decode($body, true);
        } catch (\Exception $e) {
            throw new RemoteRequestFailureException("unable to parse remote response $e\n response:\n  $body");
        }
        Resource::checkForErrorInResponse($json);

        return $json;
    }

    public static function checkForErrorInResponse($json) {
        $message = (is_array($json) && key_exists('messages', $json) && is_array($json['messages'])) ?
            implode(',', $json['messages']) :
            "unable to perform remote action on Moxi Works platform\n";

        if (!is_array($json) || (key_exists('status', $json) && ($json['status'] == 'fail' || $json['status'] == 'error' ))) {
            throw new RemoteRequestFailureException($message);
        }
        return true;
    }

    public static function underscore($attr) {
        $out = preg_replace( '/::/', '/', $attr);
        $out = preg_replace('/([A-Z]+)([A-Z][a-z])/','\1_\2', $out);
        $out = preg_replace('/([a-z\d])([A-Z])/','\1_\2', $out);
        $out = str_replace( "-", "_", $out);
        $out = ltrim(strtolower($out), '_');
        return $out;
    }

}