<?php

function trim_recursive($value) {
  if (is_array($value)) {
    return array_map(__FUNCTION__, $value);
  }
  else {
    return trim($value);
  }
}

require_once __DIR__ . '/vendor/autoload.php';

$doc = QueryPath::withHTML5($argv[1]);

$info = array();

$info['name'] = $doc->find('article.main-content h1')->text();

foreach ($doc->find('.svtabs-panel:first-child h2 + .vitals-table') as $table) {
  $section = $table->prev()->text();
  $section = trim($section);

  switch ($section) {
    case 'Pokédex data':
      foreach ($table->find('tbody tr:nth-child(2) td a') as $type) {
        $info['type'][] = $type->text();
      }
      foreach ($table->find('tbody tr:nth-child(6) td a') as $ability) {
        $info['abilities'][] = $ability->text();
      }
      $info['species'] = $table->find('tbody tr:nth-child(3) td')->text();
      $info['height'] = $table->find('tbody tr:nth-child(4) td')->text();
      $info['weight'] = $table->find('tbody tr:nth-child(5) td')->text();
      $info['japanese_name'] = $table->find('tbody tr:last-child td')->text();
      break;
    case 'Training':
      $info['growth_rate'] = $table->find('tbody tr:last-child td')->text();
      break;
    default:
      break;
  }
}

$info = array_map('trim_recursive', $info);
echo json_encode($info);
