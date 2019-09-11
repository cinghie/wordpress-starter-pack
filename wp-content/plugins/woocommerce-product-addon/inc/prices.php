<?php
/**
 * PPOM Price Controls
 * 
 * */
 
 /**
 * Important function: getting prices against posted fields
 **/


function ppom_price_controller($cart_items, $values) {
    
    // ppom_pa($cart_items);
    if( empty($cart_items) ) return $cart_items;

	if( ! isset( $values['ppom']['fields'] ) ) return $cart_items;
	
	$wc_product         = $cart_items['data'];
	$product_id 	    = ppom_get_product_id($wc_product);
	$variation_id		= isset($cart_items['variation_id']) ? $cart_items['variation_id'] : '';
	$ppom_fields_post   = $values['ppom']['fields'];
	$product_quantity   = floatval($cart_items['quantity']);
	$ppom_field_prices  = ppom_get_field_prices( $ppom_fields_post, $product_id, $product_quantity, $variation_id );
	$ppom_discount      = 0;
	// ppom_pa($product_quantity);
	// ppom_pa($ppom_fields_post);
	// ppom_pa($ppom_field_prices);
	
	$total_addon_price  	= ppom_price_get_addon_total( $ppom_field_prices );
	$total_cart_fee_price	= ppom_price_get_cart_fee_total( $ppom_field_prices );
	
	// return array with: price, source
	$price_info 		= ppom_price_get_product_base( $wc_product, $ppom_fields_post, 
													$product_quantity, $ppom_field_prices, $ppom_discount);
	$product_base_price = $price_info['price'];
	// ppom_pa($price_info);
	// var_dump("product_base_price ==> ".$product_base_price."<br>");
	// var_dump("total_addon_price ==> ".$total_addon_price."<br>");   
	// var_dump("total_cart_fee_price ==> ".$total_cart_fee_price."<br>");   
	// var_dump("ppom_discount ==> ".$ppom_discount."<br>");
	
	$ppom_total_price   = $total_addon_price + $product_base_price - $ppom_discount;
	// var_dump("ppom_total_price ==> ".$ppom_total_price."<br>");
	
	do_action( 'ppom_before_calculate_cart_total', $ppom_field_prices, $ppom_fields_post, $cart_items);
	
	$ppom_total_price	= apply_filters('ppom_cart_line_total', $ppom_total_price, $cart_items, $values);
	$wc_product -> set_price($ppom_total_price);
	
	return $cart_items;
}


