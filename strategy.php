<?php /* Template Name: Стратегия развития */ ?>


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



<section class="invest-philosophy">
    <div class="container">
        <h2 class="invest-philosophy__heading">
            Инвестиционная философия

        </h2>
        <div class="invest-philosophy__content">
            <ul class="invest-philosophy__list">
                <?php if (have_rows('invest_phil', 'option')) : ?>
                    <?php while (have_rows('invest_phil', 'option')) : the_row(); ?>
                        <?php
                        $large_card = get_sub_field('invest_phil_card_large');
                        $card_with_image = get_sub_field('invest_phil_card_with_image');

                        $icon = get_sub_field('invest_phil_card_icon');


                        ?>
                        <li class="invest-philosophy__list-item <?php echo $large_card ? 'invest-philosophy__list-item--large' : ''; ?> ">
                            <div class="invest-philosophy__standard-card">
                                <?php if ($card_with_image) : ?>
                                    <?php
                                    $image = get_sub_field('invest_phil_card_content_image');
                                    if (!empty($image)) : ?>
                                        <img class="invest-philosophy__standard-card-image" src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
                                    <?php endif; ?>

                                <?php else : ?>
                                    <div class="invest-philosophy__standard-card-top-row">
                                        <div class="invest-philosophy__standard-card-icon-container">


                                            <?php if (!empty($icon)) : ?>
                                                <img src="<?php echo esc_url($icon['url']); ?>" alt="<?php echo esc_attr($icon['alt']); ?>" />
                                            <?php endif; ?>
                                        </div>
                                        <h5 class="invest-philosophy__standard-card-title">
                                            <?php the_sub_field('invest_phil_card_title'); ?>
                                        </h5>
                                    </div>
                                    <div class="invest-philosophy__standard-card-text">
                                        <?php the_sub_field('invest_phil_card_content'); ?>
                                    </div>

                                <?php endif; ?>

                            </div>
                        </li>
                    <?php endwhile; ?>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</section>

<section class="invest-strategy">
    <div class="container">
        <h2 class="invest-strategy__heading">
            Инвестиционная стратегия
            <?php
            $file = get_field('invest_download');
            if ($file) : ?>
                <a download href="<?php echo $file['url']; ?>" class="invest-strategy__download"> Скачать стратегию развития</a>
            <?php endif; ?>
        </h2>
        <div class="invest-strategy__text-content">
            <?php the_field('invest_strat_content', 'option'); ?>

           

        </div>
        <?php $image = get_field('invest_strat_image', 'option'); ?>



        <?php
        if (!empty($image)) : ?>
            <div class="invest-strategy__image-container">
                <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
            </div>
        <?php endif; ?>

    </div>
</section>

<section class="invest-institutes" id="institutes">
    <div class="container">
        <div class="inner-container">
            <div class="invest-institutes__content">
                <h2 class="invest-institutes__heading">
                    Институты развития
                </h2>
                <?php if (have_rows('invest_institutes')) : ?>
                    <ul class="invest-institutes__list">
                        <?php while (have_rows('invest_institutes')) : the_row();
                            $image = get_sub_field('invest_institutes_image');
                        ?>
                            <li class="invest-institutes__list-item">
                                <div class="invest-institutes__card">
                                    <div class="invest-institutes__card-image-container">
                                        <?php if (!empty($image)) : ?>
                                            <img src="<?php echo esc_url($image['url']); ?>" class="invest-institutes__card-image" alt="<?php echo esc_attr($image['alt']); ?>" />
                                        <?php endif; ?>
                                    </div>
                                    <div class="invest-institutes__card-content">
                                        <h5 class="invest-institutes__card-title">
                                            <?php the_sub_field('invest_institutes_name'); ?>
                                        </h5>
                                        <div class="invest-institutes__category">
                                            Категория помощи: <?php the_sub_field('invest_institutes_category'); ?>
                                        </div>
                                        <div class="invest-institutes__card-text">
                                            <?php the_sub_field('invest_institutes_description'); ?>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        <?php endwhile; ?>
                    </ul>
                <?php else : ?>
                    Нет институтов
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>




