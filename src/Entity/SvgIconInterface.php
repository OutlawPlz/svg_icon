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

  public function getSvg();
}