<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin']) == 0)
{   
header('location:index.php');
}else{
$pid = intval($_GET['prid']);
if(isset($_POST['update']))
{
    $adrespro = $_POST['adrespro'];
    $activpro = $_POST['activpro'];   
    $natpro = $_POST['natpro']; 
    $agpro = $_POST['agpro']; 
    $assujetpro = $_POST['assujetpro']; 
    $design = $_POST['design']; 
    $sql = "update tpropriete set AdresseId=:adrespro,ActiviteId=:activpro,NatureId=:natpro,AgentId=:agpro,AssujettiId=:assujetpro,Designation=:design where id=:pid";
    $query = $dbh->prepare($sql);
    $query->bindParam(':adrespro', $adrespro, PDO::PARAM_STR);
    $query->bindParam(':activpro', $activpro, PDO::PARAM_STR);
    $query->bindParam(':natpro', $natpro, PDO::PARAM_STR);
    $query->bindParam(':agpro', $agpro, PDO::PARAM_STR);
    $query->bindParam(':assujetpro', $assujetpro, PDO::PARAM_STR);
    $query->bindParam(':design', $design, PDO::PARAM_STR);
    $query->bindParam(':pid', $pid, PDO::PARAM_STR);
    $query->execute();
    $msg = "Propriety record updated Successfully";
}
?><!DOCTYPE html>
<html lang="en">
    <head>
        <!-- Title -->
        <title>Admin | Update Property</title>
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
.errorWrap{
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
                        <div class="page-title">Création de la propriété</div>
                    </div>
                    <div class="col s12 m12 l12">
                        <div class="card">
                            <div class="card-content">
                                <form id="example-form" method="post" name="addpr">
                                    <div>
                                        <h3>Informations de la propriété</h3>
                                        <section>
                                            <div class="wizard-content">
                                                <div class="row">
                                                    <div class="col m6">
                                                        <div class="row">
                                                         <?php if($error){?><div class="errorWrap"><strong>error</strong>:<?php echo htmlentities($error); ?> </div><?php } 
                                                         else if($msg){?><div class="succWrap"><strong>susucces</strong>:<?php echo htmlentities($msg); ?> </div><?php }?>
                                                        <?php 
                                                            $pid = intval($_GET['prid']);
                                                            $sql = "SELECT * from tpropriete WHERE id=:pid";
                                                            $query = $dbh->prepare($sql);
                                                            $query->bindParam(':pid', $pid, PDO::PARAM_STR);
                                                            $query->execute();
                                                            $results = $query->fetchAll(PDO::FETCH_OBJ);
                                                            $cnt = 1;
                                                            if($query->rowCount() > 0)
                                                            {
                                                            foreach($results as $result)
                                                            { ?>  
                                                            <div class="row">
                                                            <div class="input-field col  s12">
                                                                <label for="prid">Code (Doit etre unique)</label>
                                                                <input  name="prid" id="prid" type="text" autocomplete="off" readonly value="<?php echo htmlentities($result->PrId) ;?>" required>
                                                                <span id="prid-availability" style="font-size:12px;"></span> 
                                                            </div>
                                                            <div class="input-field col s12">
                                                                <input id="adrespro" type="text"  class="validate" autocomplete="off" name="adrespro" value="<?php echo htmlentities($result->AdresseId); ?>" required>
                                                                <label for="adrespro">Adresse</label>
                                                            </div>
                                                            <div class="input-field col s12">
                                                                <input id="activpro" type="text"  class="validate" autocomplete="off" name="activpro" value="<?php echo htmlentities($result->ActiviteId);?>" required>
                                                                <label for="activpro">Activité</label>
                                                            </div>
                                                            <div class="input-field col s12">
                                                                <input id="natpro" type="text"  class="validate" autocomplete="off" name="natpro" value="<?php echo htmlentities($result->NatureId); ?>" required>
                                                                <label for="natpro">Nature</label>
                                                            </div>
                                                            <div class="input-field col s12">
                                                                <input id="agpro" type="text"  class="validate" autocomplete="off" name="agpro" value="<?php echo htmlentities($result->AgentId); ?>" required>
                                                                <label for="agpro">Agent</label>
                                                            </div>
                                                            <div class="input-field col m6 s12">
                                                                <label for="assujetpro">Nom de la propriété</label>
                                                                <input id="assujetpro" type="text" class="validate" autocomplete="off" name="assujetpro" value="<?php echo htmlentities($result->AssujettiId);?>" required>
                                                            </div>
                                                            <div class="input-field col m6 s12">
                                                                <label for="design">Nom de la propriété</label>
                                                                <input id="design" type="text" name="design" value="<?php echo htmlentities($result->Designation);?>" required>
                                                            </div>
                                                            <?php }} ?> 
                                                            <div class="input-field col s12">
                                                            <button type="submit" name="update"  id="update" class="waves-effect waves-light btn indigo m-b-xs">Modifier</button>
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