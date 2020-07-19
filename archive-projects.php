<?php /* Template Name: Истории успеха */ ?>


<?php get_header(); ?>

<section class="page-title">
    <div class="page-title__bg-image-container">


        <img class="page-title__bg-image" src="<?php echo get_template_directory_uri(); ?>/img/projects.jpg" />

    </div>
    <div class="container">
        <div class="inner-container">
            <div class="page-title__content">
                <h1 class="page-title__heading">
                    Все истории успеха
                </h1>
                <div class="breadcrumbs">
                    <?php require_once get_theme_file_path('/breadcrumbs.php'); ?>
                    <?php if (function_exists('dimox_breadcrumbs')) dimox_breadcrumbs(); ?>
                </div>
            </div>
        </div>
    </div>
</section>




<?php if (have_posts()) : ?>
    <section class="projects-archive">
        <div class="container">
            <ul class="projects-archive__list">
                <?php while (have_posts()) : the_post(); ?>
                    <?php $has_story = get_field('project_has_success_story');

                    if (!$has_story) {
                        continue;
                    } ?>
                    <li class="projects-archive__list-item">
                        <div class="projects-archive__card">
                            <?php if ($image = get_field('project_success_story_slider_photo')) : ?>
                                <div class="projects-archive__card-image-container">
                                    <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>">
                                    <h3 class="projects-archive__card-company-name">
                                        <?php the_field('project_company_name'); ?>
                                    </h3>
                                </div>
                                <div class="projects-archive__card-content">
                                    <div class="projects-archive__card-representative">
                                        <div class="projects-archive__card-representative-name">
                                            <?php the_field('project_success_story_representative_name'); ?>
                                        </div>
                                        <div class="projects-archive__card-representative-role">
                                            <?php the_field('project_success_story_representative_role'); ?>
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
                    </li>
                <?php endwhile; ?>
            </ul>
            <?php the_posts_pagination(); ?>
        </div>
    </section>
<?php endif; ?>


<?php get_footer(); ?>


<?php include get_theme_file_path('/modals.php'); ?>