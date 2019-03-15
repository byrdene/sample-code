<?php
/**
 * @file
 * Contains \Drupal\project_ds_code_fields\Plugin\DsField\GraduateCourseButton.
 */

namespace Drupal\project_ds_code_fields\Plugin\DsField;

use Drupal\Core\Url;
use Drupal\ds\Plugin\DsField\DsFieldBase;

/**
 * Plugin that generates a button link to a filtered view of graduate courses
 * related to the Field of Study on which the button is displayed.
 *
 * Courses related to the Fields of Study may or may exist per academic term.
 * The content editors will check the "display related courses" checkbox on the
 * node edit form when they want this button to appear.
 *
 * @DsField(
 *   id = "graduate_course_button",
 *   title = @Translation("DS: Graduate Course Button"),
 *   entity_type = "node",
 *   provider = "project_ds_code_fields",
 *   ui_limit = {"field_of_study|*"}
 * )
 */
class GraduateCourseButton extends DsFieldBase {

  /**
   * {@inheritdoc}
   */
  public function build() {
    $entity = $this->entity();
    $display = '';
    $button = '';
    $list = '65'; // nid of node that displays the Graduate Courses view (via a ViewField)
    $node = \Drupal::routeMatch()->getParameter('node');
    $nid = $node->id(); // nid of this Field of Study node which is used to filter the view
    $filter = "field-of-study[" . $nid . "]"; // the filter identifier in the Graduate Courses view
    $render_array = [];

    if ($entity->hasField('field_display_grad_btn')) {
      $display = $entity->field_display_grad_btn->value;
    }

    if ($display == 1) {

      $options = array(
        'query'      => [$filter => $nid],
      );
      
      $render_array = [
        '#title' => "View Graduate Courses",
        '#type' => 'link',
        '#url' => Url::fromRoute('entity.node.canonical', ['node' => $list], $options),
        '#attributes' => ['class' => ['button-link-outline']],
      ];
    }

    return $render_array;

  }
  
}
