<?php
/**
 * @files
 * Contains \Drupal\svg_icon\Form\SvgIconForm
 */

namespace Drupal\svg_icon\Form;


use Drupal\Core\Entity\EntityForm;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\Core\Form\FormStateInterface;
use Drupal\file\Entity\File;
use Drupal\file\FileInterface;

/**
 * Form handler for the SvgIcon configuration add and edit forms.
 */
class SvgIconForm extends EntityForm {

  /**
   * Gets the actual form array to be built.
   *
   * @param array $form
   *   An associative array containing the structure of the form.
   * @param \Drupal\Core\Form\FormStateInterface $form_state
   *   The current state of the form.
   * @return array
   *   The form structure.
   */
  public function form(array $form, FormStateInterface $form_state) {

    /** @var \Drupal\svg_icon\Entity\SvgIconInterface $entity */
    $entity = $this->entity;
    $form = parent::form($form, $form_state);

    $form['label'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Label'),
      '#maxlength' => EntityTypeInterface::ID_MAX_LENGTH,
      '#default_value' => $entity->get('label'),
      '#description' => $this->t(''),
      '#required' => TRUE,
    );

    $form['id'] = array(
      '#type' => 'machine_name',
      '#default_value' => $entity->get('id'),
      '#maxlength' => EntityTypeInterface::ID_MAX_LENGTH,
      '#machine_name' => array(
        'exists' => '\Drupal\svg_icon\Entity\SvgIcon::load',
        'source' => array('label')
      ),
      '#disabled' => !$entity->isNew(),
      '#description' => $this->t('')
    );

    $form['svg'] = array(
      '#type' => 'managed_file',
      '#title' => 'SVG sprite',
      '#description' => 'Upload an SVG sprite file.',
      '#upload_location' => 'public://svg-icon',
      '#upload_validators' => array(
        'file_validate_extensions' => array('svg')
      ),
      '#default_value' => $entity->get('svg'),
      '#required' => TRUE
    );

    return $form;
  }

  /**
   * Form submission handler for the 'save' action.
   *
   * @param array $form
   *   An associative array containing the structure of the form.
   * @param \Drupal\Core\Form\FormStateInterface $form_state
   *   The current state of the form.
   * @return int
   *   Either SAVED_NEW or SAVED_UPDATED, depending on the operation performed.
   */
  public function save(array $form, FormStateInterface $form_state) {

    /** @var \Drupal\svg_icon\Entity\SvgIconInterface $entity */
    $entity = $this->entity;
    $svg = $form_state->getValue('svg');

    $this->saveFile(File::load($svg[0]));

    $status = parent::save($form, $form_state);

    $replacement = array(
      '%label' => $entity->get('label')
    );

    if ($status === SAVED_NEW) {
      drupal_set_message($this->t('Configuration <em>%label</em> has been created'), $replacement);
    }
    elseif ($status === SAVED_UPDATED) {
      drupal_set_message($this->t('Configuration <em>%label</em> has been updated.'), $replacement);
    }

    $form_state->setRedirect('entity.svg_icon.collection');

    return $status;
  }

  /**
   * Set file status to permanent and register the file_usage entry.
   *
   * @param \Drupal\file\FileInterface $file
   */
  protected function saveFile(FileInterface $file) {

    /** @var \Drupal\file\FileUsage\FileUsageInterface $file_usage */
    $file_usage = \Drupal::service('file.usage');
    $entity = $this->entity;

    $file_usage->add($file, 'svg_icon', $entity->getEntityTypeId(), $entity->id());
    $file->setPermanent();
    $file->save();
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
