<?php
	
	
	defined( 'ABSPATH' ) or die( 'Keep Quit' );
	
	if ( ! class_exists( 'Woo_Variation_Swatches_Export_Import' ) ):
		
		class Woo_Variation_Swatches_Export_Import {
			
			private $export_type = 'product';
			private $column_id   = 'woo_variation_swatches_attribute_types';
			
			public function __construct() {
				
				// EXPORT
				// "woocommerce_{$this->export_type}_export_column_names"
				//add_filter( 'woocommerce_product_export_column_names', 'add_woo_variation_gallery_export_column' );
				
				//add_filter( "woocommerce_product_export_{$this->export_type}_default_columns", array( $this, 'export_column_name' ) );
				//add_filter( "woocommerce_product_export_{$this->export_type}_column_{$this->column_id}", array( $this, 'export_column_data' ), 10, 3 );
				
				add_filter( 'woocommerce_product_export_row_data', array( $this, 'prepare_attributes_for_export' ), 10, 2 );
				
				// IMPORT
				//add_filter( 'woocommerce_csv_product_import_mapping_options', array( $this, 'import_column_name' ) );
				//add_filter( 'woocommerce_csv_product_import_mapping_default_columns', array( $this, 'default_import_column_name' ) );
				//add_action( 'woocommerce_product_import_inserted_product_object', array( $this, 'process_wc_import' ), 10, 2 );
				
			}
			
			public function prepare_attributes_for_export( $row, $product ) {
				
				//print_r( $row); die;
				//if ( $this->is_column_exporting( 'attributes' ) ) {
				$attributes         = $product->get_attributes();
				$default_attributes = $product->get_default_attributes();
				
				
				if ( count( $attributes ) ) {
					$i = 1;
					foreach ( $attributes as $attribute_name => $attribute ) {
						/* translators: %s: attribute number */
						// $row[ 'attributes:type' . $i ] = sprintf( __( 'Attribute %d type', 'woocommerce' ), $i );
						//$x[ 'attributes:type' . $i ] = sprintf( __( 'Attribute %d type', 'woocommerce' ), $i );
						/* translators: %s: attribute number */
						//$this->column_names[ 'attributes:value' . $i ] = sprintf( __( 'Attribute %d value(s)', 'woocommerce' ), $i );
						/* translators: %s: attribute number */
						//$this->column_names[ 'attributes:visible' . $i ] = sprintf( __( 'Attribute %d visible', 'woocommerce' ), $i );
						/* translators: %s: attribute number */
						//$this->column_names[ 'attributes:taxonomy' . $i ] = sprintf( __( 'Attribute %d global', 'woocommerce' ), $i );
						
						//
						
						//
						//print_r( $attribute);
						if ( is_a( $attribute, 'WC_Product_Attribute' ) ) {
							if ( $attribute->is_taxonomy() ) {
								$attr = wc_get_attribute( $attribute->get_id() );
								
								//print_r($attr);
								
								$row[ 'attributes:name' . $i ] = $row[ 'attributes:name' . $i ] . '#' . $attr->type;
							} else {
								$row[ 'attributes:name' . $i ] = $row[ 'attributes:name' . $i ] . '#' . 'select';
							}
							//$attr = wc_get_attribute( $attribute->get_id() );
							//$row[ 'attributes:type' . $i ] =  $attr->type;
							//$x[ 'attributes:type' . $i ] = $attr->type;
							//	$row[ 'attributes:type' . $i ] =  $attr->type;
						} else {
							//$row[ 'attributes:type' . $i ] = $attr->type;
						}
						
						//print_r($attr);
						
						$i ++;
					}
				}
				//}
				//print_r($row);
				//die(__FILE__);
				// array_push( $row, $x);
				return $row;
				
			}
			
			public function export_column_name( $columns ) {
				
				// column slug => column name
				$columns[ $this->column_id ] = esc_html__( 'Woo Variation Swatches Attributes types', 'woo-variation-gallery' );
				
				return $columns;
			}
			
			public function export_column_data( $value, $product, $column_id ) {
				$product_id     = $product->get_id();
				$gallery_images = get_post_meta( $product_id, 'woo_variation_gallery_images', true );
				$images         = array();
				
				foreach ( $gallery_images as $image_id ) {
					$image = wp_get_attachment_image_src( $image_id, 'full' );
					
					if ( $image ) {
						$images[] = $image[ 0 ];
					}
				}
				
				return implode( ',', $images );
			}
			
			
			public function import_column_name( $columns ) {
				// column slug => column name
				$columns[ $this->column_id ] = esc_html__( 'Woo Variation Gallery Images', 'woo-variation-gallery' );
				
				return $columns;
			}
			
			public function default_import_column_name( $columns ) {
				// potential column name => column slug
				$columns[ esc_html__( 'Woo Variation Gallery Images', 'woo-variation-gallery' ) ] = $this->column_id;
				
				return $columns;
			}
			
			public function process_wc_import( &$product, $data ) {
				
				$product_id = $product->get_id();
				
				if ( isset( $data[ $this->column_id ] ) && ! empty( $data[ $this->column_id ] ) ) {
					
					
					$woo_variation_gallery = array();
					$raw_gallery_images    = (array) explode( ',', $data[ $this->column_id ] );
					
					foreach ( $raw_gallery_images as $url ) {
						$woo_variation_gallery[] = $this->get_attachment_id_from_url( $url, $product_id );
					}
					
					update_post_meta( $product_id, 'woo_variation_gallery_images', array_values( $woo_variation_gallery ) );
				}
			}
			
			public function get_attachment_id_from_url( $url, $product_id ) {
				if ( empty( $url ) ) {
					return 0;
				}
				
				$id         = 0;
				$upload_dir = wp_upload_dir( null, false );
				$base_url   = $upload_dir[ 'baseurl' ] . '/';
				
				// Check first if attachment is inside the WordPress uploads directory, or we're given a filename only.
				if ( false !== strpos( $url, $base_url ) || false === strpos( $url, '://' ) ) {
					// Search for yyyy/mm/slug.extension or slug.extension - remove the base URL.
					$file = str_replace( $base_url, '', $url );
					$args = array(
						'post_type'   => 'attachment',
						'post_status' => 'any',
						'fields'      => 'ids',
						'meta_query'  => array( // @codingStandardsIgnoreLine.
						                        'relation' => 'OR',
						                        array(
							                        'key'     => '_wp_attached_file',
							                        'value'   => '^' . $file,
							                        'compare' => 'REGEXP',
						                        ),
						                        array(
							                        'key'     => '_wp_attached_file',
							                        'value'   => '/' . $file,
							                        'compare' => 'LIKE',
						                        ),
						                        array(
							                        'key'     => '_wc_attachment_source',
							                        'value'   => '/' . $file,
							                        'compare' => 'LIKE',
						                        ),
						),
					);
				} else {
					// This is an external URL, so compare to source.
					$args = array(
						'post_type'   => 'attachment',
						'post_status' => 'any',
						'fields'      => 'ids',
						'meta_query'  => array( // @codingStandardsIgnoreLine.
						                        array(
							                        'value' => $url,
							                        'key'   => '_wc_attachment_source',
						                        ),
						),
					);
				}
				
				$ids = get_posts( $args ); // @codingStandardsIgnoreLine.
				
				if ( $ids ) {
					$id = current( $ids );
				}
				
				// Upload if attachment does not exists.
				if ( ! $id && stristr( $url, '://' ) ) {
					$upload = wc_rest_upload_image_from_url( $url );
					
					if ( is_wp_error( $upload ) ) {
						throw new Exception( $upload->get_error_message(), 400 );
					}
					
					$id = wc_rest_set_uploaded_image_as_attachment( $upload, $product_id );
					
					if ( ! wp_attachment_is_image( $id ) ) {
						/* translators: %s: image URL */
						throw new Exception( sprintf( __( 'Not able to attach "%s".', 'woocommerce' ), $url ), 400 );
					}
					
					// Save attachment source for future reference.
					update_post_meta( $id, '_wc_attachment_source', $url );
				}
				
				if ( ! $id ) {
					/* translators: %s: image URL */
					throw new Exception( sprintf( __( 'Unable to use image "%s".', 'woocommerce' ), $url ), 400 );
				}
				
				return $id;
			}
			
		}
		
		// new Woo_Variation_Swatches_Export_Import();
	endif;