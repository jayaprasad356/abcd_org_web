<?php include("includes/header.php");

require("includes/function.php");
require("language/language.php");


$qry = "SELECT * FROM tbl_settings where id='1'";
$result = mysqli_query($mysqli, $qry);
$settings_row = mysqli_fetch_assoc($result);


if (isset($_POST['spin_setting'])) {
    $data = array(
        'daily_spin_limit' => $_POST['daily_spin_limit'],
        'ads_frequency_limit' => $_POST['ads_frequency_limit']
    );


    $settings_edit = Update('tbl_settings', $data, "WHERE id = '1'");

    $_SESSION['msg'] = "11";
    header("Location:spin_setting.php");
    exit;

}


?>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="page_title_block">
                <div class="col-md-5 col-xs-12">
                    <div class="page_title">Spinner Setting</div>
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="row mrg-top">
                <div class="col-md-12">

                    <div class="col-md-12 col-sm-12">
                        <?php if (isset($_SESSION['msg'])) { ?>
                            <div class="alert alert-success alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                            aria-hidden="true">×</span></button>
                                <?php echo $client_lang[$_SESSION['msg']]; ?></a> </div>
                            <?php unset($_SESSION['msg']);
                        } ?>
                    </div>
                </div>
            </div>
            <div class="card-body mrg_bottom">

                <form action="" name="spin_setting" method="post" class="form form-horizontal"
                      enctype="multipart/form-data">
                    <div class="row">

                        <div class="section">
                            <div class="section-body">
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Daily Spin Limit:-</label>
                                    <div class="col-md-4">
                                        <input type="text" name="daily_spin_limit" id="daily_spin_limit"
                                               value="<?php echo $settings_row['daily_spin_limit']; ?>"
                                               class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Spin Ads Frequency Limit:-</label>
                                    <div class="col-md-4">
                                        <input type="text" name="ads_frequency_limit" id="ads_frequency_limit"
                                               value="<?php echo $settings_row['ads_frequency_limit']; ?>"
                                               class="form-control">
                                    </div>
                                </div>


                                <div align="center" class="form-group">
                                    <div class="col-md-8">
                                        <button type="submit" name="spin_setting" class="btn btn-primary ">
                                            Save
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                </form>
            </div>
        </div>
    </div>
</div>


<?php include("includes/footer.php"); ?>
