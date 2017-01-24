<?php
/**
 * @file
 * Contains \Drupal\svg_icon\Form\SvgIconDeleteForm
 */

namespace Drupal\svg_icon\Form;


use Drupal\Core\Entity\EntityDeleteForm;
use Drupal\Core\Form\FormStateInterface;
use Drupal\file\Entity\File;

class SvgIconDeleteForm extends EntityDeleteForm {

  /**
   * Form submission handler for the 'delete' action.
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {

    /** @var \Drupal\svg_icon\Entity\SvgIconInterface $entity */
    $entity = $this->entity;
    $svg = $entity->getSvg();
    /** @var \Drupal\file\FileUsage\FileUsageInterface $file_usage */
    $file_usage = \Drupal::service('file.usage');

    $file = File::load($svg[0]);
    $file_usage->delete($file, 'svg_icon', $entity->getEntityTypeId(), $entity->id());
    $file->setTemporary();
    $file->save();

    parent::submitForm($form, $form_state);
  }
}