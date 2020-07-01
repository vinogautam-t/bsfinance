<?php
if(!class_exists('WP_List_Table')){
    require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' );
}

class Deposit_Request_Table extends WP_List_Table {
	function __construct(){
        global $status, $page;
                
        //Set parent defaults
        parent::__construct( array(
            'singular'  => 'movie',     //singular name of the listed records
            'plural'    => 'movies',    //plural name of the listed records
            'ajax'      => false        //does this table support ajax?
        ) );
        
    }

    function column_default($item, $column_name){
        switch($column_name){
            case 'rating':
            case 'director':
                return $item[$column_name];
            case 'action':
            	return '<a href="?page='.$_REQUEST['page'].'&action=admin_approve&id='.$item['id'].'" class="button">Approve</a> 
            	<a href="?page='.$_REQUEST['page'].'&action=admin_reject&id='.$item['id'].'" class="button">Reject</a>';
            default:
                return $item[$column_name]; //Show the whole array for troubleshooting purposes
        }
    }

    function column_title($item){
        
        //Build row actions
        $actions = array(
            'edit'      => sprintf('<a href="?page=%s&action=%s&movie=%s">Edit</a>',$_REQUEST['page'],'edit',$item['ID']),
            'delete'    => sprintf('<a href="?page=%s&action=%s&movie=%s">Delete</a>',$_REQUEST['page'],'delete',$item['ID']),
        );
        
        //Return the title contents
        return sprintf('%1$s <span style="color:silver">(id:%2$s)</span>%3$s',
            /*$1%s*/ $item['title'],
            /*$2%s*/ $item['ID'],
            /*$3%s*/ $this->row_actions($actions)
        );
    }

    function column_cb($item){
        return sprintf(
            '<input type="checkbox" name="%1$s[]" value="%2$s" />',
            /*$1%s*/ $this->_args['singular'],  //Let's simply repurpose the table's singular label ("movie")
            /*$2%s*/ $item['ID']                //The value of the checkbox should be the record's id
        );
    }

    function get_columns(){
        $columns = array(
            'cb'        => '<input type="checkbox" />', //Render a checkbox instead of text
            'name'     => 'User',
            'plan'    => 'Plan',
            'amount'  => 'Deposit Amount',
            'reference_id' => 'Reference Id',
            'notes' => 'Notes',
            'request_date' => 'Request_date',
            'action' => 'Action'
        );
        return $columns;
    }

    function get_sortable_columns() {
        $sortable_columns = array(
            'name'     => array('name',false),
            'plan'     => array('plan',false),
            'request_date'  => array('request_date',false)
        );
        return $sortable_columns;
    }

    function get_bulk_actions() {
        $actions = array(
            'delete'    => 'Delete'
        );
        return $actions;
    }

    function process_bulk_action() {
        
        //Detect when a bulk action is being triggered...
        if( 'delete'===$this->current_action() ) {
            wp_die('Items deleted (or they would be if we had items to delete)!');
        }
        
    }

    function prepare_items() {
        global $wpdb; 
        $per_page = 5;
        
        $columns = $this->get_columns();
        $hidden = array();
        $sortable = $this->get_sortable_columns();
        $this->_column_headers = array($columns, $hidden, $sortable);
        
        
        $this->process_bulk_action();

        $res = $wpdb->get_results('select * from wp_user_request where type = "deposit" and status = 0');
        $data = array();
        foreach ($res as $key => $value) {
        	$value = (array)$value;

        	$value['name'] = get_user_meta($value['user_id'], 'name', true);
        	$value['plan'] = $wpdb->get_row('select * from wp_plans where id = '.$value['plan_id'])->name;
        	$data[] = $value;
        }
            
        function usort_reorder($a,$b){
            $orderby = (!empty($_REQUEST['orderby'])) ? $_REQUEST['orderby'] : 'title'; //If no sort, default to title
            $order = (!empty($_REQUEST['order'])) ? $_REQUEST['order'] : 'asc'; //If no order, default to asc
            $result = strcmp($a[$orderby], $b[$orderby]); //Determine sort order
            return ($order==='asc') ? $result : -$result; //Send final sort direction to usort
        }
        usort($data, 'usort_reorder');
        
        $current_page = $this->get_pagenum();
        $total_items = count($data);
        
        $data = array_slice($data,(($current_page-1)*$per_page),$per_page);
        
        $this->items = $data;
        $this->set_pagination_args( array(
            'total_items' => $total_items,                  //WE have to calculate the total number of items
            'per_page'    => $per_page,                     //WE have to determine how many items to show on a page
            'total_pages' => ceil($total_items/$per_page)   //WE have to calculate the total number of pages
        ) );
    }


}

