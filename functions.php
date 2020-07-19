<?php

// API

add_action('rest_api_init', function () {
    register_rest_route('api/v1', 'objects', [
        'methods' => 'GET',

        'callback' => function () {


            $args = [
                'post_type' => 'objects',
                'posts_per_page' => '-1',
                'tax_query' => [],
                'meta_query' => [
                    'relation' => 'AND'
                ],
                'meta_key' => 'object_area_land',
                'orderby' => 'meta_value_num',
                'order' => 'DESC'
            ];
            if (isset($_GET['type'])) {
                $slugs = $_GET['type'];
                $tax_query_options = [
                    'taxonomy' => 'type',
                    'field' => 'slug',
                    'terms' => $slugs,
                    'operator' => 'IN'
                ];

                array_push($args['tax_query'], $tax_query_options);
            }


            if (isset($_GET['land_area'])) {
                $land_area = $_GET['land_area'];
                $area_query = [
                    'key' => 'object_area_land',
                    'value' => $land_area,
                    'compare' => '>=',
                    'type' => 'NUMERIC'
                ];

                array_push($args['meta_query'], $area_query);
            }
            if (isset($_GET['object_area'])) {
                $object_area = $_GET['object_area'];
                $area_query = [
                    'key' => 'object_area',
                    'value' => $object_area,
                    'compare' => '>=',
                    'type' => 'NUMERIC'
                ];

                array_push($args['meta_query'], $area_query);
            }
            if (isset($_GET['railroad_distance'])) {
                $railroad_distance = $_GET['railroad_distance'];
                $railroad_query = [
                    'key' => 'object_railroad_distance',
                    'value' => $railroad_distance,
                    'compare' => '<=',
                    'type' => 'DECIMAL'
                ];

                array_push($args['meta_query'], $railroad_query);
            }
            if (isset($_GET['road_distance'])) {
                $road_distance = $_GET['road_distance'];
                $road_query = [
                    'key' => 'object_road_asf_distance',
                    'value' => $road_distance,
                    'compare' => '<=',
                    'type' => 'DECIMAL'
                ];

                array_push($args['meta_query'], $road_query);
            }
            if (isset($_GET['gas'])) {
                $resource_query = [
                    'key'   => 'object_gas',
                    'value' => $_GET['gas'],
                ];

                array_push($args['meta_query'], $resource_query);
            }
            if (isset($_GET['gas_power'])) {
                $power = $_GET['gas_power'];
                $power_query = [
                    'key' => 'object_gas_max_power',
                    'value' => $power,
                    'compare' => '>=',
                    'type' => 'NUMERIC'
                ];

                array_push($args['meta_query'], $power_query);
            }
            if (isset($_GET['heat'])) {
                $resource_query = [
                    'key'   => 'object_heat',
                    'value' => $_GET['heat'],
                ];

                array_push($args['meta_query'], $resource_query);
            }
            if (isset($_GET['heat_power'])) {
                $power = $_GET['heat_power'];
                $power_query = [
                    'key' => 'object_heat_max_power',
                    'value' => $power,
                    'compare' => '>=',
                    'type' => 'NUMERIC'
                ];

                array_push($args['meta_query'], $power_query);
            }
            if (isset($_GET['water'])) {
                $resource_query = [
                    'key'   => 'object_water',
                    'value' => $_GET['water'],
                ];

                array_push($args['meta_query'], $resource_query);
            }
            if (isset($_GET['water_power'])) {
                $power = $_GET['water_power'];
                $power_query = [
                    'key' => 'object_water_max_power',
                    'value' => $power,
                    'compare' => '>=',
                    'type' => 'NUMERIC'
                ];

                array_push($args['meta_query'], $power_query);
            }
            if (isset($_GET['sewers'])) {
                $resource_query = [
                    'key'   => 'object_sewers',
                    'value' => $_GET['sewers'],
                ];

                array_push($args['meta_query'], $resource_query);
            }
            if (isset($_GET['sewers_power'])) {
                $power = $_GET['sewers_power'];
                $power_query = [
                    'key' => 'object_sewers_max_power',
                    'value' => $power,
                    'compare' => '>=',
                    'type' => 'NUMERIC'
                ];

                array_push($args['meta_query'], $power_query);
            }
            if (isset($_GET['electricity'])) {
                $resource_query = [
                    'key'   => 'object_electricity',
                    'value' => $_GET['electricity'],
                ];

                array_push($args['meta_query'], $resource_query);
            }

            if (isset($_GET['electric_power'])) {
                $power = $_GET['electric_power'];
                $power_query = [
                    'key' => 'object_electricity_max_power',
                    'value' => $power,
                    'compare' => '>=',
                    'type' => 'NUMERIC'
                ];

                array_push($args['meta_query'], $power_query);
            }


            $objects = new WP_Query($args);

            $objectsResults = [];

            while ($objects->have_posts()) {
                $objects->the_post();

                $newObject = [
                    'id' => get_the_id(),
                    'title' => mb_strimwidth(get_the_title(), 0, 30, "..."),
                    'permalink' => get_permalink(),
                    'coords' => [
                        'lat' => get_field('object_coords')['lat'],
                        'lng' => get_field('object_coords')['lng']
                    ],
                    'type' => has_term('brownfield', 'type') ? 'brownfield' : 'greenfield',
                    'land_area' => get_field('object_area_land'),
                    'object_card_number' => get_field('object_card_number')

                ];


                $image = get_field('object_map_card_image');

                if (!empty($image)) {
                    $newObject['card_image'] = esc_url($image['url']);
                }

                if (!empty(get_field('object_area'))) {
                    $newObject['object_area'] = get_field('object_area');
                }
                if (!empty(get_field('object_road_asf_distance'))) {
                    $newObject['road_distance'] = get_field('object_road_asf_distance');
                }
                if (!empty(get_field('object_railroad_distance'))) {
                    $newObject['railroad_distance'] = get_field('object_railroad_distance');
                }
                if (!empty(get_field('object_electricity'))) {
                    $newObject['electricity'] = get_field('object_electricity');
                }
                if (!empty(get_field('object_electricity_max_power'))) {
                    $newObject['electric_power'] = get_field('object_electricity_max_power');
                }
                if (!empty(get_field('object_gas'))) {
                    $newObject['gas'] = get_field('object_gas');
                }
                if (!empty(get_field('object_gas_max_power'))) {
                    $newObject['gas_power'] = get_field('object_gas_max_power');
                }
                if (!empty(get_field('object_water'))) {
                    $newObject['water'] = get_field('object_water');
                }
                if (!empty(get_field('object_water_max_power'))) {
                    $newObject['water_power'] = get_field('object_water_max_power');
                }
                if (!empty(get_field('object_sewers'))) {
                    $newObject['sewers'] = get_field('object_sewers');
                }
                if (!empty(get_field('object_sewers_max_power'))) {
                    $newObject['sewers_power'] = get_field('object_sewers_max_power');
                }
                if (!empty(get_field('object_heat'))) {
                    $newObject['heat'] = get_field('object_heat');
                }
                if (!empty(get_field('object_heat_max_power'))) {
                    $newObject['heat_power'] = get_field('object_heat_max_power');
                }





                $terms = get_the_terms($post->ID, 'property');

                if (is_array($terms)) {
                    $term_names = array_map(function ($term) {
                        return $term->name;
                    }, $terms);

                    $property_types = implode(', ', $term_names);
                    $newObject['property_type'] = $property_types;
                }



                array_push($objectsResults, $newObject);
            }

            return $objectsResults;
        }
    ]);


    register_rest_route('api/v1', 'objects/types', [
        'methods' => 'GET',
        'callback' => function () {
            $terms = [];
            $terms = get_terms('type', [
                'hide_empty' => false,
                'hierarchical' => false,
                'pad_counts'  => 1
            ]);


            return $terms;
        }
    ]);


    register_rest_route('api/v1', 'objects/taxonomies', [
        'methods' => 'GET',
        'callback' => function () {
            $taxonomies = get_taxonomies([
                'public' => true,
                'object_type' => ['objects'],
                '_builtin' => false
            ], 'objects');


            $taxonomiesList = [];

            foreach ($taxonomies as $taxonomy) {
                array_push($taxonomiesList, $taxonomy);
            }


            return $taxonomiesList;
        }
    ]);
    register_rest_route('api/v1', 'districts', [
        'methods' => 'GET',
        'callback' => function () {
            $districts = new WP_Query([
                'post_type' => 'districts',
                'posts_per_page' => '-1'
            ]);

            $districtsResults = [];

            while ($districts->have_posts()) {
                $districts->the_post();
                array_push($districtsResults, [
                    'id' => get_the_id(),
                    'title' => get_the_title(),
                    'styles' => [
                        'strokeColor' => get_field('district_stroke_color'),
                        'fillColor' => get_field('district_fill_color'),
                        'fillOpacity' => get_field('district_opacity'),
                        'strokeOpacity' => get_field('district_stroke_opacity'),
                        'strokeWeight' => get_field('district_stroke_width')
                    ]
                ]);
            }

            return $districtsResults;
        }
    ]);
    register_rest_route('api/v1', 'events', [
        'methods' => 'GET',
        'callback' => function () {
            $args = [
                'post_type' => 'news',
                'posts_per_page' => '-1',
                'meta_query' => [
                    'relation' => 'AND',
                    [
                        'key' => 'news_is_event',
                        'value' => '1',
                    ]
                ]
            ];


            if (isset($_GET['date'])) {
                $date = [
                    'key' => 'news_event_start',
                    'value' => $_GET['date'],
                    'compare' => '=',
                    'type' => 'DATE'
                ];


                array_push($args['meta_query'], $date);
            }


          
            if (isset($_GET['start']) && isset($_GET['end'])) {

                $range = [
                    'relation' => 'AND',
                    array(
                        'key' => 'news_event_start',
                        'value' => date('Y-m-d', strtotime($_GET['start'])),
                        'compare' => '>=',
                        'type' => 'DATE'
                    ),
                    array(
                        'key' => 'news_event_start',
                        'value' => date('Y-m-d', strtotime($_GET['end'])),
                        'compare' => '<=',
                        'type' => 'DATE'
                    ),
                ];

                array_push($args['meta_query'], $range);
            }


           






            $events = new WP_Query($args);

            $eventsResults = [];

            while ($events->have_posts()) {
                $events->the_post();

                $datetime = strtotime(get_field('news_event_start'));


               

                array_push($eventsResults, [
                    'id' => get_the_ID(),
                    'title' => get_the_title(),
                    'url' => get_permalink(),
                    'start' => date_i18n('j F Y H:i', $datetime),
                    'creation_date' => get_the_date(),
                    'thumbnail' => get_the_post_thumbnail()
                
                ]);
            }

            return $eventsResults;
        }
    ]);
    register_rest_route('api/v1', 'events/dates', [
        'methods' => 'GET',
        'callback' => function () {
            $args = [
                'post_type' => 'news',
                'posts_per_page' => '-1',
                'meta_query' => [
                    'relation' => 'AND',
                    [
                        'key' => 'news_is_event',
                        'value' => '1',
                    ]
                ],
                'meta_key' => 'news_event_start',
                'orderby' => 'meta_value_num',
                'order' => 'DESC'
            ];





            $events = new WP_Query($args);

            $dates = [];

            while ($events->have_posts()) {
                $events->the_post();

                array_push($dates, get_field('news_event_start'));
            }

            return $dates;
        }
    ]);
});




