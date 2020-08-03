    </main>
    <footer class="page-footer">
        <div class="container">
            <div class="page-footer__row">

                <a href="/contacts/#maincontacts" class="page-footer__logo-block">
                    <img src="<?php echo get_template_directory_uri(); ?>/img/logo.png" alt="" class="page-footer__logo-image">
                    <div class="page-footer__logo-text">
                        Корпорация развития<br>
                        Оренбургской области
                        <span class="copyright">
                            <?php echo date("Y"); ?> ©
                        </span>

                    </div>
                </a>


                <a href="tel:+73532442455" class="page-footer__phone-link">8 (3532) 44-24-55</a>


                <nav class="page-footer__nav">
                    <div class="page-footer__nav-items">
                        <div class="page-footer__nav-item">
                            <a href="/about-region" class="page-footer__nav-link">О регионе</a>
                        </div>
                        <div class="page-footer__nav-item">
                            <a href="/strategy" class="page-footer__nav-link">Стратегия развития</a>
                        </div>
                        <div class="page-footer__nav-item">
                            <a href="/support" class="page-footer__nav-link">Поддержка</a>
                        </div>
                        <div class="page-footer__nav-item">
                            <a href="/invest/" class="page-footer__nav-link">Площадки</a>
                        </div>
                        <div class="page-footer__nav-item">
                            <a href="/media" class="page-footer__nav-link">Медиа</a>
                        </div>
                        <div class="page-footer__nav-item">
                            <a href="/contacts" class="page-footer__nav-link">Контакты</a>
                        </div>
                    </div>
                </nav>

                <div class="page-footer__address-block">
                    <div class="page-footer__address">
                        460006, Оренбургская область <br>
                        г. Оренбург, ул. Цвиллинга, д. 14/1
                    </div>
                    <div class="page-footer__social">
                        <h4 class="page-footer__social-heading">
                            Присоединяйтесь к нам
                        </h4>
                        <div class="page-footer__social-links">

                            <a href="#" class="page-footer__social-link" target="_blank">
                                <svg width="20" height="20" aria-hidden="true" class="icon-facebook">
                                    <use xlink:href="#facebook" />
                                </svg>
                            </a>
                            <a href="https://www.instagram.com/investinorenburg/" class="page-footer__social-link" target="_blank">
                                <svg width="20" height="20" aria-hidden="true" class="icon-instagram">
                                    <use xlink:href="#instagram" />
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>






            </div>


            <?php
            $file = get_field('user_policy', 'option');
            if ($file) : ?>
                <div class="page-footer__bottom-row">
                    <a class="page-footer__user-policy" href="<?php echo $file['url']; ?>">Политика конфиденциальности</a>
                </div>
            <?php endif; ?>

        </div>
    </footer>
    </div>
    <?php wp_footer(); ?>
    </body>

    </html>