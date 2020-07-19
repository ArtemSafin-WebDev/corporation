<?php /* Template Name: Поддержка */ ?>


<?php get_header(); ?>

<section class="page-title">
    <div class="page-title__bg-image-container">
        <?php
        $image = get_field('page_title_bg_image');
        if (!empty($image)) : ?>
            <img class="page-title__bg-image" src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
        <?php endif; ?>
    </div>
    <div class="container">
        <div class="inner-container">
            <div class="page-title__content">
                <h1 class="page-title__heading">
                    <?php the_title(); ?>
                </h1>
                <div class="breadcrumbs">
                    <?php require_once get_theme_file_path('/breadcrumbs.php'); ?>
                    <?php if (function_exists('dimox_breadcrumbs')) dimox_breadcrumbs(); ?>
                </div>
            </div>
        </div>
    </div>
</section>



<section class="schema" id="apply">
    <div class="container">
        <div class="inner-container">
            <div class="schema__title">
                <h2 class="schema__title-heading">
                    Единое окно
                </h2>
                <div class="schema__counters">
                    <div class="schema__counter">
                        <span class="schema__counter-amount">
                            <?php the_field('support_first_counter'); ?>
                        </span>
                        <span class="schema__counter-text">
                            Получено
                            обращений
                        </span>
                    </div>
                    <div class="schema__counter">
                        <span class="schema__counter-amount schema__counter-amount--blue">
                            <?php the_field('support_second_counter'); ?>
                        </span>
                        <span class="schema__counter-text">
                            Обработано
                            обращений
                        </span>
                    </div>
                </div>
                <?php
                $file = get_field('support_reglament');
                if ($file) : ?>
                    <a class="schema__reglament" href="<?php echo $file['url']; ?>">
                        <svg width="30" height="40" aria-hidden="true" class="icon-pdf">
                            <use xlink:href="#pdf" />
                        </svg>
                        Регламент сопровождения инвестиционных проектов
                    </a>
                <?php endif; ?>

            </div>


            <hr class="schema__divider">

            <div class="schema__steps">

                <?php
                $args = [
                    'post_type' => 'steps',
                    'posts_per_page' => '-1',
                    'meta_key' => 'step_number',
                    'orderby' => 'meta_value_num',
                    'order' => 'ASC'
                ];

                $steps = new WP_Query($args);
                ?>
                <?php if ($steps->have_posts()) : ?>
                    <div class="schema__steps-slider js-step-slider">
                        <div class="schema__steps-slider-pagination">
                            <div class="schema__steps-slider-pagination-text">

                                <h3 class="schema__subheading">
                                    Шаги инвестора
                                </h3>
                            </div>
                            <div class="schema__steps-slider-pagination-bullets">

                            </div>
                        </div>
                        <div class="schema__steps-slider-inner-wrapper">
                            <div class="schema__steps-slider-left-col">
                                <button class="schema__steps-btn schema__steps-btn--prev">
                                    <svg width="30" height="60" aria-hidden="true" class="icon-double-arrow">
                                        <use xlink:href="#double-arrow" />
                                    </svg>
                                </button>
                            </div>
                            <div class="schema__steps-slider-right-col">

                                <div class="schema__steps-slider-block-wrapper">
                                    <div class="swiper-container">
                                        <div class="swiper-wrapper">
                                            <?php while ($steps->have_posts()) : $steps->the_post(); ?>

                                                <div class="swiper-slide">
                                                    <div class="schema__steps-card">
                                                        <div class="schema__steps-card-content">
                                                            <span class="schema__steps-card-step-digit">
                                                                0<?php the_field('step_number'); ?>
                                                            </span>



                                                            <h4 class="schema__steps-card-name">
                                                                <?php the_title(); ?>
                                                            </h4>
                                                            <div class="schema__steps-card-text">
                                                                <?php the_content(); ?>
                                                            </div>

                                                        </div>

                                                        <div class="schema__steps-image-container">

                                                            <?php
                                                            $image = get_field('step_icon');
                                                            if (!empty($image)) : ?>
                                                                <img class="schema__steps-image" src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
                                                            <?php endif; ?>
                                                        </div>
                                                        <span class="schema__steps-card-next-step-digit">
                                                            0<?php echo get_field('step_number') + 1; ?>
                                                        </span>
                                                    </div>
                                                </div>
                                            <?php endwhile; ?>
                                        </div>
                                    </div>
                                </div>

                                <button class="schema__steps-btn schema__steps-btn--next">
                                    <svg width="30" height="60" aria-hidden="true" class="icon-double-arrow">
                                        <use xlink:href="#double-arrow" />
                                    </svg>
                                </button>
                            </div>

                        </div>

                    </div>
                <?php else : ?>
                    <div class="schema__steps-no-steps">
                        Нет шагов
                    </div>
                <?php endif; ?>
                <?php wp_reset_query(); ?>
            </div>
        </div>
    </div>
