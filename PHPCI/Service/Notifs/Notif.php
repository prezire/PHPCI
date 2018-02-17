<?php namespace PHPCI\Service\Notifs;
use b8\Config;
use PHPCI\Service\Notifs\PushPubService;
use PHPCI\Service\Notifs\PushSubService;
use PHPCI\Service\Notifs\PushService;
final class Notif
{
  public function __construct()
  {
    $config = Config::getInstance();
    $uri = $config->get('phpci.notifs.uri');
    $bindDns = $config->get('phpci.notifs.bindDns');
    new PushSubService($uri, $bindDns);
  }
}