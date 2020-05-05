<?php


class PostWidget extends WP_Widget
{
    function __construct()
    {
        // Запускаем родительский класс
        parent::__construct(
            '',
            __('Posts', 'lustshop'),
            array('description' => 'Widget render posts.')
        );
    }

    /**
     * Вывод виджета во Фронт-энде
     *
     * @param array $args аргументы виджета.
     * @param array $instance сохраненные данные из настроек
     */
    function widget($args, $instance)
    {
        $title = apply_filters('widget_title', $instance['title']);
        $showButton = $instance['showButton'] ? true : false;
        $category_id = $instance['archive'];

        echo $args['before_widget'];
        if (!empty($title)) {
            echo $args['before_title'] . $title . $args['after_title'];
        }
        $params = array(
            'showposts' => $instance['count'],
            'cat' => $instance['archive'],
        );
        $popular = new WP_Query($params);
        if (have_posts()) {
            while ($popular->have_posts()) {
                $popular->the_post();
                $id = $popular->post->ID;

                LustShop::get_template_part('template-parts/components/widgets/post-widget', '', array(
                    $id => $id
                ));
            }

            if ($showButton) {
                echo "<a class='wp-block-lustshop-button post-widget__button-more' href='". get_category_link($category_id) ."'>" . __('Open blog', 'lustshop') . "</a>";
            }
        }

        echo $args['after_widget'];
    }

    /**
     * Админ-часть виджета
     *
     * @param array $instance сохраненные данные из настроек
     */
    function form($instance)
    {
        $title = @ $instance['title'] ?: __('Default title', 'sage');
        $count = @ $instance['count'] ?: 2;
        $category = get_categories();
        $showButton = @ $instance['showButton'];
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>"
                   name="<?php echo $this->get_field_name('title'); ?>" type="text"
                   value="<?php esc_attr_e($title); ?>">
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('archive'); ?>"><?php _e('Category'); ?>:</label>
            <select name="<?php echo $this->get_field_name('archive'); ?>"
                    id="<?php echo $this->get_field_id('archive'); ?>">
                <?php foreach ($category as $key => $value): ?>
                    <option value="<?php esc_attr_e($value->term_id); ?>" <?php if ($value->term_id == $instance['archive']) {
                        echo 'selected';
                    } ?> ><?php esc_attr_e($value->name); ?></option>
                <?php endforeach; ?>
            </select>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('count'); ?>"><?php _e('Count'); ?>:</label>
            <input class="widefat" id="<?php echo $this->get_field_id('count'); ?>"
                   name="<?php echo $this->get_field_name('count'); ?>" type="number"
                   value="<?php esc_attr_e($count); ?>">
        </p>
        <p>
            <input class="checkbox" type="checkbox" <?php checked($instance['showButton'], 'on'); ?>
                   id="<?php echo $this->get_field_id('showButton'); ?>"
                   name="<?php echo $this->get_field_name('showButton'); ?>"/>
            <label for="<?php echo $this->get_field_id('showButton'); ?>"><?php _e('Show button more', 'lustshop') ?></label>
        </p>
        <?php
    }

    /**
     * Сохранение настроек виджета. Здесь данные должны быть очищены и возвращены для сохранения их в базу данных.
     *
     * @param array $new_instance новые настройки
     * @param array $old_instance предыдущие настройки
     *
     * @return array данные которые будут сохранены
     * @see WP_Widget::update()
     *
     */
    function update($new_instance, $old_instance)
    {
        $instance = array();
        $instance['title'] = (!empty($new_instance['title'])) ? strip_tags($new_instance['title']) : '';
        $instance['archive'] = (!empty($new_instance['archive'])) ? strip_tags($new_instance['archive']) : '';
        $instance['count'] = (!empty($new_instance['count'])) ? strip_tags($new_instance['count']) : '';
        $instance['showButton'] = $new_instance['showButton'];

        return $instance;
    }

}

// регистрация Foo_Widget в WordPress
function register_post_widget()
{
    register_widget('PostWidget');
}

add_action('widgets_init', 'register_post_widget');