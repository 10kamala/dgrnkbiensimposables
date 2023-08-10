<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
    {   
header('location:index.php');
}else{
if(isset($_POST['update']))
{
$did = intval($_GET['natid']);
$nataux = $_POST['nataux'];
$natdesign = $_POST['natdesign']; 
$natmes = $_POST['natmes']; 
$sql = "update tnature set Taux_id=:nataux,Designation=:natdesign,Mesurage=:natmes where id=:did";
$query = $dbh->prepare($sql);
$query->bindParam(':nataux', $nataux, PDO::PARAM_STR);
$query->bindParam(':natdesign', $natdesign, PDO::PARAM_STR);
$query->bindParam(':natmes', $natmes, PDO::PARAM_STR);
$query->bindParam(':did', $did, PDO::PARAM_STR);
$query->execute();
$msg = "Nature est modifiée avec succes";
}
?><!DOCTYPE html>
<html lang="en">
    <head>
        <!-- Title -->
        <title>Admin | Mise à jour d'une nature</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
        <meta charset="UTF-8">
        <meta name="description" content="Responsive Admin Dashboard Template" />
        <meta name="keywords" content="admin,dashboard" />
        <meta name="author" content="Steelcoders" />
        <!-- Styles -->
        <link type="text/css" rel="stylesheet" href="../assets/plugins/materialize/css/materialize.min.css"/>
        <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link href="../assets/plugins/material-preloader/css/materialPreloader.min.css" rel="stylesheet"> 
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
                        <div class="page-title">Modification d'une avenue</div>
                    </div>
                    <div class="col s12 m12 l12">
                        <div class="card">
                            <div class="card-content">
                                <form id="example-form" method="post" name="addag">
                                    <div>
                                        <h3>Informations sur la nature</h3>
                                        <section>
                                            <div class="wizard-content">
                                                <div class="row">
                                                    <div class="col m6">
                                                        <div class="row">
                                                         <?php if($error){?><div class="errorWrap"><strong>error</strong>:<?php echo htmlentities($error); ?> </div><?php } 
                                                         else if($msg){?><div class="succWrap"><strong>susucces</strong>:<?php echo htmlentities($msg); ?> </div><?php }?>
                                                            <div class="input-field col s12">
                                                            <?php 
                                                                    $did = intval($_GET['natid']);
                                                                    $sql = "SELECT * from tnature WHERE id=:did";
                                                                    $query = $dbh->prepare($sql);
                                                                    $query->bindParam(':did', $did, PDO::PARAM_STR);
                                                                    $query->execute();
                                                                    $results=$query->fetchAll(PDO::FETCH_OBJ);
                                                                    $cnt = 1;
                                                                    if($query->rowCount() > 0)
                                                                    {
                                                                    foreach($results as $result)
                                                                { ?>
                                                                    <input id="nataux" type="text"  class="validate" autocomplete="off" name="nataux" value="<?php echo htmlentities($result->Taux_id); ?>" required>
                                                                    <label for="nataux">Taux</label>
                                                                </div>
                                                                <div class="input-field col s12">
                                                                    <input id="natdesign" type="text"  class="validate" autocomplete="off" name="natdesign" value="<?php echo htmlentities($result->Designation); ?>" required>
                                                                    <label for="natdesign">Designation</label>
                                                                </div>
                                                            </div>
                                                            </div>                                                                                                               
                                                            <div class="col m6">
                                                                <div class="row">
                                                                <div class="input-field col s12">
                                                                    <input id="natmes" type="text"  class="validate" autocomplete="off" name="natmes" value="<?php echo htmlentities($result->Mesurage); ?>" required>
                                                                    <label for="natmes">Mesurage</label>
                                                                </div> 
                                                                <?php }} ?>
                                                                <div class="input-field col s12">
                                                                    <button type="submit" name="update" class="waves-effect waves-light btn indigo m-b-xs">Modifier</button>
                                                                </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </section>
                                        </section>
                                    </div>
                                </form>
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
        <script src="../assets/js/alpha.min.js"></script>
        <script src="../assets/js/pages/form_elements.js"></script>
        
    </body>
</html>
<?php } ?> 