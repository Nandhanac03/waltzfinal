<style>
    .alert-error,
    .required {
        color: #ff0000;
    }
</style>
<div class="breadcrumb-area text-center shadow dark text-light bg-cover" style="background-image: url(<?= base_url('assets/web/') ?>img/banner/14.jpg);">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 offset-lg-2">
                <h1><?= $web_labels['CANDIDATE_REGISTER'] ?></h1>
                <ul class="breadcrumb">
                    <li><a href="#"><i class="fas fa-home"></i> <?= $web_labels['HOME'] ?></a></li>
                    <li class="active"><?= $web_labels['CANDIDATE_REGISTER'] ?></li>
                </ul>
            </div>
        </div>
    </div>
</div>



<div class="contact-us-area default-padding bg-gray">
    <div class="right-shape">
        <img src="<?= base_url('assets/web/') ?>img/shape/9.png" alt="Shape">
    </div>
    <div class="container">
        <div class="row align-center">
            <!-- <div class="col-lg-5 info">
                <div class="content">
                    <h2>Let's talk?</h2>

                    <ul>
                        <li>
                            <div class="icon">
                                <i class="fas fa-map-marker-alt"></i>
                            </div>
                            <div class="content">
                                <h5>Address</h5>
                                <p>
                                    Flamingo Villas, Ajman, UAE </p>
                            </div>
                        </li>
                        <li>
                            <div class="icon">
                                <i class="fas fa-phone"></i>
                            </div>
                            <div class="content">
                                <h5>Phone</h5>
                                <p>
                                    +971 6 577 3876
                                </p>
                            </div>
                        </li>
                        <li>
                            <div class="icon">
                                <i class="fas fa-envelope"></i>
                            </div>
                            <div class="content">
                                <h5>Email</h5>

                                <p>
                                    CVs to : <a href="mailto:careers@creativehrc.com"> careers@creativehrc.com</a> <br>
                                    Business Enquiries: <a href="mailto:business@creativehrc.com">business@creativehrc.com</a>
                                </p>
                            </div>
                        </li>
                    </ul>
                </div>
            </div> -->
            <!-- <div class="col-lg-5">
                &nbsp;
