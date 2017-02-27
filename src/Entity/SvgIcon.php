<?php
/**
 * @file
 * Contains \Drupal\svg_icon\Entity\SvgIcon
 */

namespace Drupal\svg_icon\Entity;


use Drupal\Core\Config\Entity\ConfigEntityBase;
use Drupal\file\Entity\File;

/**
 * Defines the SvgIcon configuration entity.
 *
 * @ConfigEntityType(
 *   id = "svg_icon",
 *   label = @Translation("SVG icon"),
 *   handlers = {
 *     "list_builder" = "Drupal\svg_icon\SvgIconListBuilder",
 *     "form" = {
 *       "add" = "Drupal\svg_icon\Form\SvgIconForm",
 *       "edit" = "Drupal\svg_icon\Form\SvgIconForm",
 *       "delete" = "Drupal\svg_icon\Form\SvgIconDeleteForm"
 *     }
 *   },
 *   config_prefix = "svg_icon",
 *   admin_permission = "administer site configuration",
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "label",
 *     "uuid" = "uuid"
 *   },
 *   links = {
 *     "canonical" = "/admin/config/user-interface/svg-icon/{svg_icon}",
 *     "add-form" = "/admin/config/user-interface/svg-icon/add",
 *     "edit-form" = "/admin/config/user-interface/svg-icon/{svg_icon}/edit",
 *     "delete-form" = "/admin/config/user-interface/svg-icon/{svg_icon}/delete",
 *     "collection" = "/admin/config/user-interface/svg-icon"
 *   }
 * )
 */
class SvgIcon extends ConfigEntityBase implements SvgIconInterface {

  /**
   * The machine name of this SvgIcon configuration.
   * @var string
   */
  protected $id;

  /**
   * The huma-readable name of this SvgIcon configuration.
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

    $entities = SvgIcon::loadMultiple();
    $config_list = array();

    /** @var SvgIconInterface $entity */
    foreach ($entities as $entity) {
      $config_list[$entity->get('id')] = $entity->get('label');
    }

    return $config_list;
  }
}