<style>
	.landing{
		margin-right: 15px;
		border: 1px solid #d8d8d8;
		border-top: 0;
	}
	.section{
		font-family: -apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol";
		/*background: #fafafa;*/
		background: #FFFFFF;
	}
	.section h1{
		text-align: center;
		text-transform: uppercase;
		color: #445674;
		font-size: 35px;
		font-weight: 700;
		line-height: normal;
		display: inline-block;
		width: 100%;
		margin: 50px 0 0;
	}
	.section .section-title h2{
		vertical-align: middle;
		padding: 0;
		line-height: normal;
		font-size: 24px;
		font-weight: 700;
		color: #445674;
		text-transform: uppercase;
		background: none;
		border: none;
		text-align: center;
	}
	.section p{
		margin: 15px 0;
		font-size: 19px;
		line-height: 32px;
		font-weight: 300;
		text-align: center;
	}
	.section ul li{
		margin-bottom: 4px;
	}
	.section.section-cta{
		background: #fff;
	}
	.cta-container,
	.landing-container{
		display: flex;
		max-width: 1200px;
		margin-left: auto;
		margin-right: auto;
		padding: 30px 0;
		align-items: center;
	}
	.landing-container-wide{
		flex-direction: column;
	}
	.cta-container{
		display: block;
		max-width: 860px;
	}
	.landing-container:after{
		display: block;
		clear: both;
		content: '';
	}
	.landing-container .col-1,
	.landing-container .col-2{
		float: left;
		box-sizing: border-box;
		padding: 0 15px;
	}
	.landing-container .col-1{
		width: 58.33333333%;
	}
	.landing-container .col-2{
		width: 41.66666667%;
	}
	.landing-container .col-1 img,
	.landing-container .col-2 img,
	.landing-container .col-wide img{
		max-width: 100%;
	}
	.premium-cta{
		color: #4b4b4b;
		border-radius: 10px;
		padding: 30px 25px;
		display: flex;
		align-items: center;
		justify-content: space-between;
		width: 100%;
		box-sizing: border-box;
	}
	.premium-cta:after{
		content: '';
		display: block;
		clear: both;
	}
	.premium-cta p{
		margin: 10px 0;
		line-height: 1.5em;
		display: inline-block;
		text-align: left;
	}
	.premium-cta a.button{
		border-radius: 25px;
		float: right;
		background: #e09004;
		box-shadow: none;
		outline: none;
		color: #fff;
		position: relative;
		padding: 10px 50px 8px;
		text-align: center;
		text-transform: uppercase;
		font-weight: 600;
		font-size: 20px;
		line-height: normal;
		border: none;
	}
	.premium-cta a.button:hover,
	.premium-cta a.button:active,
	.wp-core-ui .yith-plugin-ui .premium-cta a.button:focus{
		color: #fff;
		background: #d28704;
		box-shadow: none;
		outline: none;
	}
	.premium-cta .highlight{
		text-transform: uppercase;
		background: none;
		font-weight: 500;
	}

	@media (max-width: 991px){
		.landing-container{
			display: block;
			padding: 50px 0 30px;
		}

		.landing-container .col-1,
		.landing-container .col-2{
			float: none;
			width: 100%;
		}

		.premium-cta{
			display: block;
			text-align: center;
		}

		.premium-cta p{
			text-align: center;
			display: block;
			margin-bottom: 30px;
		}
		.premium-cta a.button{
			float: none;
			display: inline-block;
		}
	}
