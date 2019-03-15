<?php
/**
 * @file
 * Contains \Drupal\project_ds_code_fields\Plugin\DsField\BodySummary.
 */

namespace Drupal\project_ds_code_fields\Plugin\DsField;

use Drupal\ds\Plugin\DsField\DsFieldBase;

/**
 * Plugin that renders the text explicitly entered in the body summary field
 * but will NOT generate a summary from the body field if the summary is left blank.
 *
 * @DsField(
 *   id = "banner_summary",
 *   title = @Translation("DS: Summary for Banners"),
 *   entity_type = "node",
 *   provider = "project_ds_code_fields",
 *   ui_limit = {"*|*"}
 * )
 */
class BodySummary extends DsFieldBase {

  /**
   * {@inheritdoc}
   */
  public function build() {
    // Fetch the entity
    $node = $this->entity();
    $summary = "";
    $render_array = [];

    // If body field exists
    if (isset($node->body)) {
      $summary = $node->body->summary;
    }
    // If body summary exists
    if (!empty($summary)) {
      $render_array = array(
        '#markup' => $summary,
      );
    }
    return $render_array;
  }

}
