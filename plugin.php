<?php

/*
Plugin Name: Display Data
Plugin URI: https://github.com/Emad-Shtay/display-data.git
Description: This plugin is geting data from two table and store that in other db table
Version: 1.0
Author: Emad Shtay
Author URI:  http://emadsh.cf
*/

if ( ! class_exists( 'WP_List_Table' ) ) {
	require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' );
}

class Dsiplay_Data_List extends WP_List_Table {

	/** Class constructor */
	public function __construct() {

		parent::__construct( [
			'singular' => __( 'Code', 'sp' ), //singular name of the listed records
			'plural'   => __( 'Codes', 'sp' ), //plural name of the listed records
			'ajax'     => false //does this table support ajax?
		] );

	}


	/**
	 * Retrieve  data from the database
	 *
	 * @param int $per_page
	 * @param int $page_number
	 *
	 * @return mixed
	 */
	public static function get_data( $per_page = 10, $page_number = 1 ) {

		global $wpdb;

		$sql = "SELECT wp1.id As wp1ID , wp1.code as Code , wp1.client_id as Client_ID , wp1.is_taken as Is_Taken , wp2.id as wp2ID, wp2.phone as Phone FROM wp_vavt_de_k8_coupon wp1 LEFT JOIN wp_vavt_de_k8_client wp2 ON wp1.client_id=wp2.id";

		//$sql = "SELECT * FROM {$wpdb->prefix}vavt_de_k8_coupon wp1 LEFT JOIN {$wpdb->prefix}vavt_de_k8_client wp2 ON wp1.client_id=wp2.id";

		if ( ! empty( $_REQUEST['orderby'] ) ) {
			$sql .= ' ORDER BY ' . esc_sql( $_REQUEST['orderby'] );
			$sql .= ! empty( $_REQUEST['order'] ) ? ' ' . esc_sql( $_REQUEST['order'] ) : ' ASC';
		}

		$sql .= " LIMIT $per_page";
		$sql .= ' OFFSET ' . ( $page_number - 1 ) * $per_page;


		$results = $wpdb->get_results( $sql, 'ARRAY_A' );


		// add all availabe data to usermeta data
		$r1 = $wpdb->get_results("SELECT wp1.id As wp1ID , wp1.code as Code , wp1.client_id as Client_ID , wp1.is_taken as Is_Taken , wp2.id as wp2ID, wp2.phone as Phone FROM wp_vavt_de_k8_coupon wp1 LEFT JOIN wp_vavt_de_k8_client wp2 ON wp1.client_id=wp2.id");

		foreach ($r1 as $result) {

			add_user_meta( $result->wp1ID, 'Code',  $result->Code,true);
			add_user_meta( $result->wp1ID, 'Client_ID',  $result->Client_ID,true);
			add_user_meta( $result->wp1ID, 'Is_Taken',  $result->Is_Taken,true);
			add_user_meta( $result->wp1ID, 'wp2ID',  $result->wp2ID,true);
			add_user_meta( $result->wp1ID, 'Phone',  $result->Phone,true);

		}
		return $results;
	}


	/**
	 * Delete a record in admin panel
	 *
	 * @param int $id 
	 */
	public static function delete_data( $id ) {
		global $wpdb;

		$wpdb->delete(
			"{$wpdb->prefix}vavt_de_k8_coupon",
			[ 'ID' => $id ],
			[ '%d' ]
		);
		/* Delete all meta data about filed */
		delete_user_meta( $id, 'Code' );
		delete_user_meta( $id, 'Client_ID' );
		delete_user_meta( $id, 'Is_Taken' );
		delete_user_meta( $id, 'wp2ID' );
		delete_user_meta( $id, 'Phone' );
	}


	/**
	 * Returns the count of records in the database.
	 *
	 * @return null|string
	 */
	public static function record_count() {
		global $wpdb;

		$sql = "SELECT COUNT(*) FROM {$wpdb->prefix}vavt_de_k8_coupon";

		return $wpdb->get_var( $sql );
	}


	/** Text displayed when no data is available */
	public function no_items() {
		_e( 'No data avaliable.', 'sp' );
	}


	/**
	 * Render a column when no column specific method exist.
	 *
	 * @param array $item
	 * @param string $column_name
	 *
	 * @return mixed
	 */
	public function column_default( $item, $column_name ) {
		switch ( $column_name ) {
			case 'wp1ID':
			case 'Code':
			case 'Client_ID':
			case 'Is_Taken':
			case 'wp2ID':
			case 'Phone':
				return $item[ $column_name ];
			default:
				return print_r( $item, true ); //Show the whole array for troubleshooting purposes
		}
	}

	/**
	 * Render the bulk edit checkbox
	 *
	 * @param array $item
	 *
	 * @return string
	 */
	function column_cb( $item ) {
		return sprintf(
			'<input type="checkbox" name="bulk-delete[]" value="%s" />', $item['wp1ID']
		);
	}


	/**
	 * Method for name column
	 *
	 * @param array $item an array of DB data
	 *
	 * @return string
	 */
	function column_name( $item ) {

		$delete_nonce = wp_create_nonce( 'sp_delete_data' );

		$title = '<strong>' . $item['name'] . '</strong>';

		$actions = [
			'delete' => sprintf( '<a href="?page=%s&action=%s&id=%s&_wpnonce=%s">Delete</a>', esc_attr( $_REQUEST['page'] ), 'delete', absint( $item['wp1ID'] ), $delete_nonce )
		];

		return $title . $this->row_actions( $actions );
	}