class Withdraw_Request_Table extends WP_List_Table {
	function __construct(){
        global $status, $page;
                
        //Set parent defaults
        parent::__construct( array(
            'singular'  => 'movie',     //singular name of the listed records
            'plural'    => 'movies',    //plural name of the listed records
            'ajax'      => false        //does this table support ajax?
        ) );
        
    }

    function column_default($item, $column_name){
        switch($column_name){
            case 'rating':
            case 'director':
                return $item[$column_name];
            case 'action':
            	return '<a href="?page='.$_REQUEST['page'].'&action=admin_approve&id='.$item['id'].'" class="button">Approve</a> 
            	<a href="?page='.$_REQUEST['page'].'&action=admin_reject&id='.$item['id'].'" class="button">Reject</a>';
            default:
                return $item[$column_name]; //Show the whole array for troubleshooting purposes
        }
    }

    function column_title($item){
        
        //Build row actions
        $actions = array(
            'edit'      => sprintf('<a href="?page=%s&action=%s&movie=%s">Edit</a>',$_REQUEST['page'],'edit',$item['ID']),
            'delete'    => sprintf('<a href="?page=%s&action=%s&movie=%s">Delete</a>',$_REQUEST['page'],'delete',$item['ID']),
        );
        
        //Return the title contents
        return sprintf('%1$s <span style="color:silver">(id:%2$s)</span>%3$s',
            /*$1%s*/ $item['title'],
            /*$2%s*/ $item['ID'],
            /*$3%s*/ $this->row_actions($actions)
        );
    }

    function column_cb($item){
        return sprintf(
            '<input type="checkbox" name="%1$s[]" value="%2$s" />',
            /*$1%s*/ $this->_args['singular'],  //Let's simply repurpose the table's singular label ("movie")
            /*$2%s*/ $item['ID']                //The value of the checkbox should be the record's id
        );
    }

    function get_columns(){
        $columns = array(
            'cb'        => '<input type="checkbox" />', //Render a checkbox instead of text
            'name'     => 'User',
            'amount'  => 'Withdraw Amount',
            'notes' => 'Notes',
            'request_date' => 'Request_date',
            'action' => 'Action'
        );
        return $columns;
    }

    function get_sortable_columns() {
        $sortable_columns = array(
            'name'     => array('name',false),
            'plan'     => array('plan',false),
            'request_date'  => array('request_date',false)
        );
        return $sortable_columns;
    }

    function get_bulk_actions() {
        $actions = array(
            'delete'    => 'Delete'
        );
        return $actions;
    }

    function process_bulk_action() {
        
        //Detect when a bulk action is being triggered...
        if( 'delete'===$this->current_action() ) {
            wp_die('Items deleted (or they would be if we had items to delete)!');
        }
        
    }

    function prepare_items() {
        global $wpdb; 
        $per_page = 5;
        
        $columns = $this->get_columns();
        $hidden = array();
        $sortable = $this->get_sortable_columns();
        $this->_column_headers = array($columns, $hidden, $sortable);
        
        
        $this->process_bulk_action();

        $res = $wpdb->get_results('select * from wp_user_request where type = "withdraw" and status = 0');
        $data = array();
        foreach ($res as $key => $value) {
        	$value = (array)$value;

        	$value['name'] = get_user_meta($value['user_id'], 'name', true);
        	$value['plan'] = $wpdb->get_row('select * from wp_plans where id = '.$value['plan_id'])->name;
        	$data[] = $value;
        }
            
        function usort_reorder($a,$b){
            $orderby = (!empty($_REQUEST['orderby'])) ? $_REQUEST['orderby'] : 'title'; //If no sort, default to title
            $order = (!empty($_REQUEST['order'])) ? $_REQUEST['order'] : 'asc'; //If no order, default to asc
            $result = strcmp($a[$orderby], $b[$orderby]); //Determine sort order
            return ($order==='asc') ? $result : -$result; //Send final sort direction to usort
        }
        usort($data, 'usort_reorder');
        
        $current_page = $this->get_pagenum();
        $total_items = count($data);
        
        $data = array_slice($data,(($current_page-1)*$per_page),$per_page);
        
        $this->items = $data;
        $this->set_pagination_args( array(
            'total_items' => $total_items,                  //WE have to calculate the total number of items
            'per_page'    => $per_page,                     //WE have to determine how many items to show on a page
            'total_pages' => ceil($total_items/$per_page)   //WE have to calculate the total number of pages
        ) );
    }


}

