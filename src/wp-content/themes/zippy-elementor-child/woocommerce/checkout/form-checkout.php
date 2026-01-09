<?php

/**
 * Checkout Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-checkout.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.5.0
 */

if (! defined('ABSPATH')) {
  exit;
}
// Waiver Form
do_action('woocommerce_before_checkout_form', $checkout);
// If checkout registration is disabled and not logged in, the user cannot checkout.
if (! $checkout->is_registration_enabled() && $checkout->is_registration_required() && ! is_user_logged_in()) {
  echo esc_html(apply_filters('woocommerce_checkout_must_be_logged_in_message', __('You must be logged in to checkout.', 'woocommerce')));
  return;
}
?>
<div class="loading-container loading">
  <?php echo form_waiver(); ?>
  <form name="checkout" method="post" class="checkout woocommerce-checkout" action="<?php echo esc_url(wc_get_checkout_url()); ?>" enctype="multipart/form-data">
    <?php if ($checkout->get_checkout_fields()) : ?>
      <?php do_action('woocommerce_checkout_before_customer_details'); ?>
      <div class="col2-set" id="customer_details">
        <div class="col-1">
          <?php do_action('woocommerce_checkout_billing'); ?>
          <?php do_action('woocommerce_checkout_shipping'); ?>
        </div>
        <div class="col-2">
          <h3 id="order_review_heading"><?php esc_html_e('Your order', 'woocommerce'); ?></h3>
          <?php do_action('woocommerce_checkout_before_order_review'); ?>
          <div id="order_review" class="woocommerce-checkout-review-order">
            <!-- Delivery method part  -->
            <?php get_template_part('template-parts/checkout/delivery-review', ''); ?>
            <?php do_action('woocommerce_checkout_order_review'); ?>
          </div>
          <?php do_action('woocommerce_checkout_after_customer_details'); ?>
        </div>
      </div>


    <?php endif; ?>


    <?php do_action('woocommerce_checkout_before_order_review_heading'); ?>


    <?php do_action('woocommerce_checkout_after_order_review'); ?>

  </form>
</div>


<?php
function form_waiver()
{
?>
  <span class="loader"></span>
  <div class="waiver-form-block">
    <h3>Waiver Agreement</h3>
    <a class="waiver_link" target="_blank" href="/waiver"><span class="notice-dot">*</span>Please read and complete the form</a>
    <div class="waiver">
      <form id="waiver-form">
        <div class="customer-information-block">
          <!-- Parent detail -->
          <div class="parent-infomation-block">
            <h3>Parent/Guardian details <span class="notice-dot">*</span></h3>
            <div>
              <label>First Name<span class="notice-dot">*</span></label>
              <input type="text" class="parent_first_name" name="parent_first_name" required>
            </div>
            <div>
              <label>Last Name<span class="notice-dot">*</span></label>
              <input type="text" class="parent_last_name" name="parent_last_name" required>
            </div>
            <div>
              <label>Phone Number <span class="notice-dot">*</span></label>
              <input type="tel" class="phone_text" name="phone" placeholder="+65 1234 5678" required>
            </div>
            <div>
              <label>Email <span class="notice-dot">*</span></label>
              <input type="email" class="email_text" name="email" placeholder="example@example.com" required>
            </div>
          </div>
          <!-- Child detail -->
          <div class="children-information-block">
            <div class="add-children-section add-children-section-default">
              <h3>Child details <span class="notice-dot">*</span></h3>
              <div class="child-section">
                <div class="child-field">
                  <label>First Name</label>
                  <input type="text" class="child_first_name" name="child_first_name">
                </div>
                <div class="child-field">
                  <label>Last Name</label>
                  <input type="text" class="child_last_name" name="child_last_name">
                </div>
                <div class="child-field">
                  <label>Birthday</label>
                  <input type="text" class="child_birthday js-birthday-picker flatpickr-input" name="child_birthday">
                </div>
                <div class="children-remove">
                  <span class="main-content-remove" style="cursor:pointer; color:red;">Remove</span>
                </div>
              </div>
            </div>
            <button type="button" id="add-child">Add Child Details</button>
          </div>
        </div>
        <!-- Check all boxed -->
        <div class="consent-section">
          <h3>Consent <span class="notice-dot">*</span></h3>
          <div class="consent-item">
            <input id="consent_check_all" type="checkbox" name="consent_check_all">
            <label class="check-all-label" for="consent_check_all">
              Check all boxes
            </label>
          </div>
          <div class="divider-block">
            <div class="divider"></div>
          </div>
          <div class="consent-item">
            <input id="consent_self" type="checkbox" name="consent_self" required>
            <label for="consent_self">
              I am at least 18 years old and I have read and agree to the terms of this Waiver and Consent for myself.
            </label>
          </div>
          <div class="consent-item">
            <input id="consent_guardian" type="checkbox" name="consent_guardian" required>
            <label for="consent_guardian">
              I am the parent or legal guardian of the listed minors, or am the duly authorised agent of the parent or legal guardian of the listed minors, and have due authority to agree to the terms of this Waiver and Consent on their behalf.
            </label>
          </div>
          <div class="consent-item">
            <input id="consent_terms" type="checkbox" name="consent_terms" required>
            <label for="consent_terms">
              I have read and agree to the terms of Giggle Jungle by Yooland Conditions of Sale and Privacy Policy.
            </label>
          </div>
        </div>
        <button class="confirmation-button" type="submit">Submit</button>
      </form>
    </div>
  </div>
<?php
}
