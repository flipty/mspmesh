<?php

/* Template Name: Order Page */

get_header();
include('includes/hours.php');
if(have_posts()):
	while(have_posts()): the_post();
?>

<?php
$modal = get_field('modal');
if ($modal) { ?>
<div class="overlay">
	<div class="modal">
		<div class="modal-close">
			<a href="#">&times;</a>
		</div>
		<div class="modal-content">
			<?php the_field('modal_content');?>
			<div class="modal-close">
				<a href="#">Close</a>
			</div>
		</div>
	</div>
</div>
<?php } ?>

<div class="container content-container">
	<div class="content-inner">

<?php
	$external_order_system = get_field('use_external_ordering', 'options');
?>

<?php

	if (!$open) {
		echo get_field('closed_content'); ?>
		<div class="all-hours">
			<h3>We are closed <?php echo $close_reason;?>.</h3>
			<p>
				Sunday: <?php echo $sun_open; ?> - <?php echo $sun_close; ?><br>
				Monday: <?php echo $mon_open; ?> - <?php echo $mon_close; ?><br>
				Tuesday: <?php echo $tues_open; ?> - <?php echo $tues_close; ?><br>
				Wednesday: <?php echo $weds_open; ?> - <?php echo $weds_close; ?><br>
				Thursday: <?php echo $thur_open; ?> - <?php echo $thur_close; ?><br>
				Friday: <?php echo $fri_open; ?> - <?php echo $fri_close; ?><br>
				Saturday: <?php echo $sat_open; ?> - <?php echo $sat_close; ?>
			</p>
		</div>
		<?php
	} //if closed
	// if is open OR admin...
 	if ( $open || current_user_can('administrator') ) {
	?>

	<?php// if (!$external_order_system) { //we are using the original carryout system ?>

	<div class="row">
		<div class="col-md-8 intro">
			<?php if ( ! $open && current_user_can('administrator') ) {
				echo '<span style="display: block; text-align: center; font-size: 24px; background: red; color: yellow;">CLOSED - BUT ADMIN OVERRIDE</span>';
			} ?>
			<?php the_content(); ?>

			<?php
			date_default_timezone_set('America/Chicago');
			$currentTimeStamp = time();
			$orderAhead = true;
			$closeTime = strtotime($closeHour);
			$window = $closeTime - (60 * 30);
			if ($currentTimeStamp > $window) {
				$orderAhead = false;
			}
			date_default_timezone_set('UTC'); //have to reset the time for some reason watch for this in the future...

			?>
			<?php if ($orderAhead) { ?>
			<div class="order-time">
				<div class="inner">
					<?php echo get_field('pickup_content');?>
					<div style="margin: 10px 0; background: #C00; color: white; font-weight: bold; text-align: center; padding: 7px; border: solid 2px yellow;"> Please ensure you add the pick-up time to your order by clicking the button after selecting the pick-up time from the list. The pick up time should then appear in your cart as a $0.01 item.<br>
					Orders intended for future pickup <u>without a pick-up time in your cart</u> cannot be re-made.</div>

					<form action="https://secure.nmi.com/cart/cart.php" method="POST">
					My pick-up time:<Br> <select name="product_option_1_1">
					<!-- <option value="10 15AM">10:15 AM</option> -->
					<option value="DID_NOT_SELECT">Choose a time for pick up later than <?php echo date("g:i A", strtotime("-270 minutes"));//weird time here because of timezone offset -- 270 for DST, 330 for non-DST?></option>
					<option value="10 30AM">10:30 AM</option>
					<option value="10 45AM">10:45 AM</option>
					<option value="11 00AM">11:00 AM</option>
					<option value="11 15AM">11:15 AM</option>
					<option value="11 30AM">11:30 AM</option>
					<option value="11 45AM">11:45 AM</option>
					<option value="12 00PM">12:00 PM</option>
					<option value="12 15PM">12:15 PM</option>
					<option value="12 30PM">12:30 PM</option>
					<option value="12 45PM">12:45 PM</option>
					<option value="1 00 PM">1:00 PM</option>
					<option value="1 15PM">1:15 PM</option>
					<option value="1 30PM">1:30 PM</option>
					<option value="1 45PM">1:45 PM</option>
					<option value="2 00PM">2:00 PM</option>
					<option value="2 15PM">2:15 PM</option>
					<option value="2 30PM">2:30 PM</option>
					<option value="2 45PM">2:45 PM</option>
					<option value="3 00PM">3:00 PM</option>
					<option value="3 15PM">3:15 PM</option>
					<option value="3 30PM">3:30 PM</option>
					<option value="3 45PM">3:45 PM</option>
					<option value="4 00PM">4:00 PM</option>
					<option value="4 15PM">4:15 PM</option>
					<option value="4 30PM">4:30 PM</option>
					<option value="4 45PM">4:45 PM</option>
					<option value="5 00PM">5:00 PM</option>
					<option value="5 15PM">5:15 PM</option>
					<option value="5 30PM">5:30 PM</option>
					<option value="5 45PM">5:45 PM</option>
					<option value="6 00PM">6:00 PM</option>
					<option value="6 15PM">6:15 PM</option>
					<option value="6 30PM">6:30 PM</option>
					<option value="6 45PM">6:45 PM</option>
					<option value="7 00PM">7:00 PM</option>
					<option value="7 15PM">7:15 PM</option>
					<option value="7 30PM">7:30 PM</option>
					<option value="7 45PM">7:45 PM</option>
					<option value="8 00PM">8:00 PM</option>
					</select>
					<input type="hidden" name="key_id" value="13804453" />
					<input type="hidden" name="product_option_values_1_1" value="10 15AM|10 30AM|10 45AM|11 00AM|11 15AM|11 30AM|11 45AM|12 00PM|12 15PM|12 30PM|12 45PM|1 00 PM|1 15PM|1 30PM|1 45PM|2 00PM|2 15PM|2 30PM|2 45PM|3 00PM|3 15PM|3 30PM|3 45PM|4 00PM|4 15PM|4 30PM|4 45PM|5 00PM|5 15PM|5 30PM|5 45PM|6 00PM|6 15PM|6 30PM|6 45PM|7 00PM|7 15PM|7 30PM|7 45PM|8 00PM" />
					<input type="hidden" name="action" value="process_cart" />
					<input type="hidden" name="product_sku_1" value="TIME-ORDER-PICKUP" />
					<input type="hidden" name="product_description_1" value="Pick Up At:" />
					<input type="hidden" name="product_amount_1" value="0.01" />
					<input type="hidden" name="url_continue" value="http://order.habanerotacosgrill.com/" />
					<input type="hidden" name="language" value="en" />
					<input type="hidden" name="url_finish" value="https://habanerotacosgrill.com/order-thanks" />
					<input type="hidden" name="customer_receipt" value="true" />
					<input type="hidden" name="hash" value="product_option_values_1_1|action|product_sku_1|product_description_1|product_amount_1|00af46abfacbda9dfa954fd619e81cc2" />
					<input type="submit" name="submit" value="Click to add selected Pick-up Time to order" />
					</form>

				</div>
			</div>
		<?php } ?>
		<?php if (!$orderAhead) { ?>
			<h2>The kitchen closes soon.<br>Please make sure your order is complete by <?php echo $closeHour; ?>.</h2>
		<?php } ?>
			<div class="tip">
				<form action="https://secure.nmi.com/cart/cart.php" method="POST">
				  Tip Amount in $:
				<input type="text" size="3" name="product_quantity_1" />
				<input type="hidden" name="key_id" value="13804453" />
				<input type="hidden" name="action" value="process_cart" />
				<input type="hidden" name="product_sku_1" value="WEB-Tip" />
				<input type="hidden" name="product_description_1" value="Tip" />
				<input type="hidden" name="product_amount_1" value="1.00" />
				<input type="hidden" name="url_continue" value="http://order.habanerotacosgrill.com/" />
				<input type="hidden" name="language" value="en" />
				<input type="hidden" name="url_cancel" value="http://order.habanerotacosgrill.com/" />
				<input type="hidden" name="url_finish" value="https://habanerotacosgrill.com/order-thanks" />
				<input type="hidden" name="customer_receipt" value="true" />
				<input type="hidden" name="hash" value="action|product_sku_1|product_description_1|product_amount_1|70cb625ede04f75afccc69a9d443748c" />
				<input type="submit" name="submit" value="Tip the Crew!" />
				</form>
			</div>
		</div>
		<div class="col-md-4 meats">
			<?php echo get_field('meat_options');?>
		</div>
	</div>

	<?php
	if( have_rows('menu_section') ):
	while( have_rows('menu_section') ): the_row();
		$title = get_sub_field('section_title');
		$items = get_sub_field('menu_items');
		$intro = get_sub_field('intro');
	?>
	<div class="section">
		<h2>
			<?php echo $title; ?>
		</h2>
		<?php if ($intro) { echo '<p>'; echo $intro; echo '</p>'; } ?>
		<div class="menu-items">

			<?php foreach ($items as $item) { ?>
				<?php $content = get_post_field('post_content', $item);?>
				<?php $extra_fields = get_field('extra_fields', $item); ?>
				<?php
					$daily_special = get_field('daily_special', $item);
					//still have to choose the right timezone here for some reason -- gets reset at the loop
					date_default_timezone_set('America/Chicago');
					$today_name = date('l');
					$special = false;
					// if an item has a day checked, turn $special true
					if ($daily_special) { $special = true; }
					// select all itmes if today is listed in an item's $daily_special array
					if ((!$special) || in_array($today_name, $daily_special)) {
				?>
				<div class="menu-item<?php if ($extra_fields) {echo ' meat-picker';} if ($special) { echo ' special';}	?>">
					<?php
					//NOTE: there are javscripts that can manipulate these forms in habanero.js
					?>
					<div class="content">
						<h3><?php echo get_the_title($item);?><span class="price"></span></h3>
						<div class="image">
							<?php echo get_the_post_thumbnail($item, 'large'); ?>
						</div>
						<div class="copy">
							<?php echo $content;?>
						</div>
					</div>
					<?php
						// building 3-item menu items that need more than the 3 allowed fields from merchantOne -
						// one text field for all three meat choices, and one for notes.
						// javascript habanero.extraFields is taking the select values and putting them into a text field
						if ($extra_fields) {
							$meats = get_field('meats', $item);
						?>
						<div class="meat-selects">
						<select class="meat-select" id="item<?php echo rand(1, 10000);?>">
							<option value=""># 1</option>
							<?php foreach ($meats as $meat){
								echo '<option> #1 ';
								echo $meat;
								echo '</option>';
							}?>
						</select>
						<select class="meat-select" id="item<?php echo rand(1, 10000);?>">
							<option value=""># 2</option>
							<?php foreach ($meats as $meat){
								echo '<option> #2 ';
								echo $meat;
								echo '</option>';
							}?>
						</select>
						<select class="meat-select" id="item<?php echo rand(1, 10000);?>">
							<option value=""># 3</option>
							<?php foreach ($meats as $meat){
								echo '<option> #3 ';
								echo $meat;
								echo '</option>';
							}?>
						</select>
						</div>
						<?php } ?>

					<div class="merchantOne">
						<?php echo get_field('html', $item);?>
					</div>
				</div>
			<?php
				} //special check
				// reset to false for the loop
				$special = false;
				date_default_timezone_set('UTC'); //have to reset the time for some reason watch for this in the future...
			} //each item
			?>
		</div>
	</div>
	<?php endwhile;	endif; ?>

	<h2>Special instructions?</h2>
			<p>
				If your order needs any special instructions other than the notes on the individual items, please let us know here.
			</p>
			<div class="special-instructions">
				<form action="https://secure.nmi.com/cart/cart.php" method="POST">
				<textarea name="product_option_1_1" rows="8" width="100%"></textarea>
				<input type="hidden" name="key_id" value="13804453" />
				<input type="hidden" name="action" value="process_cart" />
				<input type="hidden" name="product_sku_1" value="WEB-Special-Instructions" />
				<input type="hidden" name="product_description_1" value="SPECIAL INSTRUCTIONS" />
				<input type="hidden" name="product_amount_1" value="0.01" />
				<input type="hidden" name="url_continue" value="http://order.habanerotacosgrill.com/" />
				<input type="hidden" name="language" value="en" />
				<input type="hidden" name="url_cancel" value="http://order.habanerotacosgrill.com/" />
				<input type="hidden" name="url_finish" value="https://habanerotacosgrill.com/order-thanks" />
				<input type="hidden" name="customer_receipt" value="true" />
				<input type="hidden" name="hash" value="action|product_sku_1|product_description_1|product_amount_1|26bbd1111e9060bc56242705d456babc" />
				<input type="submit" name="submit" value="Add Special Instructions to my Order" />
				</form>
			</div>
<?php } // if open ?>

<?php // } // if using custom order system ?>

<?php //if ($external_order_system) { //we are using the original carryout system ?>

	<?php // the_field('external_ordering_content');?>

<?php //} ?>

	</div>
</div>

<?php
	endwhile;
endif;

get_footer();
?>