</div> -->
            <div class="col-lg-8 contact-form-box">
                <!-- For business inquiries only,  -->
                <!-- <p>Job Seekers can send their cv's to <a href="mailto:careers@creativehrc.com">careers@creativehrc.com</a></p> -->

                <div class="form-box">
                    <form action="<?= base_url('candidate') . '/send' ?>" method="post" class="contact-form" id="contact-form" name="contact-form" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="name"><?= $web_labels['NAME'] ?> <span class="required">*</span></label>
                                    <input class="form-control" id="name" name="name" placeholder="<?= $web_labels['NAME'] ?>" type="text" value="<?= set_value('name') ?>">
                                    <span class="alert-error"><?= form_error('name') ?></span>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="country"><?= $web_labels['NATIONALITY'] ?> <span class="required">*</span></label>
                                    <select id="country" name="country" class="form-control">
                                        <option value=""><?= $web_labels['SELECT_NATIOINALITY'] ?></option>
                                        <?php
                                        foreach ($country_list as $item) {
                                        ?>
                                            <option value="<?= $item->id ?>" <?= ((int)$country == (int)$item->id) ? "selected" : "" ?>><?= $item->name ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                    <span class="alert-error"><?= form_error('country') ?></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="phone"><?= $web_labels['MOBILE_WITH_WHATSAPP'] ?> <span class="required">*</span></label>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <select id="phonecode" name="phonecode" class="form-control">
                                                <option value=""><?= $web_labels['SELECT_COUNTRY_CODE'] ?></option>
                                                <?php
                                                if ($phonecode == "") {
                                                    $phonecode  =   "971";
                                                }
                                                foreach ($country_list as $item) {
                                                    if ($item->id == 224) {
                                                        $item->name =   "UAE";
                                                    }
                                                ?>
                                                    <option value="<?= $item->phonecode ?>" <?= ((int)$phonecode == (int)$item->phonecode) ? "selected" : "" ?>><?= $item->name ?> (+<?= $item->phonecode ?>)</option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                            <!-- <input class="form-control" id="phonecode" name="phonecode" placeholder="Country Code" type="text" value="<?= set_value('phonecode') ?>"> -->
                                        </div>
                                        <div class="col-md-8">
                                            <input class="form-control" id="phone" name="phone" placeholder="<?= $web_labels['MOBILE'] ?>" type="text" value="<?= set_value('phone') ?>" maxlength="10">
                                        </div>
                                    </div>

                                    <!--<input class="form-control" id="phone" name="phone" placeholder="Mobile With WhatsApp" type="text" value="<?= set_value('phone') ?>">-->
                                    <span class="alert-error"><?= form_error('phone') ?></span>
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <!-- <div class="form-group">
                                    <label for="address">Address <span class="required">*</span></label>
                                    <input class="form-control" id="address" name="address" placeholder="Address" type="text" value="<?= set_value('address') ?>">
                                    <span class="alert-error"><?= form_error('address') ?></span>
                                </div> -->
                                <div class="form-group">
                                    <label for="email"><?= $web_labels['EMAIL'] ?> <span class="required">*</span></label>
                                    <input class="form-control" id="email" name="email" placeholder="<?= $web_labels['EMAIL'] ?>" type="email" value="<?= set_value('email') ?>">
                                    <span class="alert-error"><?= form_error('email') ?></span>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="address"><?= $web_labels['CURRENT_LOCATION'] ?> <span class="required">*</span></label>
                                    <input class="form-control" id="current_loc" name="current_loc" placeholder="<?= $web_labels['CURRENT_LOCATION'] ?>" type="text" value="<?= set_value('current_loc') ?>">
                                    <span class="alert-error"><?= form_error('current_loc') ?></span>
                                </div>
                            </div>


                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="gender"><?= $web_labels['NOTICE_PERIOD'] ?> <span class="required">*</span></label>
                                    <select id="notice_period" name="notice_period" class="form-control">
                                        <option value="" <?= ($notice_period == "") ? "selected" : "" ?>><?= $web_labels['SELECT'] ?></option>
                                        <option value="1" <?= ($notice_period == "1") ? "selected" : "" ?>><?= $web_labels['0_DAYS'] ?></option>
                                        <option value="15" <?= ($notice_period == "15") ? "selected" : "" ?>><?= $web_labels['15_DAYS'] ?></option>
                                        <option value="30" <?= ($notice_period == "30") ? "selected" : "" ?>><?= $web_labels['30_DAYS'] ?></option>
                                        <option value="45" <?= ($notice_period == "45") ? "selected" : "" ?>><?= $web_labels['MORE_THAN_30_DAYS'] ?></option>
                                    </select>
                                    <span class="alert-error"><?= form_error('notice_period') ?></span>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="company_name"><?= $web_labels['CAN_YOU_JOIN_IMMEDIATELY'] ?> <span class="required">*</span></label>
                                    <select id="join_now" name="join_now" class="form-control">
                                        <option value="YES" <?= ($join_now == "YES") ? "selected" : "" ?>><?= $web_labels['YES'] ?></option>
                                        <option value="NO" <?= ($join_now == "NO") ? "selected" : "" ?>><?= $web_labels['NO'] ?></option>
                                    </select>
                                    <span class="alert-error"><?= form_error('join_now') ?></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="gender"><?= $web_labels['GENDER'] ?> <span class="required">*</span></label>
                                    <select id="gender" name="gender" class="form-control">
                                        <option value="Male" <?= ($gender == "Male") ? "selected" : "" ?>><?= $web_labels['MALE'] ?></option>
                                        <option value="Female" <?= ($gender == "Female") ? "selected" : "" ?>><?= $web_labels['FEMALE'] ?></option>
                                    </select>
                                    <span class="alert-error"><?= form_error('gender') ?></span>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="company_name"><?= $web_labels['HIGHEST_DEGREE'] ?> </label>
                                    <input class="form-control" id="company_name" name="company_name" placeholder="<?= $web_labels['HIGHEST_DEGREE'] ?>" type="text" value="<?= set_value('company_name') ?>">
                                    <span class="alert-error"><?= form_error('company_name') ?></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="job_role"><?= $web_labels['CURRENT_JOB_ROLE'] ?> </label>
                                    <input class="form-control" id="job_role" name="job_role" value="<?= set_value('job_role') ?>" placeholder="<?= $web_labels['CURRENT_JOB_ROLE'] ?>">
                                    <span class="alert-error"><?= form_error('job_role') ?></span>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group comments">
                                    <label for="experience"><?= $web_labels['YEAR_OF_EXPERIENCE'] ?> </label>
                                    <input type="number" class="form-control" id="experience" name="experience" value="<?= set_value('experience') ?>" placeholder="<?= $web_labels['YEAR_OF_EXPERIENCE'] ?>" min="0">
                                    <span class="alert-error"><?= form_error('experience') ?></span>
                                </div>
                            </div>
                        </div>
                        <hr />

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="subject"><?= $web_labels['APPLIED_POST'] ?> <span class="required">*</span></label>
                                    <input class="form-control" id="subject" name="subject" placeholder="<?= $web_labels['POST'] ?>*" type="text" value="<?= $subject ?>">
                                    <span class="alert-error"><?= form_error('subject') ?></span>
                                    <input id="career_id" name="career_id" type="hidden" value="<?= $career_id ?>">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="resume_file"><?= $web_labels['RESUME'] ?></label>
                                    <input class="form-control" id="resume_file" name="resume_file" placeholder="" type="file" value="">
                                    <span class="alert-error"><?= form_error('resume_file') ?></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <button type="submit" name="submit" id="submit" onclick="button_click()">
                                <?= $web_labels['SUBMIT'] ?> <i class="fa fa-paper-plane"></i>
                                </button>
                            </div>
                        </div>
                        <!-- Alert Message -->
                        <div class="col-lg-12 alert-notification">
                            <div id="message" class="alert-msg"><?= $error_message ?></div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function button_click() {
        $('#submit').after('<img src="<?= base_url('assets/web/') ?>img/ajaximg.gif" width="70" height="70" class="loader" />');
    }
</script>