<x-app>
    @section('title', 'Translation')
    @section('menu', 'Translation List')
    <div class="container-fluid">
        @if (auth()->user()->role == 'master' || auth()->user()->role == 'client')
            <div class="container-fluid">
                <div class="row">
                    <!-- Area Chart -->
                    <div class="col-xl-12 col-lg-12">
                        <div class="card shadow mb-4">
                            <!-- Card Header - Dropdown -->
                            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                <h6 class="m-0 font-weight-bold text-primary">
                                    Translation Service
                                </h6>
                                @if (auth()->user()->role != 'client')
                                    <button type="button"
                                        class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"
                                        data-toggle="modal" data-target="#createTranslation"><i
                                            class="fas fa-plus fa-sm text-white-50"></i> Create new Translation Service
                                    </button>
                                @endif
                            </div>
                            <!-- Card Body -->
                            <div class="card-body">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Description</th>
                                            <th scope="col">Price</th>
                                            <th scope="col">Type</th>
                                            <th scope="col">Process</th>
                                            @if (auth()->user()->role != 'client')
                                                <th scope="col">Action</th>
                                            @endif
                                        </tr>
                                    </thead>
                                    <tbody id="translation-table"></tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- Create Order Modal --}}
            <div class="modal fade bd-example-modal-lg" id="createTranslation" tabindex="-1" role="dialog"
                aria-labelledby="createTranslationLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="createTranslationLabel">New Translation Service</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form>
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="name" class="col-form-label">Name</label>
                                            <input type="text" class="form-control" name="name"
                                                placeholder="Translation Name" id="name">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="description" class="col-form-label">Description</label>
                                            <select class="form-control" name="description" id="description">
                                                <option value="sworn">Sworn</option>
                                                <option value="non-sworn">Non-Sworn</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="price" class="col-form-label">Price</label>
                                            <input type="number" placeholder="Rp." class="form-control" name="price"
                                                id="price">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="type" class="col-form-label">Type</label>
                                            <select class="form-control" name="type" id="type">
                                                <option value="regular">Regular</option>
                                                <option value="express">Express</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="process" class="col-form-label">Process</label>
                                            <input type="number" placeholder="Work Days" class="form-control"
                                                name="process" id="process">
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary" id="create">Create</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            {{-- Edit Modal --}}
            <div class="modal fade bd-example-modal-lg" id="editModal" tabindex="-1" role="dialog"
                aria-labelledby="editOrderLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editOrderLabel">Edit Translation Service</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form>
                                @csrf
                                <div class="row">
                                    <input type="hidden" class="form-control" name="id" id="edit_id">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="name" class="col-form-label">Name</label>
                                            <input type="text" class="form-control" name="name"
                                                placeholder="Translation Name" id="edit_name">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="description" class="col-form-label">Description</label>
                                            <select class="form-control" name="description" id="edit_description">
                                                <option value="sworn">Sworn</option>
                                                <option value="non-sworn">Non-Sworn</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="price" class="col-form-label">Price</label>
                                            <input type="number" placeholder="Rp." class="form-control"
                                                name="price" id="edit_price">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="type" class="col-form-label">Type</label>
                                            <select class="form-control" name="type" id="edit_type">
                                                <option value="regular">Regular</option>
                                                <option value="express">Express</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="process" class="col-form-label">Process</label>
                                            <input type="number" placeholder="Work Days" class="form-control"
                                                name="process" id="edit_process">
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary" id="update">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endif
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
            read()

            $('#create').on('click', function(e) {
                var name = $("#name").val();
                var description = $("#description").val();
                var price = $("#price").val();
                var type = $("#type").val();
                var process = $("#process").val();
                if (name == '' || description == '' || price == '' || type == '' || process == '') {
                    swal.fire("Warning!", "Incomplete Data", "warning");
                } else {
                    $.ajax({
                        type: "POST",
                        url: "/translation/store",
                        data: {
                            name: name,
                            description: description,
                            price: price,
                            type: type,
                            process: process,
                        },
                        success: function(data) {
                            $('#createTranslation').modal('hide');
                            swal.fire("Good job!", "Data added Successfully", "success");
                            read()
                        },
                        error: function(data) {
                            console.log('Error:', data);
                        }
                    });
                }
            });
            $('#update').on('click', function(e) {
                var id = $("#edit_id").val();
                var name = $("#edit_name").val();
                var description = $("#edit_description").val();
                var price = $("#edit_price").val();
                var type = $("#edit_type").val();
                var process = $("#edit_process").val();
                if (name == '' || description == '' || price == '' || type == '' || process == '') {
                    swal.fire("Warning!", "Incomplete Data", "warning");
                } else {
                    $.ajax({
                        type: "PUT",
                        url: "/translation/update/" + id,
                        data: {
                            name: name,
                            description: description,
                            price: price,
                            type: type,
                            process: process,
                        },
                        success: function(data) {
                            $('#editModal').modal('hide');
                            swal.fire("Good job!", "Data update Successfully", "success");
                            read()
                        },
                        error: function(data) {
                            console.log('Error:', data);
                        }
                    });
                }
            });
        });

        function read() {
            $.ajax({
                type: "GET",
                url: "{{ route('translation.read') }}",
                success: function(data) {
                    $('#translation-table').html(data);
                },
                error: function(data) {
                    console.log('Error:', data);
                }
            });
        }

        function edit(id) {
            $.ajax({
                type: "GET",
                url: "{{ route('translation') }}/" + id,
                success: function(data) {
                    $('#editModal').modal('show');
                    $('#edit_id').val(data.id);
                    $('#edit_name').val(data.name);
                    $('#edit_description').val(data.description);
                    $('#edit_price').val(data.price);
                    $('#edit_type').val(data.type);
                    $('#edit_process').val(data.process);
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
                        url: "{{ route('translation') }}/destroy/" + id,
                        success: function(data) {
                            swal.fire(
                                'Deleted!',
                                'Your Translation has been deleted.',
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
    </script>
</x-app>