function ppom_get_field_prices( $ppom_fields_post, $product_id, &$product_quantity, $variation_id) {
	
	$field_prices = array();
	
	foreach( $ppom_fields_post as $data_name => $value ) {
		
		if( $data_name == 'id' ) continue;
		
		if( empty($value) ) continue;
		
		$value	= ! is_array( $value ) ? stripcslashes($value) : $value;
		
		$field_meta 	= ppom_get_field_meta_by_dataname($product_id, $data_name);
		$product		= wc_get_product($product_id);
		// ppom_pa($field_meta);
		
		$field_type 	= isset($field_meta['type']) ? $field_meta['type'] : '';
		$field_title 	= isset($field_meta['title']) ? $field_meta['title'] : '';
		
		$charge		 	= isset($field_meta['onetime']) ? $field_meta['onetime'] : '';
		$charge			= $charge == 'on' ? 'cart_fee' : 'addon';
		
		$product_price	= ppom_get_product_price( $product, $variation_id);
		
		$options		= array();
		
		// Getting options
		switch( $field_type ) {
			
			case 'bulkquantity':
				$options	= isset($field_meta['options']) ? json_decode(stripcslashes($field_meta['options']), true) : array();
				break;
			case 'image':
				$options	= isset($field_meta['images']) ? $field_meta['images'] : array();
				break;
			case 'imageselect':
				$options	= isset($field_meta['images']) ? ppom_convert_options_to_key_val($field_meta['images'], $field_meta, $product) : array();
				break;
			case 'eventcalendar':

				$disbl_global_price	= isset($field_meta['disabled_global_price']) ? $field_meta['disabled_global_price'] : '';

				if (isset($field_meta['global_price']) && $field_meta['global_price'] != '') {
					$global_price = $field_meta['global_price'];
				}else{
					$global_price = 0;
				}

				$options = isset($field_meta['options']) ? $field_meta['options'] : array();
				
				$options[]  = array('price'  => $global_price,
									'option' => 'Simple',
									'id'     => 'simple'
									);
			
				break;
			default:
				$options	= isset($field_meta['options']) ? ppom_convert_options_to_key_val($field_meta['options'], $field_meta, $product) : array();
				break;
		}
		// ppom_pa($options);
		
		
		$field_price	= '';
		$option_quantity= 1;
		
		if( ! ppom_is_cart_quantity_updatable($product_id) ) {
			$option_quantity = ppom_price_get_total_quantities($ppom_fields_post, $product_id);
		}
		
		switch( $field_type ) {
			
			case 'text':
			case 'textarea':
			case 'date':
			case 'email':
				$field_price = isset($field_meta['price']) ? $field_meta['price'] : '';
				if( $field_price !== '' ) {
					$field_prices[] = ppom_generate_field_price($field_price, $field_meta, $charge);
				}
			break;
			
			case 'select':
			case 'radio':
				
				
				foreach($options as $option) {
					
					if( $option['raw'] == $value ) {
				
						$option_price = isset($option['raw_price']) ? $option['raw_price'] : '';
						$option_percent = isset($option['percent']) ? $option['percent'] : '';
						
						if( $option_price !== '' ) {
							
							if( $option_percent !== '' ){
								$option_price = ppom_get_amount_after_percentage($product_price, $option_percent);
							}
							
							$field_prices[] = ppom_generate_field_price($option_price, $field_meta, $charge, $option, $option_quantity);
						}
						
						// weight
						if( !empty($option['option_weight'])) {
							$field_price  = 0;
							$field_prices[] = ppom_generate_field_price($field_price, $field_meta, 'weight', $option);
						}
					}
				}
			break;
			
			case 'imageselect':
				
				foreach($options as $option) {
					if( $option['id'] == $value ) {
				
						$option_price = isset($option['raw_price']) ? $option['raw_price'] : '';
						if( $option_price !== '' ) {
							if(strpos($option_price,'%') !== false){
								$option_price = ppom_get_amount_after_percentage($product_price, $option_price);
							}
							$field_prices[] = ppom_generate_field_price($option_price, $field_meta, $charge, $option, $option_quantity);
						}
					}
				}
			break;
			
			// case 'imageselect':
			case 'image':
				foreach($options as $option) {
					
					foreach($value as $images_meta) {
						
						$images_meta	= json_decode(stripslashes($images_meta), true);
						$image_id		= $images_meta['id'];
						$image_price	= $images_meta['price'];
						
						if( $option['id'] == $image_id ) {
							
							$option_price = isset($option['price']) ? $option['price'] : '';
							// var_dump($option_price);
							if( $option_price !== '' ) {
								if(strpos($option_price,'%') !== false){
									$option_price = ppom_get_amount_after_percentage($product_price, $option_price);
								}
								$field_prices[] = ppom_generate_field_price($option_price, $field_meta, $charge, $option, $option_quantity);
							}
						}
					}
				}
				// $field_prices[] = ppom_generate_field_price($option_price, $field_meta, $charge, $option);
			break;
			
			case 'checkbox':
				
				foreach($options as $option) {
					// ppom_pa($option);
					
					foreach($value as $val) {
						
						if( $option['raw'] == $val ) {
							
							$option_price = isset($option['raw_price']) ? $option['raw_price'] : '';
							if( $option_price !== '' ) {
								if(strpos($option_price,'%') !== false){
									$option_price = ppom_get_amount_after_percentage($product_price, $option_price);
								}
								$field_prices[] = ppom_generate_field_price($option_price, $field_meta, $charge, $option, $option_quantity);
							}
							
							// weight
							if( !empty($option['option_weight'])) {
								$field_price  = 0;
								$field_prices[] = ppom_generate_field_price($field_price, $field_meta, 'weight', $option);
							}
						}
					}
				}
			break;
			
			case 'quantities':
				
				if( ppom_is_field_has_price($field_meta) ) {
					// ppom_pa($options);
					foreach($options as $option) {
					$quantities_total = 0;
						
						foreach($value as $val => $quantity ) {
							
							$quantities_total += $quantity;
							
							if( $option['raw'] == $val && $quantity > 0) {
								$option_price = isset($option['raw_price']) ? $option['raw_price'] : '';
								
								/*if( ! ppom_is_field_has_price($field_meta) ) {
									$quantity = 1;
								}*/
								$field_prices[] = ppom_generate_field_price($option_price, $field_meta, $charge, $option, $quantity);
							}
						}
					}
					
					if( $quantities_total > 0 ) {
						$product_quantity = $quantities_total;
					}
				} else {
					$option_price = $product_price;
					$option = array();
					$field_prices[] = ppom_generate_field_price($option_price, $field_meta, $charge, $option, 1);
				}
				
				
				// Check if matrix used
				$pricematrix_field = ppom_has_field_by_type(ppom_get_product_id($product), 'pricematrix');
				if ( $pricematrix_field ) {
					$matrix_found   = ppom_price_matrix_chunk($product, $pricematrix_field, $product_quantity);
				    
					if( $matrix_found ) {
						// $option_price = $matrix_found['matrix_price'];
						$charge = 'matrix_quantities';
						$field_prices[] = ppom_generate_field_price($option_price, $field_meta, $charge, $option, $product_quantity);
					}
				}
			break;
			
			
			case 'bulkquantity':
				$product_quantity	= $value['qty'];
				$bq_value			= $value['option'];
				// $option				= null;
				
				$bq_found = ppom_price_bulkquantity_chunk($product, $options, $product_quantity);
				$option_price = isset($bq_found[$bq_value]) ? floatval($bq_found[$bq_value]) : null;
				if( $option_price ) {
					$field_prices[] = ppom_generate_field_price($option_price, $field_meta, $charge, $bq_found, $product_quantity);
				}
				// ppom_pa($bq_found);
			break;
			
			case 'fixedprice':
				
				$fp_found = ppom_price_fixedprice_chunk($product, $options, $product_quantity);
				$unit_price = PPOM_FP()->get_unit_price($fp_found, $field_meta);
				if( $unit_price ) {
					$field_prices[] = ppom_generate_field_price($unit_price, $field_meta, $charge, $fp_found, $product_quantity);
				}
				break;
				
			case 'measure':
				// var_dump($value);
				$product_quantity	= $value;
				$unit_price			= 0;
				$field_prices[] 	= ppom_generate_field_price($unit_price, $field_meta, $charge, $options, $product_quantity);
				break;
				
			case 'eventcalendar':

				// if( ppom_is_field_has_price($field_meta) ) { // Waite & Watch Party
				if( 1 ) {
					foreach ($options as $ticket) {
						
						$quantities_total = 0;
						$ticket_label  = isset($ticket['option']) ? $ticket['option'] : '';
						
						foreach ($value as $date => $ticket_meta) {
							
							
							foreach($ticket_meta as $label => $qty) {
								
								$quantities_total += $qty;
								
								if($ticket_label == $label) {
									$ticket_price  = isset($ticket['price']) ? $ticket['price'] : '';
									$field_prices[] = ppom_generate_field_price($ticket_price, $field_meta, $charge, $options, $qty);
								}
							}
						}
						
						if( $quantities_total > 0 ) {
							$product_quantity = $quantities_total;
						}
					}
				}
			
				break;
			
		}
		
		
	}
	
	// ppom_pa($field_prices);
	
	return apply_filters('ppom_fields_prices', $field_prices, $ppom_fields_post, $product_id);
}

