<?php
/**
 * @file
 * Contains \Drupal\svg_icon_menu_link\Element\SvgIconMenuLink.
 */

namespace Drupal\svg_icon\Element;


use Drupal\Core\Render\Element\RenderElement;

/**
 * Class SvgIcon
 *
 * @RenderElement("svg_icon_text")
 */
class SvgIconText extends RenderElement {


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
      '#theme' => 'svg_icon_text',
      '#svg_sprite' => '',
      '#icon_id' => '',
      '#label' => '',
      '#icon_right' => FALSE,
      '#hide_label' => FALSE,
      '#pre_render' => array(
        [$class, 'preRenderSvgIconText']
      )
    );
  }

  /**
   * Prepare render array for the template.
   */
  public static function preRenderSvgIconText($element) {

    $element['icon'] = array(
      '#type' => 'svg_icon',
      '#svg_sprite' => $element['#svg_sprite'],
      '#icon_id' => $element['#icon_id']
    );

    $element['label'] = array(
      '#markup' => $element['#label']
    );

    return $element;
  }
}