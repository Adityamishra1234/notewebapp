<?php 

$insert= false;
$update=false;
$delete= false;
$con = mysqli_connect('localhost' , 'root');

mysqli_select_db($con , 'crud');

if(isset($_GET['delete'])){
  $Sno = $_GET['delete'];
  $delete = true;
  $sql = "DELETE FROM `crudinfo` WHERE `Sno` = $Sno";
  $result = mysqli_query($con, $sql);
}
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
  if (isset( $_POST['SnoEdit'])){
    // Update the record
      $Sno = $_POST["SnoEdit"];
      $title = $_POST["titleEdit"];
      $description = $_POST["descriptionEdit"];
  
    // Sql query to be executed
    $sql = "UPDATE `crudinfo` SET `title` = '$title' , `description` = '$description' WHERE `crudinfo`.`Sno` = $Sno";
    $result = mysqli_query($con, $sql);
    if($result){
      $update = true;
  }
  else{
      echo "We could not update the record successfully";
  }
  }


else
{
$title = $_POST["title"];
$description = $_POST["description"];

 $sql= "INSERT INTO `crudinfo` ( `title`, `description`) VALUES ('$title' , '$description')";
 $result= mysqli_query($con , $sql);
 if($result)
 {
   $insert=true;
 }
 else{
   echo $_SERVER['REQUEST_METHOD'];
   echo ("error caused because of-->" . mysqli_error($con));
 }
}
}
?>
<!doctype html>
<html lang= "en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="//cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="style.css">

    <title>iNoteApp-CRUD</title>
  </head>
  <body>

<!--Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editModalLabel">Edit Note</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="index.php" method="post">
        <div class="modal-body">
           <input type="hidden" name="SnoEdit" id="SnoEdit">
            <div class="mb-3 my-3">
              <label for= "title">Note's Title</label>
              <input type="text" class="form-control" id= "titleEdit" name= "titleEdit">
             <div class="mb-3 my-3">
              <label for= "description"> Note's Description</label>
              <textarea class= "form-control" id= "descriptionEdit" name= "descriptionEdit" height="29px" row="3"></textarea>
             </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
             </div>
        </form>
      </div>
  </div>
</div>
</div>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark my-0">
        <div class="container-fluid">
          <a class="navbar-brand" href="#">iNOTE-APP</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="#">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Link</a>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  Extra
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                  <li><a class="dropdown-item" href="#">Action</a></li>
                  <li><a class="dropdown-item" href="#">Another action</a></li>
                  <li><hr class="dropdown-divider"></li>
                  <li><a class="dropdown-item" href="#">Something else here</a></li>
                </ul>
              </li>
              <li class="nav-item">
                <a class="nav-link disabled">Disabled</a>
              </li>
            </ul>
            <form class="d-flex">
              <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
              <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
          </div>
        </div>
      </nav>

<?php
if($insert)
{
  echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
        <strong>Success!</strong> Your note has been successfully ADDED.
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
      </div>";
}
?>
<?php
  if($delete){
    echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
    <strong>Success!</strong> Your note has been successfully DELETED.
    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
  </div>";
  }
  ?>
  <?php
  if($update){
    echo "<div class='alert alert-primary alert-dismissible fade show' role='alert'>
    <strong>Success!</strong> Your note has been successfully UPDATED.
    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
  </div>";
  }
  ?>

      <div class="container my-2">
          <h2>Add Your Notes!</h2>
        <form action="index.php" method="post">
            <div class="mb-3 my-3">
              <label for= "title" >Note's Title</label>
              <input type="text" class="form-control" id= "title" name = "title">
            <div class="mb-3 my-3">
              <label for= "description" >Note's Description</label>
              <textarea class="form-control" id= "description" name= "description" height="29px" width="20px"></textarea>
            </div>
            <div class="mb-3 form-check">
              <input type="checkbox" class="form-check-input" id="exampleCheck1">
              <label class="form-check-label" for="exampleCheck1">Check me out</label>
            </div>
            <button type="submit" class="btn btn-primary">Add Note</button>
          </form>
      </div>
      <div class="container" >

<table class="table" id= "myTable">
  <thead>
    <tr>
      <th scope="col">S.no</th>
      <th scope="col">Note Title</th>
      <th scope="col">Note-Description</th>
      <th scope="col">Actions</th>
    </tr>
  </thead>
  <tbody>
    <?php 
    $sql= "SELECT * FROM `crudinfo`";
    $result= mysqli_query($con , $sql);
    $Sno = 0;
    while($row = mysqli_fetch_assoc($result))
    {
      $Sno+= 1;
      echo "<tr>
      <th scope='row'>" . $Sno . "</th>
      <td>" . $row['title'] . "</td>
      <td>" . $row['description'] . "</td>
      <td>  <button class= 'edit btn btn-sm btn-success' id=".$row['Sno']."> Edit </button> <button  class='delete btn btn-sm btn danger' id=d".$row['Sno']."> Delete</td>
      </tr>";
    }  
    ?>
      
  </tbody>
</table>
  </div>
    <!-- Optional JavaScript; choose one of the two! -->
    <script src="https://code.jquery.com/jquery-3.6.0.slim.min.js" integrity="sha256-u7e5khyithlIdTpu22PHhENmPcRdFiHRjhAuHcs05RI=" crossorigin="anonymous"></script>
    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    <script src="//cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script>
      $(document).ready(function() {
            $('#myTable').DataTable();

             });
    </script>
    <script>
      edits = document.getElementsByClassName('edit');
      Array.from(edits).forEach((element) =>{
        element.addEventListener("click" , (e) => {
          console.log("edit");
          tr = e.target.parentNode.parentNode;
          title= tr.getElementsByTagName("td")[0].innerText;
          description= tr.getElementsByTagName("td")[1].innerText;
          console.log(title , description);
          titleEdit.value = title;
          descriptionEdit.value = description;
          SnoEdit.value = e.target.id;
          console.log(e.target.id);
          $('#editModal').modal('toggle');
        })
      })

      deletes = document.getElementsByClassName('delete');
      Array.from(deletes).forEach((element) => {
      element.addEventListener("click", (e) => {
        console.log("edit");
        Sno = e.target.id.substr(1,);

        if (confirm("Are you sure you want to delete this note!")) {
          console.log("yes");
          window.location = `index.php?delete=${Sno}`;
          // TODO: Create a form and use post request to submit a form
        }
        else {
          console.log("no");
        }
      })
    })
    </script>
  </body>
</html>