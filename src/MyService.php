<?php

namespace Drupal\mymodule;

use Drupal\Core\StringTranslation\StringTranslationTrait;

class MyService {

  use StringTranslationTrait;

  /**
   * @param int $term_id
   *
   * @return array
   */
  public function getTermStatusLink(int $term_id): array {
    $markup = [
      'admin' => [
        '#type' => 'html_tag',
        '#tag' => 'h2',
        '#access' => TRUE,
        '#value' => $this->t('Administrator only information %request_time', ['%request_time' => \Drupal::time()->getRequestTime()]),
      ],
      'user' => [
        '#type' => 'html_tag',
        '#tag' => 'h2',
        '#access' => TRUE,
        '#value' => $this->t('User only information %request_time', ['%request_time' => \Drupal::time()->getRequestTime()]),
      ],
    ];

    if (\Drupal::currentUser()->hasPermission('administer users')) {
      $markup['user']['#access'] = FALSE;
    }
    else {
      $markup['admin']['#access'] = FALSE;
    }

    return $markup;
  }

}