function ppom_generate_field_price($field_price, $field_meta, $apply, $option=array(), $qty=0 ) {

	// ppom_pa($option);
	
	$data_name	= isset($field_meta['data_name']) ? $field_meta['data_name'] : '';
	$field_title= isset($field_meta['title']) ? $field_meta['title'] : '';
	$field_type	= isset($field_meta['type']) ? $field_meta['type'] : '';
	$taxable	= (isset($field_meta['onetime_taxable']) && $field_meta['onetime_taxable'] == 'on') ? true : false;
	$option_label= isset($option['raw']) ? $option['raw'] : '';
	$without_tax= isset($option['without_tax']) ? $option['without_tax'] : '';
	
	$label_price = "{$field_title} - ".wc_price($field_price);
	// For bulkquantity
	$base_price	= isset($option['Base Price']) ? $option['Base Price'] : '';
	$option_id	= isset($option['option_id']) ? $option['option_id'] : '';
	
	/*if( $apply == 'fixedprice' ) {
		$base_price = $field_price;
		$field_price = 0;
	}*/
	
	return apply_filters('ppom_price_option_meta', 
						array(
							'type'			=> $field_type,
							'option_id'		=> $option_id,
							'label'			=> $field_title,
							'label_price'	=> sprintf(__("%s", "ppom"), $label_price),
							'price'			=> $field_price,
							'apply'			=> $apply,
							'data_name'		=> $data_name,
							'taxable'		=> $taxable,
							'without_tax'	=> $without_tax,
							'option_label'	=> $option_label,
							'quantity'		=> $qty,
							'base_price'	=> $base_price,
							),
						$field_meta,
						$field_price,
						$option,
						$qty
						);
}