// Подключаем файлы и стили

function assets()
{
    wp_enqueue_style('open_sans_font', '//fonts.googleapis.com/css?family=Open+Sans:400,700&display=swap&subset=cyrillic');
    wp_enqueue_style('fira_sans_condensed_font', '//fonts.googleapis.com/css2?family=Fira+Sans+Condensed:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,900;1,300;1,400&display=swap');
    wp_enqueue_style('fira_sans_font', '//fonts.googleapis.com/css?family=Fira+Sans&display=swap&subset=cyrillic');
    wp_enqueue_style('roboto_font', '//fonts.googleapis.com/css?family=Roboto:300,400&display=swap&subset=cyrillic');
    wp_enqueue_style('main_css', get_template_directory_uri() . '/css/styles.min.css');
    wp_enqueue_script('main_js', get_template_directory_uri() . '/js/app.js', ['jquery', 'google_maps'], '1.0', true);
    wp_enqueue_script('google_maps', '//maps.googleapis.com/maps/api/js?key=AIzaSyARSAFafQFEYWEZvA02Nc6PE--Vv9gT8OE', ['jquery'], '1.0', true);
}

add_action('wp_enqueue_scripts', 'assets');


// Включаем поддержку функций темы

function website_features()
{
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
}

add_action('after_setup_theme', 'website_features');

