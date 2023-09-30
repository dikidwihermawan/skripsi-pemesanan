<x-app>
    @section('title', 'Jobs')
    @section('menu', 'Jobs')
    <div class="container-fluid">
        <div class="row">
            <!-- Area Chart -->
            <div class="col-xl-12 col-lg-12">
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">
                            <input type="hidden" id="status" value="{{ $status }}">
                            {{ $status == 'pending' ? 'Pending Request' : ($status == 'in_progress' ? 'In Progress' : ucfirst($status)) }}
                        </h6>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Username</th>
                                    <th scope="col">Project Info</th>
                                    <th scope="col">Total Pages</th>
                                    <th scope="col">Total Values</th>
                                    <th scope="col">Payment</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody id="jobs-table"></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade bd-example-modal-lg" id="viewJob" tabindex="-1" role="dialog"
        aria-labelledby="viewJobLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewJobLabel">View Job</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form>
                    <div class="modal-body">
                        <input type="hidden" name="dataid" id="dataid">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="name" class="col-form-label">Name</label>
                                    <input type="text" class="form-control" id="name" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="translation_service" class="col-form-label">Translation Service</label>
                                    <input type="text" class="form-control" name="translation" id="translation"
                                        disabled>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="type" class="col-form-label">Type</label>
                                    <input type="text" class="form-control" name="type" id="type" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="container my-4">
                            <h5 class="mb-3">Original Files</h5>
                            <div class="row" id="files"></div>
                        </div>
                        <div class="container my-4" id="text_complete">
                            <hr>
                            <h5 class="mb-3">Files Completed</h5>
                            <div class="row" id="file_complete"></div>
                        </div>
                        <div class="row" id="result_sheet">
                            <div class="col-md-8"></div>
                            <div class="col-md-4">
                                <label for="sheet" class="col-form-label">Result Sheet</label>
                                <input type="text" name="sheet" id="sheet" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" id="btn-accept" onclick="update()" class="btn btn-primary"
                            data-dismiss="modal">Accept</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- upload-data --}}

    <div class="modal fade bd-example-modal-lg" id="uploadJobModal" tabindex="-1" role="dialog"
        aria-labelledby="uploadJobModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="uploadJobModalLabel"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="uploadDataJob" enctype="multipart/form-data">
                    <input type="hidden" name="id" id="id_data">
                    <input type="hidden" name="status" id="status_data">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="name1" class="col-form-label">Name</label>
                                    <input type="text" class="form-control" id="name1" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="translation1" class="col-form-label">Translation
                                        Service</label>
                                    <input type="text" class="form-control" name="translation1" id="translation1"
                                        disabled>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="type1" class="col-form-label">Type</label>
                                    <input type="text" class="form-control" name="type1" id="type1"
                                        disabled>
                                </div>
                            </div>
                        </div>
                        <div class="container my-4">
                            <h5 class="mb-3">Original Files</h5>
                            <div class="row" id="files1"></div>
                        </div>
                        <hr>
                        <div class="container my-4">
                        <h5 class="mb-3">Payment Files</h5>
                            <div class="row" id="files2"></div>
                        </div>
                        <hr>
                        <div class="wrapper">
                            <header>Upload Your File</header>
                            <i class="fas fa-cloud-upload-alt"></i><br>
                            <label for="inputTag" id="inputLabel">
                                <p class="thumb">Browse File to Upload</p>
                                <input id="inputTag" name="fileupload[]" class="file-input" type="file"
                                    multiple />
                            </label>
                            <section class="progress-area"></section>
                            <section class="uploaded-area"></section>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" id="Upload">Upload</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="/vendor/sweetalert/sweetalert.all.js"></script>
    <script src="/js/jquery-3.6.0.js"></script>
    <script>
        $('document').ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('#wrong').hide();
            read();

            $('#uploadJobModal').on('submit', function(e) {
                e.preventDefault();
                let id = $('#id_data').val();
                let status = $('#status_data').val();
                let thisurl = "{{ route('jobs.view.upload', ['status' => ':status', 'id' => ':id']) }}",
                    url = thisurl.replace(":status", status).replace(":id", id);
                let data = new FormData($('#uploadDataJob')[0]);
                swal.fire({
                    title: 'Are you sure?',
                    text: "To Upload This Data !",
                    type: 'Success',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, Accept it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: "POST",
                            url: url,
                            data: data,
                            processData: false,
                            contentType: false,
                            success: function(data) {
                                swal.fire(
                                    'Upload!',
                                    'Upload Data Successfully.',
                                    'success'
                                );
                                $('#uploadJobModal').modal('hide');
                                read();
                            },
                            error: function(data) {
                                console.log('Error:', data);
                            }
                        });
                    } else {
                        swal.close();
                    }
                });
            });
        });

        function view_confirm(id) {
            $('#uploadJobModal').modal();
            let status = $('#status').val();
            let thisurl = "{{ route('jobs.view', ['status' => ':status', 'id' => ':id']) }}",
                url = thisurl.replace(":status", status).replace(":id", id);
            $.ajax({
                type: "GET",
                url: url,
                data: {
                    id: id,
                    status: status,
                },
                success: function(data) {
                    console.log(data);
                    $.each(data, function(i, item) {
                        if (i == 0) {
                            $('#name1').val(item);
                        } else if (i == 1) {
                            const string = item.type;
                            let type = string.charAt(0).toUpperCase() + string.slice(1);
                            $('#translation1').val(item.name);
                            $('#type1').val(type);
                        } else if (i == 2) {
                            $('#files1').html("");
                            $.each(item, function(j, column) {
                                j++;
                                $('#files1').append('<div class="col-md-3">' +
                                    '<div class="card img-thumbnail">' +
                                    '<div class="card-img-top">&nbsp;&nbsp;File ' + j +
                                    '</div>' +
                                    '<div class="card-body">' +
                                    '<center><i class="fas fa-fw fa-file-pdf"></i>' +
                                    '<a href="/' + column.path +
                                    '" class="btn btn-sm btn-primary mt-4" target="_blank">Download</a></center></div></div></div>'
                                );
                            });
                        } else if (i == 3) {
                            $('#id_data').val(item.id);
                            $('#status_data').val(status);
                            if (item.payment_id == null) {
                                $('#uploadJobModalLabel').html("Upload Data &nbsp;#UNPAID");
                            } else {
                                $('#uploadJobModalLabel').html("Upload Data &nbsp;#PAID");
                            }
                        } else if (i == 4) {
                            $('#files2').html("");
                            $.each(item, function(l, column) {
                                l++;
                                $('#files2').append('<div class="col-md-3">' +
                                    '<div class="card img-thumbnail">' +
                                    '<div class="card-img-top">&nbsp;&nbsp;File ' + l +
                                    '</div>' +
                                    '<div class="card-body">' +
                                    '<center><i class="fas fa-fw fa-file-pdf"></i>' +
                                    '<a href="/' + column.path +
                                    '" class="btn btn-sm btn-primary mt-4" target="_blank">Download</a></center></div></div></div>'
                                );
                            });
                        }
                    });
                },
                error: function(data) {
                    console.log('Error:', data);
                }
            });
        }


        function update() {
            id = $('#dataid').val();
            sheet = $('#sheet').val();
            let status = $('#status').val();
            let thisurl = "{{ route('jobs.view.update', ['status' => ':status', 'id' => ':id']) }}",
                url = thisurl.replace(":status", status).replace(":id", id);
            swal.fire({
                title: 'Are you sure?',
                text: "To Update This Data !",
                type: 'Success',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, Accept it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "PUT",
                        url: url,
                        data: {
                            id: id,
                            status: status,
                            sheet: sheet,
                        },
                        success: function(data) {
                            swal.fire(
                                'Accept!',
                                'Data Accept Successfully.',
                                'success'
                            );
                            $('#viewJob').modal('hide');
                            read();
                        },
                        error: function(data) {
                            console.log('Error:', data);
                        }
                    });
                } else {
                    swal.close();
                }
            })
        }

        function view(id) {
            $('#viewJob').modal();
            let status = $('#status').val();
            let thisurl = "{{ route('jobs.view', ['status' => ':status', 'id' => ':id']) }}",
                url = thisurl.replace(":status", status).replace(":id", id);
            $.ajax({
                type: "GET",
                url: url,
                data: {
                    id: id,
                    status: status,
                },
                success: function(data) {
                    $.each(data, function(i, item) {
                        if (i == 0) {
                            $('#name').val(item);
                        } else if (i == 1) {
                            const string = item.type;
                            let type = string.charAt(0).toUpperCase() + string.slice(1);
                            $('#translation').val(item.name);
                            $('#type').val(type);
                        } else if (i == 2) {
                            $('#files').html("");
                            $.each(item, function(j, column) {
                                j++;
                                $('#files').append('<div class="col-md-3">' +
                                    '<div class="card img-thumbnail">' +
                                    '<div class="card-img-top">&nbsp;&nbsp;File ' + j +
                                    '</div>' +
                                    '<div class="card-body">' +
                                    '<center><i class="fas fa-fw fa-file-pdf"></i>' +
                                    '<a href="/' + column.path +
                                    '" class="btn btn-sm btn-primary mt-4" target="_blank">Download</a></center></div></div></div>'
                                );
                            });
                        } else if (i == 3) {
                            $('#dataid').val(item.id);
                            if (item.status == "pending") {
                                $('#text_complete').hide();
                            } else if (item.status == "in_progress" && item.payment_id == null) {
                                $('#result_sheet').hide();
                                $('#btn-accept').hide();
                                $('#text_complete').hide();
                            } else if (item.status == "completed") {
                                $('#result_sheet').hide();
                                $('#btn-accept').hide();
                            }
                        } else if (i == 4) {
                            $('#file_complete').html("");
                            $.each(item, function(k, column) {
                                k++;
                                $('#file_complete').append('<div class="col-md-3">' +
                                    '<div class="card img-thumbnail">' +
                                    '<div class="card-img-top">&nbsp;&nbsp;File ' + k +
                                    '</div>' +
                                    '<div class="card-body">' +
                                    '<center><i class="fas fa-fw fa-file-pdf"></i>' +
                                    '<a href="/' + column.path +
                                    '" class="btn btn-sm btn-primary mt-4" target="_blank">Download</a></center></div></div></div>'
                                );
                            });
                        }
                    });

                },
                error: function(data) {
                    console.log('Error:', data);
                }
            });
        }

        function read() {
            let status = $('#status').val();
            let thisurl = "{{ route('jobs.read', ['status' => ':status']) }}",
                url = thisurl.replace(":status", status);
            $.ajax({
                type: "GET",
                url: url,
                data: status,
                success: function(data) {
                    console.log(data);
                    $('#jobs-table').html(data);
                },
                error: function(data) {
                    console.log('Error:', data);
                }
            });
        }

        function number(event) {
            $('#wrong').hide();
            var angka = (event.which) ? event.which : event.keyCode
            if (angka != 46 && angka > 31 && (angka < 48 || angka > 57)) {
                return false;
            }
            if ($('#sheet').val() < 1) {
                $('#wrong').show();
            }
            return true;
        }
    </script>
</x-app>
