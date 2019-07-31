<?php 

namespace Drupal\ticket\Form; 

use Drupal\Core\Entity\ContentEntityForm; 
use Drupal\Core\Form\FormStateInterface; 

/**
 * Form controller for the ticket edit forms 
 * @ingroup ticket 
 */
class TicketForm extends ContentEntityForm{

    /**
     * {@inheritdoc} 
     * */
    public function buildForm(array $form, FormStateInterface $form_state){
        $form = parent::buildForm($form, $form_state);
        $entity = $this->entity; 

        //TODO: To fill out the rest of the form information maybe?

        $form['actions'] = [
            '#type' => 'actions', 
        ];

        $form['actions']['submit'] = [
            '#type' => 'submit', 
            '#value' => 'Submit',
        ];

        return $form; 
    }


    public function save(array $form, FormStateInterface $form_state){

    }

    public function validateForm(array &$form, FormStateInterface $form_state){
        $title = $form_state->getValue('name');
        if(empty($title)){
            $form_state->setErrorByName('name', 'The name must exists.');
        }
    }

    public function submitForm(array &$form, FormStateInterface $form_state){
        $title = $form_state->getValue('name');
        drupal_set_message('You submitted the form with name: ' .$name); 
    }
    
}