// Устанавливаем силу сжатия картинок

add_filter('jpeg_quality', function ($arg) {
    return 90;
});

// Новые размеры миниатюр

if (function_exists('add_image_size')) {


    add_image_size('person-photo', 600, 600, true);
    add_image_size('object-medium-image', 1200, 9999);
    add_image_size('object-large-image', 2000, 9999);
}

// Регистрация новых типов записей

function register_objects_type()
{
    $options = [
        'labels' => [
            'name' => 'Объекты',
            'singular_name' => 'Объект',
            'add_new' => 'Добавить новый',
            'add_new_item' => 'Добавить новый объект',
            'edit_item' => 'Редактировать объект',
            'new_item' => 'Новый объект',
            'view_item'          => 'Посмотреть объект',
            'search_items'       => 'Найти объект',
            'not_found'          =>  'Объектов не найдено',
            'not_found_in_trash' => 'В корзине объектов не найдено',
            'parent_item_colon'  => '',
            'menu_name'          => 'Объекты'
        ],
        'public' => true,
        'has_archive' => true,
        'rewrite' => [
            'with_front' => false
        ],
        'menu_position' => 2,
        'menu_icon' => 'dashicons-admin-home',
        'supports' => ['title', 'editor', 'custom-fields'],
        'taxonomies' => ['location', 'type', 'land', 'property']
    ];
    register_post_type('objects', $options);
}