// Get total addon price of given Price Array
function ppom_price_get_addon_total($price_array) {
    
    $total_addon = 0;
    
    if($price_array) {
        foreach( $price_array as $price ) {
            
            if( $price['apply'] != 'addon' ) continue;
            
        	$total_addon += ($price['price'] * $price['quantity']);
        	
            /*if( $price['type'] == 'quantities' || $price['type'] == 'bulkquantity' ) {
            	$total_addon += ($price['price'] * $price['quantity']);
            } else {
	            $total_addon += $price['price'];
            }*/
        }
    }
    
    return $total_addon;
}

// Get total cart_fee price of given Price Array
function ppom_price_get_cart_fee_total($price_array) {
    
    $total_cart_fee = 0;
    
    if($price_array) {
        foreach( $price_array as $price ) {
            
            if( $price['apply'] == 'cart_fee' )
                $total_cart_fee += $price['price'];
        }
    }
   
    return $total_cart_fee;
}

// Get total quantities
function ppom_price_get_total_quantities($ppom_fields_post, $product_id) {
    
    $total_quantities	= 0;
    
    foreach( $ppom_fields_post as $data_name => $value ) {
		
		if( $data_name == 'id' ) continue;
		
		if( empty($value) ) continue;
		
		$field_meta 	= ppom_get_field_meta_by_dataname($product_id, $data_name);
		$field_type 	= isset($field_meta['type']) ? $field_meta['type'] : '';
		
		switch($field_type) {
			
			case 'quantities':
				$total_quantities = 0;
				foreach($value as $option => $qty){
					$total_quantities += $qty;
				}
			break;
			
			case 'bulkquantity':
				$total_quantities = 0;
				foreach($value as $option => $qty){
					$total_quantities += $qty;
				}
				
			case 'eventcalendar':
				$total_quantities = 0;
				foreach($value as $date => $ticket_meta) {
					foreach($ticket_meta as $option => $qty){
						$total_quantities += $qty;
					}
				}
			break;
			
		}
    }
    
    return $total_quantities;
}

