<?php /* Template Name: Площадки */ ?>


<?php get_header(); ?>






<section class="objects-map js-objects-map" data-root-url="<?php echo get_template_directory_uri(); ?>" data-districts="<?php echo get_template_directory_uri() . '/js/districts.json' ?>" id="objects">
    <div class="container">
        <div class="inner-container">
            <h2 class="objects-map__heading">
                Инвестиционная карта
            </h2>

            <div class="objects-map__content">
                <div class="objects-map__filters">
                    <div class="objects-map__filters-group objects-map__filters-group--type">
                        <h4 class="objects-map__filters-group-name">
                            Вид и размер площадки
                        </h4>
                        <div class="objects-map__filters-group-dropdown">
                            <div class="objects-map__filters-group-dropdown-inner">
                                <div class="objects-map__filters-group-content">
                                    <label class="objects-map__filters-simple-checkbox">
                                        <input type="checkbox" name="type" value="brownfield" class="objects-map__filters-simple-checkbox-input" checked id="brownfield-checkbox">
                                        <span class="objects-map__filters-simple-checkbox-mark">
                                            <svg width="10" height="10" aria-hidden="true" class="icon-checkmark">
                                                <use xlink:href="#checkmark" />
                                            </svg>
                                        </span>
                                        <span class="objects-map__filters-simple-checkbox-text">
                                            Brownfield
                                        </span>
                                    </label>
                                    <div class="objects-map__filters-group-area-range-block" id="brownfield-area-block">
                                        <p class="objects-map__filters-group-area-range-block-title">
                                            Площадь объекта (м²)
                                        </p>



                                        <div class="objects-map__range-slider js-range-slider">
                                            <input type="range" name="object-area" class="objects-map__range-input" min="0" max="<?php the_field('max_object_area', 'option'); ?>" step="10" value="<?php echo get_field('max_object_area', 'option') / 2; ?>">
                                            <div class="objects-map__range-slider-wrapper">
                                                <div class="objects-map__range-slider-price">

                                                </div>
                                                <div class="objects-map__range-slider"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <label class="objects-map__filters-simple-checkbox">
                                        <input type="checkbox" name="type" value="greenfield" class="objects-map__filters-simple-checkbox-input" checked id="greenfield-checkbox">
                                        <span class="objects-map__filters-simple-checkbox-mark">
                                            <svg width="10" height="10" aria-hidden="true" class="icon-checkmark">
                                                <use xlink:href="#checkmark" />
                                            </svg>
                                        </span>
                                        <span class="objects-map__filters-simple-checkbox-text">
                                            Greenfield
                                        </span>
                                    </label>

                                    <div class="objects-map__filters-group-area-range-block" id="greenfield-area-block">
                                        <p class="objects-map__filters-group-area-range-block-title">
                                            Площадь земельного участка (га)
                                        </p>

                                        <div class="objects-map__range-slider js-range-slider">
                                            <input type="range" name="land-area" class="objects-map__range-input" min="0" max="<?php the_field('max_land_area', 'option'); ?>" step="1" value="<?php echo get_field('max_land_area', 'option') / 2; ?>">
                                            <div class="objects-map__range-slider-wrapper">
                                                <div class="objects-map__range-slider-price">

                                                </div>
                                                <div class="objects-map__range-slider"></div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="objects-map__filters-group-buttons">
                                    <button class="objects-map__filters-group-reset-btn">
                                        Сбросить
                                    </button>
                                    <button class="objects-map__filters-group-apply-btn">
                                        Применить
                                    </button>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="objects-map__filters-group objects-map__filters-group--transport">
                        <h4 class="objects-map__filters-group-name">
                            Транспортная инфраструктура
                        </h4>
                        <div class="objects-map__filters-group-dropdown">
                            <div class="objects-map__filters-group-dropdown-inner">
                                <div class="objects-map__filters-group-content active">

                                    <div class="objects-map__filters-group-area-range-block">
                                        <p class="objects-map__filters-group-area-range-block-title">
                                            Расстояние до
                                            асфальтированной дороги (км)
                                        </p>

                                        <div class="objects-map__range-slider js-range-slider">
                                            <input type="range" name="road-distance" class="objects-map__range-input" min="0" max="10" step="0.5" value="5">
                                            <div class="objects-map__range-slider-wrapper">
                                                <div class="objects-map__range-slider-price">

                                                </div>
                                                <div class="objects-map__range-slider"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="objects-map__filters-group-area-range-block">
                                        <p class="objects-map__filters-group-area-range-block-title">
                                            Расстояние до
                                            железнодорожной ветки (км)
                                        </p>

                                        <div class="objects-map__range-slider js-range-slider">
                                            <input type="range" name="railroad-distance" class="objects-map__range-input" min="0" max="10" step="0.5" value="5">
                                            <div class="objects-map__range-slider-wrapper">
                                                <div class="objects-map__range-slider-price">

                                                </div>
                                                <div class="objects-map__range-slider"></div>
                                            </div>
                                        </div>
                                    </div>


                                </div>
                                <div class="objects-map__filters-group-buttons">
                                    <button class="objects-map__filters-group-reset-btn">
                                        Сбросить
                                    </button>
                                    <button class="objects-map__filters-group-apply-btn">
                                        Применить
                                    </button>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="objects-map__filters-group objects-map__filters-group--infra">
                        <h4 class="objects-map__filters-group-name">
                            Инженерная инфраструктура
                        </h4>
                        <div class="objects-map__filters-group-dropdown">
                            <div class="objects-map__filters-group-dropdown-inner">
                                <div class="objects-map__filters-group-content">
                                    <div class="objects-map__filters-infra-heading-block">
                                        <span>
                                            Доступность<br>
                                            подключения
                                        </span>
                                        <span>
                                            Минимально<br>
                                            необходимый объем
                                        </span>
                                    </div>
                                    <div class="objects-map__filters-infra-block">
                                        <label class="objects-map__filters-simple-checkbox">
                                            <input type="checkbox" name="electricity" value="1" class="objects-map__filters-simple-checkbox-input" checked>
                                            <span class="objects-map__filters-simple-checkbox-mark">
                                                <svg width="10" height="10" aria-hidden="true" class="icon-checkmark">
                                                    <use xlink:href="#checkmark" />
                                                </svg>
                                            </span>
                                            <span class="objects-map__filters-simple-checkbox-text">
                                                Электроснабжение
                                            </span>
                                        </label>

                                        <label class="objects-map__filters-number-label">
                                            <input type="number" name="electric-power" class="objects-map__filters-number-input" value="0">
                                            <span class="objects-map__filters-number-label-units">
                                                мВт
                                            </span>
                                        </label>

                                    </div>

                                    <div class="objects-map__filters-infra-block">
                                        <label class="objects-map__filters-simple-checkbox">
                                            <input type="checkbox" name="gas" value="1" class="objects-map__filters-simple-checkbox-input" checked>
                                            <span class="objects-map__filters-simple-checkbox-mark">
                                                <svg width="10" height="10" aria-hidden="true" class="icon-checkmark">
                                                    <use xlink:href="#checkmark" />
                                                </svg>
                                            </span>
                                            <span class="objects-map__filters-simple-checkbox-text">
                                                Газоснабжение
                                            </span>
                                        </label>

                                        <label class="objects-map__filters-number-label">
                                            <input type="number" name="gas-power" class="objects-map__filters-number-input" value="0">
                                            <span class="objects-map__filters-number-label-units">
                                                м³/сут
                                            </span>
                                        </label>
                                    </div>
                                    <div class="objects-map__filters-infra-block">
                                        <label class="objects-map__filters-simple-checkbox">
                                            <input type="checkbox" name="water" value="1" class="objects-map__filters-simple-checkbox-input">
                                            <span class="objects-map__filters-simple-checkbox-mark">
                                                <svg width="10" height="10" aria-hidden="true" class="icon-checkmark">
                                                    <use xlink:href="#checkmark" />
                                                </svg>
                                            </span>
                                            <span class="objects-map__filters-simple-checkbox-text">
                                                Водоснабжение
                                            </span>
                                        </label>

                                        <label class="objects-map__filters-number-label">
                                            <input type="number" name="water-power" class="objects-map__filters-number-input" value="0">
                                            <span class="objects-map__filters-number-label-units">
                                                м³/cут.
                                            </span>
                                        </label>
                                    </div>
                                    <div class="objects-map__filters-infra-block">
                                        <label class="objects-map__filters-simple-checkbox">
                                            <input type="checkbox" name="sewers" value="1" class="objects-map__filters-simple-checkbox-input">
                                            <span class="objects-map__filters-simple-checkbox-mark">
                                                <svg width="10" height="10" aria-hidden="true" class="icon-checkmark">
                                                    <use xlink:href="#checkmark" />
                                                </svg>
                                            </span>
                                            <span class="objects-map__filters-simple-checkbox-text">
                                                Водоотведение
                                            </span>
                                        </label>

                                        <label class="objects-map__filters-number-label">
                                            <input type="number" name="sewers-power" class="objects-map__filters-number-input" value="0">
                                            <span class="objects-map__filters-number-label-units">
                                                м³/cут.
                                            </span>
                                        </label>
                                    </div>
                                    <div class="objects-map__filters-infra-block">
                                        <label class="objects-map__filters-simple-checkbox">
                                            <input type="checkbox" name="heat" value="1" class="objects-map__filters-simple-checkbox-input">
                                            <span class="objects-map__filters-simple-checkbox-mark">
                                                <svg width="10" height="10" aria-hidden="true" class="icon-checkmark">
                                                    <use xlink:href="#checkmark" />
                                                </svg>
                                            </span>
                                            <span class="objects-map__filters-simple-checkbox-text">
                                                Теплоснабжение
                                            </span>
                                        </label>

                                        <label class="objects-map__filters-number-label">
                                            <input type="number" name="heat-power" class="objects-map__filters-number-input" value="0">
                                            <span class="objects-map__filters-number-label-units">
                                                Гкал/сут
                                            </span>
                                        </label>
                                    </div>


                                </div>
                                <div class="objects-map__filters-group-buttons">
                                    <button class="objects-map__filters-group-reset-btn">
                                        Сбросить
                                    </button>
                                    <button class="objects-map__filters-group-apply-btn">
                                        Применить
                                    </button>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="objects-map__row">
                    <div class="objects-map__list-column">
                        <div class="objects-map__objects-total-amount">
                            Поиск объектов
                        </div>
                        <div class="objects-map__objects-list-scroll-wrapper">
                            <ul class="objects-map__objects-list">


                            </ul>
                        </div>

                    </div>
                    <div class="objects-map__map-column">
                        <div class="objects-map__map-container">
                            <div class="objects-map__map">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- <section class="areas__objects">
    <div class="container">
        <h2 class="areas__objects-heading">
            Объекты
        </h2>
        <?php
        $args = [
            'post_type' => 'objects',
            'posts_per_page' => '-1'
        ];

        $objects = new WP_Query($args);
        ?>
        <div class="areas__objects-row js-objects-list">
            <div class="areas__objects-left-column">

                <div class="areas__objects-gradient-wrapper">


                    <?php if ($objects->have_posts()) : ?>
                        <ul class="areas__objects-nav">
                            <?php while ($objects->have_posts()) : $objects->the_post(); ?>
                                <li class="areas__objects-nav-item">
                                    <a href="<?php the_permalink(); ?>" class="areas__objects-nav-card">
                                        <div class="areas__objects-nav-card-photo">
                                            <?php
                                            $image = get_field('object_preview');
                                            if (!empty($image)) : ?>
                                                <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
                                            <?php endif; ?>
                                        </div>
                                        <div class="areas__objects-nav-card-content">
                                            <h5 class="areas__objects-nav-card-title">
                                                <?php the_title(); ?>
                                            </h5>

                                        </div>
                                    </a>
                                </li>
                            <?php endwhile; ?>
                        </ul>
                    <?php endif; ?>
                </div>
            </div>
            <div class="areas__objects-right-column">

                <?php if ($objects->have_posts()) : ?>
                    <ul class="areas__objects-list">
                        <?php while ($objects->have_posts()) : $objects->the_post(); ?>
                            <li class="areas__objects-list-item">
                                <div class="areas__objects-card">
                                    <div class="areas__objects-photo">
                                        <?php
                                        $image = get_field('object_preview');
                                        if (!empty($image)) : ?>
                                            <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
                                        <?php endif; ?>
                                    </div>
                                    <div class="areas__objects-content">
                                        <h5 class="areas__objects-card-title">
                                            <?php the_title(); ?>
                                        </h5>
                                        <div class="areas__objects-text-content default-content">
                                            <?php the_content(); ?>
                                        </div>
                                        <a href="<?php the_permalink(); ?>" class="areas__objects-more-link">Подробнее</a>
                                    </div>
                                </div>
                            </li>
                        <?php endwhile; ?>
                    </ul>
                <?php endif; ?>

            </div>
            <?php wp_reset_query(); ?>
        </div>
    </div>