function register_indicators_type()
{
    $options = [
        'labels' => [
            'name' => 'Показатели',
            'singular_name' => 'Показатель',
            'add_new' => 'Добавить новый',
            'add_new_item' => 'Добавить новый показатель',
            'edit_item' => 'Редактировать показатель',
            'new_item' => 'Новый показатель',
            'view_item'          => 'Посмотреть показатель',
            'search_items'       => 'Найти показатель',
            'not_found'          =>  'Показателей не найдено',
            'not_found_in_trash' => 'В корзине показателей не найдено',
            'parent_item_colon'  => '',
            'menu_name'          => 'Показатели'
        ],
        'public' => false,
        'show_ui' => true,
        'has_archive' => false,
        'rewrite' => [
            'with_front' => false
        ],
        'menu_position' => 4,
        'menu_icon' => 'dashicons-chart-area',
        'supports' => ['title', 'editor', 'custom-fields'],
        'taxonomies' => ['indicator_type']
    ];
    register_post_type('indicators', $options);
}

function register_steps_type()
{
    $options = [
        'labels' => [
            'name' => 'Шаги',
            'singular_name' => 'Шаг',
            'add_new' => 'Добавить новый',
            'add_new_item' => 'Добавить новый шаг',
            'edit_item' => 'Редактировать шаг',
            'new_item' => 'Новый шаг',
            'view_item'          => 'Посмотреть шаг',
            'search_items'       => 'Найти шаг',
            'not_found'          =>  'Шагов не найдено',
            'not_found_in_trash' => 'В корзине шагов не найдено',
            'parent_item_colon'  => '',
            'menu_name'          => 'Шаги'
        ],
        'public' => false,
        'show_ui' => true,
        'has_archive' => false,
        'rewrite' => [
            'with_front' => false
        ],
        'menu_position' => 4,
        'menu_icon' => 'dashicons-arrow-right-alt',
        'supports' => ['title', 'editor', 'custom-fields']
    ];
    register_post_type('steps', $options);
}
function register_govsupport_type()
{
    $options = [
        'labels' => [
            'name' => 'Меры господдержки',
            'singular_name' => 'Мера господдержки',
            'add_new' => 'Добавить новую',
            'add_new_item' => 'Добавить новую меру господдержки',
            'edit_item' => 'Редактировать меру господдержки',
            'new_item' => 'Новая мера господдержки',
            'view_item'          => 'Посмотреть меру',
            'search_items'       => 'Найти меру господдержки',
            'not_found'          =>  'Мер господдержки не найдено',
            'not_found_in_trash' => 'В корзине мер господдержки не найдено',
            'parent_item_colon'  => '',
            'menu_name'          => 'Меры господдержки'
        ],
        'public' => true,
        'show_ui' => true,
        'has_archive' => true,
        'rewrite' => [
            'with_front' => false
        ],
        'menu_position' => 4,
        'menu_icon' => 'dashicons-phone',
        'supports' => ['title', 'editor', 'custom-fields', 'support-category']
    ];
    register_post_type('govsupport', $options);
}
function register_reports_type()
{
    $options = [
        'labels' => [
            'name' => 'Отчеты и планы',
            'singular_name' => 'Отчеты и планы',
            'add_new' => 'Добавить новые',
            'add_new_item' => 'Добавить новые',
            'edit_item' => 'Редактировать',
            'new_item' => 'Новый',
            'view_item'          => 'Посмотреть отчеты и планы',
            'search_items'       => 'Найти отчеты и планы',
            'not_found'          =>  'Отчетов и планов не найдено',
            'not_found_in_trash' => 'В корзине отчетов и планов не найдено',
            'parent_item_colon'  => '',
            'menu_name'          => 'Отчеты и планы'
        ],
        'public' => false,
        'show_ui' => true,
        'has_archive' => false,
        'rewrite' => [
            'with_front' => false
        ],
        'menu_position' => 4,
        'menu_icon' => 'dashicons-media-text',
        'supports' => ['title', 'editor', 'custom-fields']
    ];
    register_post_type('reports', $options);
}
function register_advantages_type()
{
    $options = [
        'labels' => [
            'name' => 'Преимущества',
            'singular_name' => 'Преимущество',
            'add_new' => 'Добавить новое',
            'add_new_item' => 'Добавить новое преимущество',
            'edit_item' => 'Редактировать преимущество',
            'new_item' => 'Новое преимущество',
            'view_item'          => 'Посмотреть преимущество',
            'search_items'       => 'Найти преимущество',
            'not_found'          =>  'Преимуществ не найдено',
            'not_found_in_trash' => 'В корзине преимуществ не найдено',
            'parent_item_colon'  => '',
            'menu_name'          => 'Преимущества'
        ],
        'public' => false,
        'show_ui' => true,
        'has_archive' => false,
        'rewrite' => [
            'with_front' => false
        ],
        'menu_position' => 4,
        'menu_icon' => 'dashicons-yes-alt',
        'supports' => ['title', 'editor', 'custom-fields']
    ];
    register_post_type('advantages', $options);
}

