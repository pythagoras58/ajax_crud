<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AJAX CRUD</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/styles.css">
</head>

<body>

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">

                    <div class="card-header">
                        <h4>PHP AJAX CRUD
                            <button type="button" class="btn btn-primary float-end" data-bs-toggle="modal" data-bs-target="#studentAddModal">
                                Add Student
                            </button>
                        </h4>

                    </div>

                    <div class="card-body">

                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="studentAddModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header" id="modalHead">
                    <h5 class="modal-title  w-100 text-center" id="exampleModalLabel">Add Student</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="studentForm">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="name">Name</label>
                            <input type="text" name="name" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="email">Email</label>
                            <input type="email" name="email" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="phone">Phone</label>
                            <input type="tel" name="phone" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="course">Course</label>
                            <input type="text" name="course" class="form-control">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-outline-primary">Save Student</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).on('submit', '#studentForm', function(e) {
            e.preventDefault();

            var formData = new FormData(this);
            formData.append('save_student', true);

            $.ajax({
                type: 'POST',
                url: 'add.php',
                data: 'formData',
                dataType: 'json',

                success: function(response) {
                    console.log(response);
                    var res = jQuery.parseJSON(response);
                    console.log(res);
                    if (res.status == 422) {
                        Swal.fire({
                            position: 'top-end',
                            icon: 'error',
                            title: res.message,
                            showConfirmButton: false,
                            timer: 1500
                        });
                    }else if(res.status == 200){
                        Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: res.message,
                            showConfirmButton: false,
                            timer: 1500
                        });
                        $('#studentAddModal').modal('hide');
                        $('#studentForm')[0].reset();
                    }
                },
                error: function (response) 
                { console.log('ERROR OCCURED', response); }
            });
        });
    </script>

</body>

</html>