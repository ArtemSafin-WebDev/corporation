<?php /* Template Name: Контакты */ ?>


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


<section class="corporation-map" id="maincontacts">
    <div class="container">
        <div class="inner-container">
            <div class="corporation-map__row">
                <div class="corporation-map__col">
                    <div class="corporation-map__text-content default-content">
                        <?php the_field('corporation_map_content', 'option'); ?>
                    </div>
                </div>
                <div class="corporation-map__col">
                    <div class="corporation-map__wrapper">
                        <div class="corporation-map__map js-corporation-map">

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>


<?php if (have_rows('contacts_content_blocks')) : ?>
    <section class="contacts" id="corporation">
        <div class="container">
            <div class="inner-container">
                <h2 class="contacts__heading">
                    Корпорация развития Оренбургской области
                </h2>
                <div class="contacts__blocks">
                    <?php while (have_rows('contacts_content_blocks')) : the_row();

                        $image = get_sub_field('contacts_content_blocks_image');
                        $content = get_sub_field('contacts_content_blocks_content');

                    ?>
                        <div class="contacts__block">
                            <div class="contacts__block-left-col">
                                <?php
                                if (!empty($image)) : ?>
                                    <div class="contacts__block-image-container">
                                        <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class="contacts__block-right-col">
                                <div class="contacts__block-content default-content">
                                    <?php echo $content; ?>
                                </div>
                            </div>
                        </div>
                    <?php endwhile; ?>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>


<section class="block gubernator gubernator--ignat">
    <img src="<?php echo get_template_directory_uri(); ?>/img/petuchov-bg.jpg" alt="" class="gubernator__bg">
    <div class="container">
        <div class="inner-container">
            <div class="gubernator__row">
                <div class="gubernator__left-column">
                    <div class="gubernator__photo-wrapper">
                        <?php
                        $image = get_field('contact_ceo_photo');
                        if (!empty($image)) : ?>
                            <img src="<?php echo esc_url($image['url']); ?>" class="gubernator__photo" alt="<?php echo esc_attr($image['alt']); ?>" />
                        <?php endif; ?>
                    </div>
                </div>
                <div class="gubernator__right-column">
                    <div class="gubernator__quote">
                        <div class="gubernator__quote-text">
                            <?php $field = get_field('contact_ceo_quote_text');
                            echo !empty($field) ? $field : 'Цитата'; ?>
                        </div>
                        <div class="gubernator__quote-name">

                            <?php $field = get_field('contact_ceo_name');
                            echo !empty($field) ? $field : 'Имя'; ?>
                        </div>
                        <div class="gubernator__quote-role">

                            <?php $field = get_field('contact_ceo_role');
                            echo !empty($field) ? $field : 'Должность'; ?>
                        </div>
                        <a href="#feedback" class="gubernator__contact-link js-modal-open">
                            Обратная связь
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>






<?php if (have_rows('partner_network', 'option')) : ?>
    <section class="news-slider js-news-slider partner-network" id="partners">
        <div class="container">
            <div class="inner-container">
                <div class="news-slider__top-row">
                    <h2 class="news-slider__heading">
                        Партнерская сеть
                    </h2>
                    <div class="news-slider__btns">
                        <button class="news-slider__arrow-btn news-slider__arrow-btn--prev">
                            <svg width="20" height="20" aria-hidden="true" class="icon-slider-arrow-left">
                                <use xlink:href="#slider-arrow-left" />
                            </svg>
                        </button>
                        <button class="news-slider__arrow-btn news-slider__arrow-btn--next">
                            <svg width="20" height="20" aria-hidden="true" class="icon-slider-arrow-right">
                                <use xlink:href="#slider-arrow-right" />
                            </svg>
                        </button>
                    </div>
                </div>

                <div class="news-slider__slider-wrapper">

                    <div class="swiper-container">
                        <div class="swiper-wrapper">
                            <?php while (have_rows('partner_network', 'option')) : the_row(); ?>
                                <div class="swiper-slide">
                                    <a href="<?php the_sub_field('partner_network_company_link'); ?>" class="news-slider__card">
                                        <div class="news-slider__card-image-container">
                                            <?php
                                            $image = get_sub_field('partner_network_company_image');
                                            ?>
                                            <img src="<?php echo esc_url($image['url']); ?>" alt="">
                                        </div>
                                        <div class="news-slider__card-content">
                                            <h5 class="news-slider__card-title">
                                                <?php echo mb_strimwidth(get_sub_field('partner_network_company_name'), 0, 120, "..."); ?>
                                            </h5>
                                        </div>
                                    </a>
                                </div>
                            <?php endwhile; ?>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>

<?php endif; ?>

<?php get_footer(); ?>


<?php include get_theme_file_path('/modals.php'); ?>