</style>
<div class="landing">
    <div class="section section-cta section-odd">
        <div class="landing-container">
			<div class="premium-cta">
				<p><?php echo sprintf ( esc_html__('Upgrade to the %1$spremium version%2$s%3$sof %1$sYITH WooCommerce Multi-step%2$s to benefit from all features!','yith-woocommerce-multi-step-checkout'),'<span class="highlight">','</span>','<br/>');?></p>
				<a href="<?php echo YITH_Multistep_Checkout()->admin->get_premium_landing_uri(); ?>" target="_blank" class="premium-cta-button button btn">
					<?php esc_html_e('Upgrade','yith-woocommerce-multi-step-checkout');?>
				</a>
			</div>
        </div>
    </div>
    <div class="one section section-even clear">
        <h1><?php esc_html_e('Premium Features','yith-woocommerce-multi-step-checkout');?></h1>
        <div class="landing-container">
            <div class="col-1">
                <img src="<?php echo YITH_WCMS_ASSETS_URL?>images/2.jpg" alt="Display styles" />
            </div>
            <div class="col-2">
                <div class="section-title">
                    <h2><?php esc_html_e('Choose among 10 different layouts for the timeline of your multi-step checkout ','yith-woocommerce-multi-step-checkout');?></h2>
                </div>
                <p>
                    <?php esc_html_e( 'You can choose among 10 different layouts for the timeline, four of them in vertical style and four of them horizontal. Set the layout that best suits your e-commerce website and the one to show to mobile users. ', 'yith-woocommerce-multi-step-checkout' );?>
                </p>
            </div>
        </div>
    </div>
    <div class="two section section-odd clear">
        <div class="landing-container">
            <div class="col-2">
                <div class="section-title">
                    <h2><?php esc_html_e('Customize the timeline colors: a checkout that suits every style and theme','yith-woocommerce-multi-step-checkout');?></h2>
                </div>
                <p>
                    <?php esc_html_e('To make sure that the checkout style can suit every e-commerce theme, you will be able to customize the colors of every step and status (previous, next and current step) and all the texts.','yith-woocommerce-multi-step-checkout');?>
                </p>
            </div>
            <div class="col-1">
                <img src="<?php echo YITH_WCMS_ASSETS_URL?>images/3.jpg" alt="Custom layout" />
            </div>
        </div>
    </div>
    <div class="three section section-even clear">
        <div class="landing-container">
            <div class="col-1">
                <img src="<?php echo YITH_WCMS_ASSETS_URL?>images/4.jpg" alt="Icons and numbers" />
            </div>
            <div class="col-2">
                <div class="section-title">
                    <h2><?php esc_html_e( 'Choose whether to show icons or numbers for your checkout steps','yith-woocommerce-multi-step-checkout'); ?></h2>
                </div>
                <p>
                    <?php esc_html_e( 'Identify your steps with numbers or icons before the text. You can choose among the many high-quality icons we’ve designed for you or upload your own ones.','yith-woocommerce-multi-step-checkout');?>
                </p>
            </div>
        </div>
    </div>
    <div class="four section section-odd clear">
        <div class="landing-container">
			<div class="col-2">
				<div class="section-title">
					<h2><?php esc_html_e( 'Merge Billing / Shipping and Order info / Payment steps to reduce the number of steps','yith-woocommerce-multi-step-checkout'); ?></h2>
				</div>
				<p>
					<?php esc_html_e( 'Usability tests confirm that a multi-step checkout is much more effective if there are no more than four steps in total. To streamline the process, combine Billing and Shipping Info into one step and Order and Payment Info into another step.','yith-woocommerce-multi-step-checkout');?>
				</p>
			</div>
            <div class="col-1">
                <img src="<?php echo YITH_WCMS_ASSETS_URL?>images/5.jpg" alt="Merge steps" />
            </div>
        </div>
    </div>
    <div class="five section section-even clear">
        <div class="landing-container">
            <div class="col-1">
                <img src="<?php echo YITH_WCMS_ASSETS_URL?>images/6.jpg" alt="Ajax validation" />
            </div>
            <div class="col-2">
				<div class="section-title">
					<h2><?php esc_html_e( 'Enable AJAX validation for every step','yith-woocommerce-multi-step-checkout'); ?></h2>
				</div>
				<p>
					<?php esc_html_e( 'With the AJAX validation you can prevent customers from going on to the next step unless they have completed all mandatory fields.','yith-woocommerce-multi-step-checkout');?>
				</p>
            </div>
        </div>
    </div>
    <div class="six section section-odd clear">
        <div class="landing-container">
            <div class="col-2">
				<div class="section-title">
					<h2><?php esc_html_e( 'Disable the Shipping step with just one click','yith-woocommerce-multi-step-checkout'); ?></h2>
				</div>
				<p>
					<?php esc_html_e( 'If your products don’t need to be shipped, just disable the Shipping step and it will not show up in the checkout process.','yith-woocommerce-multi-step-checkout');?>
				</p>
            </div>
            <div class="col-1">
                <img src="<?php echo YITH_WCMS_ASSETS_URL?>images/7.jpg" alt="Disable the shipping step" />
            </div>
        </div>
    </div>
    <div class="section section-cta section-odd">
        <div class="landing-container">
			<div class="premium-cta">
				<p><?php echo sprintf (__('Upgrade to the %1$spremium version%2$s%3$sof %1$sYITH WooCommerce Multi-step%2$s to benefit from all features!','yith-woocommerce-multi-step-checkout'),'<span class="highlight">','</span>','<br/>');?></p>
				<a href="<?php echo YITH_Multistep_Checkout()->admin->get_premium_landing_uri(); ?>" target="_blank" class="premium-cta-button button btn">
					<?php _e('Upgrade','yith-woocommerce-multi-step-checkout');?>
				</a>
			</div>

		</div>
    </div>
</div>
