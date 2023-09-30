<div class="container-fluid">
    <div class="row">
        <!-- Area Chart -->
        <div class="col-xl-12 col-lg-12">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">
                        My Orders
                    </h6>
                    <button type="button" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"
                        data-toggle="modal" data-target="#createOrderModal" id="createOrder"><i
                            class="fas fa-plus fa-sm text-white-50"></i>
                        Create new Order </button>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Project Info</th>
                                <th scope="col">Status</th>
                                <th scope="col">Total Pages</th>
                                <th scope="col">Total Price</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody id="orders-table"></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade bd-example-modal-lg" id="createOrderModal" tabindex="-1" role="dialog"
    aria-labelledby="createOrderModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createOrderModalLabel">New Order</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="upload-data" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="name" class="col-form-label">Name</label>
                                <input type="text" class="form-control" value="{{ auth()->user()->name }}"
                                    id="name" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="translation_service" class="col-form-label">Translation Service</label>
                                <select class="form-control" name="translation_service" id="translation_service">
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="type" class="col-form-label">Type</label>
                                <select class="form-control" name="type" id="type">
                                    <option value="regular">Regular</option>
                                    <option value="express">Express</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="container mb-4">
                        <x-upload></x-upload>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="container">
                                <span class="text-danger text-xs">Data cannot be changed after you place an order</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="d-flex justify-content-end align-items-center">
                                <div class="mr-4" id="price"></div>
                                <button type="button" class="btn btn-sm btn-primary" onclick="total_price()">Check
                                    Estimate
                                    Price</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="create">Order</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade bd-example-modal-lg" id="viewOrder" tabindex="-1" role="dialog"
    aria-labelledby="viewOrderLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewOrderLabel">Upload Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="name_user" class="col-form-label">Name</label>
                                <input type="text" class="form-control" id="name_user" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="translation_name" class="col-form-label">Translation
                                    Service</label>
                                <input type="text" class="form-control" name="translation_name"
                                    id="translation_name" disabled>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="translation_type" class="col-form-label">Type</label>
                                <input type="text" class="form-control" name="translation_type"
                                    id="translation_type" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="container my-4">
                        <h5 class="mb-3">Original Files</h5>
                        <div class="row" id="original_file"></div>
                    </div>
                    <div class="container my-4" id="files_completed">
                        <hr>
                        <h5 class="mb-3">Files Completed</h5>
                        <div class="row" id="file_complete"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- payment --}}
<div class="modal fade bd-example-modal-lg" id="paymentModal" tabindex="-1" role="dialog"
    aria-labelledby="paymentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="paymentModalLabel"></h5>
                <div class="d-flex justify-content-end">
                    <a class="btn btn-sm btn-primary printOrder" target="_blank"><i
                            style="font-size: 16px;
                            color: white;"
                            class="fas fa-fw fa-print"></i>&nbsp;
                        <small>Print</small></a>
                </div>
            </div>
            <form id="upload-payment" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="row">
                        <input type="hidden" class="form-control" name="upload_id" id="upload_id">
                        <div class="col-md-6">
                            <label for="upload_name" class="col-form-label">Name</label>
                            <input type="text" class="form-control" id="upload_name" disabled>
                        </div>
                        <div class="col-md-6">
                            <label for="upload_price" class="col-form-label">Price</label>
                            <input type="text" class="form-control" id="upload_price" disabled>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="upload_translation_name" class="col-form-label">Translation
                                    Service</label>
                                <input type="text" class="form-control" name="upload_translation_name"
                                    id="upload_translation_name" disabled>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="upload_type" class="col-form-label">Type</label>
                                <input type="text" class="form-control" name="upload_type" id="upload_type"
                                    disabled>
                            </div>
                        </div>
                    </div>
                    <h6 class="mb-2">Payment Method</h6>
                    <div class="row mb-4">
                        <div class="col-md-12">
                            <span>Note: <br> Payment please transfer to the following account:</span>
                        </div>
                        <div class="col-md-12">
                            <b><span>BNI account 1120011848 at Samudera Biru Nusantara <br>
                                    BCA Account 6565056208 Tekni Megaster</span></b>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="product_name" class="col-form-label">Product Name</label>
                                <select class="form-control" name="product_name" id="product_name">
                                    <option value="bca">BCA</option>
                                    <option value="bni">BNI</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="upload_sender_name" class="col-form-label">Sender Name</label>
                                <input type="text" class="form-control" name="upload_sender_name"
                                    id="upload_sender_name">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="upload_sender_number" class="col-form-label">Sender Number</label>
                                <input type="text" class="form-control" name="upload_sender_number"
                                    id="upload_sender_number">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <label for="uploadpayment" class="col-form-label">Upload proof of Transfer </label>
                            <input type="file" class="form-control-file" name="uploadpayment[]"
                                id="uploadpayment" multiple>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="upload">Upload</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="/vendor/sweetalert/sweetalert.all.js"></script>
