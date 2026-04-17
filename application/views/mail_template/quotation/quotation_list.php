<tr style="bquotation-collapse:collapse">
    <td align="left" style="Margin:0;padding-top:5px;padding-bottom:10px;padding-left:20px;padding-right:20px">
        <!--[if mso]><table style="width:560px" cellpadding="0" cellspacing="0"><tr><td style="width:178px" valign="top"><![endif]-->
        <table class="es-left" cellspacing="0" cellpadding="0" align="left" style="mso-table-lspace:0pt;mso-table-rspace:0pt;bquotation-collapse:collapse;bquotation-spacing:0px;float:left">
            <tr style="bquotation-collapse:collapse">
                <td class="es-m-p0r es-m-p20b" valign="top" align="center" style="padding:0;Margin:0;width:178px">
                    <table width="100%" cellspacing="0" cellpadding="0" role="presentation" style="mso-table-lspace:0pt;mso-table-rspace:0pt;bquotation-collapse:collapse;bquotation-spacing:0px">
                        <tr style="bquotation-collapse:collapse">
                            <td style="padding:0;Margin:0;font-size:0" align="center"><a href="<?= base_url('product/info/' . $quotation_product->id) ?>" target="_blank" style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:arial, 'helvetica neue', helvetica, sans-serif;font-size:14px;text-decoration:underline;color:#D48344">
                                    <?php if ($quotation_product->product_cover) : ?>
                                        <img src="<?= base_url('assets/uploads/product/thumb_' . $quotation_product->product_cover) ?>" alt="<?= $quotation_product->product_name ?>" class="adapt-img" title="<?= $quotation_product->product_name ?>" width="125" style="display:block;bquotation:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic">
                                    <?php else : ?>
                                        <img src="<?= base_url('assets/common/no_image.png') ?>" alt="" class="adapt-img" title="<?= $quotation_product->product_name ?>" width="125" style="display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic">
                                    <?php endif; ?>
                                </a>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
        <!--[if mso]></td><td style="width:20px"></td><td style="width:362px" valign="top"><![endif]-->
        <table cellspacing="0" cellpadding="0" align="right" style="mso-table-lspace:0pt;mso-table-rspace:0pt;bquotation-collapse:collapse;bquotation-spacing:0px">
            <tr style="bquotation-collapse:collapse">
                <td align="left" style="padding:0;Margin:0;width:362px">
                    <table width="100%" cellspacing="0" cellpadding="0" role="presentation" style="mso-table-lspace:0pt;mso-table-rspace:0pt;bquotation-collapse:collapse;bquotation-spacing:0px">
                        <tr style="bquotation-collapse:collapse">
                            <td align="left" style="padding:0;Margin:0">
                                <p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:14px;font-family:arial, 'helvetica neue', helvetica, sans-serif;line-height:21px;color:#333333"><br></p>
                                <table style="mso-table-lspace:0pt;mso-table-rspace:0pt;bquotation-collapse:collapse;bquotation-spacing:0px;width:100%" class="cke_show_bquotation" cellspacing="1" cellpadding="1" bquotation="0" role="presentation">
                                    <tr style="bquotation-collapse:collapse">
                                        <td style="padding:0;Margin:0"><?= $quotation_product->product_name ?>
                                            <?php if ($quotation_properties) : ?>
                                                <?php foreach ($quotation_properties as $quotation_property) : ?>
                                                    <p><?= $quotation_property->attribute . ' : ' . $quotation_property->attribute_value ?></p>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                        </td>
                                        <td style="padding:0;Margin:0;width:60px;text-align:center"><?= $quotation_detail->quotation_quantity ?></td>
                                        <!--<td style="padding:0;Margin:0;width:100px;text-align:center"><?/*= config_item('CURRENCY') */?> <?/*= $quotation_detail->quotation_total */?></td> -->
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
<tr style="bquotation-collapse:collapse">
    <td align="left" style="padding:0;Margin:0;padding-left:20px;padding-right:20px">
        <table width="100%" cellspacing="0" cellpadding="0" style="mso-table-lspace:0pt;mso-table-rspace:0pt;bquotation-collapse:collapse;bquotation-spacing:0px">
            <tr style="bquotation-collapse:collapse">
                <td valign="top" align="center" style="padding:0;Margin:0;width:560px">
                    <table width="100%" cellspacing="0" cellpadding="0" role="presentation" style="mso-table-lspace:0pt;mso-table-rspace:0pt;bquotation-collapse:collapse;bquotation-spacing:0px">
                        <tr style="bquotation-collapse:collapse">
                            <td style="padding:0;Margin:0;padding-bottom:10px;font-size:0" align="center">
                                <table width="100%" height="100%" cellspacing="0" cellpadding="0" bquotation="0" role="presentation" style="mso-table-lspace:0pt;mso-table-rspace:0pt;bquotation-collapse:collapse;bquotation-spacing:0px">
                                    <tr style="bquotation-collapse:collapse">
                                        <td style="padding:0;Margin:0;bquotation-bottom:1px solid #EFEFEF;height:1px;width:100%;margin:0px"></td>
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