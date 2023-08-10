<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin']) == 0)
{   
header('location:index.php');
}else{
if(isset($_POST['add']))
{
$prid = $_POST['prcode'];
$adrespro = $_POST['adrespro'];
$activpro = $_POST['activpro'];   
$natpro = $_POST['natpro']; 
$agpro = $_POST['agpro']; 
$assujetpro = $_POST['assujetpro']; 
$design = $_POST['design']; 
$status = 1;
$sql = "INSERT INTO tpropriete(PrId,AdresseId,ActiviteId,NatureId,AgentId,AssujettiId,Designation,Status) VALUES(:prid,:adrespro,:activpro,:natpro,:agpro,:assujetpro,:design,:status)";
$query = $dbh->prepare($sql);
$query->bindParam(':prid', $prid, PDO::PARAM_STR);
$query->bindParam(':adrespro', $adrespro, PDO::PARAM_STR);
$query->bindParam(':activpro', $activpro, PDO::PARAM_STR);
$query->bindParam(':natpro', $natpro, PDO::PARAM_STR);
$query->bindParam(':agpro', $agpro, PDO::PARAM_STR);
$query->bindParam(':assujetpro', $assujetpro, PDO::PARAM_STR);
$query->bindParam(':design', $design, PDO::PARAM_STR);
$query->bindParam(':status', $status, PDO::PARAM_STR);
$query->execute();
$lastInsertId = $dbh->lastInsertId();
if($lastInsertId)
{
$msg = "Propety record added Successfully";
}else{
$error = "Something went wrong. Please try again";
}
}
?><!DOCTYPE html>
<html lang="en">
    <head>
        <!-- Title -->
        <title>Admin | Add Assujetti</title>
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

<script>
function checkAvailabilityPrid() {
$("#loaderIcon").show();
jQuery.ajax({
url: "check_availability.php",
data:'prid='+$("#prid").val(),
type: "POST",
success:function(data){
$("#prid-availability").html(data);
$("#loaderIcon").hide();
},
error:function (){}
});
}
</script>
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
                                                            else if($msg){?><div class="succWrap"><strong>success</strong>:<?php echo htmlentities($msg); ?> </div><?php }?>
                                                            <div class="input-field col  s12">
                                                                <label for="prcode">Code (Doit etre unique)</label>
                                                                <input  name="prcode" id="prcode" onBlur="checkAvailabilityPrid()" type="text" autocomplete="off" required>
                                                                <span id="prid-availability" style="font-size:12px;"></span> 
                                                            </div>
                                                            <div class="input-field col m6 s12">
                                                                    <select name="adrespro" autocomplete="off">
                                                                        <option value="">Adresse ...</option>
                                                                        <?php $sql = "SELECT * from tadresse";
                                                                            $query = $dbh->prepare($sql);
                                                                            $query->execute();
                                                                            $results = $query->fetchAll(PDO::FETCH_OBJ);
                                                                            $cnt = 1;
                                                                            if($query->rowCount() > 0)
                                                                            {
                                                                            foreach($results as $result)
                                                                        {?>                                            
                                                                        <option value="<?php echo htmlentities($result->id); ?>"><?php echo htmlentities($result->Numero); ?></option>
                                                                        <?php }} ?>
                                                                    </select>
                                                            </div>
                                                            <div class="input-field col m6 s12">
                                                                    <select name="activpro" autocomplete="off">
                                                                        <option value="">Activite ...</option>
                                                                        <?php $sql = "SELECT * from tactivite";
                                                                            $query = $dbh->prepare($sql);
                                                                            $query->execute();
                                                                            $results = $query->fetchAll(PDO::FETCH_OBJ);
                                                                            $cnt = 1;
                                                                            if($query->rowCount() > 0)
                                                                            {
                                                                            foreach($results as $result)
                                                                        {?>                                            
                                                                        <option value="<?php echo htmlentities($result->id); ?>"><?php echo htmlentities($result->Designation); ?></option>
                                                                        <?php }} ?>
                                                                    </select>
                                                            </div>
                                                            <div class="input-field col m6 s12">
                                                                    <select name="natpro" autocomplete="off">
                                                                        <option value="">Nature ...</option>
                                                                        <?php $sql = "SELECT * from tnature";
                                                                            $query = $dbh->prepare($sql);
                                                                            $query->execute();
                                                                            $results = $query->fetchAll(PDO::FETCH_OBJ);
                                                                            $cnt = 1;
                                                                            if($query->rowCount() > 0)
                                                                            {
                                                                            foreach($results as $result)
                                                                        {?>                                            
                                                                        <option value="<?php echo htmlentities($result->id); ?>"><?php echo htmlentities($result->Designation); ?></option>
                                                                        <?php }} ?>
                                                                    </select>
                                                            </div>
                                                            <div class="input-field col m6 s12">
                                                                    <select name="agpro" autocomplete="off">
                                                                        <option value="">Agent ...</option>
                                                                        <?php $sql = "SELECT * from tagent";
                                                                            $query = $dbh->prepare($sql);
                                                                            $query->execute();
                                                                            $results = $query->fetchAll(PDO::FETCH_OBJ);
                                                                            $cnt = 1;
                                                                            if($query->rowCount() > 0)
                                                                            {
                                                                            foreach($results as $result)
                                                                        {?>                                            
                                                                        <option value="<?php echo htmlentities($result->id); ?>"><?php echo htmlentities($result->FirstName." ".$result->LastName); ?></option>
                                                                        <?php }} ?>
                                                                    </select>
                                                            </div>
                                                            <div class="input-field col m6 s12">
                                                                    <select name="assujetpro" autocomplete="off">
                                                                        <option value="">Assujetti ...</option>
                                                                        <?php $sql = "SELECT * from tassujetti";
                                                                            $query = $dbh->prepare($sql);
                                                                            $query->execute();
                                                                            $results = $query->fetchAll(PDO::FETCH_OBJ);
                                                                            $cnt = 1;
                                                                            if($query->rowCount() > 0)
                                                                            {
                                                                            foreach($results as $result)
                                                                        { ?>                                            
                                                                        <option value="<?php echo htmlentities($result->id); ?>"><?php echo htmlentities($result->FirstName." ".$result->LastName); ?></option>
                                                                        <?php }} ?>
                                                                    </select>
                                                            </div>                                   
                                                            <div class="input-field col m6 s12">
                                                                <label for="design">Nom de la propriété</label>
                                                                <input id="design" name="design" type="text" class="validate" autocomplete="off" required>
                                                            </div>                  
                                                                <div class="input-field col s12">
                                                                    <button type="submit" name="add" onclick="return valid();" id="add" class="waves-effect waves-light btn indigo m-b-xs">Créer</button>
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