<?php
/**
 * @file
 * Contains \Drupal\yandex_metrics_reports\Form\YandexMetricsReportsCronForm.
 */

namespace Drupal\yandex_metrics_reports\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Provides a cron settings form.
 */
class YandexMetricsReportsCronForm extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormID() {
    return 'yandex_metrics_reports_cron_form';
  }

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {

    // Create config object.
    $config = $this->configFactory->get('yandex_metrics_reports.settings');

    $form['popular_content'] = array(
      '#type' => 'fieldset',
      '#title' => t('Popular Content Block Data')
    );

    $options = array(
      'day' => t('Today'),
      'yesterday' => t('Yesterday'),
      'week' => t('Week'),
      'month' => t('Month')
    );
    $form['popular_content']['date_period'] = array(
      '#type' => 'select',
      '#title' => t('Date period'),
      '#description' => t('This date period is used to fetch popular content from Yandex.Metrica by cron.'),
      '#options' => $options,
      '#default_value' => $config->get('popular_content_date_period'),
    );

    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {

    $config = $this->configFactory->get('yandex_metrics_reports.settings');

    $config
      ->set('popular_content_date_period', $form_state['values']['date_period'])
      ->save();

    parent::submitForm($form, $form_state);
  }
}
