<?php

namespace App\Helpers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class Helper {
  public static function phone( $val ) {
    if (empty($val))
      return;

    $val = trim(explode(',', $val)[0]);

    $val = str_replace(" ", "", $val);
    $val = str_replace("(", "", $val);
    $val = str_replace(")", "", $val);
    $val = str_replace("-", "", $val);

    return $val;
  }

  public static function empty( $val ) {
    $val = !empty($val) ? $val : '';
    return $val;
  }

  public static function price_format( $val ) {
    $val = number_format($val, 0, '', ' ');
    return $val;
  }

  public static function clear( $name ) {
    $name = strip_tags($name);
    $name = str_replace('\n', ' ', $name);
    $name = str_replace('  ', ' ', $name);
    return $name;
  }

  public static function formatBytes( $size, $precision = 2, $russian = false ) {
    if ($size > 0) {
      $size = (int) $size;
      $base = log($size) / log(1024);
      $suffixes = $russian ? [' байтов', ' КБ', ' МБ', ' ГБ', ' ТБ'] : array(' bytes', ' KB', ' MB', ' GB', ' TB');

      return round(pow(1024, $base - floor($base)), $precision) . $suffixes[floor($base)];
    }
    else {
      return $size;
    }
  }

  public static function decl( $number, $titles ) {
    $cases = array(2, 0, 1, 1, 1, 2);
    return $titles[($number % 100 > 4 && $number % 100 < 20) ? 2 : $cases[min($number % 10, 5)]];
  }

  public static function hash() {
    $hash = md5(uniqid(rand(), true));
    return $hash;
  }

  public static function personal( $name, $user ) {
    $value = Cookie::get('order_personal_' . $name);
    if (empty($value) && !empty($user))
      $value = @$user->{$name} ?? '';
    return $value;
  }

  public static function validatePhoneNumber( $phone_number ) {
    return preg_match("/^\\+?\\d{1,4}?[-.\\s]?\\(?\\d{1,3}?\\)?[-.\\s]?\\d{1,4}[-.\\s]?\\d{1,4}[-.\\s]?\\d{1,9}$/", $phone_number);
  }

  public static function language( $value ) {
    $language = session()->get('language');
    $postfix = '';
    if (!empty($language) && $language != 'ru')
      $postfix = '_' . $language;
    return $value . $postfix;
  }

  public static function traitList( $str ) {
    require_once(public_path() . '/lib/simple_html_dom.php');

    $dom = str_get_html('<wrapper>' . $str . '</wrapper>');
    $uls = $dom->find('ul');
    if (empty($uls)) $uls = $dom->find('ol');

    if (!empty($uls))
      foreach ($uls as $ul) {
        $ul->setAttribute('class', 'trait-list clear-list');
        $lis = $ul->find('li');
        if (!empty($lis))
          foreach ($lis as $li)
            $li->setAttribute('class', 'trait-list__item');
      }

    $result = (string) $dom;
    $result = str_replace('<wrapper>', '', $result);
    $result = str_replace('</wrapper>', '', $result);

    return $result;
  }


  public static function TablePrettier( $str ) {
    require_once(public_path() . '/lib/simple_html_dom.php');

    $dom = str_get_html($str);
    if (!$dom)
      return $str;

    $tables = $dom->find('table');

    if (!empty($tables))
      foreach ($tables as $key => &$table) {
        $table->setAttribute('class', 'table');

        $tbodys = $table->find('tbody');

        $trs = $table->find('tr');
        $trsCount = count($trs);

        
        if ($trsCount === 1) {
          $tds = $trs[0]->find('td');
          if(count($tds) == 1){
            $table->setAttribute('class', 'boxed-text');
            continue;
          }else{
            $table->innertext = static::TableToCols($trs[0]);
          }
        }

        if (!empty($tbodys)) {
          foreach ($tbodys as $tbody)
            $tbody->setAttribute('class', 'table__body');
        }

        if (!empty($trs)) {
          foreach ($trs as $key => $tr) {
            $ishead = false;

            if (!$key) {
              $tr->setAttribute('class', ' table__row table__row_head table__head');
            }
            else {
              $tr->setAttribute('class', 'table__row');
            }

            $tds = $tr->find('td');
            if (!empty($tds)) {


              $text = $tds[0]->plaintext;
              $isTrigger = mb_substr($text, 0, 1) === '!';
              $ishead = !$key || $isTrigger;

              if ($isTrigger) {
                $tds[0]->innertext = mb_substr($text, 1);
              }

              foreach ($tds as $key2 => &$td) {
                $td->setAttribute('class', $ishead ? "table__head-cell " : 'table__cell');
              }
            }
          }
        }
      }

    $result = (string) $dom;

    return $result;
  }

  public static function TableToCols( $str ) {
    $dom = str_get_html($str);
    $cols = $dom->find('td');
    $row = $dom->createElement('div');
    $row->setAttribute('class','row-'.count($cols));

    foreach ($cols as $key => $col) {
      $htmlCol = $dom->createElement('div');
      $htmlCol->setAttribute('class','col');
      $htmlCol->innertext = $col->plaintext;
      $row->innertext .= $htmlCol. ' ';
    }
    return $row;
  }

}