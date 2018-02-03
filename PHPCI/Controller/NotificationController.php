<?php namespace PHPCI\Controller;

use b8;
use b8\Form;
use b8\View;
use b8\Exception\HttpException\NotFoundException;
use b8\Store;
use b8\Store\Factory;
use PHPCI;
use PHPCI\BuildFactory;
use PHPCI\Helper\Github;
use PHPCI\Helper\Lang;
use PHPCI\Helper\SshKey;
use PHPCI\Service\BuildService;
use PHPCI\Service\NotificationService;

final class NotificationController extends PHPCI\Controller
{

  protected $store;
  protected $svc;

  public function init()
  {
    $this->store = Factory::getStore('Notification');
    $this->svc = new NotificationService($this->store);
  }
  
  public function index()
  {
    //Listing.
    /*$this->view = new View('Notifications/index');
    $this->view->title = 'Add Notfication';*/

    //$this->requireAdmin();

    $notifications = array();
    $storedNotifications = $this
      ->store
      ->getWhere
      (
        array(),
        100,
        0,
        array(),
        array('title' => 'ASC')
      );
    print_r($storedNotifications);exit;

    /*foreach ($storedNotifications['items'] as $notification) 
    {
      $thisGroup = array
      (
        'title' => $notification->getTitle(),
        'id' => $notification->getId(),
      );
      $projects = Factory::getStore('Notification')
        ->getByNotificationId($notification->getId());
      $thisGroup['projects'] = $projects['items'];
      $notifications[] = $thisGroup;
    }*/

    $this->view->notifications = $notifications;
  }

  public function add($title, $body)
  {
    //$this->request->getMethod() === 'POST'
    //$this->getParam('title')
    $this->view = new View('Notifications/index');
    $this->view->title = $title;
    $this->view->body = $body;
    return $this->view->render();
  }

  public function read($id){}

  public function update($id){}

  public function delete($id){}

  public function sendEmailers()
  {
    //TODO: Admin email(s).
  }

  public function show()
  {
    //TODO: Cron per user??
    $user = $_SESSION['phpci_user'];
  }
}