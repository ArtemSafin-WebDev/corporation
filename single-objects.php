<?php get_header(); ?>

<section class="page-title">
    <div class="page-title__bg-image-container">
        <?php
        $image = get_field('object_background_photo');
        if (!empty($image)) : ?>
            <img class="page-title__bg-image" src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
        <?php endif; ?>
    </div>
    <div class="container">
        <div class="inner-container">
            <div class="page-title__content">
                <h1 class="page-title__heading object-card__main-heading">
                    <?php if (!empty(get_field('object_card_number'))) : ?>
              
                    №<?php the_field('object_card_number'); ?>
            
                    <?php endif; ?>

                    <?php the_title(); ?>

                   
                </h1>
              
            </div>
        </div>
    </div>
</section>

<?php if (have_posts()) : ?>

    <?php while (have_posts()) : the_post(); ?>
        <section class="object-card">
            <div class="container">
                <div class="inner-container">
                    <div class="object-card__common-info">
                        <h2 class="object-card__heading">
                            Общая информация
                        </h2>
                        <div class="object-card__top-row">
                            <div class="object-card__general-info">
                                <ul class="object-card__general-info-list">
                                    <?php if (get_field('object_address')) : ?>
                                        <li class="object-card__general-info-list-item">
                                            <div class="object-card__general-info-card">
                                                Адрес - <?php the_field('object_address') ?>
                                            </div>
                                        </li>
                                    <? endif; ?>
                                    <?php if (get_field('object_area_land')) : ?>
                                        <li class="object-card__general-info-list-item">
                                            <div class="object-card__general-info-card">
                                                Площадь земельного участка - <?php the_field('object_area_land') ?> га
                                            </div>
                                        </li>
                                    <? endif; ?>
                                    <?php if (get_field('object_area')) : ?>
                                        <li class="object-card__general-info-list-item">
                                            <div class="object-card__general-info-card">
                                                Площадь объекта - <?php the_field('object_area') ?> м²
                                            </div>
                                        </li>
                                    <? endif; ?>
                                    <?php if (get_field('object_number')) : ?>
                                        <li class="object-card__general-info-list-item">
                                            <div class="object-card__general-info-card">
                                                Кадастровый номер - <?php the_field('object_number') ?>
                                            </div>
                                        </li>
                                    <? endif; ?>

                                    <?php
                                    $terms = get_the_terms($post->ID, 'land');
                                    $show_land = true;
                                    if (is_array($terms)) {
                                        $term_names = array_map(function ($term) {
                                            return $term->name;
                                        }, $terms);

                                        $land_categories = implode(', ', $term_names);
                                    } else {
                                        $show_land = false;
                                    }
                                    ?>

                                    <?php if ($show_land) : ?>

                                        <li class="object-card__general-info-list-item">
                                            <div class="object-card__general-info-card">
                                                Категория земли - <?php echo $land_categories; ?>

                                            </div>
                                        </li>

                                    <?php endif; ?>

                                    <?php
                                    $terms = get_the_terms($post->ID, 'property');
                                    $show_property_type = true;
                                    if (is_array($terms)) {
                                        $term_names = array_map(function ($term) {
                                            return $term->name;
                                        }, $terms);

                                        $property_types = implode(', ', $term_names);
                                    } else {
                                        $show_property_type = false;
                                    }

                                    ?>

                                    <?php if ($show_property_type) : ?>
                                        <li class="object-card__general-info-list-item">
                                            <div class="object-card__general-info-card">
                                                Форма собственности - <?php echo $property_types; ?>
                                            </div>
                                        </li>
                                    <?php endif; ?>
                                    <?php if (get_field('object_has_railroad')) : ?>
                                        <li class="object-card__general-info-list-item">
                                            <div class="object-card__general-info-card">
                                                Железнодорожные пути - имеются
                                                <?php $railroad_distance = get_field('object_railroad_distance'); ?>
                                                <?php if (!empty($railroad_distance)) : ?>
                                                    , расстояние до ЖД ветки - <?php echo $railroad_distance; ?> км.
                                                <?php endif; ?>
                                            </div>
                                        </li>
                                    <?php endif; ?>
                                    <?php if (!empty(get_field('object_airport_distance'))) : ?>
                                        <li class="object-card__general-info-list-item">
                                            <div class="object-card__general-info-card">
                                                Расстояние до ближайшего аэропорта - <?php the_field('object_airport_distance'); ?> км.
                                            </div>
                                        </li>
                                    <?php endif; ?>
                                </ul>
                            </div>
                            <?php
                            $file = get_field('object_card_file');
                            if ($file) : ?>
                                <a class="object-card__download-btn" download href="<?php echo $file['url']; ?>">
                                    <svg width="20" height="20" aria-hidden="true" class="icon-pdf">
                                        <use xlink:href="#pdf" />
                                    </svg>
                                    Скачать карточку объекта
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                    <?php $description = get_the_content(); ?>
                    <?php if (!empty($description)) : ?>
                        <div class="object-card__description">
                            <h2 class="object-card__heading">
                                Описание объекта
                            </h2>
                            <div class="default-content object-card__description-text">
                                <?php echo $description; ?>
                            </div>
                        </div>
                    <?php endif; ?>

                    <div class="object-card__infra">
                        <h2 class="object-card__heading">
                            Инженерная инфраструктура
                        </h2>
                        <ul class="object-card__infra-list">
                            <?php if (get_field('object_electricity')) : ?>
                                <li class="object-card__infra-list-item">
                                    <div class="object-card__infra-card object-card__infra-card--electricity">
                                        <svg class="object-card__dashed-frame" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none" width="500" height="1000">
                                            <rect fill="none" x="2" y="2" width="496" height="996" rx="32" stroke="#707070" stroke-linecap="round" stroke-dasharray="8 16" stroke-width="2" preserveAspectRatio="none" vector-effect="non-scaling-stroke"></rect>
                                        </svg>
                                    
                                      
                                        <div class="object-card__infra-card-top-row">

                                            <div class="object-card__infra-card-icon-container">
                                                <img class="object-card__infra-card-icon" src="<?php echo get_template_directory_uri(); ?>/img/infra/electricity.svg" />
                                            </div>

                                            <h3 class="object-card__infra-card-name">
                                                Электроснабжение
                                            </h3>
                                        </div>
                                        <div class="object-card__infra-card-bottom-row">
                                            <ul class="object-card__infra-card-features-list">
                                                <?php if (!empty(get_field('object_electricity_max_power'))) : ?>
                                                    <li class="object-card__infra-card-features-list-item">
                                                        <div class="object-card__infra-card-features-card">
                                                            <span class="object-card__infra-card-features-card-text">
                                                                максимально возможная мощность
                                                            </span>
                                                            <span class="object-card__infra-card-features-card-amount">
                                                                <span class="object-card__infra-card-features-card-amount-digit">
                                                                    <?php the_field('object_electricity_max_power'); ?>
                                                                </span>
                                                                <span class="object-card__infra-card-features-card-amount-units">
                                                                    МВт
                                                                </span>
                                                            </span>
                                                        </div>
                                                    </li>

                                                <? endif; ?>

                                                <?php if (!empty(get_field('object_electricity_free_power'))) : ?>
                                                    <li class="object-card__infra-card-features-list-item">
                                                        <div class="object-card__infra-card-features-card">
                                                            <span class="object-card__infra-card-features-card-text">
                                                                свободная мощность
                                                            </span>
                                                            <span class="object-card__infra-card-features-card-amount">
                                                                <span class="object-card__infra-card-features-card-amount-digit">
                                                                    <?php the_field('object_electricity_free_power'); ?>
                                                                </span>
                                                                <span class="object-card__infra-card-features-card-amount-units">
                                                                    МВт
                                                                </span>
                                                            </span>
                                                        </div>
                                                    </li>

                                                <?php endif; ?>

                                                <?php if (!empty(get_field('object_electricity_tariff'))) : ?>
                                                    <li class="object-card__infra-card-features-list-item">
                                                        <div class="object-card__infra-card-features-card">
                                                            <span class="object-card__infra-card-features-card-text">
                                                                тариф от
                                                            </span>
                                                            <span class="object-card__infra-card-features-card-amount">
                                                                <span class="object-card__infra-card-features-card-amount-digit">
                                                                    <?php the_field('object_electricity_tariff'); ?>
                                                                </span>
                                                                <span class="object-card__infra-card-features-card-amount-units">
                                                                    ₽ / кВтч
                                                                </span>
                                                            </span>
                                                        </div>
                                                    </li>

                                                <?php endif; ?>
                                            </ul>

                                        </div>
                                    </div>
                                </li>

                            <?php endif; ?>
                            <?php if (get_field('object_gas')) : ?>
                                <li class="object-card__infra-list-item">
                                    <div class="object-card__infra-card object-card__infra-card--gas">
                                        <svg class="object-card__dashed-frame" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none" width="500" height="1000">
                                            <rect fill="none" x="2" y="2" width="496" height="996" rx="32" stroke="#707070" stroke-linecap="round" stroke-dasharray="8 16" stroke-width="2" preserveAspectRatio="none" vector-effect="non-scaling-stroke"></rect>
                                        </svg>
                                        <div class="object-card__infra-card-top-row">
                                            <div class="object-card__infra-card-icon-container">
                                                <img class="object-card__infra-card-icon" src="<?php echo get_template_directory_uri(); ?>/img/infra/gas.svg" />
                                            </div>
                                            <h3 class="object-card__infra-card-name">
                                                Газоснабжение
                                            </h3>
                                        </div>
                                        <div class="object-card__infra-card-bottom-row">
                                            <ul class="object-card__infra-card-features-list">
                                                <?php if (!empty(get_field('object_gas_max_power'))) : ?>
                                                    <li class="object-card__infra-card-features-list-item">
                                                        <div class="object-card__infra-card-features-card">
                                                            <span class="object-card__infra-card-features-card-text">
                                                                максимально возможная мощность
                                                            </span>
                                                            <span class="object-card__infra-card-features-card-amount">
                                                                <span class="object-card__infra-card-features-card-amount-digit">
                                                                    <?php the_field('object_gas_max_power'); ?>
                                                                </span>
                                                                <span class="object-card__infra-card-features-card-amount-units">
                                                                    м³ / сут
                                                                </span>
                                                            </span>
                                                        </div>
                                                    </li>

                                                <? endif; ?>

                                                <?php if (!empty(get_field('object_gas_free_power'))) : ?>
                                                    <li class="object-card__infra-card-features-list-item">
                                                        <div class="object-card__infra-card-features-card">
                                                            <span class="object-card__infra-card-features-card-text">
                                                                свободная мощность
                                                            </span>
                                                            <span class="object-card__infra-card-features-card-amount">
                                                                <span class="object-card__infra-card-features-card-amount-digit">
                                                                    <?php the_field('object_gas_free_power'); ?>
                                                                </span>
                                                                <span class="object-card__infra-card-features-card-amount-units">
                                                                    м³ / сут
                                                                </span>
                                                            </span>
                                                        </div>
                                                    </li>

                                                <?php endif; ?>

                                                <?php if (!empty(get_field('object_gas_tariff'))) : ?>
                                                    <li class="object-card__infra-card-features-list-item">
                                                        <div class="object-card__infra-card-features-card">
                                                            <span class="object-card__infra-card-features-card-text">
                                                                тариф от
                                                            </span>
                                                            <span class="object-card__infra-card-features-card-amount">
                                                                <span class="object-card__infra-card-features-card-amount-digit">
                                                                    <?php the_field('object_gas_tariff'); ?>
                                                                </span>
                                                                <span class="object-card__infra-card-features-card-amount-units">
                                                                    ₽ / м³
                                                                </span>
                                                            </span>
                                                        </div>
                                                    </li>

                                                <?php endif; ?>
                                            </ul>

                                        </div>
                                    </div>
                                </li>

                            <?php endif; ?>
                            <?php if (get_field('object_water')) : ?>
                                <li class="object-card__infra-list-item">
                                    <div class="object-card__infra-card object-card__infra-card--water">
                                        <svg class="object-card__dashed-frame" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none" width="500" height="1000">
                                            <rect fill="none" x="2" y="2" width="496" height="996" rx="32" stroke="#707070" stroke-linecap="round" stroke-dasharray="8 16" stroke-width="2" preserveAspectRatio="none" vector-effect="non-scaling-stroke"></rect>
                                        </svg>
                                        <div class="object-card__infra-card-top-row">
                                            <div class="object-card__infra-card-icon-container">
                                                <img class="object-card__infra-card-icon" src="<?php echo get_template_directory_uri(); ?>/img/infra/water.svg" />
                                            </div>
                                            <h3 class="object-card__infra-card-name">
                                                Водоснабжение
                                            </h3>
                                        </div>
                                        <div class="object-card__infra-card-bottom-row">
                                            <ul class="object-card__infra-card-features-list">
                                                <?php if (!empty(get_field('object_water_max_power'))) : ?>
                                                    <li class="object-card__infra-card-features-list-item">
                                                        <div class="object-card__infra-card-features-card">
                                                            <span class="object-card__infra-card-features-card-text">
                                                                максимально возможная мощность
                                                            </span>
                                                            <span class="object-card__infra-card-features-card-amount">
                                                                <span class="object-card__infra-card-features-card-amount-digit">
                                                                    <?php the_field('object_water_max_power'); ?>
                                                                </span>
                                                                <span class="object-card__infra-card-features-card-amount-units">
                                                                    м³ / сут
                                                                </span>
                                                            </span>
                                                        </div>
                                                    </li>

                                                <? endif; ?>

                                                <?php if (!empty(get_field('object_water_free_power'))) : ?>
                                                    <li class="object-card__infra-card-features-list-item">
                                                        <div class="object-card__infra-card-features-card">
                                                            <span class="object-card__infra-card-features-card-text">
                                                                свободная мощность
                                                            </span>
                                                            <span class="object-card__infra-card-features-card-amount">
                                                                <span class="object-card__infra-card-features-card-amount-digit">
                                                                    <?php the_field('object_water_free_power'); ?>
                                                                </span>
                                                                <span class="object-card__infra-card-features-card-amount-units">
                                                                    м³ / сут
                                                                </span>
                                                            </span>
                                                        </div>
                                                    </li>

                                                <?php endif; ?>

                                                <?php if (!empty(get_field('object_water_tariff'))) : ?>
                                                    <li class="object-card__infra-card-features-list-item">
                                                        <div class="object-card__infra-card-features-card">
                                                            <span class="object-card__infra-card-features-card-text">
                                                                тариф от
                                                            </span>
                                                            <span class="object-card__infra-card-features-card-amount">
                                                                <span class="object-card__infra-card-features-card-amount-digit">
                                                                    <?php the_field('object_water_tariff'); ?>
                                                                </span>
                                                                <span class="object-card__infra-card-features-card-amount-units">
                                                                    ₽ / м³
                                                                </span>
                                                            </span>
                                                        </div>
                                                    </li>

                                                <?php endif; ?>
                                            </ul>

                                        </div>
                                    </div>
                                </li>

                            <?php endif; ?>
                            <?php if (get_field('object_sewers')) : ?>
                                <li class="object-card__infra-list-item">
                                    <div class="object-card__infra-card object-card__infra-card--sewers">
                                    <svg class="object-card__dashed-frame" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none" width="500" height="1000">
                                            <rect fill="none" x="2" y="2" width="496" height="996" rx="32" stroke="#707070" stroke-linecap="round" stroke-dasharray="8 16" stroke-width="2" preserveAspectRatio="none" vector-effect="non-scaling-stroke"></rect>
                                        </svg>
                                        <div class="object-card__infra-card-top-row">
                                            <div class="object-card__infra-card-icon-container">
                                                <img class="object-card__infra-card-icon" src="<?php echo get_template_directory_uri(); ?>/img/infra/sewers.svg" />
                                            </div>
                                            <h3 class="object-card__infra-card-name">
                                                Водоотведение
                                            </h3>
                                        </div>
                                        <div class="object-card__infra-card-bottom-row">
                                            <ul class="object-card__infra-card-features-list">
                                                <?php if (!empty(get_field('object_sewers_max_power'))) : ?>
                                                    <li class="object-card__infra-card-features-list-item">
                                                        <div class="object-card__infra-card-features-card">
                                                            <span class="object-card__infra-card-features-card-text">
                                                                максимально возможная мощность
                                                            </span>
                                                            <span class="object-card__infra-card-features-card-amount">
                                                                <span class="object-card__infra-card-features-card-amount-digit">
                                                                    <?php the_field('object_sewers_max_power'); ?>
                                                                </span>
                                                                <span class="object-card__infra-card-features-card-amount-units">
                                                                    м³ / сут
                                                                </span>
                                                            </span>
                                                        </div>
                                                    </li>

                                                <? endif; ?>

                                                <?php if (!empty(get_field('object_sewers_free_power'))) : ?>
                                                    <li class="object-card__infra-card-features-list-item">
                                                        <div class="object-card__infra-card-features-card">
                                                            <span class="object-card__infra-card-features-card-text">
                                                                свободная мощность
                                                            </span>
                                                            <span class="object-card__infra-card-features-card-amount">
                                                                <span class="object-card__infra-card-features-card-amount-digit">
                                                                    <?php the_field('object_sewers_free_power'); ?>
                                                                </span>
                                                                <span class="object-card__infra-card-features-card-amount-units">
                                                                    м³ / сут
                                                                </span>
                                                            </span>
                                                        </div>
                                                    </li>

                                                <?php endif; ?>

                                                <?php if (!empty(get_field('object_sewers_tariff'))) : ?>
                                                    <li class="object-card__infra-card-features-list-item">
                                                        <div class="object-card__infra-card-features-card">
                                                            <span class="object-card__infra-card-features-card-text">
                                                                тариф от
                                                            </span>
                                                            <span class="object-card__infra-card-features-card-amount">
                                                                <span class="object-card__infra-card-features-card-amount-digit">
                                                                    <?php the_field('object_sewers_tariff'); ?>
                                                                </span>
                                                                <span class="object-card__infra-card-features-card-amount-units">
                                                                    ₽ / м³
                                                                </span>
                                                            </span>
                                                        </div>
                                                    </li>

                                                <?php endif; ?>
                                            </ul>

                                        </div>
                                    </div>
                                </li>

                            <?php endif; ?>
                            <?php if (get_field('object_heat')) : ?>
                                <li class="object-card__infra-list-item">
                                    <div class="object-card__infra-card object-card__infra-card--heat">
                                        <svg class="object-card__dashed-frame" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none" width="500" height="1000">
                                            <rect fill="none" x="2" y="2" width="496" height="996" rx="32" stroke="#707070" stroke-linecap="round" stroke-dasharray="8 16" stroke-width="2" preserveAspectRatio="none" vector-effect="non-scaling-stroke"></rect>
                                        </svg>
                                        <div class="object-card__infra-card-top-row">
                                            <div class="object-card__infra-card-icon-container">
                                                <img class="object-card__infra-card-icon" src="<?php echo get_template_directory_uri(); ?>/img/infra/heat.svg" />
                                            </div>
                                            <h3 class="object-card__infra-card-name">
                                                Теплоснабжение
                                            </h3>
                                        </div>
                                        <div class="object-card__infra-card-bottom-row">
                                            <ul class="object-card__infra-card-features-list">
                                                <?php if (!empty(get_field('object_heat_max_power'))) : ?>
                                                    <li class="object-card__infra-card-features-list-item">
                                                        <div class="object-card__infra-card-features-card">
                                                            <span class="object-card__infra-card-features-card-text">
                                                                максимально возможная мощность
                                                            </span>
                                                            <span class="object-card__infra-card-features-card-amount">
                                                                <span class="object-card__infra-card-features-card-amount-digit">
                                                                    <?php the_field('object_heat_max_power'); ?>
                                                                </span>
                                                                <span class="object-card__infra-card-features-card-amount-units">
                                                                    Гкал / сут
                                                                </span>
                                                            </span>
                                                        </div>
                                                    </li>

                                                <? endif; ?>

                                                <?php if (!empty(get_field('object_heat_free_power'))) : ?>
                                                    <li class="object-card__infra-card-features-list-item">
                                                        <div class="object-card__infra-card-features-card">
                                                            <span class="object-card__infra-card-features-card-text">
                                                                свободная мощность
                                                            </span>
                                                            <span class="object-card__infra-card-features-card-amount">
                                                                <span class="object-card__infra-card-features-card-amount-digit">
                                                                    <?php the_field('object_heat_free_power'); ?>
                                                                </span>
                                                                <span class="object-card__infra-card-features-card-amount-units">
                                                                    Гкал / сут
                                                                </span>
                                                            </span>
                                                        </div>
                                                    </li>

                                                <?php endif; ?>

                                                <?php if (!empty(get_field('object_heat_tariff'))) : ?>
                                                    <li class="object-card__infra-card-features-list-item">
                                                        <div class="object-card__infra-card-features-card">
                                                            <span class="object-card__infra-card-features-card-text">
                                                                тариф от
                                                            </span>
                                                            <span class="object-card__infra-card-features-card-amount">
                                                                <span class="object-card__infra-card-features-card-amount-digit">
                                                                    <?php the_field('object_heat_tariff'); ?>
                                                                </span>
                                                                <span class="object-card__infra-card-features-card-amount-units">
                                                                    ₽ / Гкал
                                                                </span>
                                                            </span>
                                                        </div>
                                                    </li>

                                                <?php endif; ?>
                                            </ul>

                                        </div>
                                    </div>
                                </li>

                            <?php endif; ?>

                        </ul>
                    </div>

                    <?php
                    $location = get_field('object_coords');
                    if ($location) : ?>
                        <div class="object-card__map-container js-object-card-map" data-districts="<?php echo get_template_directory_uri() . '/js/districts.json' ?>" data-lat="<?php echo esc_attr($location['lat']); ?>" data-lng="<?php echo esc_attr($location['lng']); ?>">
                            <div class="object-card__map">

                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </section>




    <?php endwhile; ?>

<?php else : ?>
    <div class="no-posts">
        Записи отсутствуют
    </div>
<?php endif; ?>


<section class="areas__feedback">
    <div class="container">
        <h2 class="areas__feedback-heading">
            Запросить информацию об объекте
        </h2>
        <div class="areas__feedback-wrapper">
            <?php echo do_shortcode('[contact-form-7 id="545" title="Открыть бизнес"]'); ?>
        </div>
    </div>
</section>


<?php get_footer(); ?>


<?php include get_theme_file_path('/modals.php'); ?>