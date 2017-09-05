<?php
/**
 * @file
 * Contains \Drupal\yandex_metrics_reports\YandexMetricsReports.
 */

namespace Drupal\yandex_metrics_reports;

use Drupal\Component\Utility\String;

/**
 * Reports manager for YandexMetrics module.
 */
class Reports {

  private $counter_id;
  private $filter;

  public function __construct($counter_id, $filter) {
    $this->counter_id = $counter_id;
    $this->filter = $filter;
  }

  /**
   * The function generates pie chart with traffic sources summary.
   *
   * @param string $this->filter
   */
  public function sources_chart() {
    $date_range = _yandex_metrics_reports_filter_to_date_range($this->filter);

    $parameters = array(
      'id' => $this->counter_id,
      'date1' => $date_range['start_date'],
      'date2' => $date_range['end_date']
    );

    $results = yandex_metrics_reports_retreive_data('/stat/sources/summary', $parameters);
    $summary = json_decode($results->getBody(TRUE));
    if (empty($summary->data)) {
      return t('There is no information about traffic sources for the selected date range.');
    }

    $sum = $summary->totals->visits;

    $i = 1;
    foreach ($summary->data as $value) {
      $name = String::checkPlain($value->name);
      $data[] = array(
        'legends' => $i . '. ' . $name . ' (' . round($value->visits * 100 / $sum) . '%' . ')',
        'visits' => $value->visits,
      );
      $i++;
    }
    $chart = array(
      '#theme' => 'visualization',
      '#options' => array(
        'title' => t('Traffic Sources'),
        'width' => 500,
        'height' => 200,
        'fields' => array(
          'legends' => array(
            'label' => 'legends',
            'enabled' => TRUE,
          ),
          'visits' => array(
            'label' => 'visits',
            'enabled' => TRUE,
          ),
        ),
        'xAxis' => array(
          'labelField' => 'legends',
        ),
        'data' => $data,
        'type' => 'pie',
      ),
    );

    return drupal_render($chart);
  }

  /**
   * The function generates chart with information about page views, visitors and new visitors.
   */
  public function visits_chart() {
    $date_range = _yandex_metrics_reports_filter_to_date_range($this->filter);

    $parameters = array(
      'id' => $this->counter_id,
      'date1' => $date_range['start_date'],
      'date2' => $date_range['end_date']
    );

    if (isset($date_range['group'])) {
      $parameters['group'] = $date_range['group'];
    }
    $results = yandex_metrics_reports_retreive_data('/stat/traffic/summary', $parameters);
    $visits = json_decode($results->getBody(TRUE));

    if (empty($visits->data)) {
      return t('There is no information about page views and visitors for the selected date range.');
    }

    foreach ($visits->data as $value) {
      $data[] = array (
        'dates' => String::checkPlain($value->date),
        'page_views' => (int) $value->page_views,
        'visitors' => (int) $value->visitors,
        'new_visitors' => (int) $value->new_visitors,
      );
    }
    $data = array_reverse($data);

    $chart = array(
      '#theme' => 'visualization',
      '#options' => array(
        'title' => t('Page Views, Visitors, New Visitors'),
        'width' => 500,
        'height' => 250,
        'fields' => array(
          'dates' => array(
            'label' => t('Dates'),
            'enabled' => FALSE,
          ),
          'page_views' => array(
            'label' => t('Page Views'),
            'enabled' => TRUE,
          ),
          'visitors' => array(
            'label' => t('Visitors'),
            'enabled' => TRUE,
          ),
          'new_visitors' => array(
            'label' => t('New Visitors'),
            'enabled' => TRUE,
          ),
        ),
        'xAxis' => array(
          'labelField' => 'dates',
        ),
        'data' => $data,
        'type' => 'line',
      ),
    );

    return drupal_render($chart);
  }

