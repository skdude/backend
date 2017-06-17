<style>
    .info, .success, .warning, .error, .validation {
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

    .fileUpload {
        position: relative;
        overflow: hidden;
        margin: 0;
    }
    .fileUpload input.upload {
        position: absolute;
        top: 0;
        right: 0;
        margin: 0;
        padding: 0;
        font-size: 20px;
        cursor: pointer;
        opacity: 0;
        filter: alpha(opacity=0);
    }

</style>
<?php echo $form1->messages(); ?>

<div class="row">

    <div class="col-md-6">
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title">Account Info</h3>
            </div>
            <div class="box-body">
                <?php echo $form1->open(); ?>
                <?php echo $form1->bs3_text('First Name', 'first_name', $user->first_name); ?>
                <?php echo $form1->bs3_text('Last Name', 'last_name', $user->last_name); ?>
                <?php echo $form1->bs3_email('E-mail', 'email', $user->email); ?>

                <label for="profile_image">Profile image</label>
                <br />
                <?php echo $form1->field_upload('profile_image', $user->profile_image, $user->profile_image); ?>
                <br />
                <br />
                <?php echo $form1->bs3_submit('Update'); ?>
                <?php echo $form1->close(); ?>
            </div>
        </div>
    </div>
</div>