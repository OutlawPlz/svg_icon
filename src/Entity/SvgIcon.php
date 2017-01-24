<?php
/**
 * @file
 * Contains \Drupal\svg_icon\Entity\SvgIcon
 */

namespace Drupal\svg_icon\Entity;


use Drupal\Core\Config\Entity\ConfigEntityBase;

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
   * @var
   */
  protected $svg;

  /**
   * Return the SVG.
   * @return mixed
   */
  public function getSvg() {

    return $this->svg;
  }
}