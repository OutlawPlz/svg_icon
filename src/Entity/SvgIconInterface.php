<?php
/**
 * @file
 * Contains \Drupal\scg_icon\Entity\SvgIconInterface
 */

namespace Drupal\svg_icon\Entity;

use Drupal\Core\Config\Entity\ConfigEntityInterface;

/**
 * Provides an interface defining a SvgIcon configuration entity.
 * @package Drupal\droppy\Entity
 */
interface SvgIconInterface extends ConfigEntityInterface {


  /**
   * Gets the SVG sprite file.
   *
   * @return \Drupal\file\FileInterface
   *   The SVG sprite file.
   */
  public function getSvgSprite();

  /**
   * Gets the configuration list.
   *
   * @return array
   *   An array of Droppy configuration. The config ID is the key, and the
   *   config label the value.
   */
  public static function getConfigList();
}