<?php
require_once 'myHttpResponse.class.php';

/**
 * HTTP通信を行うクラス
 *
 */
class myHttpRequest
{
    private $host;
    private $port;
    private $path;
    private $param;
    private $fp;

    public function __construct($host, $port = 80, $path = '/', $param = null)
    {
        $this->host = $host;
        $this->port = $port;
        $this->path = $path;
        $this->param = $param;

        $this->open();

    }

    public function open($timeout = 30)
    {
        $this->fp = fsockopen($this->host, $this->port, $errno, $errstr, $timeout);

        if (! $this->fp) {
            echo "$errstr ($errno)\n";
        }
    }
    public function postJSON($params = array())
    {
        $content = json_encode($params);
        $header = '';
        $header .= "POST " . $this->path . " HTTP/1.0\r\n";
        $header .= "Host: " . $this->host . "\r\n";
        $header .= "Content-Type: application/json; charset=utf8\r\n";
        $header .= "Content-Length: " . strlen($content) . "\r\n";
        $header .= "Connection: Close\r\n\r\n";
        $header .= $content."\r\n";
        return $this->doMethod($header);
    }

    public function doGet()
    {
        $header = '';
        $header .= "GET " . $this->path . " HTTP/1.0\r\n";
        $header .= "Host: " . $this->host . "\r\n";
        $header .= "Connection: Close\r\n\r\n";
        return $this->doMethod($header);
    }

    public function doPost($content)
    {
        $header = '';
        $header .= "POST " . $this->path . " HTTP/1.0\r\n";
        $header .= "Host: " . $this->host . "\r\n";
        $header .= "Content-Type: application/x-www-form-urlencoded\r\n";
        $header .= "Content-Length: " . strlen($content) . "\r\n";
        $header .= "Connection: Close\r\n\r\n";
        $header .= $content."\r\n";
        return $this->doMethod($header);
    }

    public function doMethod($header)
    {
        fwrite($this->fp, $header);
        $str = '';
        /*
        while (! feof($this->fp)) {
            $str .= fgets($this->fp, 128);
        }
        dv($str);
        */
        $res = new myHttpResponse($this->fp);
        fclose($this->fp);

        return $res;
    }

    protected function genHeader($headers = array()) {
        $header = '';
        $header .= $this->method . " " . $this->path . " HTTP/1.0\r\n";
        $header .= "Host: " . $this->host . "\r\n";
        if ($this->method == HTTP_POST) {
            $header .= "Content-Type: application/x-www-form-urlencoded\r\n";
            //$header .= "Content-Length: " . strlen() . "\r\n";
        }
        //$header .= "Connection: Close\r\n\r\n";
    }
}
