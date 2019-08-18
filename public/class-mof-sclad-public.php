<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://webbooks.com.ua/portfolio
 * @since      1.0.0
 *
 * @package    Mof_Sclad
 * @subpackage Mof_Sclad/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Mof_Sclad
 * @subpackage Mof_Sclad/public
 * @author     Andrii Beznosko <homeandriy@gmail.com>
 */
class Mof_Sclad_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;
		$this->register_shortcode();
		$this->register_ajax_hooks();

	}
	public function register_ajax_hooks (){
		add_action('wp_ajax_insert_order', [$this, 'insert_order']);
    }

	public function register_shortcode ()
    {
        add_action('wp_footer', [$this, 'register_ajax_uri']);
        add_shortcode('create_order', [$this, 'display_order']);
        add_shortcode('add_nomenclature', [$this, 'add_nomenclature']);
        add_shortcode('main_orders', [$this, 'render_orders']);
        add_shortcode('my_orders', [$this, 'get_my_orders']);
        add_shortcode('delete_materials', [$this, 'delete_materials']);
    }
    public function insert_order() {
	    if( wp_doing_ajax() ){
//	    	print_r($_REQUEST);
	    	$nomenclatures = [];
		    foreach ( $_REQUEST['nomenclature'] as $_item ) {
			    if(!empty($_item)) {
				    $nomenclatures[] = $_item;
			    }
	    	}
	        $order = new MOF_Order();
		    $order->create($nomenclatures, $_REQUEST['comment']);
        }
	    wp_die();
    }
    public function register_ajax_uri() {
	    echo '<script type="text/javascript"> var mof_ajaxurl = "'.admin_url('admin-ajax.php').'"</script>';
    }

    public function display_order()
    {
        require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/partials/shorcode_parts/create_order.php';
    }
    public function add_nomenclature()
    {
        if(!empty($_POST)){
            $create = new MOF_Nomenclature();
            $res = $create->prepareNomenclature($_POST)->insertNomenclature();
            if($res){
                echo '
                    <div class="alert alert-success" role="alert">
                      Номенклатура створена
                    </div>
                ';
            }
            else {
                echo '
                    <div class="alert alert-danger" role="alert">
                      Така номенклатура вже є
                    </div>
                ';
            }
            $_POST = array();
        }
        require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/partials/shorcode_parts/add_nomenclature.php';
    }

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Mof_Sclad_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Mof_Sclad_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/mof-sclad-public.css', array(), $this->version, 'all' );
        wp_enqueue_style( $this->plugin_name.'-bootstrap', plugin_dir_url( __FILE__ ) . 'css/bootstrap.min.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Mof_Sclad_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Mof_Sclad_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/mof-sclad-public.js', array( 'jquery' ), $this->version, false );

	}

}
