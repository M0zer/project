<?php
namespace Drupal\iq_module\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;


class IqSettingsForm extends ConfigFormBase {

  /** 
   * Config settings.
   *
   * @var string
   */
  

  /** 
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'iq_settings';
  }

  protected function getEditableConfigNames(){

      return [];    
  }


  /** 
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = \Drupal::config('iq_module.settings');
    print $config->get('iq_min_value');
    
    $form['Iq_value'] = [
      '#type' => 'number',
      '#title' => $this->t('IQ'),
      '#default_value' => 120,
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