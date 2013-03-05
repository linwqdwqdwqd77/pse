<?php

/**
 * Return a themed breadcrumb trail.
 *
 * @param $breadcrumb
 *   An array containing the breadcrumb links.
 * @return a string containing the breadcrumb output.
 */
function phptemplate_breadcrumb($breadcrumb) {
  if (!empty($breadcrumb)) {
    return '<div class="breadcrumb">'. implode(' › ', $breadcrumb) .'</div>';
  }
}

/**
 * Override or insert PHPTemplate variables into the templates.
 */
function phptemplate_preprocess_page(&$vars) {
  $vars['tabs2'] = menu_secondary_local_tasks();

  // Hook into color.module
  if (module_exists('color')) {
    _color_page_alter($vars);
  }

  // JK have only CSS required for widget
  $vars['css']['all']['module'] = array();

  // get modules dir based on path to 'Token' module, but assume Drupal standard
  $modules_dir = 'sites/all/modules/contrib';
  if (module_exists('token')) {
    $modules_dir = str_replace('/token', '', drupal_get_path('module', 'token'));
  }
  // 'good' css:
  $good_css = array(
    'modules/system/system.css' => 1,
    $modules_dir . '/cck/modules/fieldgroup/fieldgroup.css' => 1,
    $modules_dir . '/mollom/mollom.css' => 1,
    $modules_dir . '/wysiwyg/editors/css/tinymce-3.css' => 1, // should be hidden except in entry widget really
    $modules_dir . '/quicktabs/css/quicktabs.css' => 1,
  );
  // get styles re-rendered with only above and this theme's css
  $vars['css']['all']['module'] = $good_css;
  $vars['styles'] = drupal_get_css($vars['css']);
}

/**
 * Returns the rendered local tasks. The default implementation renders
 * them as tabs. Overridden to split the secondary tasks.
 *
 * @ingroup themeable
 */
function phptemplate_menu_local_tasks() {
  return menu_primary_local_tasks();
}

/**
 * Returns the themed submitted-by string for the comment.
 */
function phptemplate_comment_submitted($comment) {
  return t('!datetime — !username',
    array(
      '!username' => theme('username', $comment),
      '!datetime' => format_date($comment->timestamp)
    ));
}

/**
 * Returns the themed submitted-by string for the node.
 */
function phptemplate_node_submitted($node) {
  return t('!datetime — !username',
    array(
      '!username' => theme('username', $node),
      '!datetime' => format_date($node->created),
    ));
}

/**
 * Add a "Comments" heading above comments except on forum pages.
 */
function pse_preprocess_comment_wrapper(&$vars) {
  if ($vars['content'] && $vars['node']->type != 'forum') {
    $vars['content'] = '<h2 class="comments">'. t('Comments') .'</h2>'.  $vars['content'];
  }
}

/**
 * Generates IE CSS links for LTR and RTL languages.
 */
function phptemplate_get_ie_styles() {
  global $language;

  $iecss = '<link type="text/css" rel="stylesheet" media="all" href="'. base_path() . path_to_theme() .'/fix-ie.css" />';
  if ($language->direction == LANGUAGE_RTL) {
    $iecss .= '<style type="text/css" media="all">@import "'. base_path() . path_to_theme() .'/fix-ie-rtl.css";</style>';
  }

  return $iecss;
}

function themename_preprocess_page(&$vars) {
  // Add per content type pages
  if (isset($vars['node'])) {
    // Add template naming suggestion. It should alway use hyphens.
    // If node type is "custom_news", it will pickup "page-custom-blah-de-blah.tpl.php".
    $vars['template_files'][] = 'page-'. str_replace('_', '-', $vars['node']->type);
  }
}

function pse_status_messages($display = NULL) {
  $output = '';
  foreach (drupal_get_messages($display) as $type => $messages) {
    $output .= "<div class=\"messages $type\">\n";
    $output .= '<span class="icon">&nbsp;</span>';
    $output .= '<div class="inner">';

    if (count($messages) > 1) {
      $output .= " <ul>\n";
      foreach ($messages as $message) {
        $output .= '  <li>'. $message ."</li>\n";
      }
      $output .= " </ul>\n";
    }
    else {
      $output .= $messages[0];
    }
    $output .= "</div>\n";
    $output .= "</div>\n";
  }
  return $output;
}

function pse_status_report($requirements) {
  $i = 0;
  $output = '<table class="system-status-report">';
  foreach ($requirements as $requirement) {
    if (empty($requirement['#type'])) {
      $class = ++$i % 2 == 0 ? 'even' : 'odd';

      $classes = array(
        REQUIREMENT_INFO => 'info',
        REQUIREMENT_OK => 'ok',
        REQUIREMENT_WARNING => 'warning',
        REQUIREMENT_ERROR => 'error',
      );
      $class = $classes[isset($requirement['severity']) ? (int)$requirement['severity'] : 0] .' '. $class;

      // Output table row(s)
      if (!empty($requirement['description'])) {
        $output .= '<tr class="'. $class .' merge-down"><th><span class="icon">&nbsp;</span>'. $requirement['title'] .'</th><td>'. $requirement['value'] .'</td></tr>';
        $output .= '<tr class="'. $class .' merge-up"><td colspan="2">'. $requirement['description'] .'</td></tr>';
      }
      else {
        $output .= '<tr class="'. $class .'"><th><span class="icon">&nbsp;</span>'. $requirement['title'] .'</th><td>'. $requirement['value'] .'</td></tr>';
      }
    }
  }

  $output .= '</table>';
  return $output;
}
