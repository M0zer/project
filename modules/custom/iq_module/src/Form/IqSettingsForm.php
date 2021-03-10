<?php
namespace Drupal\iq_module\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;


class IqSettingsForm extends ConfigFormBase {
  protected $configFactory;

  public static function create(ContainerInterface $container)
  {
    return new static(
      $container->get('config.factory')
    );
  }

  public function __construct(
    ConfigFactoryInterface $configFactory
  )
  {
    $this->configFactory = $configFactory;
  }

  /** 
   * Config settings.
   *
   * @var string
   */
  const SETTINGS = 'example.settings';

  /** 
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'iq_settings';
  }

  /** 
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return [
      static::SETTINGS,
    ];
  }

  /** 
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config(static::SETTINGS);
    $settings = $this->configFactory->getEditable('iq_module.settings');
    $form['Iq_value'] = [
      '#type' => 'number',
      '#title' => $this->t('IQ'),
      '#default_value' => $settings->get('iq_value'),
    ];  

    return parent::buildForm($form, $form_state);
  }

  /** 
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $settings
      ->set('iq_value', $form_state->getValue('iq_value'))
      ->save();

    parent::submitForm($form, $form_state);
  }

}