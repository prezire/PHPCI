<?php namespace PHPCI\Controller;
final class NotificationController extends \PHPCI\Controller
{
  public function __construct()
  {
    return $this->view->render();
  }
  private function sendEmailers()
  {
    //TODO: Admin email(s).
  }
}