<?php
/**
 * @file
 * Contains \Drupal\svg_icon\Form\SvgIconDeleteForm
 */

namespace Drupal\svg_icon\Form;


use Drupal\Core\Entity\EntityDeleteForm;
use Drupal\Core\Form\FormStateInterface;
use Drupal\file\Entity\File;
use Drupal\file\FileInterface;

class SvgIconDeleteForm extends EntityDeleteForm {

  /**
   * Form submission handler for the 'delete' action.
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {

    /** @var \Drupal\svg_icon\Entity\SvgIconInterface $entity */
    $entity = $this->entity;
    $svg = $entity->getSvg();

    $this->deleteFile(File::load($svg[0]));

    parent::submitForm($form, $form_state);
  }

  /**
   * Remove the file_usage entry and if there are no other usage, set file
   * status to temporary.
   *
   * @param \Drupal\file\FileInterface $file
   */
  public function deleteFile(FileInterface $file) {

    /** @var \Drupal\file\FileUsage\FileUsageInterface $file_usage */
    $file_usage = \Drupal::service('file.usage');
    /** @var \Drupal\svg_icon\Entity\SvgIconInterface $entity */
    $entity = $this->entity;

    $file_usage->delete($file, 'svg_icon', $entity->getEntityTypeId(), $entity->id());
    $usage_list_count = count($file_usage->listUsage($file));

    if (!$usage_list_count) {
      $file->setTemporary();
    }

    $file->save();
  }
}
