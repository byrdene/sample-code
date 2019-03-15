<?php

namespace Drupal\dl_masonry_view_style\Plugin\views\style;

use Drupal\core\form\FormStateInterface;
use Drupal\views\Plugin\views\style\StylePluginBase;

/**
 * Style plugin to render a masonry grid
 *
 * @ingroup views_style_plugins
 *
 * @ViewsStyle(
 *   id = "dl_masonry_vs",
 *   title = @Translation("DL Masonry View Style"),
 *   help = @Translation("Masonry grid output."),
 *   theme = "views_view_dl_masonry_vs",
 *   display_types = { "normal" }
 * )
 */
class Masonry extends StylePluginBase {
  /**
    * Does the style plugin allows to use style plugins.
    *
    * @var bool
    */
  protected $usesRowPlugin = TRUE;

  /**
    * Does the style plugin support custom css class for the rows.
    *
    * @var bool
    */
  protected $usesRowClass = FALSE;
}
