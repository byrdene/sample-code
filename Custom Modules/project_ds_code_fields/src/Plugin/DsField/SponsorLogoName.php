<?php
/**
 * @file
 * Contains \Drupal\project_ds_code_fields\Plugin\DsField\SponsorLogoName.
 */

namespace Drupal\project_ds_code_fields\Plugin\DsField;

use Drupal\ds\Plugin\DsField\DsFieldBase;
use Drupal\file\Entity\File;
use Drupal\Core\Url;
use Drupal\Core\Link;

/**
 * Plugin that conditionally renders sponsor logo (linked if website exists)
 * or sponsor name (linked if website exists).
 *
 * @DsField(
 *   id = "sponsor_logo_name",
 *   title = @Translation("DS: Sponsor Logo or Name"),
 *   entity_type = "paragraph",
 *   provider = "project_ds_code_fields",
 *   ui_limit = {"sponsor|*"}
 * )
 */
class SponsorLogoName extends DsFieldBase {

  /**
   * {@inheritdoc}
   */
  public function build() {
    // Fetch the entity
    $entity = $this->entity();
    $logo = "";
    $website = "";
    $name = "";
    $render_array = [];

    // If logo field exist
    if (($entity->hasField('field_logo')) && (!$entity->get('field_logo')->isEmpty())) {
      $logo = $entity->field_logo->entity->field_image;
    }

    // If website field exists
    if ($entity->hasField('field_sponsor_website')) {
      $website = $entity->field_sponsor_website->uri;
    }

    // If sponsor name field exists
    if ($entity->hasField('field_sponsor_name')) {
      $name = $entity->field_sponsor_name->value;
    }

    // Run the conditions for the various scenarios
    if ($logo && $website) { // Render a linked logo
      $file = File::load($logo->target_id);
      $url = $file->getFileUri();
      $website_url = file_create_url($website);
      $render_array = [
        // render the array as a link
        '#type' => 'link',
        '#title' => [
          '#theme' => 'image_style',
          '#style_name' => 'free_style',
          '#uri' => $url,
        ],
        '#url' => Url::fromUri($website_url),
      ];

    } else if ($logo) { // Render the logo even if it can't be linked
      $file = File::load($logo->target_id);
      $url = $file->getFileUri();
      $render_array = [
        '#theme' => 'image_style',
        '#style_name' => 'free_style',
        '#uri' => $url,
      ];

    } else if ($website && $name) { // If no logo, render the linked name
      $linked_title = Link::fromTextAndUrl(t($name), Url::fromUri($website))->toString();
      $render_array = ['#markup' => $linked_title];

    } else if ($name) { // If no link, at least render the name!
      $render_array = ['#markup' => $name];
    }

    return $render_array;
  }
}
