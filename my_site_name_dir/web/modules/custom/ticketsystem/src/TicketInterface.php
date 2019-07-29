<?php 

namespace Drupal\ticketingsystem; 

use Drupal\Core\Entity\ContentEntityInterface; 
use Drupal\user\EntityOwnerInterface;
use Drupal\Core\Entity\EntityChangedInterface; 

/**
 * Provides an interface defining a ticket entity
 * @ingroup ticket
 */

 interface TicketInterface extends ContentEntityInterface, EntityOwnerInterface, EntityChangedInterface{

 }

 ?> 
 