<?php
class Log
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
}
