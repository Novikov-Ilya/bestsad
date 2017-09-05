<?php
/**
 * @file
 * Contains \Drupal\yandex_metrics_reports\Form\YandexMetricsReportsSettingsForm.
 */

namespace Drupal\yandex_metrics_reports\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Provides a reports settings form.
 */
class YandexMetricsReportsSettingsForm extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormID() {
    return 'yandex_metrics_reports_settings_form';
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

    $form['reports'] = array(
      '#type' => 'fieldset',
      '#title' => t('Reports visibility settings'),
      '#description' => t('Choose reports to display on Yandex.Metrics Summary Report page.')
    );

    $reports = yandex_metrics_reports_get_list(TRUE);

    foreach ($reports as $report_name => $report_data) {
      $form['reports'][$report_name . '_visible'] = array(
        '#type' => 'checkbox',
        '#title' => $report_data['title'],
        '#default_value' => \Drupal::state()->get('yandex_services_reports_'.$report_name . '_visible') ?: FALSE,
      );
    }

    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {

    $reports = yandex_metrics_reports_get_list(TRUE);

    foreach ($reports as $report_name => $report_data) {
      \Drupal::state()->set('yandex_services_reports_'.$report_name . '_visible', $form_state['values'][$report_name . '_visible']);
    }

    parent::submitForm($form, $form_state);
  }
}
