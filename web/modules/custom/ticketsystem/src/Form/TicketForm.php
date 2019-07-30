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


        return $form; 
    }


    public function save(array $form, FormStateInterface $form_state){

    }

    public function validateForm(array &$form, FormStateInterface $form_state){

    }

    public function submitForm(array &$form, FormStateInterface $form_state){

    }
    
}
