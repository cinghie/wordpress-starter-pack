<?php
/**
 * input quantities render
 *
 **/

ppom_direct_access_not_allowed();

// ppom_pa($default_value);

global $product;
$options = isset($args['options']) ? $args['options'] : null;
// ppom_pa($args);
echo '<input type="hidden" name="ppom_quantities_option_price" id="ppom_quantities_option_price">';

if (isset($args['view_control']) && $args['view_control'] == 'horizontal') { ?>
<div class="nm-horizontal-layout">
	<table class="table table-bordered table-hover">
       <thead> 
	    <tr>
	       <th><?php _e('Options', "ppom");?></th>
        <?php foreach($options as $opt){ ?>
        	<th>
    			<label class="quantities-lable"> <?php echo stripslashes(trim($opt['option'])); ?>
        		
    			<?php if( $opt['price'] ){
    				echo ' <span>'.wc_price($opt['price']).'</span>';
    			} ?>

    			</label>
        	</th>
        <?php } ?>
	    </tr>
	    </thead>
	    
	    <tr>
	        <th><?php _e('Quantity', "ppom");?></th>
        <?php foreach($options as $opt){ ?>
        	<td>
        		<?php
        		
        			$product_price	= $product->get_type() == 'simple' ? $product->get_price() : '';
        			$the_price		= !empty($opt['price']) ? $opt['price'] : $product_price;
        			$usebaseprice	= !empty($opt['price']) ? 'no' : 'yes';
        			
        			$min = (isset($opt['min']) ? $opt['min'] : 0 );
        			$max = (isset($opt['max']) ? $opt['max'] : 10000 );
        			$required = ($args['required'] == 'on' ? 'required' : '');
        			$label  = $opt['option'];
        			$name = $args['name'].'['.$label.']';
        			
        			// Default value
        			$selected_val = 0;
        			if($default_value){
	        			foreach($default_value as $k => $v) {
	        				if( $k == $label ) {
	        					$selected_val = $v;
	        				}
	        			}
        			}
        			
    				$input_html	 = '<input style="width:50px;text-align:center" '.esc_attr($required);
    				$input_html	.=' min="'.esc_attr($min).'" max="'.esc_attr($max).'" ';
    				$input_html	.= 'data-label="'.esc_attr($label).'" ';
    				$input_html	.= 'data-includeprice="'.esc_attr($args['include_productprice']).'" ';
    				$input_html	.= 'name="'.esc_attr($name).'" type="number" class="ppom-quantity" ';
    				$input_html	.= 'data-usebase_price="'.esc_attr($usebaseprice).'" ';
    				$input_html	.= 'value="'.esc_attr($selected_val).'" data-price="'.esc_attr($the_price).'">';          
    				
    				echo $input_html;
        		?>
        	</td>
        <?php } ?>
	    </tr>
	</table>
</div>
<?php } elseif (isset($args['view_control']) && $args['view_control'] == 'grid') { ?>

    <!-- Enable Grid View -->
    <div class="form-row  ppom-quantity-box-wrapper">
        
        <?php 
            foreach($options as $opt){ 

                $min    = (isset($opt['min']) ? $opt['min'] : 0 );
                $max    = (isset($opt['max']) ? $opt['max'] : 10000 );
                
                $product_price = $product->get_type() == 'simple' ? $product->get_price() : '';
                $the_price = !empty($opt['price']) ? $opt['price'] : $product_price;
                $usebaseprice   = !empty($opt['price']) ? 'no' : 'yes';
            
                $label  = $opt['option'];
                $name   = $args['name'].'['.$label.']';

                $required = ($args['required'] == 'on' ? 'required' : '');
                
                // Default value
                $selected_val = 0;
                if($default_value){
                    foreach($default_value as $k => $v) {
                        if( $k == $label ) {
                            $selected_val = $v;
                        }
                    }
                }
        ?>
        <div class="col-md-3 ppom-quantity-box-cols text-center">
            <div class="ppom-quantity-label">

                <label class="quantities-lable"> <?php echo stripslashes(trim($opt['option'])); ?>

                </label>
                <?php if ($opt['price']): ?>
                    <span class="ppom-quantity-price-wrap"><?php echo wc_price($opt['price']); ?></span>
                <?php endif ?>
            </div>

            <span class="ppom-quantity-qty-section">
                <input min="<?php echo esc_attr($min); ?>" max="<?php echo esc_attr($max); ?>" data-label="<?php echo esc_attr($label); ?>" data-includeprice="<?php echo esc_attr($args['include_productprice']); ?>" name="<?php echo esc_attr($name); ?>" type="number" class="ppom-quantity" data-usebase_price="<?php echo esc_attr($usebaseprice); ?>" value="<?php echo esc_attr($selected_val); ?>" placeholder="0" data-price="<?php echo esc_attr($the_price); ?>" <?php echo esc_attr($required); ?> style="width: 50%;">
            </span>
        </div>
        <?php } ?>
    </div>

<?php } else { ?>
	<table class="table table-bordered table-hover">
	    <thead>
    	    <tr>
    	        <th><?php _e('Options', "ppom");?></th>
    	        <th><?php _e('Quantity', "ppom");?></th>
    	    </tr>
    	</thead>
        <?php foreach($options as $opt){ ?>
		    <tr>
                	<th>
            			<label class="quantities-lable"> <?php echo stripslashes(trim($opt['option'])); ?>
                		
            			<?php if( $opt['price'] ){
            				echo ' <span>'.wc_price($opt['price']).'</span>';
            			} ?>

            			</label>
                	</th>
                	<td>
                		<?php
	            			$min	= (isset($opt['min']) ? $opt['min'] : 0 );
	            			$max	= (isset($opt['max']) ? $opt['max'] : 10000 );
	            			
	            			$product_price = $product->get_type() == 'simple' ? $product->get_price() : '';
        					$the_price = !empty($opt['price']) ? $opt['price'] : $product_price;
        					$usebaseprice	= !empty($opt['price']) ? 'no' : 'yes';
        				
	            			$label  = $opt['option'];
	            			$name	= $args['name'].'['.$label.']';
	            			
	            			// Default value
		        			$selected_val = 0;
		        			if($default_value){
			        			foreach($default_value as $k => $v) {
			        				if( $k == $label ) {
			        					$selected_val = $v;
			        				}
			        			}
		        			}
	            			
	            			$required = ($args['required'] == 'on' ? 'required' : '');
            				$input_html	 = '<input style="width:50px;text-align:center" '.esc_attr($required);
            				$input_html	.=' min="'.esc_attr($min).'" max="'.esc_attr($max).'" ';
            				$input_html	.= 'data-label="'.esc_attr($label).'" ';
            				$input_html	.= 'data-includeprice="'.esc_attr($args['include_productprice']).'" ';
            				$input_html	.= 'name="'.esc_attr($name).'" type="number" class="ppom-quantity" ';
            				$input_html	.= 'data-usebase_price="'.esc_attr($usebaseprice).'" ';
            				$input_html	.= 'value="'.esc_attr($selected_val).'" placeholder="0" data-price="'.esc_attr($the_price).'">';
            				
            				echo $input_html;
                		?>
                	</td>
		    </tr>
        <?php } ?>
	</table>

<?php } ?>

<div id="display-total-price">
	<span style="display:none;font-weight:700" class="ppom-total-option-price">
		<?php echo __("Options Total: ", "ppom"); printf(__(get_woocommerce_price_format(), "ppom"), get_woocommerce_currency_symbol(), '<span class="ppom-price"></span>');?>
	</span><br>
	<span style="display:none;font-weight:700" class="ppom-total-price">
		<?php echo __("Product Total: ", "ppom"); printf(__(get_woocommerce_price_format(), "ppom"), get_woocommerce_currency_symbol(), '<span class="ppom-price"></span>');?>
	</span>
	<span style="display:none;font-weight:700" class="ppom-grand-total-price">
	<hr style="margin: 0">
		<?php echo __("Grand Total: ", "ppom"); printf(__(get_woocommerce_price_format(), "ppom"), get_woocommerce_currency_symbol(), '<span class="ppom-price"></span>');?>
	</span>
</div>