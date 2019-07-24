<?php

namespace Drupal\intern\Form;

use Drupal\core\Form\FormBase; 
use Drupal\core\Form\FormStateInterface; 

class ProfileForm extends FormBase{
    public function buildForm(array $form, FormStateInterface $form_state){
        $form['first_name'] = [
            '#type' => 'textfield',
            '#title' => 'First Name',
            '#description' => 'Last Name',
            '#required' => TRUE, 
        ];
        
        $form['last_name'] = [
            '#type' => 'textfield',
            '#title' => 'Last Name', 
            '#description' => 'Last Name',
            '#required' => TRUE, 
        ];

        $form['Age'] = [
            '#type' => 'textfield', 
            '#title' => 'Last Name', 
            '#description' => 'Age'
        ]; 

        $form['actions'] = [
            '#type' => 'actions', 
        ];

        $form['actions']['submit'] = [
            '#type' => 'submit', 
            '#value' => 'Submit',
        ];

        return $form; 
    }

    public function getFormId(){
        return 'intern_first_form';
    }

    public function validateForm(array &$form, FormStateInterface $form_state){
        $title = $form_state->getValue('title');
        if(empty($title)){
            $form_state->setErrorByName('title', 'The title must exists.');
        }
    }

    public function submitForm(array &$form, FormStateInterface $form_state){
        $title = $form_state->getValue('title');
        drupal_set_message('You submitted the form with title: ' .$title);
    }

}