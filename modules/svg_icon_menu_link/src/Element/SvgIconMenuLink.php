<?php
/**
 * @file
 * Contains \Drupal\svg_icon_menu_link\Element\SvgIconMenuLink.
 */

namespace Drupal\svg_icon_menu_link\Element;


use Drupal\Core\Render\Element\RenderElement;

/**
 * Class SvgIcon
 *
 * @RenderElement("svg_icon_menu_link")
 */
class SvgIconMenuLink extends RenderElement {

  /**
   * Returns the element properties for this element.
   *
   * @return array
   *   An array of element properties. See
   *   \Drupal\Core\Render\ElementInfoManagerInterface::getInfo() for
   *   documentation of the standard properties of all elements, and the
   *   return value format.
   */
  public function getInfo() {

    $class = get_class($this);

    return array(
      '#theme' => 'svg_icon_menu_link',
      '#svg' => '',
      '#icon_id' => '',
      '#icon_right' => FALSE,
      '#pre_render' => array(
        [$class, 'preRenderSvgIcon' ]
      )
    );
  }

  /**
   * Prepare render array for the template.
   */
  public static function preRenderSvgIcon($element) {

    $element['#only'] = (bool) $element['#only'];
    $element['#right'] = (bool) $element['#right'];

    $classes = array(
      'svg-icon',
      'svg-icon' . $element['#id']
    );

    if (!$element['#only']) {
      $element['#right'] ? $classes[] = 'svg-icon--right' : $classes[] = 'svg-icon--left';
    }

    $element['label'] = array(
      '#markup' => $element['#label']
    );

    $element['svg'] = array(
      '#markup' => $element['#svg']
    );

    $element['id'] = array(
      '#markup' => $element['#id']
    );

    $element['#attributes'] = array(
      'class' => $classes
    );

    $element['#attached'] = array(
      'library' => array(
        'svg_icon/svg_icon'
      )
    );

    return $element;
  }
}