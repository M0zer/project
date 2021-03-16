<?php

namespace Drupal\iq_module\Form;

use Drupal\Core\Config\ConfigFactoryInterface;
use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 *  our simple form
 */


class IqForm extends FormBase { 

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
   *  {@inheritdoc}
   */
  public function getFormId(){
    return'iq_form';

}

  /**
   *  {@inheritdoc}
   */
  public function buildForm(array $form , FormstateInterface $form_state){

    $form['iq_value']=[
        '#type' => 'number',
        '#title' => $this->t('elso szam'),

    ];
    
    $form['submit']=[
        '#type' => 'submit',
        '#value' => $this->t('Submit'),
    ];

    return $form;
}
public function submitForm(array &$form, FormstateInterface $form_state)

  { 
    $config = \Drupal::config('iq_module.settings');
    $iq=$config->get('iq_min_value');
    $iq2=$form_state->getValue('iq_value');
    
    $this->messenger()->addWarning($this->t('@iq , @iq2', [
        '@iq'=>$iq,
        '@iq2'=>$iq2,
        ]));
      if($iq<$iq2){
            $this->messenger()->addStatus($this->t('Az IQ-d @value', [
            '@value' => $form_state->getValue('iq_value'),
            ]));
                

    }
    else{

        $this->messenger()->addWarning($this->t('Túl kevés az IQ-d'));
    
    }
  }

}