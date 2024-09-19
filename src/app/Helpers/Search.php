<?php
namespace App\Helpers;


use App\Models\Administration;
use App\Models\Branches;
use App\Models\Council;
use App\Models\Courses;
use App\Models\Documents;
use App\Models\News;
use App\Models\Pages\Pages;
use App\Models\Portfolio;
use App\Models\Publications;

class Search
{
    private static $res_limit = 5;

    private static function search_list_config()
    {
        return [
            [
                'model' => Pages::query(),
                'fields' => ['name', 'text'],
                'category' => 'Страницы',
                'description' => null,
                'page_name_clean' => self::search_query_clean('страницы'),
                'row_name_field' => 'name',
                'row_link_field' => 'url',
            ],
            [
                'model' => Branches::query(),
                'fields' => ['name', 'text', 'description', 'address'],
                'category' => 'Филиалы',
                'description' => null,
                'page_name_clean' => self::search_query_clean('филиалы'),
                'row_name_field' => 'name',
                'row_link_field' => false,
                'row_link_url' => 'filialy',
            ],
            [
                'model' => Administration::query(),
                'fields' => ['position', 'degree'],
                'category' => 'Администрация',
                'description' => null,
                'page_name_clean' => self::search_query_clean('администрация'),
                'row_name_field' => 'position',
                'row_link_field' => false,
                'row_link_url' => 'administraciia',
                'show_hidden' => true,
            ],
            [
                'model' => Council::query(),
                'fields' => ['name', 'text'],
                'category' => 'Диссертационный совет',
                'description' => null,
                'page_name_clean' => self::search_query_clean('диссертационный совет'),
                'row_name_field' => 'name',
                'row_link_field' => false,
                'row_link_url' => 'dissertacionnyi-sovet',
            ],
            [
                'model' => Courses::query(),
                'fields' => ['text_2', 'text_3', 'text_4', 'additional_information'],
                'category' => 'Курсы повышения квалификации',
                'description' => null,
                'page_name_clean' => self::search_query_clean('курсы повышения квалификации'),
                'row_name_field' => 'text_2',
                'row_link_field' => false,
                'show_hidden' => true,
                'row_link_url' => 'kursy-povyseniia-kvalifikacii',
            ],
            [
                'model' => Documents::query(),
                'fields' => ['name'],
                'category' => 'Документы',
                'description' => null,
                'page_name_clean' => self::search_query_clean('документы'),
                'row_name_field' => 'name',
                'row_link_field' => false,
                'row_link_url' => 'dokumenty',
            ],
            [
                'model' => News::query(),
                'fields' => ['name2', 'preview_text'],
                'category' => 'Новости',
                'description' => null,
                'page_name_clean' => self::search_query_clean('новости'),
                'row_name_field' => 'name2',
                'row_link_field' => false,
                'show_hidden' => true,
                'row_link_url' => 'news',
            ],
            [
                'model' => Portfolio::query(),
                'fields' => ['customer'],
                'category' => 'Портфолио',
                'description' => null,
                'page_name_clean' => self::search_query_clean('портфолио'),
                'row_name_field' => 'customer',
                'row_link_field' => false,
                'show_hidden' => true,
                'row_link_url' => '/',
            ],
            [
                'model' => Publications::query(),
                'fields' => ['name', 'text'],
                'category' => 'публикации',
                'description' => null,
                'page_name_clean' => self::search_query_clean('публикации издания'),
                'row_name_field' => 'name',
                'row_link_field' => false,
                'row_link_url' => 'izdaniia',
            ],

        ];
    }

    public static function search_results($query)
    {
        $fn = '';

//        $query = dataprocessing($query);
        $query = preg_replace('/\s+/', ' ', $query);
        $query = trim($query);
        $query = trim($query, '\\');

        $result = self::search_fetch($query);

        if ($result === false) {
            $fn .= '<div class="search-results__not-found">По вашему запросу: «<span class="search-results__query-string">' . htmlspecialchars($query) . '</span>» ничего не найдено.</div>';
        } else if ($result) {
            $fn .= '<div class="search-results__query">Результаты по запросу «<span class="search-results__query-string">' . htmlspecialchars($query) . '</span>»:</div>';

            foreach ($result as $result_item) {
                $fn .= self::search_results_item($result_item, $query);
            }
        }

        return $fn;
    }

    private static function search_fetch($query)
    {
        $query = self::search_query_clean($query);
        $result = self::search_query($query);

        return $result;
    }

    private static function search_results_item($params, $query)
    {
        $fn = '';

        $fn .= '<div class="search-results__item">';
        $fn .= '<a href="' . $params['link'] . '" class="search-results__title">' . $params['title'] . '</a>';
        $fn .= '<div class="search-results__description">' . $params['description'] . '</div>';
        $fn .= '<div class="search-results__category">' . $params['category'] . '</div>';
        $fn .= '</div>';

        return $fn;
    }

