<style>    .info, .success, .warning, .error, .validation {
        border: 1px solid;
        margin: 10px 0px;
        padding:15px 10px 15px 50px;
        background-repeat: no-repeat;
        background-position: 10px center;
    }
    .info {
        color: #00529B;
        background-color: #BDE5F8;
        background-image: url('info.png');
    }
    .success {
        color: #4F8A10;
        background-color: #DFF2BF;
        background-image:url('success.png');
    }
    .warning {
        color: #9F6000;
        background-color: #FEEFB3;
        background-image: url('warning.png');
    }
    .error {
        color: #D8000C;
        background-color: #FFBABA;
        background-image: url('error.png');
    }

</style>

<div class="container">
    <img style="width:100px;" src="../<?= UPLOAD_USER . "/" . $user->profile_image; ?>">

<div class="row">


    <div class="col-md-6">
        <?php echo modules::run('adminlte/widget/app_btn', 'fa fa-user', 'Update accountinfo', 'profile/account_update_info'); ?>
    </div>


</div>
</div>