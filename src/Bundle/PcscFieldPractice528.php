<?php

namespace Drupal\farm_pcsc\Bundle;

/**
 * Provides the PCSC Field Practice 528 bundle class.
 */
class PcscFieldPractice528 extends PcscFieldPracticeBase {

  /**
   * {@inheritdoc}
   */
  public function practiceTypeLabel(): string {
    return '528: Prescribed Grazing';
  }

  /**
   * {@inheritdoc}
   */
  public function practiceTypeOption(): string {
    return '528, Prescribed Grazing';
  }

  /**
   * {@inheritdoc}
   */
  public function buildPracticeForm(int $delta = 1): array {
    $form = parent::buildPracticeForm($delta);
    $form['528_grazing_type'] = [
      '#type' => 'select',
      '#title' => $this->t('Grazing type'),
      '#options' => $this->getListOptions('plan_record', $this->bundle(), '528_grazing_type'),
      '#required' => TRUE,
    ];
    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function buildSupplementalFieldPracticeExport(): array {
    return [
      'Grazing Type' => $this->get('528_grazing_type')->value,
    ];
  }

}
