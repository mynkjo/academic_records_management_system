<?php 
session_start();
if(!isset($_SESSION['sess_email'])) {
    header('location: ../login.php');
}  
  
?>

<?php
// include database connection file
include("../components/connection.php");
if(isset($_POST['add']))
{
// Posted Values  
$researcher=$_SESSION['sess_name'];
$title=$_POST['title'];
$date=$_POST['date'];
$weblink=$_POST['weblink'];
$description=$_POST['description'];
$user_id=$_SESSION['sess_id'];

try{
    // Query for Insertion into research table
    $sql="INSERT INTO research(title,description,date_of_research,researcher,weblink,user_id) VALUES(:title,:description,:date,:researcher,:weblink,:user_id)";
    
    //Prepare Query for Execution
    $query = $con->prepare($sql);
    // Bind the parameters
    $query->bindParam(':title',$title,PDO::PARAM_STR);
    $query->bindParam(':description',$description,PDO::PARAM_STR);
    $query->bindParam(':date',$date,PDO::PARAM_STR);
    $query->bindParam(':researcher',$researcher,PDO::PARAM_STR);
    $query->bindParam(':weblink',$weblink,PDO::PARAM_STR);
    $query->bindParam(':user_id',$user_id,PDO::PARAM_STR);
    // Query Execution
    $query->execute();
    // Message for successfull insertion
    echo "<script>alert('Record successfully inserted!');</script>";
    echo "<script>window.location.href='research_index.php'</script>"; 
}
catch(PDOException $e){
echo "<script>alert('Something went wrong. Please try again.');</script>";
echo "<script>window.location.href='research_index.php'</script>"; 
}
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Research</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../css/dashboard.css">
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <link rel = "icon" href = "../img/favicon.png" type = "image/x-icon">
</head>
<body>
    
    <!-- Side navigation -->

<!-- The sidebar -->
<div class="sidebar">
  <a class="active" href="../dashboard_home.php">Home</a>
  <a href="../publication/publication_index.php">Publication</a>
  <a href="../project/project_index.php">Project</a>
  <a href="research_index.php"><b>Research</b></a>
  <a href="../setting.php">Change Password</a>
  <a href="../logout.php">Log Out</a>
</div>

<!-- Page content -->
<div class="content">
    <div class="header">
        <h2>Academic Publications Management System</h2>
        <h4 style="color: #1e1f1f;">College of Technology, Pantnagar</h4>
    </div><hr>

    <div class="container"> 
        <div class="add-form" >
            <h3>Add Research</h3><hr>
                <form action="add_research.php" method="post" id="fileForm" role="form">

                    <div class="form-group">   
                        <label for="title"><span class="req"></span>Research Title: </label>
                        <input class="form-control" type="text" name="title" id = "txt" required />
                    </div>

                    <div class="form-group">   
                        <label for="date"><span class="req"></span> Date: </label>
                        <input class="form-control" type="date" name="date" id = "txt" required />
                    </div>

                    <div class="form-group">   
                        <label for="weblink"><span class="req"></span> Weblink: </label>
                        <input class="form-control" type="url" name="weblink" id = "txt" placeholder="http://"/>
                    </div>

                    <div class="form-group">   
                        <label for="description"><span class="req"></span> </label>
                        <textarea rows = "5" cols = "100" name = "description" placeholder="Description about research"></textarea>
                    </div>

                    <div class="form-group">
                        <hr>
                        <input class="btn btn-success" type="submit" name="add" value="Add Research">
                    </div>
                </form>
            <hr>
        </div>
    </div> 
</div>
<?php include "../components/footer.html"; ?>
</body>
</html>