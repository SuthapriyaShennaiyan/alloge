<div <?php qode_framework_class_attribute( $holder_classes ); ?>>
	<?php if ( $open_table_id !== '' ) : ?>
		<form class="qodef-m-inner" target="_blank" action="https://www.opentable.com/restaurant-search.aspx"
		      name="qodef-m-inner">
			
			<div class="qodef-m-field qodef-m-field-people">
				<?php echo qode_framework_icons()->render_icon( 'lnr-user', 'linear-icons', array( 'icon_attributes' => array( 'class' => 'qodef-m-icon qodef-m-icon-people' ) ) ); ?>
				<select name="partySize" class="qodef-m-people">
					<option value="1"><?php esc_html_e( '1 Person', 'alloggio-core' ); ?></option>
					<option value="2"><?php esc_html_e( '2 People', 'alloggio-core' ); ?></option>
					<option value="3"><?php esc_html_e( '3 People', 'alloggio-core' ); ?></option>
					<option value="4"><?php esc_html_e( '4 People', 'alloggio-core' ); ?></option>
					<option value="5"><?php esc_html_e( '5 People', 'alloggio-core' ); ?></option>
					<option value="6"><?php esc_html_e( '6 People', 'alloggio-core' ); ?></option>
					<option value="7"><?php esc_html_e( '7 People', 'alloggio-core' ); ?></option>
					<option value="8"><?php esc_html_e( '8 People', 'alloggio-core' ); ?></option>
					<option value="9"><?php esc_html_e( '9 People', 'alloggio-core' ); ?></option>
					<option value="10"><?php esc_html_e( '10 People', 'alloggio-core' ); ?></option>
				</select>
			</div>
			
			<div class="qodef-m-field qodef-m-field-label">
				<span class="qodef-m-label"><?php esc_html_e( 'for', 'alloggio-core' ); ?></span>
			</div>
			
			<div class="qodef-m-field qodef-m-field-date">
				<?php echo qode_framework_icons()->render_icon( 'icon-basic-calendar', 'linea-icons', array( 'icon_attributes' => array( 'class' => 'qodef-m-icon qodef-m-icon-date' ) ) ); ?>
				<input type="text" value="<?php echo date( 'F j, Y' ); ?>" class="qodef-m-date" name="startDate">
				<?php echo qode_framework_icons()->render_icon( 'icon-arrows-down', 'linea-icons', array( 'icon_attributes' => array( 'class' => 'qodef-m-icon-arrow' ) ) ); ?>
			</div>
			
			<div class="qodef-m-field qodef-m-field-label">
				<span class="qodef-m-label"><?php esc_html_e( 'at', 'alloggio-core' ); ?></span>
			</div>
			
			<div class="qodef-m-field qodef-m-field-time">
				<?php echo qode_framework_icons()->render_icon( 'icon-basic-clessidre', 'linea-icons', array( 'icon_attributes' => array( 'class' => 'qodef-m-icon qodef-m-icon-time' ) ) ); ?>
				<select name="ResTime" class="qodef-m-time">
					<option value="5:30pm">6:30 am</option>
					<option value="5:30pm">7:00 am</option>
					<option value="5:30pm">7:30 am</option>
					<option value="5:30pm">8:00 am</option>
					<option value="5:30pm">8:30 am</option>
					<option value="5:30pm">9:00 am</option>
					<option value="5:30pm">9:30 am</option>
					<option value="5:30pm">10:00 am</option>
					<option value="5:30pm">10:30 am</option>
					<option value="5:30pm">11:00 am</option>
					<option value="5:30pm">11:30 am</option>
					<option value="5:30pm">12:00 pm</option>
					<option value="5:30pm">12:30 pm</option>
					<option value="5:30pm">1:00 pm</option>
					<option value="5:30pm">1:30 pm</option>
					<option value="5:30pm">2:00 pm</option>
					<option value="5:30pm">2:30 pm</option>
					<option value="5:30pm">3:00 pm</option>
					<option value="5:30pm">3:30 pm</option>
					<option value="5:30pm">4:00 pm</option>
					<option value="5:30pm">4:30 pm</option>
					<option value="5:30pm">5:00 pm</option>
					<option value="5:30pm">5:30 pm</option>
					<option value="6:00pm">6:00 pm</option>
					<option value="6:30pm">6:30 pm</option>
					<option value="7:00pm" selected="selected">7:00 pm</option>
					<option value="7:30pm">7:30 pm</option>
					<option value="8:00pm">8:00 pm</option>
					<option value="8:30pm">8:30 pm</option>
					<option value="9:00pm">9:00 pm</option>
					<option value="9:30pm">9:30 pm</option>
					<option value="10:00pm">10:00 pm</option>
					<option value="10:30pm">10:30 pm</option>
					<option value="11:00pm">11:00 pm</option>
					<option value="11:30pm">11:30 pm</option>
				</select>
			</div>
			
			<div class="qodef-m-field qodef-m-field-label">
				<span class="qodef-m-label"><?php esc_html_e( 'go!', 'alloggio-core' ); ?></span>
			</div>
			
			<div class="qodef-m-field qodef-m-field-book">
				<?php if ( class_exists('AlloggioCoreButtonShortcode') ) :
					$button_params['text']      = esc_html__( 'Book a Table', 'alloggio-core' );
					$button_params['html_type'] = 'submit';
					echo AlloggioCoreButtonShortcode::call_shortcode( $button_params );
				else: ?>
					<input type="submit" class="qodef-btn qodef-btn-solid" name="qodef-rf-time">
				<?php endif; ?>
			</div>
			
			<input type="hidden" name="RestaurantID" class="RestaurantID"
			       value="<?php echo esc_attr( $open_table_id ); ?>">
			<input type="hidden" name="rid" class="rid" value="<?php echo esc_attr( $open_table_id ); ?>">
			<input type="hidden" name="GeoID" class="GeoID" value="15">
			<input type="hidden" name="txtDateFormat" class="txtDateFormat" value="MM/dd/yyyy">
			<input type="hidden" name="RestaurantReferralID" class="RestaurantReferralID"
			       value="<?php echo esc_attr( $open_table_id ); ?>">
		
		</form>
		<p class="qodef-m-copyright"><?php esc_html_e( 'Powered by OpenTable', 'alloggio-core' ); ?></p>
	<?php else: ?>
		<p><?php esc_html_e( 'You haven\'t added OpenTable ID', 'alloggio-core' ); ?></p>
	<?php endif; ?>
</div>