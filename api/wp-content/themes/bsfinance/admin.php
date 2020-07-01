<?php
function add_plugin_pages(){
	add_menu_page( 'BS Finance', 'BS Finance', 'manage_options', 'bsfinance', 'bs_admin_notifications');
	add_submenu_page( 'bsfinance', 'Deposit Request', 'Deposit Request',  9, 'deposit_request', 'bs_admin_deposit_request');
	add_submenu_page( 'bsfinance', 'Withdraw Request', 'Withdraw Request',  9, 'withdraw_request', 'bs_admin_withdraw_request');
	add_submenu_page( 'bsfinance', 'Plans', 'Plans',  9, 'plans', 'bs_admin_plans');
}

add_action( 'admin_menu', 'add_plugin_pages' );

function bs_admin_notifications(){
	global $wpdb;

	$tabs = $wpdb->get_results('select * from wp_plans');

	if ( isset ( $_GET['tab'] ) ) $current = $_GET['tab']; else $current = 'bs_plan_'.$tabs[0]->id;
	
	$current_page = 'BS Finance Return Notifications';
	$plan = str_replace('bs_plan_', '', $current);
	$plans = $wpdb->get_row('select * from wp_plans where id = '.$plan);
	?>
    <div class="wrap">
        <h2><?php echo $current_page;?></h2>           
        <?php 
			if(isset($error)) echo $error;
			adminTabs($tabs, $current, 'bsfinance');
			$testListTable = new Notification_Table();
			$testListTable->id = $plan;
    		$testListTable->prepare_items();
		?>
		<div id="col-container" class="wp-clearfix">
			<div id="col-left">
				<div class="col-wrap">
					<p><b>Plan Type : </b><?= $plans->type?></p>
					<p><b>Deposit Amount : </b><?= $plans->minamount?> - <?= $plans->maxamount?></p>
				</div>
			</div>
			<div id="col-right">
				<div class="col-wrap">
					<p><b>Return Percentage : </b><?= $plans->return_percentage?></p>
					<p><b>VIP : </b><?= $plans->vip ? 'Yes' : 'No'?></p>
				</div>
			</div>
		</div>
		<form id="movies-filter" method="get">
            <!-- For plugins, we also need to ensure that the form posts back to our current page -->
            <input type="hidden" name="page" value="<?php echo $_REQUEST['page'] ?>" />
            <!-- Now we can render the completed list table -->
            <?php $testListTable->display() ?>
        </form>
    </div>
    <?php
}

function bs_admin_deposit_request(){
	//Create an instance of our package class...
    $testListTable = new Deposit_Request_Table();
    //Fetch, prepare, sort, and filter our data...
    $testListTable->prepare_items();
    
    ?>
    <div class="wrap">
        
        <div id="icon-users" class="icon32"><br/></div>
        <h2>Deposit Request Table</h2>
        
        <form id="movies-filter" method="get">
            <!-- For plugins, we also need to ensure that the form posts back to our current page -->
            <input type="hidden" name="page" value="<?php echo $_REQUEST['page'] ?>" />
            <!-- Now we can render the completed list table -->
            <?php $testListTable->display() ?>
        </form>
        
    </div>
    <?php
}

function bs_admin_withdraw_request(){
	//Create an instance of our package class...
    $testListTable = new Withdraw_Request_Table();
    //Fetch, prepare, sort, and filter our data...
    $testListTable->prepare_items();
    
    ?>
    <div class="wrap">
        
        <div id="icon-users" class="icon32"><br/></div>
        <h2>Withdraw Request Table</h2>

        <form id="movies-filter" method="get">
            <!-- For plugins, we also need to ensure that the form posts back to our current page -->
            <input type="hidden" name="page" value="<?php echo $_REQUEST['page'] ?>" />
            <!-- Now we can render the completed list table -->
            <?php $testListTable->display() ?>
        </form>
        
    </div>
    <?php
}

