<?php
$data = [];
if(isset($_REQUEST['lang']) && $_REQUEST['lang'] != 1) {
    $data['THANK_YOU'] = 'شكرًا لك';
    $data['GO_TO_HOME'] = 'اذهب الى الصفحه الرئيسية';
} else {
    $data['THANK_YOU'] = 'Thank you';
    $data['GO_TO_HOME'] = 'Go to Home';
}
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>HR Consultancy in UAE | Creative HR Consultancy</title>
<link href="https://creativehrc.com/assets/web/css/bootstrap.min.css" rel="stylesheet" />
<link href="https://creativehrc.com/assets/web/css/font-awesome.min.css" rel="stylesheet" />
	<style type="text/css">

    body
    {
        background:#f2f2f2;
    }

    .payment
	{
		border:1px solid #f2f2f2;
		height:280px;
        border-radius:20px;
        background:#fff;
	}
   .payment_header
   {
	   background:#409ad6;
	   padding:20px;
       border-radius:20px 20px 0px 0px;
	   
   }
   
   .check
   {
	   margin:0px auto;
	   width:50px;
	   height:50px;
	   border-radius:100%;
	   background:#fff;
	   text-align:center;
   }
   
   .check i
   {
	   vertical-align:middle;
	   line-height:50px;
	   font-size:30px;
   }

    .content 
    {
        text-align:center;
    }

    .content  h1
    {
        font-size:25px;
        padding-top:25px;
    }

    .content a
    {
        width:200px;
        height:35px;
        color:#fff;
        border-radius:30px;
        padding:5px 10px;
        background:#FF9900;
        transition:all ease-in-out 0.3s;
    }

    .content a:hover
    {
        text-decoration:none;
        background:#000;
    }
   
	</style>
	
</head>

<body>
   <div class="container">
   <div class="row">
      <div class="col-md-6 mx-auto mt-5">
         <div class="payment">
            <div class="payment_header">
               <div class="check"><i class="fa fa-check" aria-hidden="true"></i></div>
            </div>
            <div class="content">
               <h1><?= $data['THANK_YOU'] ?> !</h1>
               <p>
                <?php
                if(isset($_REQUEST['type']) && $_REQUEST['type'] == "candidate") {
                    if(isset($_REQUEST['lang'])  && $_REQUEST['lang'] != 1) {
                        echo 'تم إرسال سيرتك الذاتية بنجاح. سوف نتصل بك قريبا جدا !.';
                    } else {
                        echo 'Your resume has been successfully sent. We will contact you very soon!. ';
                    }
                    
                } else {
                    if(isset($_REQUEST['lang'])  && $_REQUEST['lang'] != 1) {
                        echo 'سوف نتصل بك قريبا جدا !.';
                    } else {
                        echo 'Your message has been successfully sent. We will contact you very soon!. ';
                    }
                }
                ?>
               </p>
               <a href="http://websitedesigninguae.com/ait2022/creativehrc.com/php/"><?= $data['GO_TO_HOME'] ?></a>
            </div>
            
         </div>
      </div>
   </div>
</div>
	
   
</body>
</html>