<section class="plans">

    <div class="container">
        <div class="inner-container">
            <div class="plans__row">
                <?php if (have_rows('invest_reglament')) : ?>
                    <div class="plans__column">
                        <h3 class="plans__heading">
                            Планы инфраструктурных объектов
                        </h3>
                        <ul class="plans__list">
                            <?php while (have_rows('invest_reglament')) : the_row();
                            ?>
                                <li class="plans__list-item plans__list-item--small">
                                    <div class="plans__card">
                                        <div class="plans__title">
                                            <?php the_sub_field('invest_reglament_title'); ?>
                                        </div>
                                        <?php
                                        $file = get_sub_field('invest_reglament_file');
                                        if ($file) : ?>
                                            <a download class="filelink" href="<?php echo $file['url']; ?>">
                                                <svg width="20" height="20" aria-hidden="true" class="icon-pdf">
                                                    <use xlink:href="#pdf" />
                                                </svg>
                                                Скачать
                                            </a>
                                        <?php endif; ?>
                                    </div>
                                </li>

                            <?php endwhile; ?>

                        </ul>
                    </div>
                <?php endif; ?>



            </div>

        </div>
    </div>
</section>

<section class="invest-council">
    <div class="container">
        <h2 class="invest-council__heading">
            Инвестиционный совет при Губернаторе
        </h2>
        <div class="invest-council__row">
            <div class="invest-council__left-col">
                <div class="invest-council__content">
                    <!-- <h3>
                        Общественный совет по улучшению<br> инвестиционного климата при Губернаторе<br> Оренбургской области
                    </h3>
                    <p>
                        Цель деятельности Совета состоит в повышении<br> эффективности работы:
                    </p>
                    <ul>
                        <li>
                            по привлечению инвестиционных ресурсов;
                        </li>
                        <li>
                            по созданию благоприятного инвестиционного климата;
                        </li>
                        <li>
                            по созданию индустриальных, технологических и туристско- рекреационных парков;
                        </li>
                        <li>
                            по развитию инвестиционной и инновационной деятельности на территории области.
                        </li>
                    </ul>
                    <p>
                        Задачи Общественного совета:
                    </p>
                    <ul>
                        <li>
                            развитие приоритетных направлений инвестиционной деятельности на территории Оренбургской области;
                        </li>
                        <li>
                            устранение административных, экономических и организационных препятствий в развитии инвестиционной и инновационной деятельности;
                        </li>
                        <li>
                            формирование целостной системы инфраструктуры поддержки и развития инвестиционной и инновационной деятельности.
                        </li>
                    </ul> -->
                    <?php the_field('invest-council_content', 'option'); ?>
                </div>



                <?php
                $file = get_field('invest-council_file', 'option');
                if ($file) : ?>

                    <a href="<?php echo $file['url']; ?>" class="invest-council__file">
                        <svg width="20" height="20" aria-hidden="true" class="icon-pdf">
                            <use xlink:href="#pdf" />
                        </svg>
                        <?php the_field('invest-council_filename', 'option'); ?>
                    </a>
                <?php endif; ?>
            </div>
            <div class="invest-council__right-col">
                <div class="invest-council__guber">


                    <?php
                    $image = get_field('invest-council_guber-photo', 'option');
                    if (!empty($image)) : ?>
                        <div class="invest-council__guber-photo-container">
                            <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
                        </div>
                    <?php endif; ?>
                    <div class="invest-council__guber-content">
                        <div class="invest-council__guber-description">
                            <?php the_field('invest-council_guber-description', 'option'); ?>

                        </div>
                        <div class="invest-council__guber-name">
                            <?php the_field('invest-council_guber-name', 'option'); ?>
                        </div>
                        <div class="invest-council__role">
                            <?php the_field('invest-council_guber-role', 'option'); ?>
                        </div>
                    </div>
                </div>
                <?php if (have_rows('invest-council_persons', 'option')) : ?>

                    <div class="invest-council__persons">
                        <ul class="invest-council__persons-list">

                            <?php while (have_rows('invest-council_persons', 'option')) : the_row();


                            ?>
                                <li class="invest-council__persons-list-item">
                                    <div class="invest-council__persons-card">

                                        <?php
                                        $image = get_sub_field('invest-council_persons-photo');
                                        if (!empty($image)) : ?>
                                            <div class="invest-council__persons-card-photo-container">
                                                <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
                                            </div>
                                        <?php endif; ?>
                                        <div class="invest-council__persons-card-content">
                                            <div class="invest-council__persons-card-name">
                                                <?php the_sub_field('invest-council_persons-name'); ?>
                                            </div>
                                            <div class="invest-council__persons-card-text">
                                                <?php the_sub_field('invest-council_persons-role'); ?>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            <?php endwhile; ?>
                        </ul>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<section class="npa js-npa">
    <?php
    $indicators_types = get_terms([
        'taxonomy' => 'thematics',
        'hide_empty' => true,
        'parent' => 0,
        'orderby' => 'name',
        'order' => 'ASC'
    ]);
    ?>
    <div class="container">
        <h2 class="npa__heading">
            Нормативно-правовые акты
        </h2>
        <div class="npa__content">
            <div class="npa__left-col">
                <ul class="npa__links-list">


                    <?php foreach ($indicators_types as $type) : ?>
                        <?php if ($type->slug === 'dlya-vyvoda-na-kartu') continue; ?>

                        <li class="npa__links-list-item">
                            <a href="#" class="npa__card">
                                <div class="npa__card-icon-container">
                                    <?php
                                    $image = get_field('icon', $type);
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
                </ul>
            </div>
            <div class="npa__right-col">

                <div class="npa__items">


                    <?php foreach ($indicators_types as $type) : ?>
                        <?php if ($type->slug === 'dlya-vyvoda-na-kartu') continue; ?>
                        <div class="npa__item">
                            <div class="npa__item-inner">
                                <div class="npa__item-backplate">


                                    <?php
                                    $slug = $type->slug;
                                    $indicators = new WP_Query([
                                        'post_type' => 'laws',
                                        'posts_per_page' => '-1',
                                        'tax_query' => [
                                            [
                                                'taxonomy' => 'thematics',
                                                'field' => 'slug',
                                                'terms' => $slug
                                            ]
                                        ]
                                    ]);
                                    ?>
                                    <?php if ($indicators->have_posts()) : ?>
                                        <ul class="npa__list">
                                            <?php while ($indicators->have_posts()) : $indicators->the_post(); ?>
                                                <li class="npa__list-item">


                                                    <?php
                                                    $file = get_field('law_file');
                                                    if ($file) : ?>
                                                        <a href="<?php echo $file['url']; ?>" download class="npa__item-card">
                                                            <svg width="32" height="39" aria-hidden="true" class="icon-pdf">
                                                                <use xlink:href="#pdf" />
                                                            </svg>
                                                            <div class="npa__item-card-content">
                                                                <h5 class="npa__item-card-title">
                                                                    <?php the_title(); ?>
                                                                </h5>
                                                                <?php if (!empty($description = get_field('law_description'))) : ?>
                                                                    <div class="npa__item-card-description">
                                                                        <?php echo $description; ?>
                                                                    </div>
                                                                <?php endif; ?>
                                                            </div>
                                                        </a>
                                                    <?php endif; ?>
                                                </li>
                                            <?php endwhile; ?>
                                        </ul>
                                    <?php endif; ?>
                                    <?php wp_reset_query(); ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>

                </div>



            </div>
        </div>
    </div>
</section>



<?php get_footer(); ?>



<?php include get_theme_file_path('/modals.php'); ?>