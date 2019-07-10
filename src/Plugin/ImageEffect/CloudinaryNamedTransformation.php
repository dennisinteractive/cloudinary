<?php

namespace Drupal\cloudinary\Plugin\ImageEffect;

use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Image\ImageInterface;
use Drupal\image\ConfigurableImageEffectBase;

/**
 * Applies Cloudinary Named Transformation to an image.
 *
 * @ImageEffect(
 *   id = "cloudinary_named_transformation",
 *   label = @Translation("Cloudinary named transformation"),
 *   description = @Translation("Applies Cloudinary named transformation to an image.")
 * )
 */
class CloudinaryNamedTransformation extends ConfigurableImageEffectBase {

  /**
   * {@inheritdoc}
   */
  public function applyEffect(ImageInterface $image) {
    // This is a stub. This method is required,
    // but not being used for cloudinary transformations.
    return TRUE;
  }

  /**
   * {@inheritdoc}
   */
  public function getSummary() {
    $summary = [
      '#markup' => '(<b>' . $this->configuration['transformation'] . '</b>)',
    ];
    $summary += parent::getSummary();

    return $summary;
  }

  /**
   * {@inheritdoc}
   */
  public function defaultConfiguration() {
    return [
      'transformation' => NULL,
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function buildConfigurationForm(array $form, FormStateInterface $form_state) {
    $form['transformation'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Named transformation'),
      '#description' => $this->t('Read more at <a href="@api-doc">the Cloudinary documentation</a>.', [
          '@api-doc' => 'https://cloudinary.com/documentation/image_transformations#named_transformations',
        ]
      ),
      '#default_value' => $this->configuration['transformation'],
      '#required' => TRUE,
    ];
    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function submitConfigurationForm(array &$form, FormStateInterface $form_state) {
    parent::submitConfigurationForm($form, $form_state);
    $this->configuration['transformation'] = $form_state->getValue('transformation');
  }

}