class Notification_Table extends WP_List_Table {
	public $id = 0;
	function __construct(){
        global $status, $page;
                
        //Set parent defaults
        parent::__construct( array(
            'singular'  => 'movie',     //singular name of the listed records
            'plural'    => 'movies',    //plural name of the listed records
            'ajax'      => false        //does this table support ajax?
        ) );
        
    }

    function column_default($item, $column_name){
        switch($column_name){
            case 'action':
            	return '<a href="?page='.$_REQUEST['page'].'&tab=bs_plan_'.$this->id.'&action=admin_approve_return&id='.$item['id'].'" class="button">Approve</a>';
            default:
                return $item[$column_name]; //Show the whole array for troubleshooting purposes
        }
    }

    function column_title($item){
        
        //Build row actions
        $actions = array(
            'edit'      => sprintf('<a href="?page=%s&action=%s&movie=%s">Edit</a>',$_REQUEST['page'],'edit',$item['ID']),
            'delete'    => sprintf('<a href="?page=%s&action=%s&movie=%s">Delete</a>',$_REQUEST['page'],'delete',$item['ID']),
        );
        
        //Return the title contents
        return sprintf('%1$s <span style="color:silver">(id:%2$s)</span>%3$s',
            /*$1%s*/ $item['title'],
            /*$2%s*/ $item['ID'],
            /*$3%s*/ $this->row_actions($actions)
        );
    }

    function column_cb($item){
        return sprintf(
            '<input type="checkbox" name="%1$s[]" value="%2$s" />',
            /*$1%s*/ $this->_args['singular'],  //Let's simply repurpose the table's singular label ("movie")
            /*$2%s*/ $item['ID']                //The value of the checkbox should be the record's id
        );
    }

    function get_columns(){
        $columns = array(
            'cb'        => '<input type="checkbox" />', //Render a checkbox instead of text
            'name'     => 'User',
            'amount'  => 'Return Amount',
            'deposit' => 'Deposit Amount',
            'subscription_date' => 'Subscription Date',
            'noti_date' => 'Noti date',
            'action' => 'Action'
        );
        return $columns;
    }

    function get_sortable_columns() {
        $sortable_columns = array(
            'noti_date'  => array('noti_date',false)
        );
        return $sortable_columns;
    }

    function get_bulk_actions() {
        $actions = array(
            'delete'    => 'Delete'
        );
        return $actions;
    }

    function process_bulk_action() {
        
        //Detect when a bulk action is being triggered...
        if( 'delete'===$this->current_action() ) {
            wp_die('Items deleted (or they would be if we had items to delete)!');
        }
        
    }

    function prepare_items() {
        global $wpdb; 
        $per_page = 5;
        
        $columns = $this->get_columns();
        $hidden = array();
        $sortable = $this->get_sortable_columns();
        $this->_column_headers = array($columns, $hidden, $sortable);
        
        
        $this->process_bulk_action();

        $res = $wpdb->get_results('select * from wp_subscription_notification where status = 0 and plan_id='.$this->id);
        $data = array();
        foreach ($res as $key => $value) {
        	$value = (array)$value;

        	$value['name'] = get_user_meta($value['user_id'], 'name', true);
        	$plan = $wpdb->get_row('select * from wp_plans where id = '.$value['plan_id']);
        	$value['plan'] = $plan->name;
        	$value['return'] = $plan->return_percentage;
        	$subscription = $wpdb->get_row('select * from wp_subscription where id = '.$value['subscription_id']);
        	$value['subscription_date'] = $subscription->subscription_date;
        	$value['deposit'] = $subscription->amount;
        	$data[] = $value;
        }
            
        function usort_reorder($a,$b){
            $orderby = (!empty($_REQUEST['orderby'])) ? $_REQUEST['orderby'] : 'title'; //If no sort, default to title
            $order = (!empty($_REQUEST['order'])) ? $_REQUEST['order'] : 'asc'; //If no order, default to asc
            $result = strcmp($a[$orderby], $b[$orderby]); //Determine sort order
            return ($order==='asc') ? $result : -$result; //Send final sort direction to usort
        }
        usort($data, 'usort_reorder');
        
        $current_page = $this->get_pagenum();
        $total_items = count($data);
        
        $data = array_slice($data,(($current_page-1)*$per_page),$per_page);
        
        $this->items = $data;
        $this->set_pagination_args( array(
            'total_items' => $total_items,                  //WE have to calculate the total number of items
            'per_page'    => $per_page,                     //WE have to determine how many items to show on a page
            'total_pages' => ceil($total_items/$per_page)   //WE have to calculate the total number of pages
        ) );
    }


}