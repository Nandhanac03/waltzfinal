
    <?php
    if (isset($active_menu) && in_array($active_menu, ['contact', 'home'])) {
    ?>
        <script src="https://www.google.com/recaptcha/api.js?render=<?= config_item('SITE_KEY') ?>"></script>
    <?php
    }
    ?>
    
