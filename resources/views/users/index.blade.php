<x-app>
    @section('title', 'Users')
    @section('menu', 'Users')
    <div class="container-fluid">
        <input type="hidden" name="role" id="role" value="{{ $role }}">
        @if (auth()->user()->role == 'master')
            <div class="container-fluid">
                <div class="row">
                    <!-- Area Chart -->
                    <div class="col-xl-12 col-lg-12">
                        <div class="card shadow mb-4">
                            <!-- Card Header - Dropdown -->
                            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                <h6 class="m-0 font-weight-bold text-primary">
                                    Users
                                </h6>
                            </div>
                            <!-- Card Body -->
                            <div class="card-body">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Email</th>
                                            <th scope="col">Role</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="user-table"></tbody>
                                </table>
                            </div>
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
                            <h5 class="modal-title" id="editOrderLabel">Edit User</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form>
                                @csrf
                                <div class="row">
                                    <input type="hidden" class="form-control" name="edit_id" id="edit_id">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="edit_username" class="col-form-label">Username</label>
                                            <input type="text" class="form-control" name="edit_username"
                                                id="edit_username" disabled>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="edit_name" class="col-form-label">Name</label>
                                            <input type="text" class="form-control" name="edit_name" id="edit_name"
                                                disabled>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="edit_email" class="col-form-label">Email</label>
                                            <input type="text" class="form-control" name="edit_email" id="edit_email"
                                                disabled>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="edit_role" class="col-form-label">Role</label>
                                            <select class="form-control" name="edit_role" id="edit_role">
                                                <option value="admin">Admin</option>
                                                <option value="client">Client</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary" id="update">Update</button>
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

            $('#editModal').on('submit', function(e) {
                e.preventDefault();
                let id = $('#edit_id').val();
                let role = $('#role').val();
                let thisurl = "{{ route('user.update', ['role' => ':role', 'id' => ':id']) }}",
                    url = thisurl.replace(":role", role).replace(":id", id);
                let username = $('#edit_username').val();
                let name = $('#edit_name').val();
                let email = $('#edit_email').val();
                let changerole = $('#edit_role').val();
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
                                username: username,
                                name: name,
                                email: email,
                                changerole: changerole,
                            },
                            success: function(data) {
                                console.log(data);
                                swal.fire(
                                    'Edit!',
                                    'Edit Data Successfully.',
                                    'success'
                                );
                                $('#editModal').modal('hide');
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

        function read() {
            let role = $('#role').val();
            let thisurl = "{{ route('user.read', ['role' => ':role']) }}",
                url = thisurl.replace(":role", role);
            $.ajax({
                type: "GET",
                url: url,
                data: role,
                success: function(data) {
                    $('#user-table').html(data);
                },
                error: function(data) {
                    console.log('Error:', data);
                }
            });
        }

        function edit(id) {
            let role = $('#role').val();
            let thisurl = "{{ route('user.view', ['role' => ':role', 'id' => ':id']) }}",
                url = thisurl.replace(":role", role).replace(":id", id);
            $.ajax({
                type: "GET",
                url: url,
                success: function(data) {
                    $('#editModal').modal('show');
                    $('#edit_id').val(data.id);
                    $('#edit_username').val(data.username);
                    $('#edit_email').val(data.email);
                    $('#edit_name').val(data.name);
                    $('#edit_role').val(data.role);
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
                    let thisurl = "{{ route('user.destroy', ['id' => ':id']) }}",
                        url = thisurl.replace(":id", id);
                    $.ajax({
                        type: "DELETE",
                        url: url,
                        success: function(data) {
                            swal.fire(
                                'Deleted!',
                                'User has been deleted.',
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
