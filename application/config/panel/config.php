<?php
$config['WEBSITE_TITLE'] = 'Waltz Solutions and Services';
$config['MAX_IMG_FILE_SIZE'] = 2048;
$config['MAX_PR_IMG_FILE_SIZE'] = 2048;
$config['MAX_IMG_FILE_SIZE_MSG'] = 'Maximum file size allowed 2MB';
$config['CURRENCY'] = 'AED';
// $config['PANEL_EMAIL'] = 'girie.vst@gmail.com';
$config['LOGO_PATH'] = 'assets/web/images/logo.png';
$config['REST_PASSWORD_LINK'] = 'panel/user/reset_password';
$config['ACTIVATION_LINK'] = 'panel/user/activate';
#Google reCAPTCHA
// new key
$config['SITE_KEY'] = '6Lebf7osAAAAAFIdxTbhQzNZ9-MCrNWajRrNcY70';
$config['SECRET_KEY'] = '6Lebf7osAAAAAFG7PXte5EKOSuPazozHEDuNYagQ';

// old key
// $config['SITE_KEY'] = '6LeZN9IrAAAAAEB70MidkPv-hjOEma8ItxkiZrJB';
// $config['SECRET_KEY'] = '6LeZN9IrAAAAANKznBy3BdCBQpih6R402O7PYn6m';

// Mail configuration
$config['MAIL'] = array(
   'FROM_NAME' => 'Waltz Solutions and Services',
   'FROM_EMAIL' => 'waltz@show.yalla-web.com', 
   'ENABLE_SMTP' => TRUE,
   'SMTP_HOST' => 'mail.show.yalla-web.com',
   'SMTP_PORT' => 465,
   'SMTP_EMAIL' => 'waltz@show.yalla-web.com', 
   'SMTP_PASSWORD' => 'eNZdJElOy8dH', 
   'SMTP_SECURE' => 'ssl'
);


// $config['MAIL'] = array(
//     'FROM_NAME'    => 'smtp',
//     'SMTP_HOST'   => 'smtp.gmail.com',
//     'SMTP_EMAIL'   => 'nandhanac357@gmail.com',
//     'SMTP_PASSWORD'   => 'wslihjzgbclovpid',
//     'SMTP_PORT'   => 465,
//     'SMTP_SECURE' => 'ssl',
//     'ENABLE_SMTP' => TRUE
// );

