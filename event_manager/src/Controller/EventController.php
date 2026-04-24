<?php

namespace Drupal\event_manager\Controller;

use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\event_manager\Service\EventStorage;

class EventController extends ControllerBase {

  protected $storage;

  public function __construct(EventStorage $storage) {
    $this->storage = $storage;
  }

  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('event_manager.storage')
    );
  }

  public function list() {
    $rows = [];

    foreach ($this->storage->getAll() as $record) {
      $rows[] = [
        $record->id,
        $record->name,
        $record->email,
        $record->event,
        date('Y-m-d H:i', $record->created),
      ];
    }

    return [
      '#type' => 'table',
      '#header' => ['ID', 'Name', 'Email', 'Event', 'Created'],
      '#rows' => $rows,
    ];
  }
}
