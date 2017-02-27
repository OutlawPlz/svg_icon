<?php
/**
 * @file
 * Contains \Drupal\svg_icon\Element\SvgIcon.
 */

namespace Drupal\svg_icon\Element;


use Drupal\Core\Render\Element\RenderElement;

/**
 * Render svg_icon element.
 *
 * @RenderElement("svg_icon")
 */
class SvgIcon extends RenderElement {

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
      '#theme' => 'svg_icon',
      '#svg_sprite' => '',
      '#icon_id' => '',
      '#pre_render' => array(
        [$class, 'preRenderSvgIcon']
      )
    );
  }

  /**
   * Prepare render array for the template.
   */
  public static function preRenderSvgIcon($element) {

    /** @var \Drupal\file\FileInterface $file */
    $file = $element['#svg_sprite'];

    $element['svg_sprite'] = array(
      '#markup' => file_url_transform_relative($file->url())
    );

    $element['icon_id'] = array(
      '#markup' => $element['#icon_id']
    );

    $element['#attached'] = array(
      'library' => array(
        'svg_icon/svg_icon'
      )
    );

    return $element;
  }
}