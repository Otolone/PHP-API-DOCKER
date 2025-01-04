<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .sidebar {
            height: 100vh;
            background-color: #f8f9fa;
        }
        .sidebar a {
            font-size: 1rem;
            padding: 10px 15px;
        }
        .content {
            padding: 20px;
        }
        .topbar {
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
        }
        .services {
            text-align: center;
            padding: 20px;
            background-color: #f8f9fa;
            border-radius: 5px;
            border: 1px solid #ddd;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <nav class="col-md-2 d-none d-md-block bg-light sidebar">
                <div class="sidebar-sticky">
                    <ul class="nav flex-column">
                      <li class="nav-item">
                            <a class="nav-link" href="#">
                                Services
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                Revenue
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                Payouts
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                Transactions
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                Operations
                            </a>
                        </li>        
                                          
                        
                    </ul>
                </div>
            </nav>

            <!-- Main Content -->
            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
                <!-- Topbar -->
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom topbar">
                    <h1 class="h4">Dashboard</h1>
                    <div>
                        <span>English</span> |
                        <a href="#" class="text-white">Logout</a>
                    </div>
                </div>

                <!-- Tabs -->
                <div class="btn-group btn-group-toggle mb-3" data-toggle="buttons">
                    <label class="btn btn-light active">
                        <input type="radio" name="options" id="option1" autocomplete="off" checked> Services
                    </label>
                    <label class="btn btn-light">
                        <input type="radio" name="options" id="option2" autocomplete="off"> Revenue
                    </label>
                    <label class="btn btn-light">
                        <input type="radio" name="options" id="option3" autocomplete="off"> Payouts
                    </label>
                    <label class="btn btn-light">
                        <input type="radio" name="options" id="option4" autocomplete="off"> Transactions
                    </label>
                    <label class="btn btn-light">
                        <input type="radio" name="options" id="option5" autocomplete="off"> Edit profile
                    </label>
                </div>

                <!-- Services Section -->
                <div class="services">
                    <img src="https://via.placeholder.com/150" alt="No services" class="mb-3">
                    <h5>No services</h5>
                    <button class="btn btn-primary">Create new service</button>
                </div>
 
            </main>
        </div>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
