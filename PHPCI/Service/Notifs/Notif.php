<?php namespace PHPCI\Service\Notifs;
use b8\Config;
use Service\Notifs\PushPubService;
use Service\Notifs\PushSubService;
use Service\Notifs\PushService;
final class Notif
{
  public function __construct()
  {
    //passthru('');
    $config = Config::getInstance();
    $uri = $config->get('phpci.notifs.uri');
    $bindDns = $config->get('phpci.notifs.bindDns');
    new PushSubService($uri, $bindDns);
  }
}