// Get total bulkquantities
function ppom_price_get_total_bulkquantities($price_array) {
    
    $total_bulkquantities	= 0;
    $total_bq_baseprice		= 0;
    if($price_array) {
        foreach( $price_array as $price ) {
            
            if( $price['type'] == 'bulkquantity' )
  
                $total_bulkquantities += intval($price['quantity']);
                $total_bq_baseprice		+= intval($price['base_price']);
        }
    }
   
	$bq_data = array('quantity' => $total_bulkquantities, 'base_price' => $total_bq_baseprice);
    return $bq_data;
}

// Get total fixedprice
function ppom_price_get_total_fixedprice($price_array) {
    
    $total_fixedprice	= 0;
    $total_fp_qty		= 0;
    
    if($price_array) {
        foreach( $price_array as $price ) {
            
            if( $price['type'] == 'fixedprice' ) {
                $total_fixedprice	+= $price['price'];
                $total_fp_qty		+= $price['quantity'];
            }
        }
    }
   
	$fixedprice_data = array('quantity' => $total_fp_qty, 'base_price' => $total_fixedprice);
    return $fixedprice_data;
}

// Get total fixedprice
function ppom_price_get_total_measure($price_array) {
    
    $total_measure	= 0;
    
    if($price_array) {
        foreach( $price_array as $price ) {
            
            if( $price['type'] == 'measure' ) {
            	if( $total_measure == 0 ) {
                	$total_measure	= $price['quantity']; 
            	} else {
            		$total_measure	*= $price['quantity']; 
            	}
            }
        }
    }
   
    return $total_measure;
}

// Get product base price
function ppom_price_get_product_base( $product, $ppom_fields_post, 
									$product_quantity, $ppom_field_prices, &$ppom_discount ) {
    
    // converting back to org price if Currency Switcher is used
	$base_price	= ppom_hooks_convert_price_back($product->get_price());
	// $base_price = floatval($base_price);
	// $base_price	= $product->get_price();
	// var_dump($product->get_price());
	// var_dump($product_quantity);
	
	$total_addon_price  	= ppom_price_get_addon_total( $ppom_field_prices );
	$total_cart_fee_price	= ppom_price_get_cart_fee_total( $ppom_field_prices );
	$product_id				= ppom_get_product_id($product);
	
	$source		= 'product';
	
	$matrix_found		= ppom_price_is_matrix_found(	$product, 
														$product_quantity, 
														$base_price,
														$total_addon_price,
														$total_cart_fee_price
														);
	$quantities_found	= ppom_price_get_total_quantities( $ppom_fields_post, $product_id );
	$bulkquantities_found= ppom_price_get_total_bulkquantities( $ppom_field_prices );
	$fixedprice_found	= ppom_price_get_total_fixedprice( $ppom_field_prices );
	$measure_found		= ppom_price_get_total_measure( $ppom_field_prices );
	
	// If price matrix found
	// var_dump($matrix_found);
	if( $matrix_found ) {
		
		if( isset($matrix_found['matrix_price']) && $matrix_found['matrix_price'] != '') {
			
			$base_price = $matrix_found['matrix_price'];
			$source		= 'matrix';
		} else if( isset($matrix_found['matrix_discount']) && $matrix_found['matrix_discount'] != '' ) {
			$matrix_discount = $matrix_found['matrix_discount'];
			$base_price = floatval($base_price) - $matrix_discount;
			$source		= 'matrix_discount';
		}
		
	}
	
	// If quantities found
	// var_dump($base_price);
	if( $quantities_found > 0 ) {
		
		if( ! ppom_is_cart_quantity_updatable( $product_id ) ) {
			$base_price = $base_price * $product_quantity;
		}
	}
	
	// If Bulkquantities found, no base price is effective
	if( $bulkquantities_found['quantity'] > 0 ) {
		$base_price = $bulkquantities_found['base_price'];
		$source		= 'bulkquantities';
	}
	
	// If Fixedprice found, Set base price
	if( $fixedprice_found['quantity'] > 0 ) {
		$base_price = 0;
		$source		= 'fixedprice';
	}
	
	// If Measure found, Set base price
	if( $measure_found > 0 ) {
		$base_price *= $measure_found;
		$source		= 'measure';
	}
	
	$price_info = array('price'	=> $base_price, 'source' => $source);
	return apply_filters('ppom_price_info', $price_info, $product, $ppom_fields_post, $ppom_field_prices) ;
}