function register_projects_type()
{
    $options = [
        'labels' => [
            'name' => 'Истории успеха',
            'singular_name' => 'История успеха',
            'add_new' => 'Добавить новую',
            'add_new_item' => 'Добавить новую историю успеха',
            'edit_item' => 'Редактировать историю успеха',
            'new_item' => 'Новая история',
            'view_item'          => 'Посмотреть историю успеха',
            'search_items'       => 'Найти историю успеха',
            'not_found'          =>  'Историй успеха не найдено',
            'not_found_in_trash' => 'В корзине историй успеха не найдено',
            'parent_item_colon'  => '',
            'menu_name'          => 'Истории успеха'
        ],
        'public' => true,
        'has_archive' => true,
        'rewrite' => [
            'with_front' => false
        ],
        'menu_position' => 3,
        'menu_icon' => 'dashicons-analytics',
        'supports' => ['title', 'editor', 'custom-fields', 'thumbnail'],
        'taxonomies' => ['industry', 'status']
    ];
    register_post_type('projects', $options);
}


function register_news_type()
{
    $options = [
        'labels' => [
            'name' => 'Новости',
            'singular_name' => 'Новость',
            'add_new' => 'Добавить новую',
            'add_new_item' => 'Добавить новую новость',
            'edit_item' => 'Редактировать новость',
            'new_item' => 'Новая новость',
            'view_item'          => 'Посмотреть новость',
            'search_items'       => 'Найти новость',
            'not_found'          =>  'Новостей не найдено',
            'not_found_in_trash' => 'В корзине новостей не найдено',
            'parent_item_colon'  => '',
            'menu_name'          => 'Новости'
        ],
        'public' => true,
        'menu_position' => 3,
        'has_archive' => true,
        'rewrite' => [
            'with_front' => false
        ],
        'menu_icon' => 'dashicons-id-alt',
        'supports' => ['title', 'editor', 'custom-fields', 'thumbnail', 'author']
    ];
    register_post_type('news', $options);
}


function register_laws_type()
{
    $options = [
        'labels' => [
            'name' => 'Нормативный акт',
            'singular_name' => 'Нормативные акты',
            'add_new' => 'Добавить новый',
            'add_new_item' => 'Добавить новый нормативный акт',
            'edit_item' => 'Редактировать нормативный акт',
            'new_item' => 'Новый нормативный акт',
            'view_item'          => 'Посмотреть нормативные акты',
            'search_items'       => 'Найти нормативный акт',
            'not_found'          =>  'Нормативныъ актов не найдено',
            'not_found_in_trash' => 'В корзине нормативных актов не найдено',
            'parent_item_colon'  => '',
            'menu_name'          => 'Нормативные акты'
        ],
        'public' => true,
        'menu_position' => 3,
        'menu_icon' => 'dashicons-text-page',
        'supports' => ['title', 'editor', 'custom-fields'],
        'taxonomies' => ['type_of_law', 'thematics']
    ];
    register_post_type('laws', $options);
}


function register_taxes_type()
{
    $options = [
        'labels' => [
            'name' => 'Налоги',
            'singular_name' => 'Налог',
            'add_new' => 'Добавить новый',
            'add_new_item' => 'Добавить новый налог',
            'edit_item' => 'Редактировать налог',
            'new_item' => 'Новый налог',
            'view_item'          => 'Посмотреть налог',
            'search_items'       => 'Найти налог',
            'not_found'          =>  'Налогов не найдено',
            'not_found_in_trash' => 'В корзине налогов не найдено',
            'parent_item_colon'  => '',
            'menu_name'          => 'Налоги'
        ],
        'public' => false,
        'show_ui' => true,
        'menu_position' => 2,
        'menu_icon' => 'dashicons-chart-bar',
        'supports' => ['title', 'custom-fields']
    ];
    register_post_type('taxes', $options);
}


function register_specialist_type()
{
    $options = [
        'labels' => [
            'name' => 'Специалисты',
            'singular_name' => 'Специалист',
            'add_new' => 'Добавить нового',
            'add_new_item' => 'Добавить нового специалиста',
            'edit_item' => 'Редактировать специалиста',
            'new_item' => 'Новый специалист',
            'view_item'          => 'Посмотреть специалиста',
            'search_items'       => 'Найти специалиста',
            'not_found'          =>  'Специалистов не найдено',
            'not_found_in_trash' => 'В корзине специалистов не найдено',
            'parent_item_colon'  => '',
            'menu_name'          => 'Специалисты'
        ],
        'public' => false,
        'show_ui' => true,
        'menu_position' => 2,
        'menu_icon' => 'dashicons-businessperson',
        'supports' => ['title', 'editor', 'custom-fields'],
        'taxonomies' => ['departments']
    ];
    register_post_type('specialists', $options);
}


