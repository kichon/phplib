<?php
require_once '_debug.php';

/**
 * HTTP通信の結果を扱うクラス
 */
class myHttpResponse
{
    private $socket;
    private $HttpStatusLine;
    private $HttpHeaders;
    private $body;

    public function __construct($socket)
    {
        $this->socket = $socket;
        $this->parse();
    }

    public function parse() {
        //dbacktrace();
        //dfunction();

        // Status-Lineのパース {
            $line = $this->readLine();
            if (! preg_match('%(HTTP/\d\.\d) +(\d+) +(.+)%', $line, $mts))
                throw new Exception('Bad Response Status Line');
    
            $this->HttpStatusLine = $mts;
            //dv($this->HttpStatusLine);
        // }

        // message-headerのパース {
            $this->HttpHeaders = array();
            while ('' != ($header = $this->readLine())) {
                //$this->HttpHeaders[] = $header;
                $this->genResHeaders($header);
            }
            //dv($this->HttpHeaders);
        // }

        // bodyのパース {
            while (! feof($this->socket)) {
                $this->body .= fgets($this->socket, 128);
            }
        // }
    }

    public function getResponseCode()
    {
        return isset($this->HttpStatusLine) ? $this->HttpStatusLine[2] : false;
    }

    public function getResponseHeader($name = null)
    {
        if (! $name) return false;
        return isset($this->HttpHeaders[$name]) ? $this->HttpHeaders[$name] : false;
    }

    public function getResponseBody()
    {
        return isset($this->body) ? $this->body : false;
    }

    protected function readLine()
    {
        $line = '';
        while (! feof($this->socket)) {
            $line .= fgets($this->socket, 128);
            if (substr($line, -1) == "\n") {
                return rtrim($line, "\r\n");
            }
        }

        return $line;
    }

    protected function genResHeaders($header)
    {
        list($name, $value) = explode(':', $header, 2);
        $name = strtolower($name);

        $this->HttpHeaders[$name] = $value;

        return true;
    }
}
