<?php namespace PHPCI\Service;

use PHPCI\Model\Notification;
use PHPCI\Store\NotificationStore;

final class NotificationService
{
  protected $store;

  public function __construct(NotificationStore $store)
  {
    $this->store = $store;
  }

  public function create(){}

  public function read(){}

  public function update(){}

  public function delete(){}
}