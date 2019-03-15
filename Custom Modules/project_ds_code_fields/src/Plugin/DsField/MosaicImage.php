<?php

namespace Drupal\project_ds_code_fields\Plugin\DsField;

use Drupal\ds\Plugin\DsField\DsFieldBase;
use Drupal\file\Entity\File;

/**
 * Plugin that generates the image for the homepage mosaic tile based on whether the content
 * editor has selected the image option on the node edit form.
 *
 * Opportunities, News and People nodes have three background options to their mosaic tiles:
 * Clear, Angled White, or Image.
 *
 * Event nodes have the option to include a foreground image in their mosaic tiles. Their foreground
 * image option was added late in the game which makes the title of the plugin ("DS: Mosaic Image Background")
 * a bit misleading!
 *
 * @DsField(
 *   id = "mosaic_image_background",
 *   title = @Translation("DS: Mosaic Image Background"),
 *   entity_type = "node",
 *   provider = "project_ds_code_fields",
 *   ui_limit = {"*|featured"}
 * )
 */
class MosaicImage extends DsFieldBase {

  /**
   * {@inheritdoc}
   */
  public function build() {
    $entity = $this->entity();
    $background = '';
    $use_image = '';
    $render_array = [];

    // Opportunities, News, and People nodes have three background options to their mosaic tiles
    if ($entity->hasField('field_mosaic_background')) {
      $background = $entity->field_mosaic_background->value;
    }
    
    // Event nodes have a checkbox to include a foreground image on the mosaic tile
    if ($entity->hasField('field_mosaic_image')) {
      $use_image = $entity->field_mosaic_image->value;
    }

    // Opportunities, News, and People nodes
    if (($background) && ($background == 'image')) { // the "image" option has been selected
      // and an image has to actually exist!
      if (($entity->hasField('field_main_image') && (!$entity->get('field_main_image')->isEmpty()))) {
        $image = $entity->field_main_image->entity->field_image;
        if ($image) {
          $file = File::load($image->target_id);
          $url = $file->getFileUri();
          $render_array = [
            '#theme' => 'image_style',
            '#style_name' => 'rectangle',
            '#uri' => $url,
          ];
        }
      }

    // Event nodes
    } elseif (($use_image) && ($use_image == '1')) { // the use image option has been checked
      // and an image has to actually exist!
      if (($entity->hasField('field_main_image') && (!$entity->get('field_main_image')->isEmpty()))) {
        $image = $entity->field_main_image->entity->field_image;
        if ($image) {
          $file = File::load($image->target_id);
          $url = $file->getFileUri();
          $render_array = [
            '#theme' => 'image_style',
            '#style_name' => 'rectangle_thin',
            '#uri' => $url,
          ];
        }
      }
    }

    return $render_array;

  }
  
}
