<?php

namespace Drupal\event_manager\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

class EventRegistrationForm extends FormBase {

  public function getFormId() {
    return 'event_registration_form';
  }

  public function buildForm(array $form, FormStateInterface $form_state) {

    $form['name'] = [
      '#type' => 'textfield',
      '#title' => 'Full Name',
      '#required' => TRUE,
    ];

    $form['email'] = [
      '#type' => 'email',
      '#title' => 'Email',
      '#required' => TRUE,
    ];

    $form['event'] = [
      '#type' => 'select',
      '#title' => 'Select Event',
      '#options' => [
        'drupal' => 'Drupal Workshop',
        'react' => 'React Bootcamp',
        'api' => 'API Development',
      ],
    ];

    $form['submit'] = [
      '#type' => 'submit',
      '#value' => 'Register',
    ];

    return $form;
  }

  public function submitForm(array &$form, FormStateInterface $form_state) {
    \Drupal::messenger()->addMessage('Registration successful for ' . $form_state->getValue('name'));
  }
}
