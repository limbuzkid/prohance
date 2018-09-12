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
   *   id = "rightmenu",
   *   admin_label = @Translation("Right Menu"),
   * )
   */

  class CustomRightMenuBlock extends BlockBase {
    /**
     * {@inheritdoc}
     */
    public function build() {
      $menu  = array();
     
      $tree = \Drupal::menuTree()->load('menu-right', new \Drupal\Core\Menu\MenuTreeParameters());
      foreach ($tree as $item) {
        if($item->link->isEnabled()) {
          $title  = $item->link->getTitle();
          $link   = $item->link->getUrlObject()->toString();
          $menu[] = array(
            'title' => $title,
            'link'  => $link
          );
        }
      }
      
      
      //echo '<pre>'; print_r($menu); exit;
      
      return [
        '#theme' => 'block__rightmenu',
        '#title' => $this->t('Right Menu'),
        '#data_obj'  => $menu,
      ];
    }
  }