<script src="/js/jquery-3.6.0.js"></script>
<script>
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        read();
        $('#createOrder').on('click', function() {
            $.ajax({
                type: "GET",
                url: "{{ route('dashboard.order.create') }}",
                success: function(data) {
                    $('#translation_service').html(
                        "<option value=0 selected disabled>Select Translation</option>");
                    let a = 1;
                    $.each(data, function(i, item) {
                        $('#translation_service').append('<option value=' + a +
                            '>' + item.name + '&nbsp&nbsp(' + item
                            .description + ')</option>')
                        a++;
                    });
                },
                error: function(data) {
                    console.log('Error:', data);
                }
            });
        });
        $('#createOrderModal').on('submit', function(e) {
            e.preventDefault();
            var translation = $("#translation_service").val();
            var type = $("#type").val();
            let data = new FormData($("#upload-data")[0]);
            if (translation == null || type == '') {
                swal.fire("Warning!", "Incomplete Data", "warning");
            } else {
                // swal.fire("Success!", "Complete Data", "success");
                $.ajax({
                    url: "{{ route('dashboard.order.upload') }}",
                    type: "POST",
                    data: data,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        $('#createOrderModal').modal('hide');
                        swal.fire("Good job!", "Data added Successfully",
                            "success");
                        read();
                    },
                });
            }
        });
        $('#paymentModal').on('submit', function(e) {
            e.preventDefault();
            var id = $("#upload_id").val();
            var productName = $("#product_name").val();
            var senderName = $("#upload_sender_name").val();
            var senderNumber = $("#upload_sender_number").val();
            var uploadPayment = $("#uploadpayment").val();
            let data = new FormData($("#upload-payment")[0]);
            let thisurl = "{{ route('dashboard.order.payment', ['id' => ':id']) }}",
                url = thisurl.replace(":id", id);
            if (productName == null || senderName == "" || senderNumber == "" || uploadPayment == "") {
                swal.fire("Warning!", "Incomplete Data", "warning");
            } else {
                swal.fire("Success!", "Complete Data", "success");
                $.ajax({
                    url: url,
                    type: "POST",
                    data: data,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        $('#paymentModal').modal('hide');
                        swal.fire("Good job!", "Payment upload Successfully",
                            "success");
                        console.log(response);
                        read();
                    },
                });
            }
        });
    });

    function payment(id) {
        $('#paymentModal').modal();
        let thisurl = "{{ route('dashboard.order.payment', ['id' => ':id']) }}",
            url = thisurl.replace(":id", id);
        $.ajax({
            type: "GET",
            url: url,
            data: id,
            success: function(data) {
                $.each(data, function(i, item) {
                    if (i == 0) {
                        $('#paymentModalLabel').html("Payment &nbsp;#" + item.code);
                        let route = "{{ route('dashboard.order.print', ['id' => ':id']) }}",
                            url = route.replace(":id", item.id);
                        $('.printOrder').attr('href', url);
                        $('#upload_id').val(item.id);
                        $('#upload_price').val('Rp. ' + number_format(item.total_price));
                    } else if (i == 1) {
                        $('#upload_name').val(item);
                    } else if (i == 2) {
                        $('#upload_translation_name').val(item.name);
                        $('#upload_type').val(item.type);
                    }
                });
            },
            error: function(data) {
                console.log('Error:', data);
            }
        });
    }

    function read() {
        $.ajax({
            type: "GET",
            url: "{{ route('dashboard.read') }}",
            success: function(data) {
                $('#orders-table').html(data);
            },
            error: function(data) {
                console.log('Error:', data);
            }
        });
    }

    function total_price() {
        var name = $('#translation_service').val();
        var type = $('#type').val();

        $.ajax({
            type: "GET",
            url: "{{ route('dashboard.order.total') }}",
            data: {
                name: name,
                type: type,
            },
            success: function(data) {
                $('#price').html("Rp. " + data)
            },
            error: function(data) {
                console.log('Error:', data);
            }
        });
    }

    function destroy(id) {
        swal.fire({
            title: 'Are you sure?',
            text: "It will permanently deleted !",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "DELETE",
                    url: "{{ url('/dashboard/order/destroy') }}/" + id,
                    success: function(data) {
                        swal.fire(
                            'Deleted!',
                            'Your Order has been deleted.',
                            'success'
                        );
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
        $('#viewOrder').modal();
        let thisurl = "{{ route('dashboard.order.view', ['id' => ':id']) }}",
            url = thisurl.replace(":id", id);
        $.ajax({
            type: "GET",
            url: url,
            data: {
                id: id,
            },
            success: function(data) {
                $('#files_completed').hide();
                $.each(data, function(i, item) {
                    if (i == 0) {
                        $('#name_user').val(item);
                    } else if (i == 1) {
                        const string = item.type;
                        let type = string.charAt(0).toUpperCase() + string.slice(1);
                        $('#translation_name').val(item.name);
                        $('#translation_type').val(type);
                    } else if (i == 2) {
                        $('#original_file').html("");
                        $.each(item, function(j, column) {
                            j++;
                            $('#original_file').append('<div class="col-md-3">' +
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
                        $('#file_complete').html("");
                        $('#files_completed').show();
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
</script>
