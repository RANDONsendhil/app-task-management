<?php
class Utils
{
  private $message;
  public function __construct($message)
  {
    $this->message = $message;
    $this->logInfo();
  }

  public function logInfo()
  {
    $file = BASE_PATH . '/logInfo.log';

    file_put_contents($file,  $this->getMessage());
  }

  public function getMessage()
  {
    return $this->message;
  }


  function getCurrentUrl()
  {
    $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? "https://" : "http://";
    $host = $_SERVER['HTTP_HOST'];
    $uri = $_SERVER['REQUEST_URI'];

    return $protocol . $host . $uri;
  }

  function getUri()
  {
    return $_SERVER['REQUEST_URI'];
  }
}
