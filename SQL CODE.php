	<?						
	//THIS JOINS ALL THE TABLES
	$SQLQUERYFOUR = $wpdb->get_results("
		SELECT wp_postmeta.post_id, wp_postmeta.meta_key, wp_postmeta.meta_value, wp_woocommerce_order_items.order_id,  wp_woocommerce_order_items.order_item_name, wp_woocommerce_order_items.order_item_type
		FROM wp_postmeta
		JOIN wp_woocommerce_order_items
		ON wp_postmeta.post_id=wp_woocommerce_order_items.order_id
		WHERE (wp_postmeta.meta_key LIKE '_billing_%_name' OR  wp_postmeta.meta_key = '_billing_email' OR wp_postmeta.meta_key = '_customer_user_agent') AND wp_woocommerce_order_items.order_item_type = 'line_item';
	");
	
	//_shipping_last_name' AND wp_woocommerce_order_items.order_item_type = 'line_item') OR (wp_postmeta.meta_key = '_shipping_first_name' AND wp_woocommerce_order_items.order_item_type = 'line_item
	$ARRAYCUSTOMONE = array();
	
	for($i = 0; $i < count($SQLQUERYFOUR); $i+=4 ){ 
	array_push($ARRAYCUSTOMONE, array(
		$SQLQUERYFOUR[$i],
		$SQLQUERYFOUR[$i+1], 
		$SQLQUERYFOUR[$i+2], 
		$SQLQUERYFOUR[$i+3]
		));
	}
	
	?>
	<ul>
	<? foreach($ARRAYCUSTOMONE as $key=>$post_ordercustom){ 
		//$meta = get_post_meta($post_portfolio->ID); 
		//echo "<pre>";  var_dump($ARRAYCUSTOMONE); echo "</pre>"; 
		
		$UNIQUEIDCUSTOM = $post_ordercustom[0]->post_id;
		$UNIQUEIDTWO = $post_ordercustom[0]->order_id;
		$FIRSTNAME = $post_ordercustom[0]->meta_value;
		$LASTNAME = $post_ordercustom[1]->meta_value;
		$BILLEMAIL = $post_ordercustom[2]->meta_value;
		$USRAGT = $post_ordercustom[3]->meta_value;
		$WHATIBOUGHT =  $post_ordercustom[0]->order_item_name;
	
		//$FIRSTNAME = $post_ordercustom->_billing_first_name;
		?>
		<li>
			POST ID: <? echo $UNIQUEIDCUSTOM; ?>
			ORDER ID: <? echo $UNIQUEIDTWO; ?><br />
			FIRST NAME: <strong><? echo $FIRSTNAME; ?></strong>
			LAST NAME: <strong><? echo($LASTNAME); ?></strong>
			EMAIL: <? echo($BILLEMAIL); ?><br />
			TICKET: <strong><? echo($WHATIBOUGHT); ?></strong><br />
			USERAGENT: <strong><? echo($USRAGT); ?></strong>
			
		</li>
		<?
			//echo gettype($post_ordercustom->post_id);
			//echo "<pre>";  var_dump($SQLQUERYFOUR); echo "</pre>"; 
		?>
		
	<? } ?>
	</ul>