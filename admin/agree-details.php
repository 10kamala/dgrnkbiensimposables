<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin']) == 0)
{   
header('location:index.php');
}else{
// code for update the read notification status
$isread = 1;
$tid = intval($_GET['agrid']);  
date_default_timezone_set('Asia/Kolkata');
$admremarkdate = date('Y-m-d G:i:s ', strtotime("now"));
$sql = "update tdetails set IsRead=:isread where id=:tid";
$query = $dbh->prepare($sql);
$query->bindParam(':isread', $isread, PDO::PARAM_STR);
$query->bindParam(':tid', $tid, PDO::PARAM_STR);
$query->execute();
// code for action taken on leave
if(isset($_POST['update']))
{ 
$tid = intval($_GET['agrid']);
$description = $_POST['description'];
$status = $_POST['status'];   
date_default_timezone_set('Asia/Kolkata');
$admremarkdate=date('Y-m-d G:i:s ', strtotime("now"));
$sql = "update tdetails set AdminRemark=:description,Status=:status,AdminRemarkDate=:admremarkdate where id=:tid";
$query = $dbh->prepare($sql);
$query->bindParam(':description', $description, PDO::PARAM_STR);
$query->bindParam(':status', $status, PDO::PARAM_STR);
$query->bindParam(':admremarkdate', $admremarkdate, PDO::PARAM_STR);
$query->bindParam(':tid', $tid, PDO::PARAM_STR);
$query->execute();
$msg = "Agreement updated Successfully";
}
?><!DOCTYPE html>
<html lang="en">
    <head> 
        <!-- Title -->
        <title>Admin | Agréement Details </title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
        <meta charset="UTF-8">
        <meta name="description" content="Responsive Admin Dashboard Template" />
        <meta name="keywords" content="admin,dashboard" />
        <meta name="author" content="Steelcoders" />
        <!-- Styles -->
        <link type="text/css" rel="stylesheet" href="../assets/plugins/materialize/css/materialize.min.css"/>
        <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link href="../assets/plugins/material-preloader/css/materialPreloader.min.css" rel="stylesheet">
        <link href="../assets/plugins/datatables/css/jquery.dataTables.min.css" rel="stylesheet">
        <link href="../assets/plugins/google-code-prettify/prettify.css" rel="stylesheet" type="text/css"/>  
        <!-- Theme Styles -->
        <link href="../assets/css/alpha.min.css" rel="stylesheet" type="text/css"/>
        <link href="../assets/css/custom.css" rel="stylesheet" type="text/css"/>
<style>
.errorWrap {
    padding: 10px;
    margin: 0 0 20px 0;
    background: #fff;
    border-left: 4px solid #dd3d36;
    -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
    box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
}
.succWrap{
    padding: 10px;
    margin: 0 0 20px 0;
    background: #fff;
    border-left: 4px solid #5cb85c;
    -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
    box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
}
</style>
</head>
    <body>
       <?php include('includes/header.php');?> 
       <?php include('includes/sidebar.php');?>
            <main class="mn-inner">
                <div class="row">
                    <div class="col s12">
                        <div class="page-title" style="font-size:24px;">Details de l'agent</div>
                    </div>
                   
                    <div class="col s12 m12 l12">
                        <div class="card">
                            <div class="card-content">
                                <span class="card-title">Details de l'agent</span>
                                <?php if($msg){?><div class="succWrap"><strong>success</strong> : <?php echo htmlentities($msg); ?> </div><?php }?>
                                <table id="example" class="display responsive-table ">
                                    <tbody>
                                        <?php 
                                        $tid = intval($_GET['agrid']);
                                        $sql = "SELECT tdetails.id as tid,tagent.FirstName,tagent.LastName,tagent.AgId,tagent.id,tagent.Gender,tagent.Phonenumber,tagent.EmailId,tagent.Dob,tdetails.AgrType,tdetails.Description,tdetails.PostingDate,tdetails.Status,tdetails.AdminRemark,tdetails.AdminRemarkDate from tdetails join tagent on tdetails.agid=tagent.id where tdetails.id=:tid";
                                        $query = $dbh->prepare($sql);
                                        $query->bindParam(':tid', $tid, PDO::PARAM_STR);
                                        $query->execute();
                                        $results = $query->fetchAll(PDO::FETCH_OBJ);
                                        $cnt = 1;
                                        if($query->rowCount() > 0)
                                        {
                                        foreach($results as $result)
                                        {         
                                        ?>  
                                        <tr>
                                            <td style="font-size:16px;"> <b>Nom de l'agent :</b></td>
                                              <td><a href="editagent.php?agid=<?php echo htmlentities($result->id); ?>" target="_blank">
                                                <?php echo htmlentities($result->FirstName." ".$result->LastName); ?></a></td>
                                              <td style="font-size:16px;"><b>Agent Id :</b></td>
                                              <td><?php echo htmlentities($result->AgId); ?></td>
                                              <td style="font-size:16px;"><b>Genre :</b></td>
                                              <td><?php echo htmlentities($result->Gender); ?></td>
                                          </tr>

                                          <tr>
                                             <td style="font-size:16px;"><b>Email :</b></td>
                                            <td><?php echo htmlentities($result->EmailId); ?></td>
                                             <td style="font-size:16px;"><b>Contact No. :</b></td>
                                            <td><?php echo htmlentities($result->Phonenumber); ?></td>
                                            <td style="font-size:16px;"><b>Né le :</b></td>
                                            <td><?php echo htmlentities($result->Dob); ?></td>
                                            <td>&nbsp;</td>
                                             <td>&nbsp;</td>
                                        </tr>       
                                        <tr>
                                            <td style="font-size:16px;"><b>Grade :</b></td>
                                            <td><?php echo htmlentities($result->AgrType); ?></td>
                                            <td style="font-size:16px;"><b>Poster en date du :</b></td>
                                            <td><?php echo htmlentities($result->PostingDate); ?></td>
                                        </tr>
                                        <tr>
                                            <td style="font-size:16px;"><b>Description de l'agent : </b></td>
                                            <td colspan="5"><?php echo htmlentities($result->Description); ?></td>
                                        </tr>
                                                <tr>
                                                <td style="font-size:16px;"><b>Status :</b></td>
                                                <td colspan="5"><?php $stats = $result->Status;
                                                if($stats == 1){
                                                ?>
                                                <span style="color: green">Agrée</span>
                                                <?php } if($stats == 2)  { ?>
                                                <span style="color: red">Non Agrée</span>
                                                <?php } if($stats == 0)  { ?>
                                                <span style="color: blue">En attente</span>
                                                <?php } ?>
                                                </td>
                                                </tr>

                                                <tr>
                                                <td style="font-size:16px;"><b>Admin Remark :</b></td>
                                                <td colspan="5"><?php
                                                if($result->AdminRemark == ""){
                                                echo "En attente d'agréement";  
                                                }
                                                else{
                                                echo htmlentities($result->AdminRemark);
                                                }
                                                ?></td>
                                                </tr>

                                                <tr>
                                                <td style="font-size:16px;"><b>Admin Action taken date : </b></td>
                                                <td colspan="5"><?php
                                                if($result->AdminRemarkDate == ""){
                                                echo "NA";  
                                                }
                                                else{
                                                echo htmlentities($result->AdminRemarkDate);
                                                }
                                                ?></td>
                                                </tr>
                                                <?php 
                                                if($stats == 0)
                                                {
                                                ?>
                                                <tr>
                                                <td colspan="5">
                                                <a class="modal-trigger waves-effect waves-light btn" href="#modal1">Take&nbsp;Action</a>
                                                <form name="adminaction" method="post">
                                                <div id="modal1" class="modal modal-fixed-footer" style="height: 60%">
                                                    <div class="modal-content" style="width:90%">
                                                        <h4>Agreement take action</h4>
                                                        <select class="browser-default" name="status" required="">
                                                            <option value="">Selectionnez une des options</option>
                                                            <option value="1">Agrée</option>
                                                            <option value="2">Non agrée</option>
                                                        </select></p>
                                                        <p><textarea id="textarea1" name="description" class="materialize-textarea" name="description" placeholder="Description" length="500" maxlength="500" required></textarea></p>
                                                    </div>
                                                        <div class="modal-footer" style="width:90%">
                                                        <input type="submit" class="waves-effect waves-light btn blue m-b-xs" name="update" value="Submit">
                                                    </div>
                                                </div>   
                                                </td>
                                                </tr>
                                                <?php } ?>
                                                </form>
                                            </tr>
                                         <?php $cnt++; }}?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
        <div class="left-sidebar-hover"></div>
        <!-- Javascripts -->
        <script src="../assets/plugins/jquery/jquery-2.2.0.min.js"></script>
        <script src="../assets/plugins/materialize/js/materialize.min.js"></script>
        <script src="../assets/plugins/material-preloader/js/materialPreloader.min.js"></script>
        <script src="../assets/plugins/jquery-blockui/jquery.blockui.js"></script>
        <script src="../assets/plugins/datatables/js/jquery.dataTables.min.js"></script>
        <script src="../assets/js/alpha.min.js"></script>
        <script src="../assets/js/pages/table-data.js"></script>
         <script src="assets/js/pages/ui-modals.js"></script>
        <script src="assets/plugins/google-code-prettify/prettify.js"></script>
    </body>
</html>
<?php } ?>