<?php
namespace Drupal\custom_blocks\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Component\Annotation\Plugin;
use Drupal\Core\Annotation\Translation;
use Drupal\Core\Url;
use Drupal\Core\Link;

/**
 * Provides a 'Custom' Block
 *
 * @Block(
 *   id = "home_banner",
 *   admin_label = @Translation("Home Banner"),
 * )
 */

class CustomHomeBannerBlock extends BlockBase {
  /**
   * {@inheritdoc}
   */
  public function build() {
    $output = '';
    $query = \Drupal::entityQuery('node')
        ->condition('status', 1)
        ->condition('type', 'home_page_banner')
        ->sort('field_sequence');
    $nids = $query->execute();

    $nodes = entity_load_multiple('node', $nids);

    foreach($nodes as $node) {
      $model_image      = '';
      $background_image = '';
      $product_image    = '';
      
      if($node->field_model_image->target_id) {
        $model_image = file_create_url($node->field_model_image->entity->getFileUri());
      }
      
      if($node->field_image->target_id) {
        $background_image = file_create_url($node->field_image->entity->getFileUri());
      }
      
      if($node->field_product_image->target_id) {
        $product_image = file_create_url($node->field_product_image->entity->getFileUri());
      }
      
      $data[] = array(
        'model_image'       => $model_image,
        'background_image'  => $background_image,
        'product_image'     => $product_image,
        'link_url'          => $node->field_link->value,
        'sequence'          => $node->field_sequence->value,
      );
    }
    
    //echo '<pre>'; print_r($data); exit;

    return [
        '#theme'    => 'block__home_banner',
        '#title'    => $this->t('Home Banner'),
        '#data_obj' => $data,
    ];
  }
}