function register_areas_type()
{
    $options = [
        'labels' => [
            'name' => 'Территории',
            'singular_name' => 'Территория',
            'add_new' => 'Добавить новую территорию',
            'add_new_item' => 'Добавить новую территорию',
            'edit_item' => 'Редактировать территорию',
            'new_item' => 'Новая территория',
            'view_item'          => 'Посмотреть территорию',
            'search_items'       => 'Найти территорию',
            'not_found'          =>  'Территорий не найдено',
            'not_found_in_trash' => 'В корзине территорий не найдено',
            'parent_item_colon'  => '',
            'menu_name'          => 'Территории'
        ],
        'public' => true,
        'show_ui' => true,
        'has_archive' => true,
        'rewrite' => [
            'with_front' => false
        ],
        'menu_position' => 2,
        'menu_icon' => 'dashicons-location-alt',
        'supports' => ['title', 'custom-fields'],
        'taxonomies' => ['location', 'type_of_area']
    ];
    register_post_type('areas', $options);
}


function register_districts_type()
{
    $options = [
        'labels' => [
            'name' => 'Районы',
            'singular_name' => 'Район',
            'add_new' => 'Добавить новый',
            'add_new_item' => 'Добавить новый район',
            'edit_item' => 'Редактировать район',
            'new_item' => 'Новый район',
            'view_item'          => 'Посмотреть район',
            'search_items'       => 'Найти район',
            'not_found'          =>  'Районов не найдено',
            'not_found_in_trash' => 'В корзине районов не найдено',
            'parent_item_colon'  => '',
            'menu_name'          => 'Районы'
        ],
        'public' => true,
        'show_ui' => true,
        'has_archive' => true,
        'rewrite' => [
            'with_front' => false
        ],
        'menu_position' => 2,
        'menu_icon' => 'dashicons-admin-multisite',
        'supports' => ['title', 'custom-fields'],
        'taxonomies' => ['location']
    ];
    register_post_type('districts', $options);
}



add_action('init', 'register_post_types');
function register_post_types()
{
    register_objects_type();
    register_projects_type();
    register_news_type();
    register_laws_type();
    register_taxes_type();
    register_specialist_type();
    register_areas_type();
    register_districts_type();
    register_indicators_type();
    register_advantages_type();
    register_reports_type();
    register_govsupport_type();
    register_steps_type();
}


// Регистрация таксономий 

