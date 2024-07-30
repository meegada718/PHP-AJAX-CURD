<?php
require 'dbcon.php';
?>

<!doctype html>

<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Hello, world!</title>
  </head>
  <body>
  <div class="modal fade" id="studentAddModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Student</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form id="saveStudent">
      <div class="modal-body">
        <div class="alert alert-warning d-none">

        </div>
        <div class="mb-3">
            <label for="">Name</label>
            <input type="text" name="name" class="form-control" required>       
         </div>
         <div class="mb-3">
            <label for="">Email</label>
            <input type="text" name="email" class="form-control">       
         </div>
         <div class="mb-3">
            <label for="">Phone</label>
            <input type="text" name="phone" class="form-control">       
         </div>
         <div class="mb-3">
            <label for="">Course</label>
            <input type="text" name="course" class="form-control">       
         </div>
         
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save Student</button>
      </div>
</form>
    </div>
  </div>
</div>
  <div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>PHP Ajax CURD page reload using Bootstrap Model
                    <button type="button" class="btn btn-primary float-end" data-bs-toggle="modal" data-bs-target="#studentAddModal">
                 Add Student
                </button>
                </h4>
                </div>
                <div class="card-body">
               <table id="myTable" class="table table-bordered table-striped">
               <thead>
                <tr>
                    <th>ID</th>
                    <th>NAME</th>
                    <th>EMAIL</th>
                    <th>PHONE</th>
                    <th>COURSE</th>
                    <th>ACTION</th>
                </tr>
               </thead>
              <tbody>
                <?php
                $query = "SELECT * FROM students";
                $query_run = mysqli_query($con, $query);
                if(mysqli_num_rows($query_run) > 0)
                {
                    foreach($query_run as $student){

                    ?>
                    <tr>
                    <td><?= $student['id']?></td>
                    <td><?= $student['name']?></td>
                    <td><?= $student['email']?></td>
                    <td><?= $student['phone']?></td>
                    <td><?= $student['course']?></td>
                    <td>
                        <a href="" class="btn btn-success">Edit</a>
                        <a href="" class="btn btn-info">View</a>
                        <a href="" class="btn btn-danger">Delete</a>
                    </td>
               </tr>
               <?php
                }
                }
                ?>
                
              </tbody>
            </table>
                </div>
            </div>
        </div> 
    </div>
</div>
    

   

    
    <script src="https://code.jquery.com/jquery-3.6.3.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>

   <script>
    $(document).on('submit','#saveStudent',function (e){
        e.preventDefault();

        var formData = new FormData(this);
        formData.append("save_student", true);
        $.ajax({
            type: "POST",
            url: "code.php",
            data: formData,
            processData: false,
            contentType: false,
            success: function (responce) {
                   

                var res = jQuery.parseJSON(responce);
                if(res.status == 422){
                    $('#errorMessage').removeClass('d-none');
                    $('#errorMessage').text(res.message);
                }else if(res.status == 200){
                    $('#errorMessage').addClass('d-none');
                    $('#studentAddModal').modal('hide');
                    $('#saveStudent')[0].reset();
                    $('#myTable').load(location.href + " #myTable")
                }
            }
        });
    });
   </script>
  </body>
</html>