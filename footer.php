<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
} ?>
    <!-- Footer -->
    <div class="bottom__page">
      <div class="container">
        <div class="row">
          <div class="col-md-8">
            <div class="bottom__page-text">
              Работаем практически во всех регионах РФ.<br>Полная оплата только при получении документа.<br>Гарантия 100%. Любые проверки. Скидки при заказе комплектов
            </div>
          </div>
          <div class="col-md-4">
            <div class="bottom__page-text">
              <a href="/zakazat/" class="btn-solid">Получить аттестат</a>
            </div>
          </div>
        </div>
      </div>
    </div>
    <footer class="footer footer--dark">
      <div class="container">
        <div class="footer__widgets">
          <div class="row">
            <div class="col-lg-4 col-md-4 col-12">
              <aside class="widget widget_custom footer__widget-cust">
                <?php
                  if ( is_active_sidebar('footer_one') ){
                    dynamic_sidebar('footer_one');
                  }
                ?>
              </aside>
              <aside class="widget widget_social footer__social">
                <div class="socials socials--large socials--rounded mb-24">
                  <a href="#" class="social social-facebook" aria-label="facebook"><i class="ui-facebook"></i></a>
                  <a href="#" class="social social-twitter" aria-label="twitter"><i class="ui-twitter"></i></a>
                  <a href="#" class="social social-google-plus" aria-label="google+"><i class="ui-google"></i></a>
                  <a href="#" class="social social-youtube" aria-label="youtube"><i class="ui-youtube"></i></a>
                  <a href="#" class="social social-instagram" aria-label="instagram"><i class="ui-instagram"></i></a>
                </div>
              </aside> 
            </div>

            <div class="col-lg-4 col-md-4 col-12">
              <aside class="widget widget_map footer__map">
                <?php
                  if( is_active_sidebar('footer_two')){
                    dynamic_sidebar('footer_two');
                  }
                ?>
                <div class="footer-delivery">
                  <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/oplata-sposob.png" alt="Способы оплаты заказа оригинального диплома Гознак">
                </div>                
              </aside>
            </div>
            <div class="col-lg-4 col-md-4 col-12">
              <aside class="widget widget_map footer__map">
                <?php
                  if( is_active_sidebar('footer_three')){
                    dynamic_sidebar('footer_three');
                  }
                ?> 
                <div class="footer-delivery">
                  <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/dostavka-rossiya.jpg" alt="Способы доставки диплома на заказ с гарантией">
                </div>                  
              </aside>
            </div>
          </div>
        </div>    
      </div> <!-- end container -->
      <div class="footer__bottom">
        <div class="container">
          <div class="row">
            <div class="col-12">
              <div class="footer__copyright">
                <?php
                  if( is_active_sidebar('cust_footer_1') ){
                    dynamic_sidebar('cust_footer_1');
                  }
                ?>
              </div>
              <aside class="widget widget_nav_menu footer__nav_menu">
                <?php
                    wp_nav_menu(
                        array(
                            'menu'  => '3',
                            'menu_class'=> 'nav__menu',
                        )
                    );
                ?>
              </aside>
            </div>
          </div>
        </div>
      </div>
    </footer> <!-- end footer -->

    <div id="back-to-top">
      <a href="#top" aria-label="Go to top"><i class="ui-arrow-up"></i></a>
    </div>
</main> <!-- end main-wrapper -->

<!-- jQuery Scripts -->

<?php wp_footer();?>
<script src="https://use.fontawesome.com/72aa657e98.js"></script>
</body>
</html>