</section> -->






<section class="areas__feedback">
    <div class="container">
        <h2 class="areas__feedback-heading">
            Стать инвестором
        </h2>
        <div class="areas__feedback-wrapper">
            <?php echo do_shortcode('[contact-form-7 id="545" title="Открыть бизнес"]'); ?>
        </div>
    </div>
</section>

<?php
$args = [
    'post_type' => 'projects',
    'posts_per_page' => '-1',
    'meta_query' => array(
        array(
            'key'   => 'project_in_search',
            'value' => '1',
        )
    )
];

$projects = new WP_Query($args);
?>
<?php if ($projects->have_posts()) : ?>
    <section class="areas__slider js-areas-slider" id="projects-in-work">
        <div class="container">
            <h2 class="areas__slider-heading">
                Реализуемые проекты
            </h2>
            <div class="areas__slider-content">
                <div class="swiper-container">
                    <div class="swiper-wrapper">
                        <?php while ($projects->have_posts()) : $projects->the_post(); ?>
                            <div class="swiper-slide">
                            
                                <div class="projects-archive__card">
                                    <?php if ($image = get_field('project_slider_image')) : ?>
                                        <div class="projects-archive__card-image-container">
                                            <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>">
                                            <h3 class="projects-archive__card-company-name">
                                                <?php the_field('project_company_name'); ?>
                                            </h3>
                                        </div>
                                        <div class="projects-archive__card-content">
                                            <div class="projects-archive__card-representative">
                                                <div class="projects-archive__card-representative-name">
                                                    <?php the_field('project_short_list'); ?>
                                                </div>
                                            </div>
                                            <div class="projects-archive__card-general-info">
                                                <h4 class="projects-archive__card-general-info-heading">
                                                    Общая информация
                                                </h4>
                                                <div class="projects-archive__card-general-info-items">
                                                    <div class="projects-archive__card-general-info-item">
                                                        Объем инвестиций в проект: <?php $field = get_field('project_investments');
                                                                                    echo !empty($field) ? $field : 'Сумма'; ?> млн. руб.
                                                    </div>
                                                    <div class="projects-archive__card-general-info-item">
                                                        Создано: <?php $field = get_field('project_kolichestvo_sotrudnikov');
                                                                    echo !empty($field) ? $field : 'Количество'; ?> новых рабочих мест
                                                    </div>
                                                    <div class="projects-archive__card-general-info-item">
                                                        Статус: <?php
                                                                $terms = get_the_terms($post->ID, 'status');

                                                                if (is_array($terms)) {
                                                                    $term_names = array_map(function ($term) {
                                                                        return $term->name;
                                                                    }, $terms);

                                                                    echo implode(', ', $term_names);
                                                                } else {
                                                                    echo 'Неизвестно';
                                                                } ?>
                                                    </div>
                                                    <div class="projects-archive__card-general-info-item">
                                                        Отрасль: <?php
                                                                    $terms = get_the_terms($post->ID, 'industry');
                                                                    if (is_array($terms)) {
                                                                        $term_names = array_map(function ($term) {
                                                                            return $term->name;
                                                                        }, $terms);

                                                                        echo implode(', ', $term_names);
                                                                    } else {
                                                                        echo 'Неизвестно';
                                                                    }
                                                                    ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <a href="<?php the_permalink(); ?>" class="projects-archive__card-link">
                                                Читать полностью
                                            </a>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endwhile; ?>
                    </div>
                </div>
                <div class="areas__slider-pagination"></div>
            </div>
        </div>
    </section>
<?php endif; ?>

<?php wp_reset_query(); ?>

<?php get_footer(); ?>


<?php include get_theme_file_path('/modals.php'); ?>