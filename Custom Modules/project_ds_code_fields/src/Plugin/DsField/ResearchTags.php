<?php
/**
 * @file
 * Contains \Drupal\project_ds_code_fields\Plugin\DsField\ResearchTags.
 */

namespace Drupal\project_ds_code_fields\Plugin\DsField;

use Drupal\ds\Plugin\DsField\DsFieldBase;
use Drupal\taxonomy\Entity\Term;
use Drupal\Core\Link;
use Drupal\Core\Url;

/**
 * Plugin that renders the associated Species, System, and Treatment Type terms
 * into one set of "research" tags. These tags will appear in multiple view modes
 * but need the option to be displayed in different ways.
 * 
 * Include a field formatter to display the tags either as a
 * series of linked buttons to a filtered view or as a comma-delimited list
 *
 * @DsField(
 *   id = "research_tags",
 *   title = @Translation("DS: Research Tags"),
 *   entity_type = "node",
 *   provider = "project_ds_code_fields",
 *   ui_limit = {"model|*"}
 * )
 */
class ResearchTags extends DsFieldBase {

  /**
   * {@inheritdoc}
   */
  public function build() {
    // Fetch the entity
    $entity = $this->entity();
    $url = 'internal:/research/filtered'; // the path to the view we need to filter
    $species_tags = [];
    $species_tags_linked = [];
    $system_tags = [];
    $system_tags_linked = [];
    $treatment_tags = [];
    $treatment_tags_linked = [];
    $output = "";
    $render_array = [];

    $config = $this->getConfiguration();
    if (isset($config['field']['formatter'])) {
      $formatter = $config['field']['formatter'];
    }

    // If Species field exists & has a value
    if (($entity->hasField('field_species')) && ($entity->field_species->target_id)) {
      foreach ($entity->field_species as $index => $species) {
        $term = Term::load($species->target_id);
        if ($term) {
          $filter = "field_species_target_id[" . $species->target_id . "]"; // The filter identifier in the Research view
          $species_name = $term->getName(); // We need the term name
          $species_tags[] = $species_name;

          // Create linked versions too
          $options = [
            'query' => [$filter => $species->target_id],
          ];
          $linked_species_name = Link::fromTextAndUrl(t($species_name), Url::fromUri($url, $options))->toString();
          $species_tags_linked[] = $linked_species_name;
        }
      }
    }

    // If System field exists & has a value
    if (($entity->hasField('field_system')) && ($entity->field_system->target_id)) {
      foreach ($entity->field_system as $index => $system) {
        $term = Term::load($system->target_id);
        if ($term) {
          $filter = "field_system_target_id[" . $system->target_id . "]"; // The filter identifier in the Research view
          $system_name = $term->getName(); // We need the term name
          $system_tags[] = $system_name;

          // Create linked versions too
          $options = [
            'query' => [$filter => $system->target_id],
          ];
          $linked_system_name = Link::fromTextAndUrl(t($system_name), Url::fromUri($url, $options))->toString();
          $system_tags_linked[] = $linked_system_name;
        }
      }
    }

    // If Treatment Type field exists and has a value
    if (($entity->hasField('field_treatment_type')) && ($entity->field_treatment_type->target_id)) {
      foreach ($entity->field_treatment_type as $index => $treatment) {
        $term = Term::load($treatment->target_id);
        if ($term) {
          $filter = "field_treatment_type_target_id[" . $treatment->target_id . "]"; // the filter identifier in the Research view
          $treatment_name = $term->getName(); // We need the term name
          $treatment_tags[] = $treatment_name;

          // Create linked versions too
          $options = [
            'query' => [$filter => $treatment->target_id],
          ];
          $linked_treatment_name = Link::fromTextAndUrl(t($treatment_name), Url::fromUri($url, $options))->toString();
          $treatment_tags_linked[] = $linked_treatment_name;
        }
      }
    }

    if ($species_tags || $system_tags || $treatment_tags) {

      if ($formatter === 'delimited') {
        $research_tags = array_merge($species_tags,$system_tags,$treatment_tags);
        $research_tags = implode(', ', $research_tags);
        $output = "<div class='field__item research-tags tags-delimited'>" . $research_tags . "</div>";//

      } elseif ($formatter === 'button') {
        $tag_label = "<div class='field__label is-inline tag-label'>Tags</div>";
        $research_tags = array_merge($species_tags_linked,$system_tags_linked,$treatment_tags_linked);
        $research_tags = implode('', $research_tags);
        $output = $tag_label . "<div class='field__item research-tags button-tag'>" . $research_tags . "</div>";
      }

      $render_array = ['#markup' => $output];

    }

    return $render_array;

  }

  /**
   * {@inheritdoc}
   */
  public function formatters() {
    return array('delimited' => 'Comma delimited list', 'button' => 'Buttons');
  }

}
