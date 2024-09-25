<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>SSD-SFTP</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" type="image/x-icon" href="img/fav.png">
        <script src="{{URL::asset('js/jquery.js') }}"></script>
		<script src="{{URL::asset('js/datables.js') }}"></script>
        <script src='https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js' defer></script>
        <script src="https://kit.fontawesome.com/a5b3b870d7.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" defer></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" defer></script>
        <link rel="stylesheet" type="text/css" href="{{URL::asset('css/style.css')}}">
    </head>
    <body>
        <!-- ! partial:Page SideNav html -->
        <link rel="stylesheet" type="text/css" href="{{URL::asset('css/data-table.css')}}">
		<link rel="stylesheet" type="text/css" href="{{URL::asset('css/form.css') }}">
		<link rel="stylesheet" type="text/css" href="{{URL::asset('css/sidenav.css')}}">
        <div class="sidenav">
            <link rel="stylesheet" type="text/css" href="css/grab.css">
            <link rel="stylesheet" style="display: none;">

            <div class="logo-container">
                <img class="ssd-logo to-home" id="ssd-logo" src="{{URL::asset('img/South_Star_Drug_logo.png')}}" alt="ssd-logo">
            </div>
            <aside class="sidebar">
                <div id="leftside-navigation">
                    <ul class="level-0">
                        <li class="parent Grab-nav" id="parent-li">
                            <a href="#"><span> <img class="grab-logo" id="vendor-logo"  src="{{URL::asset('img/Logo-Grabmart.png')}}"
                                        alt="ssd-logo"></span><i class="arrow fa fa-angle-right"></i></a>
                            <ul class="level-1">
                                <li class="parent" id="link">
                                    <a href="#" id="GrabSku"><span>SKU Maintenance</span>
                                    </a>
                                </li>
                                <li class="parent" id="link">
                                    <a href="#" id="GrabStore"><span>Store Maintenance</span>
                                    </a>
                                </li>
                            </ul>
                        </li>

                    </ul>
                </div>
            </aside>
            <script src="js/sidenav.js"></script>
        </div>
        <!-- ! partial:Page SideNav html -->

        <div class="page-content toast-container" id="toast-container">

            <link rel="stylesheet"
                href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />


            <link rel="stylesheet" href="{{URL::asset('css/toast.css')}}">

            <div class="view-header toast-header" id="toast-header">
                <div></div>
                <div class="vendor-logo">
                    <img class="ssd-lg" src="img/South_Star_Drug_logo.png" alt="ssd-logo">
                    <!-- <span>
                        <p> We care a little more</p>
                    </span> -->
                </div>
            </div>
            <div class="toast" id="toast">
                <!-- <img src="./img/fav.png" alt=""> -->
                <span class="material-symbols-outlined ssd-icon">
                    add_circle
                </span>
                <span>
                    <h1 class="neu">Southstar Drug SFTP</h1>
                </span>

            </div>
        </div>

        <!--! partial:Page Grab-SKU.html -->
        <div class="page-content Grab view-hidden" id="sftpGrab"
            style="overflow-y: auto; flex-direction: column;  align-items: center; ">
            <div class="view-header">
                <div></div>
                <div class="vendor-logo">
                    <img class="grab-logo" id="vendor-logo" src="{{URL::asset('img/Logo-Grabmart.png')}}" alt="ssd-logo">
                </div>
            </div>
            <div class="table-cont Grab-tb-cont">
                <!-- Add Vendor Button -->
                <button type="button" class="btn btn-primary add" data-toggle="modal" data-target="#GrabAddSKUModal">Add
                    SKU</button>

                <table id="GrabSKUTable" class="table table-bordered Grab-table">
            </div>
            <thead>
                <tr>
                    <th>SKU Numbers</th>
                    <th> Piece to Pack</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <!-- Data will be loaded here via JavaScript -->
            </tbody>
            </table>
        </div>

        <!-- Grabs Add SKU Modal -->
        <div class=" modal fade" id="GrabAddSKUModal" tabindex="-1" role="dialog" aria-labelledby="GrabAddSKUModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header Grab-header ">
                        <h5 class="modal-title" id="GrabAddSKUModalLabel">Add SKU</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- Add Vendor form content here -->
                        <form id="GrabAddSKUForm">
                            <div class="form-group input-container">
                                <label for="GrabAddSKUNumber">SKU Number</label>
                                <input type="text" class="form-control" id="GrabAddSKUNumber" name="GrabAddSKUNumber"
                                    placeholder=" Enter SKU Number">
                            </div>
                            <div class="form-group input-container">
                                <label for="GrabAddPiecetoPack">Piece to Pack</label>
                                <input type=" text" class="form-control" id="GrabAddPiecetoPack" name="GrabAddPiecetoPack"
                                    placeholder=" Enter Piece to Pack">
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <div class="notif-container">
                            <p class="addSKUNotif" id="addSKUNotif">
                            </p>
                        </div>
                        <div>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" id="GrabAddSKUModalButton">Add</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!--Grab Edit SKU Modal -->
        <div class="modal fade" id="GrabEditSKUModal" tabindex="-1" role="dialog"
            aria-labelledby="vsetupEditVendorModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header Grab-header">
                        <h5 class="modal-title" id="GrabEditSKUNumberModalLabel">Edit SKU</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- Edit Vendor form content here -->
                        <form id="GrabEditSKUForm">
                            <div class="form-group input-container">
                                <label for="GrabEditSKUNumber">SKU Number</label>
                                <input type="text" class="form-control" id="GrabEditSKUNumber" name="GrabEditSKUNumber"
                                    placeholder="Enter SKU Number">
                            </div>
                            <div class="form-group input-container">
                                <label for="vsetupEditVendorID">Piece to Pack</label>
                                <input type="text" class="form-control" id="GrabEditPiecetoPack" name="GrabEditPiecetoPack"
                                    placeholder="Enter Piece to Pack">
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id="GrabSaveEditSKUButton">Save
                            Changes</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Delete Vendor Confirmation Modal -->
        <div class="modal fade" id="GrabDeleteSKUConfirmationModal" tabindex="-1" role="dialog"
            aria-labelledby="GrabDeleteSKUConfirmationModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header Grab-header ">
                        <h5 class="modal-title" id="GrabDeleteSKUConfirmationModal">Confirm Deletion
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body delete-msg">
                        Are you sure you want to delete this SKU?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-danger" id="GrabConfirmDeleteSKU">Delete</button>
                    </div>
                </div>
            </div>
        </div>
        <script src="js/grab-sku.js"></script>
        </div>
        <!--! partial:Page Grab-SKU.html -->

        <!--! partial:Page Grab-Store.html -->
        <div class="page-content Grab view-hidden" id="sftpGrabStore"
            style="overflow-y: auto; flex-direction: column;  align-items: center;  ">

            <link rel="stylesheet" href="{{URL::asset('css/toggle.css')}}">


            <div class="view-header">
                <div></div>
                <div class="vendor-logo">
                    <img class="grab-logo" id="vendor-logo" src="img/Logo-Grabmart.png" alt="ssd-logo">
                </div>
            </div>
            <div class="table-cont Grab-tb-cont">
                <!-- Add Store Button -->
                <button type="button" class="btn btn-primary add" data-toggle="modal" data-target="#GrabAddStoreModal">Add
                    Store</button>

                <table id="GrabStoreTable" class="table table-bordered Grab-table">
            </div>
            <thead>
                <tr>
                    <th>Participating Store</th>
                    <th style="width: 18% !important;">Grab Maintenence</th>
                    <th style="width: 18%;">Actions</th>
                </tr>
            </thead>
            <tbody>
                <!-- Data will be loaded here via JavaScript -->
            </tbody>
            </table>
        </div>

        <!-- Grabs Add Store Modal -->
        <div class=" modal fade" id="GrabAddStoreModal" tabindex="-1" role="dialog" aria-labelledby="GrabAddStoreModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header Grab-header ">
                        <h5 class="modal-title" id="GrabAddStoreModalLabel">Add Store</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- Add Store form content here -->
                        <form id="GrabAddStoreForm">
                            <div class="form-group input-container">
                                <label for="GrabAddStoreId">Store ID</label>
                                <input type="text" class="form-control" id="GrabAddStoreId" name="GrabAddStoreId"
                                    placeholder=" Enter Store ID Number">
                            </div>
                            <!-- <div class="form-group input-container">
                                <label for="GrabAddPiecetoPack">Piece to Pack</label>
                                <input type=" text" class="form-control" id="GrabAddPiecetoPack" name="GrabAddPiecetoPack"
                                    placeholder=" Enter Piece to Pack">
                            </div> -->
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id="GrabAddStoreModalButton">Add</button>
                    </div>
                </div>
            </div>
        </div>

        <!--Grab Edit Store Modal -->
        <div class="modal fade" id="GrabEditStoreModal" tabindex="-1" role="dialog"
            aria-labelledby="vsetupEditVendorModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header Grab-header">
                        <h5 class="modal-title" id="GrabEditSKUNumberModalLabel">Edit SKU</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- Edit Store form content here -->
                        <form id="GrabEditSKUForm">
                            <div class="form-group input-container">
                                <label for="GrabEditSKUNumber">SKU Number</label>
                                <input type="text" class="form-control" id="GrabEditSKUNumber" name="GrabEditSKUNumber"
                                    placeholder="Enter SKU Number">
                            </div>
                            <div class="form-group input-container">
                                <label for="vsetupEditVendorID">Piece to Pack</label>
                                <input type="text" class="form-control" id="GrabEditPiecetoPack" name="GrabEditPiecetoPack"
                                    placeholder="Enter Piece to Pack">
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id="GrabSaveEditSKUButton">Save
                            Changes</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Delete Store Confirmation Modal -->
        <div class="modal fade" id="GrabDeleteStoreConfirmationModal" tabindex="-1" role="dialog"
            aria-labelledby="GrabDeleteSKUConfirmationModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header Grab-header ">
                        <h5 class="modal-title" id="GrabDeleteSKUConfirmationModal">Confirm Deletion
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body delete-msg">
                        Are you sure you want to delete this Store?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>

                        <button type="button" class="btn btn-danger" id="GrabConfirmDeleteStore">Delete</button>
                    </div>
                </div>
            </div>
        </div>
        <script src="{{URL::asset('js/grab-store.js') }}"></script>
        </div>
        <!--! partial:Page Grab-Store.html -->

    </body>
</html>
