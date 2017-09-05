<?php
/**
 * @file
 * Contains \Drupal\yandex_metrics_reports\Form\YandexMetricsReportsFilterForm.
 */

namespace Drupal\yandex_metrics_reports\Form;

use Drupal\Core\Form\FormBase;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Drupal\Core\Form\FormStateInterface;

/**
 * Provides quick filter form for reports page.
 */
class YandexMetricsReportsFilterForm extends FormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormID() {
    return 'yandex_metrics_reports_filter_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {

    $current_filter = arg(3) ? arg(3) : 'week';

    $options = array(
      'day' => t('Today'),
      'yesterday' => t('Yesterday'),
      'week' => t('Week'),
      'month' => t('Month')
    );
    $form['filter'] = array(
      '#type' => 'select',
      '#title' => t('Quick filter'),
      '#default_value' => $current_filter,
      '#options' => $options,
      '#attributes' => array('onchange' => 'this.form.submit();')
    );
    $form['submit'] = array(
      '#type' => 'submit',
      '#value' => t('Submit'),
      '#attributes' => array('style' => 'display:none;')
    );

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $filter = $form_state['values']['filter'];
    if (!empty($filter)) {
      $form_state['redirect_route']['route_name'] = 'yandex_metrics_reports.summary';
      $form_state['redirect_route']['route_parameters'] = array('filter' => $filter);
    }
  }
}
