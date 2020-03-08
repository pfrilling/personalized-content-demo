<?php

namespace Drupal\mymodule\Plugin\Field;

use Drupal\Core\Field\FieldItemList;
use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\TypedData\ComputedItemListTrait;

/**
 * TermStatusItemList class to generate a computed field.
 */
class TermStatusItemList extends FieldItemList implements FieldItemListInterface {

  use ComputedItemListTrait;

  /**
   * {@inheritdoc}
   */
  protected function computeValue() {
    $entity = $this->getEntity();

    // This is an empty placeholder for the field.
    $this->list[0] = $this->createItem(0, $entity->id());

  }

}