  /**
   * The function generates pie chart with geographical information on visitors.
   */
  function geo_chart() {
    $date_range = _yandex_metrics_reports_filter_to_date_range($this->filter);

    $parameters = array(
      'id' => $this->counter_id,
      'date1' => $date_range['start_date'],
      'date2' => $date_range['end_date']
    );

    $results = yandex_metrics_reports_retreive_data('/stat/geo', $parameters);
    $geo = json_decode($results->getBody(TRUE));
    if (empty($geo->data)) {
      return t('There is no information about geography of visits for the selected date range.');
    }

    $total_visits = $geo->totals->visits;

    // Exclude unknown visits.
    foreach ($geo->data as $key => $value) {
      if ($value->name == "Не определено") {
        $total_visits -= $value->visits;
        unset($geo->data[$key]);
        break;
      }
    }

    $i = 1;
    $sum_visits = 0;
    foreach ($geo->data as $value) {

      $visits = (int) $value->visits;

      if ($i > 10) {
        $others_visits = $total_visits - $sum_visits;
        $data[] = array(
          'legends' => t('Others') . ' (' . round($others_visits * 100 / $total_visits, 1) . '%' . ')',
          'visits' => $others_visits,
        );
        break;
      }

      $sum_visits += $visits;

      $name = String::checkPlain($value->name);
      $data[] = array(
        'legends' => $i . '. '. $name . ' (' . round($visits * 100 / $total_visits, 1) . '%' . ')',
        'visits' => $visits,
      );

      $i++;
    }

    $chart = array(
      '#theme' => 'visualization',
      '#options' => array(
        'title' => t('Geography of Visits'),
        'width' => 500,
        'height' => 230,
        'fields' => array(
          'legends' => array(
            'label' => 'legends',
            'enabled' => TRUE,
          ),
          'visits' => array(
            'label' => 'visits',
            'enabled' => TRUE,
          ),
        ),
        'xAxis' => array(
          'labelField' => 'legends',
        ),
        'data' => $data,
        'type' => 'pie',
      ),
    );

    return drupal_render($chart);
  }

  /**
   * The function generates chart with information about hourly traffic.
   */
  function hourly_chart() {
    $date_range = _yandex_metrics_reports_filter_to_date_range($this->filter);

    $parameters = array(
      'id' => $this->counter_id,
      'date1' => $date_range['start_date'],
      'date2' => $date_range['end_date']
    );

    if (isset($date_range['group'])) {
      $parameters['group'] = $date_range['group'];
    }

    $results = yandex_metrics_reports_retreive_data('/stat/traffic/hourly', $parameters);
    $hourly_report = json_decode($results->getBody(TRUE));
    if (empty($hourly_report->data)) {
      return t('There is no information about hourly traffic for the selected date range.');
    }

    foreach ($hourly_report->data as $hour_data) {
      $data[] = array(
        'hours' => $hour_data->hours,
        'avg_visits' => $hour_data->avg_visits,
        // Convert denials from percents.
        'denials' => $hour_data->avg_visits * $hour_data->denial,
      );
    }

    $chart = array(
      '#theme' => 'visualization',
      '#options' => array(
        'title' => t('Hourly Traffic'),
        'width' => 500,
        'height' => 350,
        'fields' => array(
          'hours' => array(
            'label' => 'hours',
            'enabled' => FALSE,
          ),
          'avg_visits' => array(
            'label' => 'avg_visits',
            'enabled' => TRUE,
          ),
          'denials' => array(
            'label' => 'denials',
            'enabled' => TRUE,
          ),
        ),
        'xAxis' => array(
          'labelField' => 'hours',
        ),
        'data' => $data,
        'type' => 'column',
      ),
    );

    return drupal_render($chart);
  }

  /**
   * The function generates pie chart with demography information.
   */
  function gender_chart() {
    $date_range = _yandex_metrics_reports_filter_to_date_range($this->filter);

    $parameters = array(
      'id' => $this->counter_id,
      'date1' => $date_range['start_date'],
      'date2' => $date_range['end_date'],
    );

    $results = yandex_metrics_reports_retreive_data('/stat/demography/structure', $parameters);
    $demography = json_decode($results->getBody(TRUE));
    if (empty($demography->data)) {
      return t('There is no demography information for the selected date range.');
    }

    $info = $demography->data;
    // Sort data by gender.
    usort($info, '_yandex_metrics_reports_gender_sort');

    $i = 1;
    foreach ($info as $value) {
      if ($value->visits_percent === 0) {
        continue;
      }

      $age = String::checkPlain($value->name);
      $gender = String::checkPlain($value->name_gender);
      $data[] = array(
        'legends' => "$i. $gender / $age  — " . round($value->visits_percent * 100, 2) . '%',
        'visits' => $value->visits_percent,
      );

      $i++;
    }

    if (empty($data)) {
      return t('There is no demography information for the selected date range.');
    }

    $chart = array(
      '#theme' => 'visualization',
      '#options' => array(
        'title' => t('Demography of Visits'),
        'width' => 500,
        'height' => 200,
        'fields' => array(
          'legends' => array(
            'label' => 'legends',
            'enabled' => TRUE,
          ),
          'visits' => array(
            'label' => 'visits',
            'enabled' => TRUE,
          ),
        ),
        'xAxis' => array(
          'labelField' => 'legends',
        ),
        'data' => $data,
        'type' => 'pie',
      ),
    );

    return drupal_render($chart);
  }
}