add_action('init', 'create_taxonomy');
function create_taxonomy()
{
    register_taxonomy('location', ['objects', 'areas'], [
        'label'                 => '',
        'labels'                => [
            'name'              => 'Расположение',
            'singular_name'     => 'Расположение',
            'search_items'      => 'Искать расположение',
            'all_items'         => 'Все расположения',
            'view_item '        => 'Посмотреть расположение',
            'parent_item'       => 'Основное расположение',
            'parent_item_colon' => 'Основное расположение:',
            'edit_item'         => 'Редактировать расположение',
            'update_item'       => 'Обновить расположение',
            'add_new_item'      => 'Добавить новое расположение',
            'new_item_name'     => 'Новое расположение',
            'menu_name'         => 'Расположение',
        ],
        'description'           => 'Расположение объекта',
        'public'                => true,
        'hierarchical'          => true
    ]);


    register_taxonomy('type', ['objects'], [
        'label'                 => '',
        'labels'                => [
            'name'              => 'Типы объекта',
            'singular_name'     => 'Тип объекта',
            'search_items'      => 'Искать типы',
            'all_items'         => 'Все типы объектов',
            'view_item '        => 'Посмотреть тип объекта',
            'parent_item'       => 'Основной тип объекта',
            'parent_item_colon' => 'Основной тип объекта:',
            'edit_item'         => 'Редактировать тип объекта',
            'update_item'       => 'Обновить тип объекта',
            'add_new_item'      => 'Добавить новый тип объекта',
            'new_item_name'     => 'Новый тип объекта',
            'menu_name'         => 'Типы объектов',
        ],
        'description'           => 'Типы объектов',
        'public'                => true,
        'hierarchical'          => true
    ]);


    register_taxonomy('indicator_type', ['indicators'], [
        'label'                 => '',
        'labels'                => [
            'name'              => 'Типы показателей',
            'singular_name'     => 'Тип показателя',
            'search_items'      => 'Искать типы показателей',
            'all_items'         => 'Все типы показателей',
            'view_item '        => 'Посмотреть тип показателя',
            'parent_item'       => 'Основной тип показателя',
            'parent_item_colon' => 'Основной тип показателя:',
            'edit_item'         => 'Редактировать тип показателя',
            'update_item'       => 'Обновить тип показателя',
            'add_new_item'      => 'Добавить новый тип показателя',
            'new_item_name'     => 'Новый тип показателя',
            'menu_name'         => 'Типы показателей',
        ],
        'description'           => 'Типы показателей',
        'public'                => true,
        'hierarchical'          => true
    ]);


    register_taxonomy('support-category', ['govsupport'], [
        'label'                 => '',
        'labels'                => [
            'name'              => 'Категории мер поддержки',
            'singular_name'     => 'Категория меры поддержки',
            'search_items'      => 'Искать категории мер поддержки',
            'all_items'         => 'Все категории мер поддержки',
            'view_item '        => 'Посмотреть категорию меры поддержки',
            'parent_item'       => 'Основная категория меры поддержки',
            'parent_item_colon' => 'Основная категория меры поддержки:',
            'edit_item'         => 'Редактировать категорию меры поддержки',
            'update_item'       => 'Обновить категорию меры поддержки',
            'add_new_item'      => 'Добавить новую категорию меры поддержки',
            'new_item_name'     => 'Новая категория меры поддержки',
            'menu_name'         => 'Категории мер поддержки',
        ],
        'description'           => 'Категории мер',
        'public'                => true,
        'hierarchical'          => true
    ]);

    register_taxonomy('property', ['objects'], [
        'label'                 => '',
        'labels'                => [
            'name'              => 'Формы собственности',
            'singular_name'     => 'Форма собственности',
            'search_items'      => 'Искать формы',
            'all_items'         => 'Все формы собственности',
            'view_item '        => 'Посмотреть форму собственности',
            'parent_item'       => 'Основная форма собственности',
            'parent_item_colon' => 'Основная форма собственности:',
            'edit_item'         => 'Редактировать форму собственности',
            'update_item'       => 'Обновить форму собственности',
            'add_new_item'      => 'Добавить новую форму собственности',
            'new_item_name'     => 'Новая форма собственности',
            'menu_name'         => 'Формы собственности',
        ],
        'description'           => 'Формы собственности',
        'public'                => true,
        'hierarchical'          => true
    ]);

    register_taxonomy('industry', ['projects', 'news'], [
        'label'                 => '', // определяется параметром $labels->name
        'labels'                => [
            'name'              => 'Отрасли',
            'singular_name'     => 'Отрасль',
            'search_items'      => 'Искать отрасли',
            'all_items'         => 'Все отрасли',
            'view_item '        => 'Посмотреть отрасль',
            'parent_item'       => 'Основная отрасль',
            'parent_item_colon' => 'Основная отрасль:',
            'edit_item'         => 'Редактировать отрасль',
            'update_item'       => 'Обновить отрасли',
            'add_new_item'      => 'Добавить новую отрасль',
            'new_item_name'     => 'Новая отрасль',
            'menu_name'         => 'Отрасли',
        ],
        'description'           => 'Отрасли',
        'public'                => true,
        'hierarchical'          => true
    ]);
    register_taxonomy('status', ['projects'], [
        'label'                 => '', // определяется параметром $labels->name
        'labels'                => [
            'name'              => 'Статусы проекта',
            'singular_name'     => 'Статус проекта',
            'search_items'      => 'Искать статусы проекта',
            'all_items'         => 'Все статусы проекта',
            'view_item '        => 'Посмотреть статус проекта',
            'parent_item'       => 'Основной статус проекта',
            'parent_item_colon' => 'Основной статус проекта:',
            'edit_item'         => 'Редактировать статус проекта',
            'update_item'       => 'Обновить статус проекта',
            'add_new_item'      => 'Добавить новый статус проекта',
            'new_item_name'     => 'Новый статус проекта',
            'menu_name'         => 'Статусы проекта',
        ],
        'description'           => 'Статусы проекта',
        'public'                => true,
        'hierarchical'          => true
    ]);


    register_taxonomy('type_of_law', ['laws'], [
        'label'                 => '',
        'labels'                => [
            'name'              => 'Типы актов',
            'singular_name'     => 'Тип актов',
            'search_items'      => 'Искать типы актов',
            'all_items'         => 'Все типы актов',
            'view_item '        => 'Посмотреть тип актов',
            'parent_item'       => 'Основной тип актов',
            'parent_item_colon' => 'Основной тип актов:',
            'edit_item'         => 'Редактировать тип актов',
            'update_item'       => 'Обновить тип актов',
            'add_new_item'      => 'Добавить новый тип актов',
            'new_item_name'     => 'Новый тип актов',
            'menu_name'         => 'Типы актов',
        ],
        'description'           => 'Типы актов',
        'public'                => true,
        'hierarchical'          => true
    ]);


    register_taxonomy('thematics', ['laws'], [
        'label'                 => '',
        'labels'                => [
            'name'              => 'Тематика актов',
            'singular_name'     => 'Тематика актов',
            'search_items'      => 'Искать тематику актов',
            'all_items'         => 'Все тематики актов',
            'view_item '        => 'Посмотреть тематику актов',
            'parent_item'       => 'Основная тематика акта',
            'parent_item_colon' => 'Основная тематика акта:',
            'edit_item'         => 'Редактировать тематику акта',
            'update_item'       => 'Обновить тематику акта',
            'add_new_item'      => 'Добавить новую тематику акта',
            'new_item_name'     => 'Новая тематика акта',
            'menu_name'         => 'Тематика актов',
        ],
        'description'           => 'Тематика актов',
        'public'                => true,
        'hierarchical'          => true
    ]);


    register_taxonomy('land', ['objects'], [
        'label'                 => '',
        'labels'                => [
            'name'              => 'Категории земли',
            'singular_name'     => 'Категория земли',
            'search_items'      => 'Искать категории земли',
            'all_items'         => 'Все категории земли',
            'view_item '        => 'Посмотреть категорию земли',
            'parent_item'       => 'Основная категория земли',
            'parent_item_colon' => 'Основная категория земли:',
            'edit_item'         => 'Редактировать категорию земли',
            'update_item'       => 'Обновить категорию земли',
            'add_new_item'      => 'Добавить новую категорию земли',
            'new_item_name'     => 'Новая категория земли',
            'menu_name'         => 'Категории земли',
        ],
        'description'           => 'Категории земли',
        'public'                => true,
        'hierarchical'          => true
    ]);


    register_taxonomy('type_of_area', ['areas'], [
        'label'                 => '',
        'labels'                => [
            'name'              => 'Типы территорий',
            'singular_name'     => 'Тип территории',
            'search_items'      => 'Искать типы территорий',
            'all_items'         => 'Все типы территорий',
            'view_item '        => 'Посмотреть тип территории',
            'parent_item'       => 'Основной тип территории',
            'parent_item_colon' => 'Основной тип территории:',
            'edit_item'         => 'Редактировать тип территории',
            'update_item'       => 'Обновить тип территории',
            'add_new_item'      => 'Добавить новый тип территории',
            'new_item_name'     => 'Новый тип территории',
            'menu_name'         => 'Типы территорий',
        ],
        'description'           => 'Типы территорий',
        'public'                => true,
        'hierarchical'          => true
    ]);


    register_taxonomy('departments', ['specialists'], [
        'label'                 => '',
        'labels'                => [
            'name'              => 'Отделы',
            'singular_name'     => 'Отдел',
            'search_items'      => 'Искать отделы',
            'all_items'         => 'Все отделы',
            'view_item '        => 'Посмотреть отделы',
            'parent_item'       => 'Основной отдел',
            'parent_item_colon' => 'Основной отдел:',
            'edit_item'         => 'Редактировать отдел',
            'update_item'       => 'Обновить отдел',
            'add_new_item'      => 'Добавить новый отдел',
            'new_item_name'     => 'Новый отдел',
            'menu_name'         => 'Отделы',
        ],
        'description'           => 'Отделы',
        'public'                => true,
        'hierarchical'          => true
    ]);
}


