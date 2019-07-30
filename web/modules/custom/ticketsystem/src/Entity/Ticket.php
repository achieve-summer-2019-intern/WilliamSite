<?php 
    namespace Drupal\ticket\Entity; 

    use Drupal\Core\Entity\EntityStorageInterface;
    use Drupal\Core\Field\BaseFieldDefinition;
    use Drupal\Core\Entity\ContentEntityBase;
    use Drupal\Core\Entity\EntityTypeInterface;
    use Drupal\Core\Entity\EntityChangedTrait;
    use Drupal\ticket\TicketInterface;
    use Drupal\user\UserInterface; 


class Ticket extends TicketEntityBase implements TicketInterface{
    use EntityChangedTrait; // Implement methods defined by EntityChangedInterface 


    public static function preCreate(EntityStorageInterface $storage_controller, array &$values){
        parent::preCreate($storage_controler, $values);
        $values += array(
            'user_id' => \Drupal::currentUser()->id(),
          ); 
    }
    
    /**
   * {@inheritdoc}
   */
  public function getCreatedTime() {
    return $this->get('created')->value;
  }

  /**
   * {@inheritdoc}
   */
  public function getOwner() {
    return $this->get('user_id')->entity;
  }

  /**
   * {@inheritdoc}
   */
  public function getOwnerId() {
    return $this->get('user_id')->target_id;
  }

  /**
   * {@inheritdoc}
   */
  public function setOwnerId($uid) {
    $this->set('user_id', $uid);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function setOwner(UserInterface $account) {
    $this->set('user_id', $account->id());
    return $this;
  }

  public static function baseFieldDefinition(EntityTypeInterface $entity_type){
        // Standard Field, used as unique if primary index  
        $fields['id'] = BaseFieldDefinition::create('integer')
            ->setLabel(t('ID'))
            ->setDescription(t('The ID of the Ticket entity.'))
            ->setReadOnly(TRUE);

        // Standard Field, unique outside of the scope of the current project 
        $fields['uuid'] = BaseFieldDefinition::create('uuid')
            ->setLabel(t('UUID'))
            ->setDescription(t('The UUID of the Ticket entity.'))
            ->setReadOnly(TRUE);
    
        $fields['name'] = BaseFieldDefinition::create('string')
            ->setLabel(t('Name'))
            ->setDescription(t('The name of the Ticket entity.'))
            ->setSettings(array(
            'default_value' => '',
            'max_length' => 255,
            'text_processing' => 0,
            ))
            ->setDisplayOptions('view', array(
            'label' => 'above',
            'type' => 'string',
            'weight' => -6,
            ))
            ->setDisplayOptions('form', array(
            'type' => 'string_textfield',
            'weight' => -6,
            ))
            ->setDisplayConfigurable('form', TRUE)
            ->setDisplayConfigurable('view', TRUE);

        
        $fields['description'] = BaseFieldDefinition::create('string')
            ->setLabel(t('Description'))
            ->setDescription(t('The Description of the Ticket entity.'))
            ->setSettings(array(
            'default_value' => '',
            // 'max_length' => 255, //I wonder if this will not set a maximum length
            'text_processing' => 0,
            ))
            ->setDisplayOptions('view', array(
            'label' => 'above',
            'type' => 'string',
            'weight' => -6,
            ))
            ->setDisplayOptions('form', array(
            'type' => 'string_textfield',
            'weight' => -6,
            ))
            ->setDisplayConfigurable('form', TRUE)
            ->setDisplayConfigurable('view', TRUE);        

        // Owner field of the ticket.
        // Entity reference field, holds the reference to the user object.
        // The view shows the user name field of the user.
        // The form presents a auto complete field for the user name.
        $fields['user_id'] = BaseFieldDefinition::create('entity_reference')
            ->setLabel(t('User Name'))
            ->setDescription(t('The Name of the associated user.'))
            ->setSetting('target_type', 'user')
            ->setSetting('handler', 'default')
            ->setDisplayOptions('view', array(
                'label' => 'above',
                'type' => 'entity_reference_label',
                'weight' => -3,
            ))
            ->setDisplayOptions('form', array(
                'type' => 'entity_reference_autocomplete',
                'settings' => array(
                'match_operator' => 'CONTAINS',
                'size' => 60,
                'autocomplete_type' => 'tags',
                'placeholder' => '',
                ),
                'weight' => -3,
            ))
            ->setDisplayConfigurable('form', TRUE)
            ->setDisplayConfigurable('view', TRUE);

        $fields['created'] = BaseFieldDefinition::create('created')
            ->setLabel(t('Created'))
            ->setDescription(t('The time that the entity was created.'));

        $fields['changed'] = BaseFieldDefinition::create('changed')
            ->setLabel(t('Changed'))
            ->setDescription(t('The time that the entity was last edited.'));

        return $fields;
    }


}

