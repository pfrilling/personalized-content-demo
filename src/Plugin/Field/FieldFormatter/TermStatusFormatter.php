<?php

namespace Drupal\mymodule\Plugin\Field\FieldFormatter;

use Drupal\Core\Field\FormatterBase;
use Drupal\Core\Field\FieldItemListInterface;

/**
 * Plugin implementation of the 'mymodule_term_status' formatter.
 *
 * @FieldFormatter(
 *   id = "mymodule_term_status",
 *   module = "mymodule",
 *   label = @Translation("Display a course status"),
 *   field_types = {
 *     "integer"
 *   }
 * )
 */
class TermStatusFormatter extends FormatterBase {

  /**
   * {@inheritdoc}
   */
  public function viewElements(FieldItemListInterface $items, $langcode) {
    $elements = [];

    foreach ($items as $delta => $item) {
      $entity_id = $item->getValue();
      $user_from_route = \Drupal::routeMatch()->getParameter('user');
      if (is_array($entity_id)) {
        $entity_id = array_shift($entity_id);
      }
//      $elements[] = [
//        '#markup' => \Drupal::time()->getRequestTime(),
//        '#cache' => [
//          'contexts' => [
//            'user',
//            'url',
//          ],
//        ],
//      ];
      $elements[] = [
        '#lazy_builder' => [
          'myservice:getTermStatusLink',
          [
            $entity_id,
            $user_from_route,
          ],
        ],
        '#create_placeholder' => TRUE,
        '#cache' => [
          'contexts' => [
            'user',
            'url',
          ],
        ],
      ];

//      '#cache' => [
//        'tags' => [
//          "taxonomy_term:{$entity_id}",
//        ],
//        'contexts' => [
//          'url',
//          'user',
//        ],
//      ],
    }

    return $elements;
  }

}