	/**
	 *  Associative array of columns
	 *
	 * @return array
	 */
	function get_columns() {
		$columns = [
			'cb'      => '<input type="checkbox" />',
			'wp1ID'    => __( 'ID', 'sp' ),
			'Code' => __( 'Code', 'sp' ),
			'Client_ID'    => __( 'Client_id', 'sp' ),
			'Is_Taken'    => __( 'Is_taken', 'sp' ),
			'wp2ID'    => __( 'ID', 'sp' ),
			'Phone'    => __( 'Phone', 'sp' )
		];

		return $columns;
	}


	/**
	 * Columns to make sortable.
	 *
	 * @return array
	 */
	public function get_sortable_columns() {
		// all columns is availbel sort
		$sortable_columns = array(
			'wp1ID' => array( 'wp1ID', true ),
			'Code' => array( 'code', true ),
			'Is_Taken' => array( 'Is_Taken', true ),
			'Phone' => array('Phone',true),
			'Client_ID' => array('Client_ID',true),
			'wp2ID' => array('wp2ID',true),
		);

		return $sortable_columns;
	}

	/**
	 * Returns an associative array containing the bulk action
	 *
	 * @return array
	 */
	public function get_bulk_actions() {
		$actions = [
			'bulk-delete' => 'Delete'
		];

		return $actions;
	}


	/**
	 * Handles data query and filter, sorting, and pagination.
	 */
	public function prepare_items() {

		$this->_column_headers = $this->get_column_info();

		/** Process bulk action */
		$this->process_bulk_action();

		$per_page     = $this->get_items_per_page( 'id_per_page', 10 );
		$current_page = $this->get_pagenum();
		$total_items  = self::record_count();

		$this->set_pagination_args( [
			'total_items' => $total_items, //WE have to calculate the total number of items
			'per_page'    => $per_page //WE have to determine how many items to show on a page
		] );

		$this->items = self::get_data( $per_page, $current_page );
	}

	public function process_bulk_action() {

		//Detect when a bulk action is being triggered...
		if ( 'delete' === $this->current_action() ) {

			// In our file that handles the request, verify the nonce.
			$nonce = esc_attr( $_REQUEST['_wpnonce'] );

			if ( ! wp_verify_nonce( $nonce, 'sp_delete_data' ) ) {
				die( 'Go get a life script kiddies' );
			}
			else {
				self::delete_data( absint( $_GET['id'] ) );

		                // esc_url_raw() is used to prevent converting ampersand in url to "#038;"
		                // add_query_arg() return the current url
		                wp_redirect( esc_url_raw(add_query_arg()) );
				exit;
			}

		}

		// If the delete bulk action is triggered
		if ( ( isset( $_POST['action'] ) && $_POST['action'] == 'bulk-delete' )
		     || ( isset( $_POST['action2'] ) && $_POST['action2'] == 'bulk-delete' )
		) {

			$delete_ids = esc_sql( $_POST['bulk-delete'] );

			// loop over the array of record IDs and delete them
			foreach ( $delete_ids as $id ) {
				self::delete_data( $id );

			}

			// esc_url_raw() is used to prevent converting ampersand in url to "#038;"
		        // add_query_arg() return the current url
		        wp_redirect( esc_url_raw(add_query_arg()) );
			exit;
		}
	}

}


class DD_Plugin {

	// class instance
	static $instance;

	// Data WP_List_Table object
	public $data_obj;
	//var_dump($data_obj);
	// class constructor
	public function __construct() {
		add_filter( 'set-screen-option', [ __CLASS__, 'set_screen' ], 10, 3 );
		add_action( 'admin_menu', [ $this, 'plugin_menu' ] );
	}


	public static function set_screen( $status, $option, $value ) {
		return $value;
	}

	public function plugin_menu() {

		$hook = add_menu_page(
			'Display Data',
			'Display Data',
			'manage_options',
			'dsiplay_data_class',
			[ $this, 'plugin_settings_page' ]
		);

		add_action( "load-$hook", [ $this, 'screen_option' ] );

	}


	/**
	 * Plugin settings page
	 */
	public function plugin_settings_page() {
		?>
		<div class="wrap">
			<h2>View Data from db</h2>

			<div id="poststuff">
				<div id="post-body" class="metabox-holder columns-2">
					<div id="post-body-content">
						<div class="meta-box-sortables ui-sortable">
							<form method="post">
								<?php
								$this->data_obj->prepare_items();

								$this->data_obj->display(); ?>
							</form>
						</div>
					</div>
				</div>
				<br class="clear">
			</div>
		</div>
	<?php
	}

	/**
	 * Screen options
	 */
	public function screen_option() {

		$option = 'per_page';
		$args   = [
			'label'   => 'ID',
			'default' => 10,
			'option'  => 'id_per_page'
		];

		add_screen_option( $option, $args );

		$this->data_obj = new Dsiplay_Data_List();
		//var_dump($this->data_obj);
	}


	/** Singleton instance */
	public static function get_instance() {
		if ( ! isset( self::$instance ) ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

}


add_action( 'plugins_loaded', function () {
	DD_Plugin::get_instance();
} );
