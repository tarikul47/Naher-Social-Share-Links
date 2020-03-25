<?php
/**
 * @package WordPress
 * @subpackage Naher Social Widgets
 * @extends Wp_Widget
 */
class Naher_Social_Widget extends WP_Widget {
    /**
     * WP_Widgets::__construct()
     * @param Id
     * @param Widget_Name
     * @param Widget_Description
     */
    public function __construct() {
        parent::__construct(
            'naher_social',
            __('Naher Social Widget','verum'),
            array('description'=> __('It\'s a social Share Widget','verum'))
        );
    }
 
    public function widget( $args, $instance ) {
        /**
         * outputs the content of the widget
         */
    extract($args);

    $social_fields = array(
        "facebook","twitter","github","pinterest","instagram","google-plus","youtube","vimeo","tumblr","dribbble","flickr",
        "behance"
    );
    echo wp_kses_post($before_widget);
    /**
     * Widget Title Here
     */
    if(!empty($instance['title'])){
        echo $before_title.apply_filters('widget_title',$instance['title']).$after_title;
    }
    /**
     * Widget Body Here
     */
    echo '<div class="social-links ">';
    foreach($social_fields as $social_field){
        if(!empty($instance[$social_field])){
            $instance[$social_field] = trim($instance[$social_field]);
           // print_r($social_field);
           if('vimeo' == $social_field){
            $social_field = "vimeo-square";
           }
        ?>
        <a target="_blank" href="<?php echo esc_url($instance[$social_field])?>"><i class="fa fa-<?php echo esc_attr($social_field);?>"></i></a>
        <?php
        }
    }
    echo '</div>';

    echo wp_kses_post($after_widget);
    } //widget Function End Here 
 
    public function form( $instance ) {
        /**
         * outputs the options form in the admin
         * Take Social field in Array
         * Data Retrive 
         */
        $social_fields = array(
            "facebook","twitter","github","pinterest","instagram","google-plus","youtube","vimeo","tumblr","dribbble","flickr",
			"behance"
        );
        /**
         * Social Field value Set Here
         */
        foreach($social_fields as $social_field){
            if(!isset($instance[$social_field])){
                $instance[$social_field] = ''; 
            }
        }
        /**
         * Title Field Value Find Out Here
         */
        $title = !empty($instance['title'])?$instance['title']:__('Enter Your Title','verum');
        ?>
<p>
    <label for="<?php echo esc_attr($this->get_field_id('title'));?>"><?php _e('Title','verum');?></label>
    <input class="widefat" type="text" name="<?php echo esc_attr($this->get_field_name('title'));?>"
        id="<?php echo esc_attr($this->get_field_id('title'));?>" value="<?php echo esc_attr($title);?>">
</p>
 
<?php 
/**
 * Fields Array Etract Here
 * Fields Value = $instance[$social_field]
 */
foreach($social_fields as $social_field){ 
?>
<p>
    <label for="<?php echo esc_attr($this->get_field_id($social_field));?>"><?php _e( ucfirst($social_field));?></label>
    <input class="widefat" type="url" name="<?php echo esc_attr($this->get_field_name($social_field));?>"
        id="<?php echo esc_attr($this->get_field_id($social_field));?>" value="<?php echo esc_attr($instance[$social_field]);?>">
</p>
<?php }

    } // form Function End 
 
    public function update( $new_instance, $old_instance ) {
        $instance = array();
        if(!empty($new_instance['title'])){
        $instance['title'] = strip_tags($new_instance['title']); 
        }
        $social_fields = array(
            "facebook","twitter","github","pinterest","instagram","google-plus","youtube","vimeo","tumblr","dribbble","flickr",
            "behance"
        );
        foreach($social_fields as $social_field){
            if(!empty($new_instance[$social_field])){
                $instance[$social_field] = strip_tags($new_instance[$social_field]); 
            }            
        }
        return $instance;

    }
}

/**
 * Instance Make Here 
 * widgets_init action Hook run
 */
function verum_naher_widgets_init(){
    register_widget('Naher_Social_Widget');
}
 add_action('widgets_init','verum_naher_widgets_init');
 
?>