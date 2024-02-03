<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Dashboard</title>

    <!-- Stylesheets -->
    <link rel="stylesheet" href="{{ asset('css/dashboardStyle.css') }}">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.7.2/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('bootstrap-5.3.2-dist/css/bootstrap.css') }}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round|Open+Sans">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">

</head>

<body>

    <div class="col-md-2" style="float: left;">
        <div id="wrapper">
            <!-- Sidebar -->
            <div id="sidebar-wrapper">
                <ul class="sidebar-nav">
                    <li class="sidebar-brand my-4 ms-4">
                        <a class="navbar-brand" href="{{ route('home') }}"><img src="/images/logobyed.svg" alt="" /></a>
                    </li>
                    <li>
                        <a href="{{ route('dashboard') }}" id="dashboardTab">
                            <i class="fas fa-home me-2"></i> Dashboard
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('dashboard.users') }}" id="usersTab">
                            <i class="fas fa-user me-2"></i> Users
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('dashboard.trips') }}" id="tripsTab">
                            <i class="fas fa-suitcase me-2"></i> Trips
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('dashboard.reservations') }}">
                            <i class="fas fa-clock me-2"></i> Reservations
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="fas fa-cogs me-1"></i> Settings
                        </a>
                    </li>

                    <br>
                    <!-- Logout button -->
                    <li>
                        <a href="{{ route('logout') }}">
                            <i class="fas fa-sign-out-alt me-2"></i> Logout
                        </a>

                    </li>
                </ul>
            </div>
            <!-- /#sidebar-wrapper -->
        </div>

    </div>
    <!-- content part -->
    <div class="container col-md-10" style="float: right;padding:2rem;">
        <h1 class="text-center">Users View</h1>
        <BR></BR>
        <!-- Add User Button -->
        <a href="#" class="btn btn-primary mb-2" data-toggle="modal" data-target="#addUserModal" style="float: right;">
            <i class="fas fa-plus me-2"></i> Add User
        </a>
        <table id="dtUsers" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th class="th-sm">ID</th>
                    <th class="th-sm">Firstname</th>
                    <th class="th-sm">Lastname</th>
                    <th class="th-sm">Role</th>
                    <th class="th-sm">Email</th>
                    <th class="th-sm">Matricule</th>
                    <th class="th-sm">Phone</th>
                    <th class="th-sm">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->firstname }}</td>
                    <td>{{ $user->lastname }}</td>
                    <td>{{ $user->role->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->matricule }}</td>
                    <td>{{ $user->phone }}</td>
                    <!-- Add other user details as needed -->
                    <td>
                        <!-- Edit and delete icons with data-toggle attributes for modals -->
                        <a href="#" data-toggle="modal" data-target="#editUserModal{{ $user->id }}">
                            <i class="fas fa-edit me-2"></i>
                        </a>
                        <a href="#" data-toggle="modal" data-target="#deleteModal{{ $user->id }}">
                            <i class="fas fa-trash-alt"></i>
                        </a>
                    </td>
                    <!-- Delete Modal -->
                    <div class="modal fade" id="deleteModal{{ $user->id }}" tabindex="-1"
                        aria-labelledby="deleteModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="deleteModalLabel">Confirm Delete</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <p>Are you sure you want to delete this user?</p>
                                    <form action="{{ route('dashboard.users.delete', ['userId' => $user->id]) }}"
                                        method="post">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Edit User Modal -->
                    <div class="modal fade" id="editUserModal{{ $user->id }}" tabindex="-1"
                        aria-labelledby="editUserModalLabel{{ $user->id }}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editUserModalLabel">Edit User</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <!-- Edit User Form -->
                                    <form id="editUserForm" action="{{ route('update-user', ['userId' => $user->id]) }}" method="POST">
                                        @csrf <!-- CSRF token for security -->
                                        @method('PATCH')
                                        <!-- User Details Fields -->
                                        <input type="hidden" id="editUserId" name="editUserId" />
                                        
                                        <div class="form-outline mb-2">
                                            <label class="form-label" for="editFirstname">First name</label>
                                            <input type="text" id="editFirstname" name="editFirstname" class="form-control" value="{{ $user->firstname }}" />
                                            <div id="editFirstnameError" class="text-danger"></div>
                                        </div>
                                        
                                        <div class="form-outline mb-2">
                                            <label class="form-label" for="editLastname">Last name</label>
                                            <input type="text" id="editLastname" name="editLastname" class="form-control" value="{{ $user->lastname }}" />
                                            <div id="editLastnameError" class="text-danger"></div>
                                        </div>
                                        
                                        <div class="form-outline mb-2">
                                            <label class="form-label" for="editMatricule">Matricule</label>
                                            <input type="text" id="editMatricule" name="editMatricule" class="form-control" value="{{ $user->matricule }}" />
                                            <div id="editMatriculeError" class="text-danger"></div>
                                        </div>
                                        
                                        <div class="form-outline mb-2">
                                            <label class="form-label" for="editEmail">Email address</label>
                                            <input type="email" id="editEmail" name="editEmail" class="form-control" value="{{ $user->email }}" />
                                            <div id="editEmailError" class="text-danger"></div>
                                        </div>
                                        
                                        <div class="form-outline mb-2">
                                            <label class="form-label" for="editPhone">Phone</label>
                                            <input type="text" id="editPhone" name="editPhone" class="form-control" value="{{ $user->phone }}" />
                                            <div id="editPhoneError" class="text-danger"></div>
                                        </div>
                                    
                                        <!-- Submit Button -->
                                        <div class="d-flex justify-content-end pt-3 mb-3">
                                            <button class="btn btn-primary btn-rounded" type="submit" id="saveChangesBtn">Save Changes</button>
                                        </div>
                                    </form>
                                    
                                    <!-- Display server-side validation errors -->
                                    @if ($errors->any())
                                        <div class="alert alert-danger">
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    </div>
    <!-- add user modal -->
    <div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addUserModalLabel">Add User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Add User Form -->
                    <form id="addUserForm" action="{{ route('register-user') }}" method="POST">
                        @csrf <!-- CSRF token for security -->

                        <!-- User Details Fields -->
                        <div class="form-outline mb-2">
                            <label class="form-label" for="firstname">First name</label>
                            <input type="text" id="firstname" name="firstname" class="form-control"
                                value="{{ old('firstname') }}" />
                            <div id="firstnameError" class="text-danger"></div>
                        </div>

                        <div class="form-outline mb-2">
                            <label class="form-label" for="lastname">Last name</label>
                            <input type="text" id="lastname" name="lastname" class="form-control"
                                value="{{ old('lastname') }}" />
                            <div id="lastnameError" class="text-danger"></div>
                        </div>

                        <div class="form-outline mb-2">
                            <label class="form-label" for="matricule">Matricule</label>
                            <input type="text" id="matricule" name="matricule" class="form-control"
                                value="{{ old('matricule') }}" />
                            <div id="matriculeError" class="text-danger"></div>
                        </div>

                        <div class="form-outline mb-2">
                            <label class="form-label" for="email">Email address</label>
                            <input type="email" id="email" name="email" class="form-control"
                                value="{{ old('email') }}" />
                            <div id="emailError" class="text-danger"></div>
                        </div>

                        <div class="form-outline mb-2">
                            <label class="form-label" for="phone">Phone</label>
                            <input type="text" id="phone" name="phone" class="form-control"
                                value="{{ old('phone') }}" />
                            <div id="phoneError" class="text-danger"></div>
                        </div>

                        <div class="form-outline mb-3">
                            <label class="form-label" for="password">Password</label>
                            <input type="password" id="password" name="password" class="form-control" />
                            <div id="passwordError" class="text-danger"></div>
                        </div>

                        <!-- Submit Button -->
                        <div class="d-flex justify-content-end pt-3 mb-3">
                            <button class="btn btn-primary btn-rounded" type="button" onclick="submitForm()">Add
                                User</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>