</section>


<?php if (have_rows('competence', 'option')) : ?>
    <section class="regional-competence" id="competence">
        <div class="container">
            <div class="inner-container">
                <h2 class="regional-competence__heading">
                    Региональный центр компетенций
                </h2>

                <div class="regional-competence__info">


                    <ul class="advantages__list">


                        <?php while (have_rows('competence', 'option')) : the_row();


                        ?>

                            <li class="advantages__list-item">

                                <div class="advantages__card">

                                    <?php
                                    $image = get_sub_field('competence_icon');
                                    if (!empty($image)) : ?>

                                        <div class="advantages__card-image-container">
                                            <img class="advantages__card-image" src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
                                        </div>

                                    <?php endif; ?>

                                    <h5 class="advantages__card-title">
                                        <?php the_sub_field('competence_title'); ?>
                                    </h5>
                                    <hr class="advantages__card-divider">
                                    <div class="advantages__card-content default-content">
                                        <?php the_sub_field('competence_content'); ?>
                                    </div>

                                    <?php
                                    $link = get_sub_field('competence_link');
                                    if ($link) :

                                    ?>
                                        <a class="regional-competence__info-card-link" href="<?php echo esc_url($link); ?>"><?php the_sub_field('competence_link_text'); ?></a>
                                    <?php endif; ?>


                                    <?php
                                    $file = get_sub_field('competence_file');
                                    if ($file) : ?>
                                        <a class="regional-competence__info-card-link" href="<?php echo $file['url']; ?>"><?php the_sub_field('competence_file_text'); ?></a>
                                    <?php endif; ?>
                                </div>




                            </li>
                        <?php endwhile; ?>

                    </ul>


                </div>
            </div>
        </div>
    </section>
<?php endif; ?>





<!-- <section class="support-measures">
    <div class="container">
        <h2 class="support-measures__heading">
            Меры поддержки
        </h2>
        <ul class="support-measures__list">
            <?php
            $indicators_types = get_terms([
                'taxonomy' => 'support-category',
                'parent' => 0
            ]);


            ?>
            <?php foreach ($indicators_types as $type) : ?>
                <li class="support-measures__list-item">

                    <a href="<?php echo get_term_link($type); ?>" class="support-measures__card">
                        <?php
                        $image = get_field('support-category_icon', $type);
                        if (!empty($image)) : ?>
                            <div class="support-measures__card-icon-container">


                                <img class="support-measures__card-icon" src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />

                            </div>
                        <?php endif; ?>
                        <?php echo $type->name; ?>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>

        <div class="support-measures__bottom-row">
            <?php
            $file = get_field('all_support_measures', 'option');
            if ($file) : ?>

                <a download class="filelink" href="<?php echo $file['url']; ?>">
                    <svg width="20" height="20" aria-hidden="true" class="icon-pdf">
                        <use xlink:href="#pdf"></use>
                    </svg>
                    Скачать буклет

                </a>
            <?php endif; ?>
            <?php
            $file = get_field('all_support_measures_archive', 'option');
            if ($file) : ?>

                <a download class="filelink" href="<?php echo $file['url']; ?>">
                    <svg width="20" height="20" aria-hidden="true" class="icon-pdf">
                        <use xlink:href="#pdf"></use>
                    </svg>
                    Скачать все меры

                </a>
            <?php endif; ?>
        </div>
    </div>
