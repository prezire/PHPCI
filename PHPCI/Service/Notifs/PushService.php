<?php namespace PHPCI\Service\Notifs;
use Exception;
use Ratchet\ConnectionInterface;
use Ratchet\Wamp\WampServerInterface;
class PushService implements WampServerInterface 
{
  protected $topics;
  public function __construct()
  {
    $this->topics = array();
  }
  public function onUnSubscribe(ConnectionInterface $conn, $topic){}
  public function onOpen(ConnectionInterface $conn){}
  public function onClose(ConnectionInterface $conn){}
  public function onError(ConnectionInterface $conn, Exception $e){}
  public function onCall
  (
    ConnectionInterface $conn,
    $id,
    $topic,
    array $params
  ) 
  {
    //In this application if clients 
    //send data it's because the user hacked around in console
    $conn->callError($id, $topic, 'You are not allowed to make calls')->close();
  }
  public function onPublish(ConnectionInterface $conn,
    $topic,
    $event,
    array $exclude,
    array $eligible
  ) 
  {
    //In this application if clients send 
    //data it's because the user hacked around in console
    $conn->close();
  }
  public function onSubscribe(ConnectionInterface $conn, $topic) 
  {
    $this->topics[$topic->getId()] = $topic;
  }
  /**
   * @param  $entry  JSON'ified string we'll receive from ZeroMQ.
   */
  public function onDataEntry($entry) 
  {
    $entryData = json_decode($entry, true);
    // If the lookup topic object isn't set there is no one to publish to.
    if(!array_key_exists($entryData['category'], $this->topics)) 
    {
      return;
    }
    $topic = $this->topics[$entryData['category']];
    //Re-send the data to all the clients subscribed to that category.
    $topic->broadcast($entryData);
  }
}