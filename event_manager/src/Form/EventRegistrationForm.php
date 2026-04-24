
 <?php

namespace Drupal\event_manager\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\event_manager\Service\EventStorage;
use Drupal\Core\Ajax\AjaxResponse;
use Drupal\Core\Ajax\HtmlCommand;

class EventRegistrationForm extends FormBase {

  protected $storage;

  public function __construct(EventStorage $storage) {
    $this->storage = $storage;
  }

  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('event_manager.storage')
    );
  }

  public function getFormId() {
    return 'event_registration_form';
  }

  public function buildForm(array $form, FormStateInterface $form_state) {

    $form['#prefix'] = '<div id="event-form-wrapper">';
    $form['#suffix'] = '</div>';

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
      '#title' => 'Event',
      '#options' => [
        'drupal' => 'Drupal Workshop',
        'react' => 'React Bootcamp',
        'api' => 'API Development',
      ],
    ];

    $form['actions']['submit'] = [
      '#type' => 'submit',
      '#value' => 'Register',
      '#ajax' => [
        'callback' => '::ajaxSubmit',
        'wrapper' => 'event-form-wrapper',
      ],
    ];

    return $form;
  }

  public function validateForm(array &$form, FormStateInterface $form_state) {
    if (!filter_var($form_state->getValue('email'), FILTER_VALIDATE_EMAIL)) {
      $form_state->setErrorByName('email', 'Invalid email address');
    }
  }

  public function submitForm(array &$form, FormStateInterface $form_state) {
    $this->storage->save($form_state->getValues());
  }

  public function ajaxSubmit(array &$form, FormStateInterface $form_state) {
    $response = new AjaxResponse();

    if ($form_state->hasAnyErrors()) {
      return $form;
    }

    $this->submitForm($form, $form_state);

    $response->addCommand(
      new HtmlCommand('#event-form-wrapper', '<div class="success">Registration successful!</div>')
    );

    return $response;
  }
}
