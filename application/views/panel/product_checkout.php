<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Direct Order</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= site_url('panel/dashboard') ?>">Home</a></li>
                        <li class="breadcrumb-item active">Direct Order</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <?= $alert ?>
                    <?= validation_errors(); ?>
                    <div class="card">
                        <!-- /.card-header -->
                        <div class="card-body">
                            <form role="form" method="post"
                                  action="<?= site_url('panel/product/checkout/' . $user_id) ?>">
                                <input type="hidden" name="user_id" value="<?= $user_id ?>" id="user_id">
                                <table class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th colspan="2"><h3>Search</h3></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td width="25%"><label>Search Customer</label></td>
                                        <td>
                                            <select name="customer" id="customer"
                                                    class="select2_customer_search form-control"
                                                    onchange="customer_checkout(this.value)">
                                                <option>Search</option>
                                            </select>
                                            <?= form_error('customer') ?>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                                <?php if ($profile): ?>
                                <table class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th colspan="2"><h3>Customer Details</h3></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php if ($profile->first_name): ?>
                                        <tr>
                                            <td width="25%"><label>First Name</label></td>
                                            <td>
                                                <?= $profile->first_name ?>
                                            </td>
                                        </tr>
                                    <?php endif; ?>
                                    <?php if ($profile->last_name): ?>
                                        <tr>
                                            <td width="25%"><label>Last Name</label></td>
                                            <td>
                                                <?= $profile->last_name ?>
                                            </td>
                                        </tr>
                                    <?php endif; ?>
                                    <?php if ($profile->address): ?>
                                        <tr>
                                            <td width="25%"><label>Address</label></td>
                                            <td>
                                                <?= $profile->address ?>
                                            </td>
                                        </tr>
                                    <?php endif; ?>
                                    <?php if ($profile->company): ?>
                                        <tr>
                                            <td width="25%"><label>Company</label></td>
                                            <td>
                                                <?= $profile->company ?>
                                            </td>
                                        </tr>
                                    <?php endif; ?>
                                    <?php if ($profile->email): ?>
                                        <tr>
                                            <td width="25%"><label>Email</label></td>
                                            <td>
                                                <?= $profile->email ?>
                                            </td>
                                        </tr>
                                    <?php endif; ?>
                                    <?php if ($profile->city): ?>
                                        <tr>
                                            <td width="25%"><label>City</label></td>
                                            <td>
                                                <?= $profile->city ?>
                                            </td>
                                        </tr>
                                    <?php endif; ?>
                                    <?php if ($profile->state): ?>
                                        <tr>
                                            <td width="25%"><label>State</label></td>
                                            <td>
                                                <?= $profile->state ?>
                                            </td>
                                        </tr>
                                    <?php endif; ?>
                                    <?php if ($profile->country): ?>
                                        <tr>
                                            <td width="25%"><label>Country</label></td>
                                            <td>
                                                <?= $profile_country ? $profile_country->name : $profile->country ?>
                                            </td>
                                        </tr>
                                    <?php endif; ?>
                                    <?php if ($profile->phone): ?>
                                        <tr>
                                            <td width="25%"><label>Phone</label></td>
                                            <td>
                                                <?= $profile->phone ?>
                                            </td>
                                        </tr>
                                    <?php endif; ?>
                                    <?php if ($profile->fax): ?>
                                        <tr>
                                            <td width="25%"><label>Fax</label></td>
                                            <td>
                                                <?= $profile->fax ?>
                                            </td>
                                        </tr>
                                    <?php endif; ?>

                                    </tbody>
                                </table>
                                <div class="row">
                                    <table class="table table-bordered">
                                        <thead>
                                        <tr>
                                            <th colspan="2"><h3>Billing Address</h3></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td width="25%"><label>First Name</label></td>
                                            <td>
                                                <input type="text"
                                                       class="form-control <?= $current_language->direction == 'rtl' ? 'direction-rtl' : '' ?>"
                                                       id="first_name" placeholder="First Name" name="first_name"
                                                       value="<?= set_value('first_name', empty($profile->first_name) ? '' : $profile->first_name) ?>">
                                                <?php echo form_error('first_name'); ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="25%"><label>Last Name</label></td>
                                            <td><input type="text"
                                                       class="form-control <?= $current_language->direction == 'rtl' ? 'direction-rtl' : '' ?>"
                                                       id="last_name" placeholder="Last Name" name="last_name"
                                                       value="<?= set_value('last_name', empty($profile->last_name) ? '' : $profile->last_name) ?>">
                                                <?php echo form_error('last_name'); ?></td>
                                        </tr>
                                        <tr>
                                            <td width="25%"><label>Address</label></td>
                                            <td><textarea
                                                        class="form-control <?= $current_language->direction == 'rtl' ? 'direction-rtl' : '' ?>"
                                                        id="address" placeholder="Address"
                                                        name="address"><?= set_value('address', empty($profile->address) ? '' : $profile->address) ?></textarea>
                                                <?php echo form_error('address'); ?></td>
                                        </tr>
                                        <tr>
                                            <td width="25%"><label>Company</label></td>
                                            <td><input type="text"
                                                       class="form-control <?= $current_language->direction == 'rtl' ? 'direction-rtl' : '' ?>"
                                                       id="company_name" placeholder="Company" name="company_name"
                                                       value="<?= set_value('company_name', empty($profile->city) ? '' : $profile->city) ?>">
                                                <?php echo form_error('company_name'); ?></td>
                                        </tr>
                                        <tr>
                                            <td width="25%"><label>Email</label></td>
                                            <td><input type="text"
                                                       class="form-control <?= $current_language->direction == 'rtl' ? 'direction-rtl' : '' ?>"
                                                       id="email_address" placeholder="Email" name="email_address"
                                                       value="<?= set_value('email_address', empty($profile->email) ? '' : $profile->email) ?>">
                                                <?php echo form_error('email_address'); ?></td>
                                        </tr>
                                        <tr>
                                            <td width="25%"><label>City</label></td>
                                            <td><input type="text"
                                                       class="form-control <?= $current_language->direction == 'rtl' ? 'direction-rtl' : '' ?>"
                                                       id="city" placeholder="City" name="city"
                                                       value="<?= set_value('city', empty($profile->city) ? '' : $profile->city) ?>">
                                                <?php echo form_error('city'); ?></td>
                                        </tr>
                                        <tr>
                                            <td width="25%"><label>State</label></td>
                                            <td><input type="text"
                                                       class="form-control <?= $current_language->direction == 'rtl' ? 'direction-rtl' : '' ?>"
                                                       id="state" placeholder="State" name="state"
                                                       value="<?= set_value('state', empty($profile->state) ? '' : $profile->state) ?>">
                                                <?php echo form_error('state'); ?></td>
                                        </tr>
                                        <tr>
                                            <td width="25%"><label>Country</label></td>
                                            <td>
                                                <select name="country" class="select2">
                                                    <option value="">Select</option>
                                                    <?php if ($countries): ?>
                                                        <?php foreach ($countries as $country): ?>
                                                            <option value="<?= $country->id ?>"
                                                                <?= set_value('country', !empty($profile->country) ? $profile->country : '') == $country->id ? 'selected' : '' ?>><?= $country->name ?>
                                                            </option>
                                                        <?php endforeach; ?>
                                                    <?php endif; ?>
                                                </select>
                                                <?php echo form_error('country'); ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="25%"><label>Zip/Postal Code</label></td>
                                            <td><input type="text"
                                                       class="form-control <?= $current_language->direction == 'rtl' ? 'direction-rtl' : '' ?>"
                                                       id="postal_code" placeholder="Zip/Postal Code" name="postal_code"
                                                       value="<?= set_value('postal_code', empty($profile->po_box) ? '' : $profile->po_box) ?>">
                                                <?php echo form_error('postal_code'); ?></td>
                                        </tr>
                                        <tr>
                                            <td width="25%"><label>Phone</label></td>
                                            <td><input type="text"
                                                       class="form-control <?= $current_language->direction == 'rtl' ? 'direction-rtl' : '' ?>"
                                                       id="phone" placeholder="Phone" name="phone"
                                                       value="<?= set_value('phone', empty($profile->phone) ? '' : $profile->phone) ?>">
                                                <?php echo form_error('phone'); ?></td>
                                        </tr>
                                        <tr>
                                            <td width="25%"><label>Fax</label></td>
                                            <td><input type="text"
                                                       class="form-control <?= $current_language->direction == 'rtl' ? 'direction-rtl' : '' ?>"
                                                       id="fax" placeholder="Fax" name="fax"
                                                       value="<?= set_value('fax', empty($profile->fax) ? '' : $profile->fax) ?>">
                                                <?php echo form_error('fax'); ?></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                    <table class="table table-bordered">
                                        <thead>
                                        <tr>
                                            <th colspan="2"><h3 class="float-left">Shipping Address</h3> <label
                                                        class="float-right"><input type="checkbox"
                                                                                   name="ship_diff_address" value="1"
                                                                                   onchange="ship_address_different(this)" <?= set_value('ship_diff_address') == 1 ? 'checked' : '' ?>>
                                                    Ship to different address</label></th>
                                        </tr>
                                        </thead>
                                        <tbody id="ship_diff_address"
                                               style="<?= set_value('ship_diff_address') == 1 ? '' : 'display:none;' ?>">
                                        <tr>
                                            <td width="25%"><label>First Name</label></td>
                                            <td>
                                                <input type="text"
                                                       class="form-control <?= $current_language->direction == 'rtl' ? 'direction-rtl' : '' ?>"
                                                       id="ship_first_name" placeholder="First Name"
                                                       name="ship_first_name"
                                                       value="<?= set_value('ship_first_name') ?>">
                                                <?php echo form_error('ship_first_name'); ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="25%"><label>Last Name</label></td>
                                            <td><input type="text"
                                                       class="form-control <?= $current_language->direction == 'rtl' ? 'direction-rtl' : '' ?>"
                                                       id="ship_last_name" placeholder="Last Name" name="ship_last_name"
                                                       value="<?= set_value('ship_last_name') ?>">
                                                <?php echo form_error('ship_last_name'); ?></td>
                                        </tr>
                                        <tr>
                                            <td width="25%"><label>Address</label></td>
                                            <td><textarea
                                                        class="form-control <?= $current_language->direction == 'rtl' ? 'direction-rtl' : '' ?>"
                                                        id="ship_address" placeholder="Address"
                                                        name="ship_address"><?= set_value('address') ?></textarea>
                                                <?php echo form_error('ship_address'); ?></td>
                                        </tr>
                                        <tr>
                                            <td width="25%"><label>Company</label></td>
                                            <td><input type="text"
                                                       class="form-control <?= $current_language->direction == 'rtl' ? 'direction-rtl' : '' ?>"
                                                       id="ship_company_name" placeholder="Company"
                                                       name="ship_company_name"
                                                       value="<?= set_value('company_name') ?>">
                                                <?php echo form_error('ship_company_name'); ?></td>
                                        </tr>
                                        <tr>
                                            <td width="25%"><label>Email</label></td>
                                            <td><input type="text"
                                                       class="form-control <?= $current_language->direction == 'rtl' ? 'direction-rtl' : '' ?>"
                                                       id="ship_email_address" placeholder="Email"
                                                       name="ship_email_address"
                                                       value="<?= set_value('ship_email_address') ?>">
                                                <?php echo form_error('ship_email_address'); ?></td>
                                        </tr>
                                        <tr>
                                            <td width="25%"><label>City</label></td>
                                            <td><input type="text"
                                                       class="form-control <?= $current_language->direction == 'rtl' ? 'direction-rtl' : '' ?>"
                                                       id="ship_city" placeholder="City" name="ship_city"
                                                       value="<?= set_value('ship_city') ?>">
                                                <?php echo form_error('ship_city'); ?></td>
                                        </tr>
                                        <tr>
                                            <td width="25%"><label>State</label></td>
                                            <td><input type="text"
                                                       class="form-control <?= $current_language->direction == 'rtl' ? 'direction-rtl' : '' ?>"
                                                       id="ship_state" placeholder="State" name="ship_state"
                                                       value="<?= set_value('ship_state') ?>">
                                                <?php echo form_error('ship_state'); ?></td>
                                        </tr>
                                        <tr>
                                            <td width="25%"><label>Country</label></td>
                                            <td>
                                                <select name="ship_country" class="select2">
                                                    <option value="">Select</option>
                                                    <?php if ($countries): ?>
                                                        <?php foreach ($countries as $country): ?>
                                                            <option value="<?= $country->id ?>"
                                                                <?= set_value('ship_country') == $country->id ? 'selected' : '' ?>>
                                                                <?= $country->name ?>
                                                            </option>
                                                        <?php endforeach; ?>
                                                    <?php endif; ?>
                                                </select>
                                                <?= form_error('ship_country') ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="25%"><label>Zip/Postal Code</label></td>
                                            <td><input type="text"
                                                       class="form-control <?= $current_language->direction == 'rtl' ? 'direction-rtl' : '' ?>"
                                                       id="ship_postal_code" placeholder="Zip/Postal Code"
                                                       name="ship_postal_code"
                                                       value="<?= set_value('ship_postal_code') ?>">
                                                <?php echo form_error('ship_postal_code'); ?></td>
                                        </tr>
                                        <tr>
                                            <td width="25%"><label>Phone</label></td>
                                            <td><input type="text"
                                                       class="form-control <?= $current_language->direction == 'rtl' ? 'direction-rtl' : '' ?>"
                                                       id="ship_phone" placeholder="Phone" name="ship_phone"
                                                       value="<?= set_value('ship_phone') ?>">
                                                <?php echo form_error('ship_phone'); ?></td>
                                        </tr>
                                        <tr>
                                            <td width="25%"><label>Fax</label></td>
                                            <td><input type="text"
                                                       class="form-control <?= $current_language->direction == 'rtl' ? 'direction-rtl' : '' ?>"
                                                       id="ship_fax" placeholder="Fax" name="ship_fax"
                                                       value="<?= set_value('ship_fax') ?>">
                                                <?php echo form_error('ship_fax'); ?></td>
                                        </tr>
                                        </tbody>
                                    </table>

                                    <table class="table table-bordered">
                                        <thead>
                                        <tr>
                                            <th colspan="6"><h3>Cart</h3></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td width="25%" style="padding-top:20px;">
                                                <label>Search Product</label>
                                            </td>
                                            <td>
                                                <select name="cartProduct" id="cartProduct"
                                                        class="select2_product_search form-control">
                                                    <option>Search</option>
                                                </select>
                                                <?php echo form_error('cartProduct'); ?>
                                            </td>
                                            <td width="25%">
                                                <button type="button" class="btn btn-success"
                                                        onclick="add_cart_product()">Add To Cart
                                                </button>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                    <div id="product_cart_alert_msg" class="col-sm-12 text-center"></div>
                                    <div id="cart_items" class="col-sm-12">
                                        <table class="table table-bordered">
                                            <thead>
                                            <tr>
                                                <th colspan="8"><h3>Cart Products</h3></th>
                                            </tr>
                                            <tr>
                                                <th>Sl.No.</th>
                                                <th width="10%">Product</th>
                                                <th>Code</th>
                                                <th width="30%">Name</th>
                                                <th>Quantity</th>
                                                <th>Price</th>
                                                <th>Available</th>
                                                <th>Option</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                            if ($cart_products): $i = 0;
                                                $total_price = 0;
                                                foreach ($cart_products as $cart_product):
                                                    $i++;
                                                    $total_price += $cart_product->cart_quantity * $cart_product->selling_price;
                                                    ?>
                                                    <tr>
                                                        <td><?= $i ?></td>
                                                        <td>
                                                            <?php if ($cart_product->product_cover): ?>
                                                                <img src="<?= base_url('assets/uploads/product/thumb_' . $cart_product->product_cover) ?>"
                                                                     width="150">
                                                            <?php else: ?>
                                                                <img src="<?= base_url('assets/common/no_image.png') ?>"
                                                                     alt="" width="150">
                                                            <?php endif; ?>
                                                        </td>
                                                        <td>
                                                            <?= $cart_product->product_code ?>
                                                        </td>
                                                        <td>
                                                            <a href="<?= base_url('product/info/' . $cart_product->id . '/' . $cart_product->title_slug) ?>"
                                                               target="_blank"><?= $cart_product->product_name ?></a>
                                                        </td>
                                                        <td><input type="text" class="form-control" style="width:50px;"
                                                                   name="product_required_quantity_<?= $cart_product->id ?>"
                                                                   value="<?= $cart_product->cart_quantity ?>"
                                                                   onchange="update_required_stock(<?= $cart_product->id ?>, this.value)">
                                                        </td>
                                                        <td><?= config_item('CURRENCY') ?> <?= $cart_product->selling_price ?></td>
                                                        <td><?= $cart_product->units_in_stock >= $cart_product->cart_quantity ? 'In Stock' : 'Out of Stock' ?></td>
                                                        <td>
                                                            <button class="btn btn-danger"
                                                                    onclick="ajax_remove_cart_product(<?= $cart_product->id ?>)">
                                                                <i class="fas fa-trash"></i></button>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                                <?php
                                                $sub_total = $total_price;
                                                $vat_amount = $sub_total * ($panel_setting->vat / 100);
                                                $grand_total = $total_price + $vat_amount + $shipping_charge->rate;
                                                ?>
                                                <tr>
                                                    <td colspan="5" align="right"><label>Sub Total</label></td>
                                                    <td colspan="3"
                                                        align="left"><?= config_item('CURRENCY') ?> <?= $total_price ?></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="5" align="right"><label>Vat(<?= $panel_setting->vat ?>
                                                            %)</label></td>
                                                    <td colspan="3"
                                                        align="left"><?= config_item('CURRENCY') ?> <?= $vat_amount ?></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="5" align="right"><label>Shipping Charge</label></td>
                                                    <td colspan="3"
                                                        align="left"><?= config_item('CURRENCY') ?> <?= $shipping_charge->rate ?></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="5" align="right"><label>Grand Total</label></td>
                                                    <td colspan="3"
                                                        align="left"><?= config_item('CURRENCY') ?> <?= $grand_total ?> </td>
                                                </tr>
                                            <?php else: ?>
                                                <tr>
                                                    <td colspan="8" align="center">Cart is empty.</td>
                                                </tr>
                                            <?php endif; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="col-sm-12 mt-4">
                                        <button type="submit" class="btn btn-success float-right">Save</button>
                                    </div>
                                    <?php endif; ?>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div><!-- /.content-wrapper -->