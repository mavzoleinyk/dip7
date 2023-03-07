<?php
/*
 * This is the child theme for Total theme, generated with Generate Child Theme plugin by catchthemes.
 *
 * (Please see https://developer.wordpress.org/themes/advanced-topics/child-themes/#how-to-create-a-child-theme)
 */
add_action( 'wp_enqueue_scripts', 'totalchild_enqueue_styles' );
function totalchild_enqueue_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'bootstrap-theme', get_stylesheet_directory_uri() . '/assets/css/bootstrap.min.css', array('parent-style'));
    wp_enqueue_style( 'font-icons', get_stylesheet_directory_uri() . '/assets/css/font-icons.css', array('parent-style'));
    wp_enqueue_style( 'theme-style', get_stylesheet_directory_uri() . '/assets/css/theme-style.css', array('parent-style'));

    wp_enqueue_style( 'child-style', get_stylesheet_directory_uri() . '/style.css', array('parent-style'));

    wp_enqueue_script('modernizr-js', get_stylesheet_directory_uri() . '/assets/js/modernizr.min.js', array('jquery'), false, true);
    wp_enqueue_script('calc_script-js', get_stylesheet_directory_uri() . '/assets/js/calc_script.js', array('jquery'), false, true);
    wp_enqueue_script('scripts-js', get_stylesheet_directory_uri() . '/assets/js/scripts.js', array('jquery'), false, true);
}
/*
 * Your code goes below
 */
//  Actions
add_action( 'widgets_init', 'cust_widgets' );


// Some weare
function cust_widgets(){
    register_sidebar([
        'name' => 'Виджет для размещения копирайта',
        'id' => 'cust_footer_1',
        'before_widget' => null,
        'after_widget' => null,
    ]);
    register_sidebar([
        'name' => 'Сайдбар блок 1',
        'id' => 'cust_sidebar_1',
        'before_widget' => null,
        'after_widget' => null,
    ]);
    register_sidebar([
        'name' => 'Сайдбар блок 2',
        'id' => 'cust_sidebar_2',
		'before_widget' => '<aside id="%1$s" class="footer-widget widget widget__custom-block %2$s clr">',
		'after_widget'  => '</aside>',
		'before_title'  => '<p class="widget-title">',
		'after_title'   => '</p>',
    ]);
}


/**
 * Изменяет хлебные крошки Yoast.
 *
 * Вывести в шаблоне: do_action('pretty_breadcrumb');
 * https://wp-kama.ru/plugin/yoast/kak-izmenit-vyorstku-hlebnyh-kroshek-yoast-na-svoyu
 */
class Pretty_Breadcrumb
{

    /**
     * Какую позицию занимает элемент в цепочке хлебных крошек.
     *
     * @var int
     */
    private $el_position = 0;

    public function __construct()
    {
        add_action('pretty_breadcrumb', [$this, 'render']);
    }

    /**
     * Выводит на экран сгенерированные крошки.
     *
     * @return void
     */
    public function render()
    {
        if (!function_exists('yoast_breadcrumb')) {
            return;
        }

        // Регистрируем фильтры для изменения дефолтной вёрстки крошек
        add_filter('wpseo_breadcrumb_single_link', [$this, 'modify_yoast_items'], 10, 2);
        add_filter('wpseo_breadcrumb_output', [$this, 'modify_yoast_output']);
        add_filter('wpseo_breadcrumb_output_wrapper', [$this, 'modify_yoast_wrapper']);
        add_filter('wpseo_breadcrumb_separator', '__return_empty_string');

        // Выводим крошки на экран
        yoast_breadcrumb();

        // Отключаем фильтры
        remove_filter('wpseo_breadcrumb_single_link', [$this, 'modify_yoast_items']);
        remove_filter('wpseo_breadcrumb_output', [$this, 'modify_yoast_output']);
        remove_filter('wpseo_breadcrumb_output_wrapper', [$this, 'modify_yoast_wrapper']);
        remove_filter('wpseo_breadcrumb_separator', '__return_empty_string');

        // Обнуляем счётчик
        $this->el_position = 0;
    }

    /**
     * Изменяет html код li элементов.
     *
     * @param string $link_html Дефолтная вёрстка элемента хлебных крошек.
     * @param array $link_data Массив данных об элементе хлебных крошек.
     *
     * @return string
     */
    function modify_yoast_items($link_html, $link_data)
    {
        // Шаблон контейнера li
        $li = '<span itemprop="itemListElement" itemscope="itemscope" itemtype="https://schema.org/ListItem" %s>%s</span>';

        // Содержимое li в зависимости от позиции элемента
        if (strpos($link_html, 'breadcrumb_last') === false) {
            $li_inner = sprintf('
                <a itemprop="item" href="%s" class="pathway">
                    <span itemprop="name">%s</span>
                </a>
            ', $link_data['url'], $link_data['text']);
            $li_inner .= '<span class="divider"> / </span>';
            $li_class = '';
        } else {
            $li_inner = sprintf('<span itemprop="name">%s</span>', $link_data['text']);
            $li_class = 'class="active"';
        }

        $li_inner .= sprintf('<meta itemprop="position" content="%d"/>', ++$this->el_position);

        // Вкладываем сформированное содержание в li и возвращаем полученный элемент хлебных крошек.
        return sprintf($li, $li_class, $li_inner);
    }

    /**
     * Возвращает псевдо wrapper, который в будущем будет вырезан из вёрстки.
     * Если этого не сделать, то будущие li будут обёртнуты в единый span Yoast'ом.
     *
     * @return string
     */
    function modify_yoast_wrapper()
    {
        return 'wrapper'; // Будущий "уникальный" тег для вырезки из html
    }

    /**
     * Изменяет дефолтный html код крошек Yoast.
     *
     * @param string $html
     *
     * @return string
     */
    function modify_yoast_output($html)
    {
        // Убираем псевдо wrapper
        $html = str_replace(['<wrapper>', '</wrapper>'], '', $html);

        // Формируем контейнер для li элементов
        $ul = '<nav itemscope="itemscope" itemtype="https://schema.org/BreadcrumbList" class="breadcrumb site-breadcrumbs wpex-clr hidden-phone position-absolute has-js-fix">%s</nav>';

        // Вставляем в контейнер li элменты
        $html = sprintf($ul, $html);

        return $html;
    }
}

new Pretty_Breadcrumb();