// If price set by pricematrix in cart return matrix
function ppom_price_matrix_chunk($product, $pricematrix_fields, $product_quantity) {
	
	$matrix_found   = array();
	$pm_applied     = array();

	if( count($pricematrix_fields) > 0 ) {
		
		foreach( $pricematrix_fields as $pm ) {
		    
		    $pm_dataname = isset($pm['data_name']) ? $pm['data_name'] : '';
		    if( ppom_is_field_hidden_by_condition( $pm_dataname ) ) continue;
		    
		    $pm_applied = $pm;
		    break;
		}
		$matrix_found = ppom_extract_matrix_by_quantity($pm_applied, $product, $product_quantity);
		// ppom_pa($matrix_found);
	}
	
	return apply_filters('ppom_price_matrix_chunk_cart', $matrix_found, $product, $pm_applied);
}

// If Bulkquantity add-on is used, get it's chunk
function ppom_price_bulkquantity_chunk($product, $bulkquantity_options, $product_quantity) {
	
	$bq_found   = array();

	if( count($bulkquantity_options) > 0 ) {
		
		foreach( $bulkquantity_options as $bq ) {
		    
		    // ppom_pa($bq);
		    $range	= $bq['Quantity Range'];
		    $range_array	= explode('-', $range);
			$range_start	= intval($range_array[0]);
			$range_end		= intval($range_array[1]);
			
			// var_dump($bq);
			$quantity = intval($product_quantity);
			if( $quantity >= $range_start && $quantity <= $range_end ) {
				$bq_found = $bq;
				break;
			}
		}
	}
	
	return apply_filters('ppom_price_bulkquantity_chunk_cart', $bq_found, $product);
}


// If Bulkquantity add-on is used, get it's chunk
function ppom_price_fixedprice_chunk($product, $fixedprice_options, $product_quantity) {
	
	$fixedprice_found   = array();

	if( count($fixedprice_options) > 0 ) {
		
		foreach( $fixedprice_options as $fp ) {
		    
		    $fp_dataname = isset($fp['data_name']) ? $fp['data_name'] : '';
		    if( ppom_is_field_hidden_by_condition( $fp_dataname ) ) continue;
		    
		    if( $fp['raw'] == $product_quantity ) {
		    	$fixedprice_found = $fp;
		    	break;
		    }
		}
	}
	
	return apply_filters('ppom_price_fixedprice_chunk_cart', $fixedprice_found, $product);
	
}

/**
 * Calculating Fixed Fees 
 * **/

function ppom_price_cart_fee( $cart ) {
	
	$fee_no = 1;
	foreach( $cart->get_cart() as $item ){
	
		if( ! isset( $item['ppom']['fields'] ) ) continue;
		
		$ppom_fields_post   = $item['ppom']['fields'];
		$product_id			= $item['product_id'];
		$variation_id		= isset($item['variation_id']) ? $item['variation_id'] : '';
		$quantity			= $item['quantity'];
		$ppom_field_prices  = ppom_get_field_prices( $ppom_fields_post, $product_id, $quantity, $variation_id );
		// ppom_pa($ppom_field_prices);
		
		foreach( $ppom_field_prices as $fee ) {
			
			if( $fee['apply'] != 'cart_fee' ) continue;
			
			$label			= $fee['label'];
			$option_label	= isset($fee['option_label']) ? $fee['option_label'] : '';
			$fee_price		= apply_filters('ppom_option_price', $fee['price']);
			$taxable		= $fee['taxable'];
			
			$label = "{$fee_no}-{$label}-{$option_label}";
			$label = apply_filters('ppom_fixed_fee_label', $label, $fee, $item);
			
			
			if( !empty($fee['without_tax']) ) {
				$fee_price = $fee['without_tax'];
			}
			
			// if(  'incl' === get_option( 'woocommerce_tax_display_shop' ) ) {
			// 	$taxable = false;
			// }
			
			$fee_price	= apply_filters('ppom_cart_fixed_fee', $fee_price, $fee, $cart);
			
			if( $fee_price != 0 ) {
				$cart -> add_fee( sprintf(__( "%s", "ppom"), esc_html($label)), $fee_price, $taxable );
				$fee_no++;
			}
		}
	}
}

