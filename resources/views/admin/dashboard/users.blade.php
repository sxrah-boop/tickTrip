<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Dashboard</title>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <!-- Custom Stylesheet -->
    <link rel="stylesheet" href="{{ asset('css/dashboardStyle.css') }}">

    <!-- Bootstrap Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.7.2/font/bootstrap-icons.min.css"
        rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- Local Bootstrap CSS (Replace with your path) -->
    <link rel="stylesheet" href="{{ asset('bootstrap-5.3.2-dist/css/bootstrap.css') }}">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round|Open+Sans">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- DataTables CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <!-- DataTables JS -->
    <script type="text/javascript" charset="utf8"
        src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>



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
                        <a href="#" data-toggle="modal" data-target="#editModal{{ $user->id }}">
                            <i class="fas fa-edit me-2"></i>
                        </a>
                        <a href="#" data-toggle="modal" data-target="#deleteModal{{ $user->id }}">
                            <i class="fas fa-trash-alt"></i>
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    </div>
</body>


<script>
    $(document).ready(function () {
        // DataTables initialization
        var dataTable = $('#dtUsers').DataTable({
            "paging": true,
            "ordering": true,
            "info": false,
            "searching": true // Enable searching
        });

        // Apply search on input change
        $('#search').on('keyup', function () {
            dataTable.search(this.value).draw();
        });
    });
</script>


</html>