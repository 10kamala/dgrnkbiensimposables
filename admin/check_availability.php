<?php 
require_once("includes/config.php");
#code for agid availablity agent
if(!empty($_POST["agcode"])) {
$agid = $_POST["agcode"];
$sql = "SELECT AgId FROM tagent WHERE AgId=:agid";
$query = $dbh->prepare($sql);
$query->bindParam(':agid',$agid, PDO::PARAM_STR);
$query->execute();
$results = $query->fetchAll(PDO::FETCH_OBJ);
if($query->rowCount() > 0)
{
echo "<span style='color:red'> Agent id already exists .</span>";
echo "<script>$('#add').prop('disabled',true);</script>";
}else{	
echo "<span style='color:green'> Agent id available for Registration .</span>";
echo "<script>$('#add').prop('disabled',false);</script>";
}
}

#code for emailid availablity agent
if(!empty($_POST["email"])) {
$agid = $_POST["email"];
$sql = "SELECT EmailId FROM tagent WHERE EmailId=:email";
$query = $dbh->prepare($sql);
$query->bindParam(':email', $agid, PDO::PARAM_STR);
$query->execute();
$results = $query->fetchAll(PDO::FETCH_OBJ);
if($query->rowCount() > 0)
{
echo "<span style='color:red'> Email id already exists .</span>";
echo "<script>$('#add').prop('disabled',true);</script>";
}else{
echo "<span style='color:green'> Email available for Registration .</span>";
echo "<script>$('#add').prop('disabled',false);</script>";
}
}

#code for asid availablity assujetti
if(!empty($_POST["ascode"])){
$asid = $_POST["ascode"];
$sql = "SELECT AsId FROM tassujetti WHERE AsId=:asid";
$query = $dbh->prepare($sql);
$query->bindParam(':asid', $asid, PDO::PARAM_STR);
$query->execute();
$results = $query->fetchAll(PDO::FETCH_OBJ);
if($query->rowCount() > 0)
{
echo "<span style='color:red'> Assujetti id already exists .</span>";
echo "<script>$('#add').prop('disabled',true);</script>";
} else{	
echo "<span style='color:green'> Assujetti id available for Registration .</span>";
echo "<script>$('#add').prop('disabled',false);</script>";
}
}

#code for email availablity assujetti
if(!empty($_POST["email"])){
$asid = $_POST["email"];
$sql ="SELECT EmailId FROM tassujetti WHERE EmailId=:email";
$query = $dbh->prepare($sql);
$query->bindParam(':email', $asid, PDO::PARAM_STR);
$query->execute();
$results = $query->fetchAll(PDO::FETCH_OBJ);
if($query->rowCount() > 0)
{
echo "<span style='color:red'> Email id already exists .</span>";
echo "<script>$('#add').prop('disabled',true);</script>";
}else{
echo "<span style='color:green'> Email id available for Registration .</span>";
echo "<script>$('#add').prop('disabled',false);</script>";
}
}
?>
