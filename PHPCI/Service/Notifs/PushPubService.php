<?php namespace PHPCI\Service\Notifs;
/**
 * PushPubService class.
 * Manages WebSocket pub / publish / broadcasts.
 * Send messages to subscribers via HTML POST Request.
 */
final class PushPubService
{
  public function __construct
  (
    $bindDns = 'tcp://127.0.0.1:5555',
    $persistentId = 'PHPCI Notification Push Server',
    $category,
    $title,
    $body,
    $url
  )
  {
    $data = array
    (
      'category' => $category,
      'title' => $title,
      'article' => $article,
      'sentOn' => $time
    );
    $context = new ZMQContext();
    $socket = $context->getSocket(ZMQ::SOCKET_PUSH, $persistentId);
    $socket->connect($bindDns);
    $socket->send(json_encode($data));
  }
}