function bs_admin_plans(){
	?>
	<div class="wrap nosubsub">
		<h1 class="wp-heading-inline">BS Plans</h1>


		<hr class="wp-header-end">

		<div id="ajax-response"></div>

		<div id="col-container" class="wp-clearfix">

		<div id="col-left">
		<div class="col-wrap">

			
		<div class="form-wrap">
		<h2>Add New Plans</h2>

		<?php 
		global $wpdb;
		$plan = (array)$wpdb->get_row('select * from wp_plans where id =' . $_GET['id']);
		?>

		<form id="addtag" method="post" class="validate">
			<input type="hidden" name="bs_admin_create_plan">
			<div class="form-field form-required term-name-wrap">
				<label for="tag-name">Plan Name</label>
				<input name="name" type="text" value="<?= isset($plan['name']) ? $plan['name'] : ''?>" size="40" aria-required="true">
			</div>
			<div class="form-field term-slug-wrap">
				<label for="tag-slug">Type</label>
				<select name="type">
					<option <?= isset($plan['type']) && $plan['type'] == 'daily' ? 'selected' : ''?> type="daily">Daily</option>
					<option <?= isset($plan['type']) && $plan['type'] == 'onetime' ? 'selected' : ''?> type="onetime">One Time</option>
				</select>
			</div>
			<div class="form-field form-required term-name-wrap">
				<label for="tag-name">No of Days</label>
				<input name="no_of_days"  type="text" value="<?= isset($plan['no_of_days']) ? $plan['no_of_days'] : ''?>" size="40" aria-required="true">
			</div>
			<div class="form-field form-required term-name-wrap">
				<label for="tag-name">Min Amount</label>
				<input name="minamount" type="text" value="<?= isset($plan['minamount']) ? $plan['minamount'] : ''?>" size="40" aria-required="true">
			</div>
			<div class="form-field form-required term-name-wrap">
				<label for="tag-name">Max Amount</label>
				<input name="maxamount" type="text" value="<?= isset($plan['maxamount']) ? $plan['maxamount'] : ''?>" size="40" aria-required="true">
			</div>
			<div class="form-field form-required term-name-wrap">
				<label for="tag-name">Return Percentage</label>
				<input name="return_percentage" type="text" value="<?= isset($plan['return_percentage']) ? $plan['return_percentage'] : ''?>" size="40" aria-required="true">
			</div>
			<div class="form-field form-required term-name-wrap">
				<label for="tag-name">VIP</label>
				<input name="vip" <?= isset($plan['vip']) && $plan['vip'] == '1' ? 'checked' : ''?> type="checkbox" value="1" size="40" aria-required="true">
			</div>
			<p class="submit">
				<input type="submit" name="submit" id="submit" class="button button-primary" value="Save Plan">		<span class="spinner"></span>
			</p>
		</form>
	</div>
		</div>
		</div><!-- /col-left -->

		<div id="col-right">
		<div class="col-wrap">


		<form id="posts-filter" method="post">
				<h2 class="screen-reader-text">Categories list</h2>
				<table class="wp-list-table widefat fixed striped tags">
			<thead>
			<tr>
				<th width="5%">#</th>
				<th width="20%">Plan Name</th>	
				<th width="15%">Type</th>
				<th width="15%">Return Percentage</th>
				<th width="25%">Amount</th>
				<th width="20%">Action</th>
			</tr>
			</thead>

			<tbody id="the-list" data-wp-lists="list:tag">
				<?php 
				global $wpdb;
				$plans = $wpdb->get_results('select * from wp_plans');
				foreach ($plans as $key => $value) {
				?>
				<tr>
					<td><?= $key+1?></td>
					<td><?= $value->name?><?php if($value->vip){?>(VIP)<?php }?></td>
					<td><?= $value->type?></td>
					<td><?= $value->return_percentage?></td>
					<td>$<?= $value->minamount?> - $<?= $value->maxamount?></td>
					<td>
						<a href="admin.php?page=plans&action=edit&id=<?= $value->id?>" class="button">Edit</a>
						<a href="admin.php?page=plans&action=delete&id=<?= $value->id?>" style="border-color:red;" class="button">Delete</a>
					</td>
				</tr>
				<?php }?>		
			</tbody>


		</table>
				
		</form>

		</div>
		</div><!-- /col-right -->

		</div><!-- /col-container -->

		</div>
	<?php
}

function adminTabs($tabs, $default, $page){
        
    if ( isset ( $_GET['tab'] ) ) $current = $_GET['tab']; else $current = $default;
    
    echo '<div id="icon-themes" class="icon32"><br></div>';
    echo '<h2 class="nav-tab-wrapper">';

    foreach( $tabs as $tab ){
        $class = ( 'bs_plan_'.$tab->id == $current ) ? ' nav-tab-active' : '';
        echo "<a class='nav-tab$class' href='?page=$page&tab=bs_plan_".$tab->id."'>".$tab->name."</a>";

    }
    
    echo '</h2>';
}	