// Убрать появляющийся отступ сверху у элемента HTML

add_action('get_header', 'remove_admin_login_header');

function remove_admin_login_header()
{
    remove_action('wp_head', '_admin_bar_bump_cb');
}


// Устанавливаем API ключ для гугл карт

function my_acf_init()
{
    acf_update_setting('google_api_key', 'AIzaSyARSAFafQFEYWEZvA02Nc6PE--Vv9gT8OE');
}
add_action('acf/init', 'my_acf_init');


// Добавить страницу глобальных полей

if (function_exists('acf_add_options_page')) {
    acf_add_options_page([
        'page_title'     => 'Страницы архивов',
        'menu_title'    => 'Архивы',
        'menu_slug'     => 'archive-pages',
        'capability'    => 'edit_posts',
        'redirect'        => false
    ]);
    acf_add_options_page([
        'page_title'     => 'Инвестиционный рейтинг',
        'menu_title'    => 'Инвестиционный рейтинг',
        'menu_slug'     => 'invest-rating',
        'capability'    => 'edit_posts',
        'redirect'        => false
    ]);
    acf_add_options_page([
        'page_title'     => 'Региональный центр компетенций',
        'menu_title'    => 'Центр компетенций',
        'menu_slug'     => 'competence',
        'capability'    => 'edit_posts',
        'redirect'        => false
    ]);
    acf_add_options_page([
        'page_title'     => 'Инвестиционная карта',
        'menu_title'    => 'Инвестиционная карта',
        'menu_slug'     => 'map',
        'capability'    => 'edit_posts',
        'redirect'        => false
    ]);
    acf_add_options_page([
        'page_title'     => 'Поля блоков',
        'menu_title'    => 'Поля блоков',
        'menu_slug'     => 'blocks',
        'capability'    => 'edit_posts',
        'redirect'        => false
    ]);
}
