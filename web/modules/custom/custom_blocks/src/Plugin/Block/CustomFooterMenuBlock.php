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
   *   id = "footermenu",
   *   admin_label = @Translation("Footer Menu"),
   * )
   */

  class CustomFooterMenuBlock extends BlockBase {
    /**
     * {@inheritdoc}
     */
    public function build() {
      $menu  = array();
      $tree = \Drupal::menuTree()->load('footer', new \Drupal\Core\Menu\MenuTreeParameters());
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
        '#theme' => 'block__footermenu',
        '#title' => $this->t('Left Menu'),
        '#data_obj'  => $menu,
      ];
    }
  }