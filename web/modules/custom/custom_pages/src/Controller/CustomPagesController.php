<?php

  namespace Drupal\custom_pages\Controller;
  
  use Drupal\Core\Controller\ControllerBase;
  
  class CustomPagesController extends ControllerBase {

    public function prohance() {
      return $element = array(
        '#title'  => t('Prohance'),  
        '#markup' => '',
      );
    }
    
    public function prohance_d() {
      return $element = array(
        '#title'  => t('Prohance '),  
        '#markup' => '',
      );
    }
    
    public function prohance_mom() {
      return $element = array(
        '#title'  => t('Prohance Mom'),  
        '#markup' => '',
      );
    }
    
  
    
   

  }