    private static function search_query_clean($query)
    {
        if (!$query) {
            return [];
        }

        $query = explode(' ', $query);

        $endings_regex = '/(а|ал|ала|али|ам|ами|ас|ать|ая|е|ее|ей|ел|ела|ели|ем|еми|емя|ет|ете|еть|ешь|ею|её|и|ие|ий|им|ими|ит|ите|их|ишь|ию|м|ми|мя|о|ов|ого|ое|ой|ол|ола|оли|ом|ому|оть|ою|оё|у|ул|ула|ули|ум|умя|ут|уть|ух|ую|шь|ы|ые|ый|ь|ю|ют|я|ял|яла|яли|ять|яя|ёт|ёте|ёх|ёшь)$/i';

        foreach ($query as $index => $word) {
            $word = preg_replace($endings_regex, '', $word);

            if ($word) {
                $query[$index] = $word;
            } else {
                unset($query[$index]);
            }
        }

        return array_values($query);
    }

    private static function generate_query_array($name, $operator, $query_part)
    {
        return [
            'name' => $name,
            'operator' => $operator,
            'query_part' => $query_part,
        ];
    }

    private static function search_query_build_like($name, $query, $force = false)
    {
        $res = [];

//        if ($query[0] == 'уз') {
//            $query[] = 'ультразвуковая диагностика';
//        }

        foreach ($query as $query_part) {
            $res[] = self::generate_query_array($name, '=', $query_part);
            $res[] = self::generate_query_array($name, 'LIKE', $query_part. '%');
            $res[] = self::generate_query_array($name, 'LIKE', '% ' . $query_part . '%');

            if ($force) {
                $res[] = self::generate_query_array($name, 'LIKE', '%' . $query_part . '%');
            }
        }

        return $res;
    }

    private static function search_match($string, $query_part)
    {
        if ($query_part === '') {
            return $string;
        }

        // $string = str_replace('<', ' <', $string);
        // $string = strip_tags($string);
        // $string = preg_replace('/\s+/', ' ', $string);

        $query_part = mb_strtolower($query_part);
        $regexp = '/(' . preg_quote($query_part, '/') . ')/iu';

        $matches = preg_match($regexp, $string);
        // $string = preg_replace($regexp, '<span class="search-results__match">$1</span>', $string);

        // $endings_regex = '/<\/span>(а|ал|ала|али|ам|ами|ас|ать|ая|е|ее|ей|ел|ела|ели|ем|еми|емя|ет|ете|еть|ешь|ею|её|и|ие|ий|им|ими|ит|ите|их|ишь|ию|м|ми|мя|о|ов|ого|ое|ой|ол|ола|оли|ом|ому|оть|ою|оё|у|ул|ула|ули|ум|умя|ут|уть|ух|ую|шь|ы|ые|ый|ь|ю|ют|я|ял|яла|яли|ять|яя|ёт|ёте|ёх|ёшь)$/i';

        // $string = preg_replace($endings_regex, '$1</span>', $string);

        return [$string, $matches];
    }

    private static function matches_compare($element1, $element2)
    {
        return $element2['matches'] - $element1['matches'];
    }

    private static function search_query($query, $force = false)
    {
        $search_results = [];

        if (!$query) {
            return [];
        }

        $query_count = count($query);

        $search_models_list = self::search_list_config();

        foreach ($search_models_list as $search_model) {
            $model = $search_model['model'];
            $field_name = $search_model['row_name_field'];
            $field_link = $search_model['row_link_field'];
            $show_hidden = $search_model['show_hidden'] ?? false;
            $query_builds = [];
            $increase_matches = false;

            if ($query_count === 1 && in_array($query[0], $search_model['page_name_clean'])) {
                $query_empty_build = [];
                foreach ($search_model['fields'] as $field) {
                    $query_empty_build[] = self::generate_query_array($field, '!=', '');
                }
                $query_builds[] = $query_empty_build;
                $increase_matches = true;
            } else {
                foreach ($search_model['fields'] as $field) {
                    $query_builds[] = self::search_query_build_like($field, $query, $force);
                }
            }

            $res = $model
                ->where(function($laravel_query) use ($show_hidden) {
                    if (!$show_hidden) $laravel_query->where('hide', 0);

                })
                ->where(function ($laravel_query) use ($query_builds) {
                    foreach ($query_builds as $query_build) {
                        foreach ($query_build as $key => $where_part) {
                            if ($key === array_key_first($query_build)) {
                                $laravel_query->where($where_part['name'], $where_part['operator'], $where_part['query_part']);
                            } else {
                                $laravel_query->orWhere($where_part['name'], $where_part['operator'], $where_part['query_part']);
                            }
                        }
                    }
                })
                ->limit(self::$res_limit)
                ->get();

            if ($res) {
                foreach ($res as $row) {

                    $result = [
                        'title' => $row->$field_name,
                        'description' => $search_model['description'],
                        'link' => '/' . ($field_link ? $row->$field_link : $search_model['row_link_url']),
                        'category' => $search_model['category'],
                        'matches' => 0
                    ];

                    reset($query);

                    $matches_count = 0;

                    if ($increase_matches) {
                        $matches_count++;
                    }

                    foreach ($query as $query_part) {
                        list($title, $title_matches) = self::search_match($result['title'], $query_part);
                        $result['title'] = $title;
                        $matches_count += $title_matches;
                    }

                    $result['matches'] = $matches_count;

                    $search_results[] = $result;
                }
            }
        }

        if ($search_results) {
            usort($search_results, [self::class, 'matches_compare']);
            return $search_results;
        } else if (!$force) {
            return self::search_query($query,true);
        }

        return false;
    }
}
