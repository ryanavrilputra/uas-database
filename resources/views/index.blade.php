<!DOCTYPE html>
<html>
<head>
    <title>Course Management System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .card {
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            border: none;
            margin-bottom: 2rem;
            background: white;
        }
        .card-header {
            background: linear-gradient(to right, #4b6cb7, #182848);
            color: white;
            border-bottom: none;
            padding: 1rem 1.5rem;
        }
        .table th {
            background-color: #f8f9fa;
        }
        .action-buttons {
            white-space: nowrap;
        }
        body {
            background-color: #f5f6fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .btn-primary {
            background-color: #4b6cb7;
            border-color: #4b6cb7;
        }
        .btn-primary:hover {
            background-color: #182848;
            border-color: #182848;
        }
        .table-hover tbody tr:hover {
            background-color: #f8f9fa;
        }
        .modal-header {
            background: linear-gradient(to right, #4b6cb7, #182848);
            color: white;
        }
        .modal-header .btn-close {
            color: white;
            filter: brightness(0) invert(1);
        }
    </style>
</head>
<body>
    <div class="container py-5">
        <!-- Courses Section -->
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h3 class="m-0"><i class="fas fa-book-open me-2"></i>Course Management</h3>
                <button class="btn btn-light" data-bs-toggle="modal" data-bs-target="#courseModal">
                    <i class="fas fa-plus me-2"></i>Add Course
                </button>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Price</th>
                                <th>Category</th>
                                <th>Instructor</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($courses as $course)
                            <tr>
                                <td>{{ $course->title }}</td>
                                <td>{{ Str::limit($course->description, 100) }}</td>
                                <td>Rp {{ number_format($course->price, 2) }}</td>
                                <td>{{ $course->category->name }}</td>
                                <td>{{ $course->instructor->name }}</td>
                                <td class="action-buttons">
                                    <button class="btn btn-sm btn-primary edit-btn" 
                                            data-id="{{ $course->id }}"
                                            data-title="{{ $course->title }}"
                                            data-description="{{ $course->description }}"
                                            data-price="{{ $course->price }}"
                                            data-category="{{ $course->category_id }}"
                                            data-instructor="{{ $course->instructor_id }}">
                                        <i class="fas fa-edit me-1"></i> Edit
                                    </button>
                                    <button class="btn btn-sm btn-danger delete-btn" data-id="{{ $course->id }}">
                                        <i class="fas fa-trash me-1"></i> Delete
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Categories Section -->
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h3 class="m-0"><i class="fas fa-tags me-2"></i>Categories Management</h3>
                <button class="btn btn-light" data-bs-toggle="modal" data-bs-target="#categoryModal">
                    <i class="fas fa-plus me-2"></i>Add Category
                </button>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($categories as $category)
                            <tr>
                                <td>{{ $category->name }}</td>
                                <td class="action-buttons">
                                    <button class="btn btn-sm btn-primary edit-category-btn"
                                            data-id="{{ $category->id }}"
                                            data-name="{{ $category->name }}"
                                            data-description="{{ $category->description }}">
                                        <i class="fas fa-edit me-1"></i> Edit
                                    </button>
                                    <button class="btn btn-sm btn-danger delete-category-btn" data-id="{{ $category->id }}">
                                        <i class="fas fa-trash me-1"></i> Delete
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Instructors Section -->
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h3 class="m-0"><i class="fas fa-chalkboard-teacher me-2"></i>Instructors Management</h3>
                <button class="btn btn-light" data-bs-toggle="modal" data-bs-target="#instructorModal">
                    <i class="fas fa-plus me-2"></i>Add Instructor
                </button>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Keahlian</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($instructors as $instructor)
                            <tr>
                                <td>{{ $instructor->name }}</td>
                                <td>{{ $instructor->email }}</td>
                                <td>{{ $instructor->expertise }}</td>
                                <td class="action-buttons">
                                    <button class="btn btn-sm btn-primary edit-instructor-btn"
                                            data-id="{{ $instructor->id }}"
                                            data-name="{{ $instructor->name }}"
                                            data-email="{{ $instructor->email }}"
                                            data-expertise="{{ $instructor->expertise }}">
                                        <i class="fas fa-edit me-1"></i> Edit
                                    </button>
                                    <button class="btn btn-sm btn-danger delete-instructor-btn" data-id="{{ $instructor->id }}">
                                        <i class="fas fa-trash me-1"></i> Delete
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Course Modal -->
    <div class="modal fade" id="courseModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Course Form</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="courseForm">
                        <input type="hidden" id="courseId">
                        <div class="mb-3">
                            <label>Title</label>
                            <input type="text" class="form-control" id="title" name="title" required>
                        </div>
                        <div class="mb-3">
                            <label>Description</label>
                            <textarea class="form-control" id="description" name="description" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label>Price</label>
                            <input type="number" class="form-control" id="price" name="price" step="0.01" required>
                        </div>
                        <div class="mb-3">
                            <label>Category</label>
                            <select class="form-control" id="category_id" name="category_id" required>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label>Instructor</label>
                            <select class="form-control" id="instructor_id" name="instructor_id" required>
                                @foreach($instructors as $instructor)
                                    <option value="{{ $instructor->id }}">{{ $instructor->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="saveBtn">Save</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Category Modal -->
    <div class="modal fade" id="categoryModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Category Form</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="categoryForm">
                        <input type="hidden" id="categoryId">
                        <div class="mb-3">
                            <label>Name</label>
                            <input type="text" class="form-control" id="category_name" name="name" required>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="saveCategoryBtn">Save</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Instructor Modal -->
    <div class="modal fade" id="instructorModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Instructor Form</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="instructorForm">
                        <input type="hidden" id="instructorId">
                        <div class="mb-3">
                            <label>Name</label>
                            <input type="text" class="form-control" id="instructor_name" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label>Email</label>
                            <input type="email" class="form-control" id="instructor_email" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label>Keahlian</label>
                            <input type="text" class="form-control" id="instructor_expertise" name="expertise" required>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="saveInstructorBtn">Save</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            });

            // Course Management
            $('#saveBtn').click(function() {
                var id = $('#courseId').val();
                var url = id ? '/courses/' + id : '/courses';
                var method = id ? 'PUT' : 'POST';

                $.ajax({
                    url: url,
                    method: method,
                    data: $('#courseForm').serialize(),
                    success: function(response) {
                        $('#courseModal').modal('hide');
                        Swal.fire({
                            icon: 'success',
                            title: 'Success!',
                            text: id ? 'Course has been updated!' : 'Course has been created!',
                            showConfirmButton: false,
                            timer: 1500
                        }).then(() => {
                            location.reload();
                        });
                    },
                    error: function(xhr) {
                        var errors = xhr.responseJSON.errors;
                        Object.keys(errors).forEach(function(key) {
                            $('#' + key).addClass('is-invalid');
                            $('#' + key).after('<div class="invalid-feedback">' + errors[key][0] + '</div>');
                        });
                    }
                });
            });

            $('.edit-btn').click(function() {
                var data = $(this).data();
                $('#courseId').val(data.id);
                $('#title').val(data.title);
                $('#description').val(data.description);
                $('#price').val(data.price);
                $('#category_id').val(data.category);
                $('#instructor_id').val(data.instructor);
                $('#courseModal').modal('show');
            });

            $('.delete-btn').click(function() {
                var id = $(this).data('id');
                
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: '/courses/' + id,
                            method: 'DELETE',
                            success: function() {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Deleted!',
                                    text: 'Course has been deleted.',
                                    showConfirmButton: false,
                                    timer: 1500
                                }).then(() => {
                                    location.reload();
                                });
                            }
                        });
                    }
                });
            });

            // Category Management
            $('#saveCategoryBtn').click(function() {
                var id = $('#categoryId').val();
                var url = id ? '/categories/' + id : '/categories';
                var method = id ? 'PUT' : 'POST';

                $.ajax({
                    url: url,
                    method: method,
                    data: $('#categoryForm').serialize(),
                    success: function(response) {
                        $('#categoryModal').modal('hide');
                        Swal.fire({
                            icon: 'success',
                            title: 'Success!',
                            text: id ? 'Category has been updated!' : 'Category has been created!',
                            showConfirmButton: false,
                            timer: 1500
                        }).then(() => {
                            location.reload();
                        });
                    },
                    error: function(xhr) {
                        var errors = xhr.responseJSON.errors;
                        Object.keys(errors).forEach(function(key) {
                            $('#category_' + key).addClass('is-invalid');
                            $('#category_' + key).after('<div class="invalid-feedback">' + errors[key][0] + '</div>');
                        });
                    }
                });
            });

            $('.edit-category-btn').click(function() {
                var data = $(this).data();
                $('#categoryId').val(data.id);
                $('#category_name').val(data.name);
                $('#category_description').val(data.description);
                $('#categoryModal').modal('show');
            });

            $('.delete-category-btn').click(function() {
                var id = $(this).data('id');
                
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: '/categories/' + id,
                            method: 'DELETE',
                            success: function() {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Deleted!',
                                    text: 'Category has been deleted.',
                                    showConfirmButton: false,
                                    timer: 1500
                                }).then(() => {
                                    location.reload();
                                });
                            }
                        });
                    }
                });
            });

            // Instructor Management
            $('#saveInstructorBtn').click(function() {
                var id = $('#instructorId').val();
                var url = id ? '/instructors/' + id : '/instructors';
                var method = id ? 'PUT' : 'POST';

                $.ajax({
                    url: url,
                    method: method,
                    data: $('#instructorForm').serialize(),
                    success: function(response) {
                        $('#instructorModal').modal('hide');
                        Swal.fire({
                            icon: 'success',
                            title: 'Success!',
                            text: id ? 'Instructor has been updated!' : 'Instructor has been created!',
                            showConfirmButton: false,
                            timer: 1500
                        }).then(() => {
                            location.reload();
                        });
                    },
                    error: function(xhr) {
                        var errors = xhr.responseJSON.errors;
                        Object.keys(errors).forEach(function(key) {
                            $('#instructor_' + key).addClass('is-invalid');
                            $('#instructor_' + key).after('<div class="invalid-feedback">' + errors[key][0] + '</div>');
                        });
                    }
                });
            });

            $('.edit-instructor-btn').click(function() {
                var data = $(this).data();
                $('#instructorId').val(data.id);
                $('#instructor_name').val(data.name);
                $('#instructor_email').val(data.email);
                $('#instructor_expertise').val(data.expertise);
                $('#instructorModal').modal('show');
            });

            $('.delete-instructor-btn').click(function() {
                var id = $(this).data('id');
                
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: '/instructors/' + id,
                            method: 'DELETE',
                            success: function() {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Deleted!',
                                    text: 'Instructor has been deleted.',
                                    showConfirmButton: false,
                                    timer: 1500
                                }).then(() => {
                                    location.reload();
                                });
                            }
                        });
                    }
                });
            });

            // Reset forms when modals are hidden
            $('#courseModal').on('hidden.bs.modal', function() {
                $('#courseForm')[0].reset();
                $('#courseId').val('');
                $('.is-invalid').removeClass('is-invalid');
                $('.invalid-feedback').remove();
            });

            $('#categoryModal').on('hidden.bs.modal', function() {
                $('#categoryForm')[0].reset();
                $('#categoryId').val('');
                $('.is-invalid').removeClass('is-invalid');
                $('.invalid-feedback').remove();
            });

            $('#instructorModal').on('hidden.bs.modal', function() {
                $('#instructorForm')[0].reset();
                $('#instructorId').val('');
                $('.is-invalid').removeClass('is-invalid');
                $('.invalid-feedback').remove();
            });
        });
    </script>
</body>
</html>