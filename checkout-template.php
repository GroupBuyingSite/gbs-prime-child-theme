<?php
/*
Template Name: Checkout Page
*/
?>
<?php $checkout_page = Group_Buying_Checkouts::get_instance(); ?>
<?php get_header(); ?>


<div id="account_page" class="clearfix">
    
    <div id="content_wrap" class="clearfix">
        
        <div id="content" class="full clearfix">
        
            <div class="page_title clearfix">
                <h1 class="main_heading gb_ff"><span class="title_highlight"><?php gb_e('Checkout'); ?></span></h1>
            </div>
            <?php $checkout_page->view_checkout(); ?>
        </div><!-- #content -->
    
    </div><!-- #content_wrap -->    
    
</div><!-- #single_deal -->

<?php get_footer(); ?>