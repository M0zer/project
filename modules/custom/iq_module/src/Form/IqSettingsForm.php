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

      return ['iq_module.settings'];    
  }


  /** 
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config=$this->config('iq_module.settings');
    $form['iq_value'] = [
      '#type' => 'number',
      '#title' => $this->t('IQ'),
      '#default_value' => $config->get('iq_min_value'),
    ];  

    return parent::buildForm($form, $form_state);
  }

  /** 
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    
    $this->config('iq_module.settings')
      ->set('iq_min_value', $form_state->getValue('iq_value'))
      ->save();

    parent::submitForm($form, $form_state);
  }

}