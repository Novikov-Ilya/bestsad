<?php

/**
 * @file
 * Contains \Drupal\action\Controller\YandexMetricsReportsController
 */

namespace Drupal\yandex_metrics_reports\Controller;

use Drupal\yandex_metrics_reports\Reports;
use Drupal\Core\DependencyInjection\ContainerInjectionInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\DependencyInjection\Exception\ServiceNotFoundException;
use Drupal\Core\Url;


/**
 * Universal controller for yandex_metrics_reports module.
 */
class YandexMetricsReportsController implements ContainerInjectionInterface {

  /**
   * Class constructor.
   */
  public function __construct() {
  }

  /**
   * Implements \Drupal\Core\ControllerInterface::create().
   */
  public static function create(ContainerInterface $container) {
    return new static();
  }

  /**
   * Redirect to yandex_services_auth authorization path.
   */
  public function authorizationRedirect() {
    return new RedirectResponse(Url::fromRoute('admin/config/system/yandex_services_auth'));
  }

  /**
   * Redirect to yandex_services_auth oauth callback.
   */
  public function oauthCalbackRedirect() {
    return new RedirectResponse(Url::fromRoute('yandex_services_auth/oauth'));
  }

  /**
   * Menu callback; displays a Summary page containing reports and charts.
   */
  public function report($filter = 'week') {

    $counter_id = yandex_metrics_reports_get_counter_for_current_site();

    if (empty($counter_id)) {
      drupal_set_message(
        t('Please create Yandex.Metrics counter for the site first. See more details !link.', array('!link' => l(t('here'), 'admin/config/system/yandex_metrics'))),
        'error'
      );
      return '';
    }

    $counter_code = \Drupal::config('yandex_metrics.settings')->get('counter_code');
    if (empty($counter_code)) {
      drupal_set_message(
        t('Perhaps you have not yet placed Yandex.Metrics counter code on the site. You can do this !link.', array('!link' => l(t('here'), 'admin/config/system/yandex_metrics'))),
        'notice'
      );
    }

    $authorisation_token = yandex_services_auth_info('token');
    if (empty($authorisation_token)) {
      drupal_set_message(
        t('Please make sure that your application is authorized !link.', array('!link' => l(t('here'), 'admin/config/system/yandex_metrics/authorization'))),
        'error'
      );
      return '';
    }

    $output = '';

    $form = \Drupal::formBuilder()->getForm('\Drupal\yandex_metrics_reports\Form\YandexMetricsReportsFilterForm');

    $form['#attached']['css'][] = drupal_get_path('module', 'yandex_metrics_reports') . '/css/yandex_metrics_reports.css';

    $reports = yandex_metrics_reports_get_active_list();

    $clean_urls = TRUE;
    try {
      $clean_urls = \Drupal::request()->attributes->get('clean_urls');
    }
    catch (ServiceNotFoundException $e) {}

    $form['#attached']['js'][] = array(
      'data'=> array(
        'yandex_metrics_reports' => array(
          'modulePath' => drupal_get_path('module', 'yandex_metrics_reports'),
          'cleanUrls' => (int)$clean_urls,
          'reportList' => array_keys($reports)
        )
      ),
      'type' => 'setting',
    );

    $form['#attached']['js'][] = array('data' => drupal_get_path('module', 'yandex_metrics_reports') . '/js/yandex_metrics_reports.js');

    $output .= drupal_render($form);

    $output .= '<input type="hidden" id="yandex_metrics_reports_counter_id" value="' . $counter_id . '" />';
    $output .= '<input type="hidden" id="yandex_metrics_reports_filter" value="' . $filter . '" />';
    $reportsHandler = new Reports($counter_id, $filter);

    foreach ($reports as $report_name => $report_data) {
      $ported_chars = array('visits_chart', 'sources_chart', 'geo_chart', 'hourly_chart', 'gender_chart');

      if (in_array($report_name, $ported_chars)) {
        // @TODO Remove this condition after charts code is ported.
        $output .= $reportsHandler->{$report_name}();
      } else {
        $output .= '<div class="yandex_metrics_reports-report" id="yandex_metrics_reports_' . $report_name . '"></div>';
      }
    }

    return $output;
  }

  /**
   * Menu callback; outputs content of one of the 4 reports.
   * It is intended for AJAX calls.
   * @param $counter_id
   * @param $filter
   * @param $type
   * @return void
   */
  public function ajax ($counter_id, $filter, $type) {
    $output = '';
    $reports = yandex_metrics_reports_get_list();
    if (isset($reports[$type]) && isset($reports[$type]['callback']) && function_exists($reports[$type]['callback'])) {
      $output = call_user_func($reports[$type]['callback'], $counter_id, $filter);
    }

    echo $output;
    die;
  }

}
