<?php
/**
 * @file
 * Contains \Drupal\project_ds_code_fields\Plugin\DsField\CourseFaculty.
 */

namespace Drupal\project_ds_code_fields\Plugin\DsField;

use Drupal\ds\Plugin\DsField\DsFieldBase;

/**
 * Plugin that renders the list of faculty names (internal and external),
 * or "To be announced".
 *
 * @DsField(
 *   id = "course_faculty",
 *   title = @Translation("DS: Course - Faculty"),
 *   entity_type = "node",
 *   provider = "project_ds_code_fields",
 *   ui_limit = {"course|*"}
 * )
 */
class CourseFaculty extends DsFieldBase {

  /**
   * {@inheritdoc}
   */
  public function build() {
    // Fetch the entity
    $entity = $this->entity();
    $status = "";
    $faculty_list = [];
    $render_array = [];

    // If "status" field exists
    if ($entity->hasField('field_status')) {
      $status = $entity->field_status->value;
    }

    if ($status == "tbd") { // if no faculty have been assigned
      $render_array = ['#markup' => 'Instructor to be announced'];

    } else if ($status == "faculty") { // the faculty/instructor names have been supplied

      // If "Instructor - Dept of Politics" field exists (an entity reference field)
      if ($entity->hasField('field_instructor_politics')) {
        // and has a value
        if ($entity->field_instructor_politics->count() > 0) {
          foreach ($entity->field_instructor_politics as $index => $faculty) {
            $nid = $faculty->target_id;
            $node_storage = \Drupal::entityTypeManager()->getStorage('node');
            $node = $node_storage->load($nid);
            if ($node) { // create our list of internal faculty
            $faculty_list[] = $node->label(); 
            }
          }
        }
      }

      // If "Instructor - Other" field exists
      if ($entity->hasField('field_instructor_other')) {
        // and has a value
        if ($entity->field_instructor_other->count() > 0) {
          foreach ($entity->field_instructor_other as $index => $faculty) {
            $faculty_list[] = $faculty->value; // add any external instructors to our list
          }
        }
      }

      $instructors = implode(', ', $faculty_list);

      if (!empty($instructors)) {
        $render_array = ['#markup' => $instructors];
      }

    }

    return $render_array;
  }

}