<script>
    $(document).ready(function () {
        // DataTables initialization
        var dataTable = $('#dtUsers').DataTable({
            "paging": true,
            "ordering": true,
            "info": true,
            "searching": true // Enable searching
        });

        // Apply search on input change
        $('#search').on('keyup', function () {
            dataTable.search(this.value).draw();
        });
        // Attach a click event handler to the saveChangesBtn button
        $('#saveChangesBtn').click(function () {
        
            $('#editUserForm').submit();
        });
        });

    function submitForm() {
        // Serialize the form data
        var formData = $('#addUserForm').serialize();

        // Clear previous errors
        clearErrors();

        // Submit the form using AJAX
        $.ajax({
            url: $('#addUserForm').attr('action'),
            type: 'POST',
            data: formData,
            success: function (response) {
                // Handle success if needed
                console.log(response);
                // Clear form fields
                clearFormFields();
                // Close the modal if the form submission is successful
                $('#addUserModal').modal('hide');
            },
            error: function (xhr) {
                // Handle errors and display them dynamically
                if (xhr.status === 422) {
                    var errors = xhr.responseJSON.errors;
                    $.each(errors, function (key, value) {
                        $('#' + key + 'Error').text(value[0]);
                    });
                }
            }
        });
    }
    function clearFormFields() {
        // Clear form fields
        $('#addUserForm')[0].reset();
    }
    function clearErrors() {
        // Clear error messages
        $('.text-danger').text('');
    }

</script>
</body>
</html>