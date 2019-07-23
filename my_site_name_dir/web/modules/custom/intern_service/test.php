<?php 

$coffeeServer = \Drupal::service('intern_services.coffee'); 
$coffeeServer->coffeeRun(); 

$hyuuman = \Drupal::service('hyuuman'); 
Print $hyuuman->addHyuuman(2,3);