// Check if price is being pulled by matrix
function ppom_price_is_matrix_found( $product, $product_quantity, $base_price, $addon_price, $cart_fee ) {
	
	$matrix_discount	= 0.0;
	$matrix_price		= 0.0;
	// Check if Price Matrix is used
	$pricematrix_field = ppom_has_field_by_type(ppom_get_product_id($product), 'pricematrix');
	if ( ! $pricematrix_field ) return null;
	    
    $matrix_found   = ppom_price_matrix_chunk($product, $pricematrix_field, $product_quantity);
    // ppom_pa($matrix_found);
 
    if( isset($matrix_found['discount']) ) {
        if( isset($matrix_found['percent']) ) {
            
            // If discount only on BASE Price
            $price_tobe_discount = $base_price;
            // If discount only on BASE Price + Options
            if( $matrix_found['discount'] == 'both' ) {
                $price_tobe_discount += $addon_price + $cart_fee;
            }
            
            $matrix_discount = ppom_get_amount_after_percentage($price_tobe_discount, $matrix_found['percent']);
            $matrix_discount = floatval($matrix_discount);
            // var_dump($price_tobe_discount);
        } else {
            $matrix_discount = isset($matrix_found['raw_price']) ? floatval($matrix_found['raw_price']) : 0;
        }
    } else {
        $matrix_price     = isset($matrix_found['raw_price']) ? $matrix_found['raw_price'] : $base_price;
    }
    
    $matrix	= array('matrix_price' => $matrix_price, 'matrix_discount' => $matrix_discount );
    return apply_filters('ppom_price_is_matrix_found', $matrix, $product);
}

function ppom_is_field_has_price( $meta ) {
        
    $type = isset($meta['type']) ? $meta['type'] : '';
    $has_price = false;
    
    switch( $type ) {
        
        case 'quantities':
            if( isset($meta['default_price']) && $meta['default_price'] != '' ) {
                $has_price = true;
                break;
            }
            
            if( isset($meta['options']) ) {
                foreach($meta['options'] as $option) {
                    if( isset($option['price']) && $option['price'] != '' ) {
                        $has_price = true;
                        break;
                    }
                }
            }
        break;
        
        case 'eventcalendar':
        	if( isset($meta['options']) ) {
                foreach($meta['options'] as $option) {
                    if( isset($option['price']) && $option['price'] != '' ) {
                        $has_price = true;
                        break;
                    }
                }
            }
    	break;
        
        default:
        	if( isset($meta['options']) ) {
                foreach($meta['options'] as $option) {
                    if( isset($option['price']) && $option['price'] != '' ) {
                        $has_price = true;
                        break;
                    }
                }
            }
        break;
        
    }
    
    return apply_filters('ppom_field_has_price', $has_price, $meta);
}


// Return ammount after apply percent
function ppom_get_amount_after_percentage($base_amount, $percent) {
	
	$base_amount	= floatval($base_amount);
	$percent_amount = 0;
	$percent		= substr( $percent, 0, -1 );
	$percent_amount	= wc_format_decimal( (floatval($percent) / 100) * $base_amount, wc_get_price_decimals());
	
	return $percent_amount;
}