</section> -->

<section class="npa npa--measures js-npa">
    <?php
    $indicators_types = get_terms([
        'taxonomy' => 'support-category',
        'parent' => 0
    ]);


    ?>
    <div class="container">
        <h2 class="npa__heading">
            Виды поддержки
        </h2>
        <div class="npa__content">
            <div class="npa__left-col">
                <ul class="npa__links-list npa__links-list--measures">
                    <?php foreach ($indicators_types as $type) : ?>
                        <?php if ($type->slug === 'dlya-vyvoda-na-kartu') continue; ?>

                        <li class="npa__links-list-item">
                            <a href="#" class="npa__card">
                                <div class="npa__card-icon-container">
                                    <?php
                                    $image = get_field('support-category_icon', $type);
                                    if (!empty($image)) : ?>

                                        <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />


                                    <?php endif; ?>
                                </div>
                                <h5 class="npa__title">
                                    <?php echo $type->name; ?>
                                </h5>
                            </a>
                        </li>


                    <?php endforeach; ?>
                    <li class="npa__links-list-item">
                        <a href="#" class="npa__algorithms-link">
                            Алгоритмы и сроки
                        </a>
                    </li>
                </ul>

            </div>
            <div class="npa__right-col">



                <div class="npa__items npa__items--measures">

                    <?php foreach ($indicators_types as $type) : ?>
                        <?php if ($type->slug === 'dlya-vyvoda-na-kartu') continue; ?>
                        <div class="npa__item">
                            <div class="npa__item-inner npa__item-inner--measures">
                                <?php
                                $received_amount = get_field('support-category_received-amount', $type);
                                $received_unit = get_field('support-category_received-unit', $type);
                                $reveived_text = get_field('support-category_received-text', $type);
                                $available_amount = get_field('support-category_available-amount', $type);
                                $available_unit = get_field('support-category_available-unit', $type);
                                $available_text = get_field('support-category_available-text', $type);
                                $issued_amount = get_field('support-category_issued-amount', $type);
                                $issued_unit = get_field('support-category_issued-unit', $type);
                                $issued_text = get_field('support-category_issued-text', $type);


                                ?>
                                <?php if (!((!$received_amount || !$received_unit) && (!$available_amount || !$available_unit) && (!$issued_amount || !$issued_unit))) : ?>
                                    <div class="npa__top-panel">
                                        <ul class="npa__top-panel-list">
                                            <?php if (!empty($received_amount) && !empty($received_unit)) : ?>
                                                <li class="npa__top-panel-list-item">
                                                    <div class="npa__top-panel-card">
                                                        <div class="npa__top-panel-card-icon-container">
                                                            <svg width="70" height="70" aria-hidden="true" class="icon-issued">
                                                                <use xlink:href="#issued" />
                                                            </svg>

                                                        </div>
                                                        <div class="npa__top-panel-card-amount">
                                                            <?php echo $received_amount; ?>
                                                        </div>
                                                        <div class="npa__top-panel-card-content">
                                                            <h4 class="npa__top-panel-card-heading">
                                                                <?php echo $text = !empty($reveived_text) ? $reveived_text : 'Получили'; ?>

                                                            </h4>
                                                            <p class="npa__top-panel-card-units">
                                                                <?php echo $received_unit; ?>
                                                            </p>
                                                        </div>
                                                    </div>
                                                </li>
                                            <?php endif; ?>
                                            <?php if (!empty($available_amount) && !empty($available_unit)) : ?>
                                                <li class="npa__top-panel-list-item">
                                                    <div class="npa__top-panel-card">
                                                        <div class="npa__top-panel-card-icon-container">
                                                            <svg width="70" height="70" aria-hidden="true" class="icon-available">
                                                                <use xlink:href="#available" />
                                                            </svg>

                                                        </div>
                                                        <div class="npa__top-panel-card-amount">
                                                            <?php echo $available_amount; ?>
                                                        </div>
                                                        <div class="npa__top-panel-card-content">
                                                            <h4 class="npa__top-panel-card-heading">

                                                                <?php echo $text = !empty($available_text) ? $available_text : 'Доступно'; ?>
                                                            </h4>
                                                            <p class="npa__top-panel-card-units">
                                                                <?php echo $available_unit; ?>
                                                            </p>
                                                        </div>
                                                    </div>
                                                </li>
                                            <?php endif; ?>
                                            <?php if (!empty($issued_amount) && !empty($issued_unit)) : ?>
                                                <li class="npa__top-panel-list-item">
                                                    <div class="npa__top-panel-card">
                                                        <div class="npa__top-panel-card-icon-container">
                                                            <svg width="70" height="70" aria-hidden="true" class="icon-received">
                                                                <use xlink:href="#received" />
                                                            </svg>

                                                        </div>
                                                        <div class="npa__top-panel-card-amount">
                                                            <?php echo $issued_amount; ?>
                                                        </div>
                                                        <div class="npa__top-panel-card-content">
                                                            <h4 class="npa__top-panel-card-heading">
                                                                <?php echo $text = !empty($issued_text) ? $issued_text : 'Выдано'; ?>
                                                            </h4>
                                                            <p class="npa__top-panel-card-units">
                                                                <?php echo $issued_unit; ?>
                                                            </p>
                                                        </div>
                                                    </div>
                                                </li>
                                            <?php endif; ?>
                                        </ul>
                                    </div>
                                <?php endif; ?>
                                <?php
                                $slug = $type->slug;
                                $indicators = new WP_Query([
                                    'post_type' => 'govsupport',
                                    'posts_per_page' => '-1',
                                    'tax_query' => [
                                        [
                                            'taxonomy' => 'support-category',
                                            'field' => 'slug',
                                            'terms' => $slug
                                        ]
                                    ]
                                ]);
                                ?>
                                <?php if ($indicators->have_posts()) : ?>

                                    <ul class="npa__measures-list">
                                        <?php while ($indicators->have_posts()) : $indicators->the_post(); ?>
                                            <li class="npa__measures-list-item">
                                                <a href="<?php the_permalink(); ?>" class="npa__measure-card">
                                                    <?php if (!empty($number = get_field('govsupport_number'))) : ?>
                                                        <p class="npa__measure-card-id">
                                                            № <?php echo $number; ?>
                                                        </p>
                                                    <?php endif; ?>
                                                    <h4 class="npa__measure-card-title">
                                                        <?php the_title(); ?>
                                                    </h4>
                                                </a>

                                            </li>
                                        <?php endwhile; ?>
                                    </ul>
                                <?php endif; ?>
                                <?php wp_reset_query(); ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                    <div class="npa__item">
                        <div class="npa__item-inner npa__item-inner--measures">

                            <?php if (have_rows('algo_and_deadlines', 'option')) : ?>
                                <ul class="npa__algo-docs-list">
                                    <?php while (have_rows('algo_and_deadlines', 'option')) : the_row(); ?>

                                        <li class="npa__algo-docs-list-item">
                                            <?php $file = get_sub_field('algo_and_deadlines_file'); ?>
                                            <a download href="<?php echo $file['url']; ?>" class="npa__algo-docs-card">
                                                <svg width="32" height="40" aria-hidden="true" class="icon-pdf">
                                                    <use xlink:href="#pdf" />
                                                </svg>
                                                <?php the_sub_field('algo_and_deadlines_name'); ?>
                                            </a>
                                        </li>

                                    <?php endwhile; ?>
                                </ul>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>


<?php get_footer(); ?>


<?php include get_theme_file_path('/modals.php'); ?>