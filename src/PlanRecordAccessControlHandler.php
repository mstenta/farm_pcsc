<?php

namespace Drupal\farm_pcsc;

use Drupal\Core\Access\AccessResult;
use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;

class PlanRecordAccessControlHandler extends EntityAccessControlHandler {

  /**
   * {@inheritdoc}
   */
  protected function checkAccess(EntityInterface $entity, $operation, AccountInterface $account) {
    if ($operation === 'view label' || $operation === 'view') {
      // @todo This delegates to plan/plan_type permissions but only checks a single bundle.
      // We need a more general solution but should not load all bundles in this method on every check.
      $bundle = 'pcsc_producer';
      $entity_type_id = 'plan';
      $permissions = [
        // View permissions provided by EntityPermissionProvider.
        "view $entity_type_id",
        "view $bundle $entity_type_id",
        // View permissions provided by UncacheableEntityPermissionProvider.
        "view own $entity_type_id",
        "view any $entity_type_id",
        "view own $bundle $entity_type_id",
        "view any $bundle $entity_type_id",
      ];
      return AccessResult::allowedIfHasPermissions($account, $permissions, 'OR');
    }
    else {
      return parent::checkAccess($entity, $operation, $account);
    }
  }

}
