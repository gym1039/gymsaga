<?php
/**
 * 
 * @link http://changyan.sohu.com/
 * @author cc
 * 畅言HTTP请求类
 */

class ChangYan_Client {
    private $http_extension;
    private $http_function;

    public function __construct($ext = null) {
        $http_extension = array();
        if (function_exists('curl_init') && function_exists('curl_exec')) {
            $this->http_extension[] = 'curl';
        }
        if ((bool)ini_get('allow_url_fopen') && function_exists('fsocketopen')) {
            $this->http_extension[] = 'fsocket';
        }
        if ((bool)ini_get('allow_url_fopen') && function_exists('file_get_contents')) {
            $this->http_extension[] = 'file';
        }
        if(isset($ext) && isset($this->http_extension[$ext])) {
            $this->http_function = 'request_'.$ext;
        } else {
            $this->http_function = 'request_'.$this->http_extension[0];
        }
    }

    public function request($url,$method,$param) {
        $response =  call_user_func(array($this, $this->http_function),$url,$method,$param);
        return $response;
    }

    private function request_curl($url,$method,$param) {

    }

    private function request_fsocket($url,$method,$param) {

    }

    /*
     * return : plaintext or array
     * */
    public function http_request($url,$method,$param) {
        $post = null;
        switch ($method) {
            case 'GET':
                $url = $url.'?'.http_build_query($param);
                break;
            case 'POST':
                $post = $param;
                break;
        }
        $response = $this->send($url,0,$post,null,$post,10);
        $json = json_decode($response,true);
        return $json==null?$response:$json;
    }

    /*
     * send http request
     * @param: url
     * @post: string or array
     * @cookie: string, e.g. "key1=xx; key2=xx"
     * @return: mixed
     * @usage:
     *  send get request: request($url.'?'.http_build_query($get_array))
     *  send post request: request($url, 0, $post_array)
     */
    public function send($url, $limit=0, $post='', $cookie='', $timeout=10)
    {
        $return = '';
        $matches = parse_url($url);
        $scheme = $matches['scheme'];
        $host = $matches['host'];
        $path = $matches['path'] ? $matches['path'].(@$matches['query'] ? '?'.$matches['query'] : '') : '/';
        $port = !empty($matches['port']) ? $matches['port'] : 80;

        if (function_exists('curl_init') && function_exists('curl_exec')) {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $scheme.'://'.$host.':'.$port.$path);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            //curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
            if ($post) {
                curl_setopt($ch, CURLOPT_POST, 1);
                $content = is_array($post) ? http_build_query($post) : $post;
                curl_setopt($ch, CURLOPT_POSTFIELDS, urldecode($content));
            }
            if ($cookie) {
                curl_setopt($ch, CURLOPT_COOKIE, $cookie);
            }
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
            curl_setopt($ch, CURLOPT_TIMEOUT, 900);
            $data = curl_exec($ch);
            $status = curl_getinfo($ch);
            $errno = curl_errno($ch);
            curl_close($ch);
            if ($errno || $status['http_code'] != 200) {
                return;
            } else {
                return !$limit ? $data : substr($data, 0, $limit);
            }
        }

        if ($post) {
            $content = is_array($post) ? urldecode(http_build_query($post)) : $post;
            $out = "POST $path HTTP/1.0\r\n";
            $header = "Accept: */*\r\n";
            $header .= "Accept-Language: zh-cn\r\n";
            $header .= "Content-Type: application/x-www-form-urlencoded\r\n";
            $header .= "User-Agent: ".@$_SERVER['HTTP_USER_AGENT']."\r\n";
            $header .= "Host: $host:$port\r\n";
            $header .= 'Content-Length: '.strlen($content)."\r\n";
            $header .= "Connection: Close\r\n";
            $header .= "Cache-Control: no-cache\r\n";
            $header .= "Cookie: $cookie\r\n\r\n";
            $out .= $header.$content;
        } else {
            $out = "GET $path HTTP/1.0\r\n";
            $header = "Accept: */*\r\n";
            $header .= "Accept-Language: zh-cn\r\n";
            $header .= "User-Agent: ".@$_SERVER['HTTP_USER_AGENT']."\r\n";
            $header .= "Host: $host:$port\r\n";
            $header .= "Connection: Close\r\n";
            $header .= "Cookie: $cookie\r\n\r\n";
            $out .= $header;
        }

        $fpflag = 0;
        $fp = false;
        if (function_exists('fsocketopen')) {
            $fp = fsocketopen($host, $port, $errno, $errstr, $timeout);
        }
        if (!$fp) {
            $context = stream_context_create(array(
                'http' => array(
                    'method' => $post ? 'POST' : 'GET',
                    'header' => $header,
                    'content' => $content,
                    'timeout' => $timeout,
                ),
            ));
            $fp = @fopen($scheme.'://'.$host.':'.$port.$path, 'b', false, $context);
            $fpflag = 1;
        }

        if (!$fp) {
            return '';
        } else {
            stream_set_blocking($fp, true);
            stream_set_timeout($fp, $timeout);
            @fwrite($fp, $out);
            $status = stream_get_meta_data($fp);
            if (!$status['timed_out']) {
                while (!feof($fp) && !$fpflag) {
                    if (($header = @fgets($fp)) && ($header == "\r\n" ||  $header == "\n")) {
                        break;
                    }
                }
                if ($limit) {
                    $return = stream_get_contents($fp, $limit);
                } else {
                    $return = stream_get_contents($fp);
                }
            }
            @fclose($fp);
            return $return;
        }
    }
}
