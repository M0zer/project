<?php

namespace Drupal\sm_module\Form;

use Drupal\Core\Config\ConfigFactoryInterface;
use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 *  our sm form
 */


class SmForm extends FormBase {
     /**
   *  {@inheritdoc}
   */
    public function getFormId(){
        return'sm_form';
    
    }
     /**
   *  {@inheritdoc}
   */

    public function buildForm(array $form, FormstateInterface $form_state) {
        $form['name']=[
            '#type' => 'textfield',
            '#title' => $this->t('Name'),
    
        ];
        
        $form['apple'] = array(
            '#input' => TRUE,
            '#type' => 'checkbox',
            '#title' => $this->t('Apple'),
            '#return_value' => 'Apple',
          );
        $form['orange'] = array(
            '#input' => TRUE,
            '#type' => 'checkbox',
            '#title' => $this->t('Orange'),
            '#return_value' => 'Orange'
          );
        $form['submit']=[
            '#type' => 'submit',
            '#value' => $this->t('Submit'),
        ];
        return $form;
    }
    public function submitForm(array &$form, FormstateInterface $form_state)
    {   
        $name=$form_state->getValue('name');
        $fruitsAll=['apple','orange'];
        $a=0;
        foreach($fruitsAll as $i){
            if($form_state->getValue($i)!=NULL){
                $fruits[$a]=$form_state->getValue($i);
                $a++;
            }
        }
        $outcome;
        foreach($fruits as $fruit){
            $outcome = $outcome .", ". $fruit;
        }
        if($outcome!=NULL && $name!=NULL){
        $this->messenger()->addStatus($this->t('@you choosed this@value' ,[
            '@you'=>$name,
            '@value'=>$outcome
        ]));
        }
        elseif($name!=NULL){
            $this->messenger()->addStatus($this->t('@you choosed nothing' ,[
                '@you'=>$name
            ]));
            }
        elseif($outcome!=NULL){
            $this->messenger()->addStatus($this->t('you choosed this@value' ,[
                '@value'=>$outcome
            ]));
            }

        else{
            $this->messenger()->addStatus($this->t('you choosed nothing'));
            }
    }
}
    