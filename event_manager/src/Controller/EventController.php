<?php

namespace Drupal\event_manager\Controller;

use Drupal\Core\Controller\ControllerBase;

class EventController extends ControllerBase {

  public function list() {
    return [
      '#markup' => '
        <h2>Upcoming Events</h2>
        <ul>
          <li>Drupal Workshop</li>
          <li>React Bootcamp</li>
          <li>API Development</li>
        </ul>
      ',
    ];
  }
}
