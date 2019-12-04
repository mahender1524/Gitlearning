<?php
$page = 'viewstp';
require 'classes/city-portal-class.php';
$obj = new CityPortal();
$resval = "";
$match = 1;
$link="";
if (count($_GET) > 1 || $match !== 1 || !isset($_SESSION['user_session']) && $_SESSION['user_session'] == '' && ($_SESSION['user_role'] != 22 || $_SESSION['user_role'] != 23) && !isset($_REQUEST['id']) || ($_GET && $_REQUEST['id'] == '')) {
    session_regenerate_id();
    session_unset();
    session_destroy();
    echo "<script>window.location.href='index.php';</script>";
    die;
} else {
    if (isset($_REQUEST['id']) && $_REQUEST['id'] != '') {

        $REQUESTID = strtolower(str_replace(" ", "", $_REQUEST['id']));
        $rid = base64_decode($_REQUEST['id']);
        $exp = explode("##", $rid);
        $id = strtolower(str_replace(" ", "", $exp[0]));
        $city_id = strtolower(str_replace(" ", "", $exp[1]));
        //$link="inventory-stp-inventory.php?city_id=".base64_encode($city_id);
        $link="inventory-stp-monitoring.php?city_id=".base64_encode($city_id);

        if (stripos($REQUESTID, '<script') !== false || stripos($city_id, '<script') !== false || is_array($_GET['id']) || $exp[2] != "view") {
            session_regenerate_id();
            session_unset();
            session_destroy();
            echo "<script>window.location.href='index.php';</script>";
            die;
        }
        $data = $obj->ViewStp($id, $city_id);
    } else {
        session_regenerate_id();
        session_unset();
        session_destroy();
        echo "<script>window.location.href='index.php';</script>";
        die;
    }
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
        <title><?php echo SITE_TITLE;?></title>
        <?php include'includes/head.php'; ?>
        <script src="js/jquery.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <style>
            .btn-area, .left-p {
                position: absolute
            }

            .main {
                z-index: 11;
                margin-left: 220px;
                background-color: #fff
            }

            ol.stp li {
                line-height: 30px
            }

            ol.stp {
                padding: 0 20px
            }

            span.inner-text {
                font-weight: 700
            }

            .stp .table>tbody>tr td {
                padding: 5px 10px;
                border: none !important;
                vertical-align: middle;
                height: 45px
            }

            .stp .table>tbody>tr td input {
                width: 293px;
                height: 35px
            }

            .stp .table>tbody>tr:nth-child(odd) {
                background-color: #ebebeb;
                color: #000
            }

            .white-border table.table-bordered>tbody>tr>td {
                border-color: #EBEBEB
            }

            .white-border table thead tr th {
                border-right: 1px solid #fff !important
            }

            .bg-form, .btn-area {
                display: inline-block
            }

            .resize-n {
                resize: none;
                height: 40px !important;
                width: 100%
            }

            .label-gaps label {
                margin-top: 22px
            }

            .panel-heading {
                padding: 10px 15px !important;
                border-bottom: 1px solid transparent;
                border-top-left-radius: 3px !important;
                border-top-right-radius: 3px !important
            }

            .panel-default>.panel-heading {
                background-color: #d78705;
                color: #fff;
                font-size: 21px;
                line-height: 25px
            }

            .bg-form {
                width: 100%;
                margin-bottom: 5px
            }

            .form-group label {
                font-weight: 700;
                font-size: 11px
            }

            .form-control, table tr td .form-control {
                height: 32px;
                border-radius: 0;
                box-shadow: none;
                font-weight: 400
            }

            .form-control {
                padding: 0 12px
            }

            .zero-pad {
                padding: 0 5px
            }

            .form-control[disabled], .form-control[readonly], fieldset[disabled] .form-control {
                background-color: #eee !important;
                opacity: 1
            }

            .panel-body {
                padding: 0
            }

            .btn-area {
                width: 112px;
                margin: 0 auto;
                font-size: 20px;
                text-align: center;
                left: 0;
                right: 0
            }

            .table-tdw tr td:nth-child(1) {
                width: 3%
            }

            .table-tdw tr td:nth-child(2) {
                width: 67%
            }

            .table-tdw tr td:nth-child(3) {
                width: 30%
            }

            table tr td .form-control {
                padding: 0 12px;
                width: 293px
            }

            .left-p {
                left: 45px;
                top: 7px
            }

            .left-p2, .pos-r {
                position: relative
            }

            .left-p2 {
                left: 25px;
                top: 0
            }

            .btn-group-ns {
                width: 87px !important;
                position: absolute;
                top: 0;
                right: 15px;
                height: 35px
            }

            .nsew-in {
                width: 208px !important;
                height: 32px !important
            }

            .form-control::-moz-placeholder {
                color: #000;
                opacity: 1
            }

            .form-control::-webkit-placeholder {
                color: #000;
                opacity: 1
            }

            .newModalDesign .btn-default {
                background: #fff !important;
                border: 1px solid #ca1a1a !important;
                border-radius: 2px;
                color: #ca1a1a !important;
                padding: 6px 12px;
                font-size: 14px;
                min-width: auto !important
            }

            .newModalDesign .modal-body {
                padding: 3rem 0
            }

            .newModalDesign .modal-content, .newModalDesign .modal-footer, .newModalDesign .modal-header {
                border-radius: 5px
            }

            .back-area {
                height: 50px;
                width: 100%;
                display: inline-block;
                position: relative;
            }

            .back-area button.btn-success {
                color: #fff;
                position: absolute;
                right: 15px;
                top: 12px;
                padding: 6px 15px;
            }
            .left-p.level2 {
                left: 75px;
            }

            .left-p2.level2 {
                left: 60px;
            }
        </style>
    </head>
    <body>

    <div id="preloader">
        <div id="status">&nbsp;</div>
    </div>
    <div class="wrapper dashboard">
    <?php include'includes/header.php' ?>
    <?php include'includes/inventory_side_nav.php' ?>
        <div class="main">
            <div id="content">
                <div class="container-fluid">
                <div class="row">
                    <div class="pull-right back-area">
                        <div class="col-md-12">
                            <h4 style="font-size: 24px;text-align: center;">Welcome <?php if($_SESSION['user_role']==23){ echo "Admin"; }else{ echo $_SESSION['StateName']; } ?></h4>
                        </div>
                        <button class="btn btn-success" onclick="window.location='<?php echo $link; ?>'"><i class="fa fa-arrow-left" aria-hidden="true"></i>
                            Back</button>
                    </div>
                </div>
                    <form method="post" action="">
                        <div class="box23">
                            <div class="row">
                                <div class="col-md-12">
                                    <h4 style="font-size: 24px;background-color:#edf0f5;padding: 10px;line-height: 29px;">STP Details:</h4>
                                    <div class="table-responsive stp">
                                        <table class="table table-tdw">
                                            <tbody>
                                                <?php
                                                foreach ($data as $row) {
                                                    ?>
                                                    <tr>
                                                        <td>1.</td>
                                                        <td>Name / location of STP</td>
                                                        <td><input class="box-size form-control" name="name_stp" id="name_stp" value="<?php echo htmlentities(stripslashes($row['name_stp']), ENT_QUOTES); ?>" maxlength="40"  onkeypress="return onlyalphabet(event)" readonly="readonly"></td>
                                                    </tr>
                                                    <tr>
                                                        <td>2.</td>
                                                        <td>Status of STP</td>
                                                        <td>
                                                            <select class="operational form-control" id="status_stp_id" name="status_stp_id" disabled="disabled">
                                                                <option value="0">-- Select --</option>
                                                                <?php
                                                                $status = $obj->InvtDropDown(1);
                                                                foreach ($status as $val) {
                                                                    ?>
                                                                    <option value="<?php echo $val['id']; ?>" <?php if ($row['status_stp_id'] == $val['id']) {
                                                                        echo "selected";
                                                                    } ?>><?php echo $val['stp_name']; ?></option>
                                                                <?php
                                                                }
                                                                ?>
                                                            </select>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>3.</td>
                                                        <td>Level of treatment</td>
                                                        <td>
                                                            <div class="form-group">

                                                                <select class="others form-control" id="level_treat_id" name="level_treat_id" disabled="disabled">
                                                                    <option value="0">-- Select --</option>
                                                                    <?php
                                                                    $treatment = $obj->InvtDropDown(2);
                                                                    foreach ($treatment as $val) {
                                                                        ?>
                                                                        <option value="<?php echo $val['id']; ?>" <?php if ($row['level_treat_id'] == $val['id']) {
                                                                            echo "selected";
                                                                        } ?>><?php echo $val['stp_name']; ?></option>
                                                                    <?php
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td></td>
                                                        <td></td>
                                                        <td class="text-right">
                                                            <input class="box-size form-control" name="level_treat_other" id="level_treat_other" readonly="readonly"
                                                                   placeholder="Please mention other"
                                                                   value="<?php echo htmlentities(stripslashes($row['level_treat_other']), ENT_QUOTES); ?>"
                                                                   maxlength="40" onkeypress="return onlyalphabet(event)">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>4.</td>
                                                        <td>Technology used for treatment</td>
                                                        <td>
                                                            <div class="form-group">
                                                                <select name="tech_use_treat_id" class="treatselect form-control" id="tech_use_treat_id"
                                                                        disabled="disabled">
                                                                    <option value="0">-- Select --</option>
                                                                    <?php
                                                                    $tech_treat = $obj->InvtDropDown(7);
                                                                    foreach ($tech_treat as $val) {
                                                                        ?>
                                                                        <option
                                                                            value="<?php echo $val['id']; ?>" <?php if ($row['tech_use_treat_id'] == $val['id']) {
                                                                            echo "selected";
                                                                        } ?>><?php echo $val['stp_name']; ?></option>
                                                                    <?php
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td></td>
                                                        <td></td>
                                                        <td>
                                                            <input class="form-control" name="technology_stp_other" type="text" placeholder="Please mention other"
                                                                   id="technology_stp_other" readonly="readonly"
                                                                   value="<?php echo htmlentities(stripslashes($row['technology_stp_other']), ENT_QUOTES); ?>"
                                                                   maxlength="40" onkeypress="return onlyalphabet(event)">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>5.</td>
                                                        <td>Year of commissioning (YYYY)</td>
                                                        <td>
                                                            <input class="box-size form-control" onkeypress="return onlynumeric(event)" name="year_commision"
                                                                   id="year_commision" readonly="readonly" value="<?php echo $row['year_commision']; ?>"
                                                                   minlength="4" maxlength="4">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>6.</td>
                                                        <td>Co-ordinates of STP (in decimal degrees)</td>
                                                        <td></td>
                                                    </tr>
                                                    <tr>
                                                        <td></td>
                                                        <td class="text-right">Latitude</td>
                                                        <td>
                                                            <input type="text" class="box-size form-control" onkeypress="return onlynumericdot(event)"
                                                                   name="coordinate_stp_lat" id="coordinate_stp_lat" readonly="readonly" placeholder="xxxx.yyyyyy"
                                                                   maxlength="11" value="<?php echo $row['coordinate_stp_lat']; ?>" readonly="readonly">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td></td>
                                                        <td class="text-right">Longitude</td>
                                                        <td>
                                                            <input type="text" class="box-size form-control" onkeypress="return onlynumericdot(event)"
                                                                   name="coordinate_stp_long" id="coordinate_stp_long" readonly="readonly" placeholder="xxxx.yyyyyy"
                                                                   maxlength="11" value="<?php echo $row['coordinate_stp_long']; ?>" readonly="readonly">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>7.</td>
                                                        <td>Reason for non-operational</td>
                                                        <td>
                                                            <textarea class="form-control resize-n" name="reason_non_operation" id="reason_non_operation"
                                                                      readonly="readonly"
                                                                      maxlength="240"><?php echo htmlentities(stripslashes($row['reason_non_operation']), ENT_QUOTES); ?></textarea>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>8.</td>
                                                        <td>Installed capacity (MLD)</td>
                                                        <td>
                                                            <input class="box-size form-control" onkeypress="return onlynumericdot(event)"
                                                                   name="install_capacity_mld" id="install_capacity_mld" readonly="readonly"
                                                                   value="<?php echo $row['install_capacity_mld']; ?>" maxlength="6"
                                                                   onblur="uptotwoDec('install_capacity_mld',this.value);">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>9.</td>
                                                        <td>Average flow received during last month (MLD)</td>
                                                        <td>
                                                            <input class="box-size form-control" id="avg_flow_last_month" onkeypress="return onlynumericdot(event)"
                                                                   readonly="readonly" name="avg_flow_last_month" value="<?php echo $row['avg_flow_last_month']; ?>"
                                                                   maxlength="6" onblur="uptotwoDec('avg_flow_last_month',this.value);">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>10.</td>
                                                        <td>Mode of disposal of effluent</td>
                                                        <td>
                                                            <div class="form-group">
                                                                <select class="mod_dispo_efluent_id form-control" id="mod_dispo_efluent_id" disabled="disabled"
                                                                        name="mod_dispo_efluent_id">
                                                                    <option value="0">-- Select --</option>
                                                                    <?php
                                                                    $disposal_effluent = $obj->InvtDropDown(3);
                                                                    foreach ($disposal_effluent as $val) {
                                                                        ?>
                                                                        <option
                                                                            value="<?php echo $val['id']; ?>" <?php if ($row['mod_dispo_efluent_id'] == $val['id']) {
                                                                            echo "selected";
                                                                        } ?>><?php echo $val['stp_name']; ?></option>
                                                                    <?php
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td></td>
                                                        <td></td>
                                                        <td>
                                                            <input class="form-control" type="text" name="mod_dispo_efluent_other"
                                                                   placeholder="Please mention other" id="mod_dispo_efluent_other" readonly="readonly"
                                                                   maxlength="40" onkeypress="return onlyalphabet(event)"
                                                                   value="<?php echo htmlentities(stripslashes($row['mod_dispo_efluent_other']), ENT_QUOTES); ?>">

                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>11.</td>
                                                        <td>Is water resued / recycled?</td>
                                                        <td>
                                                            <div class="form-group">
                                                                <select class="chooseyn form-control" id="water_reused" disabled="disabled" name="water_reused">
                                                                    <option value="0">-- Select --</option>
                                                                    <option value="1" <?php if ($row['water_reused'] == 1) {
                                                                        echo "selected";
                                                                    } ?>>Yes
                                                                    </option>
                                                                    <option value="2" <?php if ($row['water_reused'] == 2) {
                                                                        echo "selected";
                                                                    } ?>>No
                                                                    </option>
                                                                </select>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr class="pos-r">
                                                        <td class="left-p" style="position: relative;top: 0;">a.</td>
                                                        <td class="left-p2">If yes, quantity reused (KLD)</td>
                                                        <td>
                                                            <input class="box-size form-control" onkeypress="return onlynumericdot(event)" id="quantity_reused_mld"
                                                                   name="quantity_reused_mld" readonly="readonly" value="<?php echo $row['quantity_reused_mld']; ?>"
                                                                   maxlength="6" onblur="uptotwoDec('quantity_reused_mld',this.value);">
                                                        </td>
                                                    </tr>
                                                    <tr class="pos-r">
                                                        <td class="left-p" style="position: relative;top: 0;">b.</td>
                                                        <td class="left-p2">Usage of treated water</td>
                                                        <td>
                                                            <div class="form-group">
                                                                <select class="other13 form-control" id="usage_treat_water_id" name="usage_treat_water_id"
                                                                        disabled="disabled">
                                                                    <option value="0">-- Select --</option>
                                                                    <?php
                                                                    $UseTreatWater = $obj->InvtDropDown(4);
                                                                    foreach ($UseTreatWater as $val) {
                                                                        ?>
                                                                        <option
                                                                            value="<?php echo $val['id']; ?>" <?php if ($row['usage_treat_water_id'] == $val['id']) {
                                                                            echo "selected";
                                                                        } ?>><?php echo $val['stp_name']; ?></option>
                                                                    <?php
                                                                    }?>
                                                                </select>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td></td>
                                                        <td></td>
                                                        <td>
                                                            <input class="form-control" type="text" name="use_treat_water_other" placeholder="Please mention other"
                                                                   id="use_treat_water_other" readonly="readonly"
                                                                   value="<?php echo htmlentities(stripslashes($row['use_treat_water_other']), ENT_QUOTES); ?>"
                                                                   maxlength="40" onkeypress="return onlyalphabet(event)">
                                                        </td>
                                                    </tr>
                                                    <tr class="pos-r">
                                                        <td class="left-p" style="position: relative;top: 0;">c.</td>
                                                        <td class="left-p2">Is any tariff levied for supply of treated water?</td>
                                                        <td>
                                                            <div class="form-group">
                                                                <select class="trafic form-control" name="tarrif_levied_supply_waste_water"
                                                                        id="tarrif_levied_supply_waste_water" disabled="disabled">
                                                                    <option value="0">-- Select --</option>
                                                                    <option value="1" <?php if ($row['tarrif_levied_supply_waste_water'] == 1) {
                                                                        echo "selected";
                                                                    } ?>>Yes
                                                                    </option>
                                                                    <option value="2" <?php if ($row['tarrif_levied_supply_waste_water'] == 2) {
                                                                        echo "selected";
                                                                    } ?>>No
                                                                    </option>
                                                                </select>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr class="pos-r">
                                                        <td class="left-p level2" style="position: relative;top: 0;">(i).</td>
                                                        <td class="left-p2 level2">Tariff (Rs./KL)</td>
                                                        <td>
                                                            <input class="box-size form-control" name="tarrif" onkeypress="return onlynumericdot(event)" id="tarrif"
                                                                   readonly="readonly" value="<?php echo $row['tarrif']; ?>" maxlength="7"
                                                                   onblur="uptotwoDec('tarrif',this.value);">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>12.</td>
                                                        <td>Quantity of sludge generated in STP (TPD)</td>
                                                        <td>
                                                            <input class="box-size form-control" name="quantity_sludge_gen_stp"
                                                                   onkeypress="return onlynumericdot(event)" id="quantity_sludge_gen_stp" readonly="readonly"
                                                                   value="<?php echo $row['quantity_sludge_gen_stp']; ?>" maxlength="7"
                                                                   onblur="uptotwoDec('quantity_sludge_gen_stp',this.value);">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>13.</td>
                                                        <td>Mode of sludge disposal</td>
                                                        <td>
                                                            <div class="form-group">
                                                                <select class="form-control" name="mod_sludge_dispo_id" id="mod_sludge_dispo_id"
                                                                        disabled="disabled">
                                                                    <option value="0">-- Select --</option>
                                                                    <?php
                                                                    $SludgeDisposal = $obj->InvtDropDown(5);
                                                                    foreach ($SludgeDisposal as $val) {
                                                                        ?>
                                                                        <option
                                                                            value="<?php echo $val['id']; ?>" <?php if ($row['mod_sludge_dispo_id'] == $val['id']) {
                                                                            echo "selected";
                                                                        } ?>><?php echo $val['stp_name']; ?></option>
                                                                    <?php
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>14.</td>
                                                        <td>Energy requirement per month for running the STP (KwH)</td>
                                                        <td><input class="box-size form-control" name="energy_require_month_run_stp"
                                                                   onkeypress="return onlynumericdot(event)" id="energy_require_month_run_stp" readonly="readonly"
                                                                   value="<?php echo $row['energy_require_month_run_stp']; ?>" maxlength="9"
                                                                   onblur="uptotwoDec('energy_require_month_run_stp',this.value);"></td>
                                                    </tr>
                                                    <tr>
                                                        <td>15.</td>
                                                        <td>Is Energy generated from STP?</td>
                                                        <td>
                                                            <div class="form-group">
                                                                <select class="EnergyGenerated form-control" name="energy_generate_stp" id="energy_generate_stp"
                                                                        disabled="disabled">
                                                                    <option value="0">-- Select --</option>
                                                                    <option value="1" <?php if ($row['energy_generate_stp'] == 1) {
                                                                        echo "selected";
                                                                    } ?>>Yes
                                                                    </option>
                                                                    <option value="2" <?php if ($row['energy_generate_stp'] == 2) {
                                                                        echo "selected";
                                                                    } ?>>No
                                                                    </option>
                                                                </select>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr class="pos-r">
                                                        <td class="left-p" style="position: relative;top: 0;">a.</td>
                                                        <td class="left-p2">If yes, Energy generated per month (KwH)</td>
                                                        <td>
                                                            <input class="box-size form-control" name="energy_gen_gas_stp" id="energy_gen_gas_stp"
                                                                   onkeypress="return onlynumericdot(event)" readonly="readonly"
                                                                   value="<?php echo $row['energy_gen_gas_stp']; ?>" maxlength="9"
                                                                   onblur="uptotwoDec('energy_gen_gas_stp',this.value);">
                                                        </td>
                                                    </tr>
                                                    <tr class="pos-r">
                                                        <td class="left-p" style="position: relative;top: 0;">b.</td>
                                                        <td class="left-p2">Energy used in the STP per month (KwH)</td>
                                                        <td>
                                                            <input class="box-size form-control" name="power_use_stp" id="power_use_stp"
                                                                   onkeypress="return onlynumericdot(event)" readonly="readonly"
                                                                   value="<?php echo $row['power_use_stp']; ?>" maxlength="9"
                                                                   onblur="uptotwoDec('power_use_stp',this.value);">
                                                        </td>
                                                    </tr>
                                                    <tr class="pos-r">
                                                        <td class="left-p" style="position: relative;top: 0;">c.</td>
                                                        <td class="left-p2">Energy fed to the grid per month (KwH)</td>
                                                        <td>
                                                            <div class="form-group">
                                                                <select class="form-control" name="power_fed_grid_id" id="power_fed_grid_id" disabled="disabled">
                                                                    <option value="0">-- Select --</option>
                                                                    <?php
                                                                    $PowerFedGrid = $obj->InvtDropDown(6);
                                                                    foreach ($PowerFedGrid as $val) {
                                                                        ?>
                                                                        <option
                                                                            value="<?php echo $val['id']; ?>" <?php if ($row['power_fed_grid_id'] == $val['id']) {
                                                                            echo "selected";
                                                                        } ?>><?php echo $val['stp_name']; ?></option>
                                                                    <?php
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>16.</td>
                                                        <td>Are truck operators allowed to discharge septage STP?</td>
                                                        <td>
                                                            <div class="form-group">
                                                                <select class="truck_operator_allow_septage form-control" name="truck_operator_allow_septage"
                                                                        id="truck_operator_allow_septage" disabled="disabled">
                                                                    <option value="0">-- Select --</option>
                                                                    <option value="1" <?php if ($row['truck_operator_allow_septage'] == 1) {
                                                                        echo "selected";
                                                                    } ?>>Yes
                                                                    </option>
                                                                    <option value="2" <?php if ($row['truck_operator_allow_septage'] == 2) {
                                                                        echo "selected";
                                                                    } ?>>No
                                                                    </option>
                                                                </select>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                <?php
                                                }
                                                ?>
                                                <tr class="pos-r">
                                                    <td class="left-p" style="position: relative;top: 0;">a.</td>
                                                    <td class="left-p2">If yes, average quantity of septage recieved (KLD)</td>
                                                    <td>
                                                        <input class="box-size form-control" name="avg_quantity_septage_receive"
                                                               onkeypress="return onlynumericdot(event)" id="avg_quantity_septage_receive" readonly="readonly" value="<?php echo $row['avg_quantity_septage_receive']; ?>" maxlength="7" onblur="uptotwoDec('avg_quantity_septage_receive',this.value);">
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php include'includes/footer.php' ?>
    </body>
    </html>
<?php
}
?>
