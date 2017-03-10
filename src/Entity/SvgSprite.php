<?php
/**
 * @file
 * Contains \Drupal\svg_sprite\Entity\SvgSprite
 */

namespace Drupal\svg_sprite\Entity;


use Drupal\Core\Config\Entity\ConfigEntityBase;
use Drupal\file\Entity\File;

/**
 * Defines the SvgSprite configuration entity.
 *
 * @ConfigEntityType(
 *   id = "svg_sprite",
 *   label = @Translation("SVG icon"),
 *   handlers = {
 *     "list_builder" = "Drupal\svg_sprite\SvgSpriteListBuilder",
 *     "form" = {
 *       "add" = "Drupal\svg_sprite\Form\SvgSpriteForm",
 *       "edit" = "Drupal\svg_sprite\Form\SvgSpriteForm",
 *       "delete" = "Drupal\svg_sprite\Form\SvgSpriteDeleteForm"
 *     }
 *   },
 *   config_prefix = "svg_sprite",
 *   admin_permission = "administer site configuration",
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "label",
 *     "uuid" = "uuid"
 *   },
 *   links = {
 *     "canonical" = "/admin/config/user-interface/svg-icon/{svg_sprite}",
 *     "add-form" = "/admin/config/user-interface/svg-icon/add",
 *     "edit-form" = "/admin/config/user-interface/svg-icon/{svg_sprite}/edit",
 *     "delete-form" = "/admin/config/user-interface/svg-icon/{svg_sprite}/delete",
 *     "collection" = "/admin/config/user-interface/svg-icon"
 *   }
 * )
 */
class SvgSprite extends ConfigEntityBase implements SvgSpriteInterface {

  /**
   * The machine name of this SvgSprite configuration.
   * @var string
   */
  protected $id;

  /**
   * The huma-readable name of this SvgSprite configuration.
   * @var string
   */
  protected $label;

  /**
   * The ID of the loaded file.
   * @var array
   */
  protected $svg_sprite;

  /**
   * Gets the SVG sprite file.
   *
   * @return \Drupal\file\FileInterface
   *   The SVG sprite file.
   */
  public function getSvgSprite() {

    $svg_sprite = $this->svg_sprite;

    return File::load($svg_sprite[0]);
  }

  /**
   * Gets the configuration list.
   *
   * @return array
   *   An array of Droppy configuration. The config ID is the key, and the
   *   config label the value.
   */
  public static function getConfigList() {

    $entities = SvgSprite::loadMultiple();
    $config_list = array();

    /** @var SvgSpriteInterface $entity */
    foreach ($entities as $entity) {
      $config_list[$entity->get('id')] = $entity->get('label');
    }

    return $config_list;
  }
}