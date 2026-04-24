<?php

namespace Drupal\event_manager\Service;

use Drupal\Core\Database\Connection;

class EventStorage {

  protected $database;

  public function __construct(Connection $database) {
    $this->database = $database;
  }

  public function save($data) {
    $this->database->insert('event_registrations')
      ->fields([
        'name' => $data['name'],
        'email' => $data['email'],
        'event' => $data['event'],
        'created' => time(),
      ])
      ->execute();
  }

  public function getAll() {
    return $this->database->select('event_registrations', 'e')
      ->fields('e')
      ->orderBy('created', 'DESC')
      ->execute()
      ->fetchAll();
  }
}
