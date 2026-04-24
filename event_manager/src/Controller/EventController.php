<?php

namespace Drupal\event_manager\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * Event Controller.
 */
class EventController extends ControllerBase {

  /**
   * Admin page callback.
   */
  public function adminPage() {
    return [
      '#markup' => t('Welcome to Event Manager'),
    ];
  }

}
