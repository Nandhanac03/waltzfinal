<tr style="border-collapse:collapse">
    <td align="left" style="Margin:0;padding-top:5px;padding-bottom:10px;padding-left:20px;padding-right:20px">
        <!--[if mso]><table style="width:560px" cellpadding="0" cellspacing="0"><tr><td style="width:178px" valign="top"><![endif]-->
        <table class="es-left" cellspacing="0" cellpadding="0" align="left" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;float:left">
            <tr style="border-collapse:collapse">
                <td class="es-m-p0r es-m-p20b" valign="top" align="center" style="padding:0;Margin:0;width:178px">
                    <table width="100%" cellspacing="0" cellpadding="0" role="presentation" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                        <tr style="border-collapse:collapse">
                            <td style="padding:0;Margin:0;font-size:0" align="center"><a href="<?= base_url('product/info/' . $order_product->id) ?>" target="_blank" style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:arial, 'helvetica neue', helvetica, sans-serif;font-size:14px;text-decoration:underline;color:#D48344">
                                    <?php if ($order_product->product_cover) : ?>
                                        <img src="<?= base_url('assets/uploads/product/thumb_' . $order_product->product_cover) ?>" alt="<?= $order_product->product_name ?>" width="125" style="display:block;bquotation:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic">
                                    <?php else : ?>
                                        <img src="<?= base_url('assets/common/no_image.png') ?>" alt="" class="adapt-img" title="<?= $order_product->product_name ?>" width="125" style="display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic">
                                    <?php endif; ?>
                                </a>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
        <!--[if mso]></td><td style="width:20px"></td><td style="width:362px" valign="top"><![endif]-->
        <table cellspacing="0" cellpadding="0" align="right" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
            <tr style="border-collapse:collapse">
                <td align="left" style="padding:0;Margin:0;width:362px">
                    <table width="100%" cellspacing="0" cellpadding="0" role="presentation" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                        <tr style="border-collapse:collapse">
                            <td align="left" style="padding:0;Margin:0">
                                <p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:14px;font-family:arial, 'helvetica neue', helvetica, sans-serif;line-height:21px;color:#333333"><br></p>
                                <table style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;width:100%" class="cke_show_border" cellspacing="1" cellpadding="1" border="0" role="presentation">
                                    <tr style="border-collapse:collapse">
                                        <td style="padding:0;Margin:0"><?= $order_product->product_name ?>
                                            <?php if ($order_product_properties) : ?>
                                                <?php foreach ($order_product_properties as $order_product_property) : ?>
                                                    <p><?= $order_product_property->attribute . ' : ' . $order_product_property->attribute_value ?></p>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                        </td>
                                        <td style="padding:0;Margin:0;width:60px;text-align:center">                                           
                                            <span><?= config_item('CURRENCY') ?> <?= number_format($order_detail->selling_price, 2) ?></span>
                                            <?php if ($order_detail->discount > 0) : ?>
                                                <span style="text-decoration: line-through!important;color: #565959!important; display: block;"><?= config_item('CURRENCY') ?> <?= number_format($order_detail->unit_price, 2) ?></span>
                                            <?php endif; ?>
                                        </td>
                                        <td style="padding:0;Margin:0;width:60px;text-align:center"><?= $order_detail->quantity ?></td>
                                        <td style="padding:0;Margin:0;width:100px;text-align:center"><?= config_item('CURRENCY') ?> <?= $order_detail->total ?></td>
                                    </tr>
                                </table>
                                <p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:14px;font-family:arial, 'helvetica neue', helvetica, sans-serif;line-height:21px;color:#333333"><br></p>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
        <!--[if mso]></td></tr></table><![endif]-->
    </td>
</tr>
<tr style="border-collapse:collapse">
    <td align="left" style="padding:0;Margin:0;padding-left:20px;padding-right:20px">
        <table width="100%" cellspacing="0" cellpadding="0" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
            <tr style="border-collapse:collapse">
                <td valign="top" align="center" style="padding:0;Margin:0;width:560px">
                    <table width="100%" cellspacing="0" cellpadding="0" role="presentation" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                        <tr style="border-collapse:collapse">
                            <td style="padding:0;Margin:0;padding-bottom:10px;font-size:0" align="center">
                                <table width="100%" height="100%" cellspacing="0" cellpadding="0" border="0" role="presentation" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                                    <tr style="border-collapse:collapse">
                                        <td style="padding:0;Margin:0;border-bottom:1px solid #EFEFEF;height:1px;width:100%;margin:0px"></td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </td>
</tr>