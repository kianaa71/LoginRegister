<!-- resources/views/dashboard.blade.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body class="bg-light">
    <div class="container my-5">
        <h1 class="text-center">Dashboard</h1>
        <p class="text-center">Welcome, <strong>{{ Auth::user()->name }}</strong>! You are logged in as
            <strong>{{ Auth::user()->role }}</strong>.</p>

        <div class="d-flex justify-content-between align-items-center my-4">
            <h2>Menu List</h2>
            @if($user->role == 'Admin')
            <div class="mt-4">
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#basicModal">
                    Add Menu
                </button>

                <!-- Modal -->
                <div class="modal fade" id="basicModal" tabindex="-1" style="display: none;" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <form action="{{ route('menu.store') }}" method="post">
                            @csrf
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel1">Add Menu</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col mb-6">
                                            <label for="nama" class="form-label">Name</label>
                                            <input type="text" id="nama" name="nama" class="form-control"
                                                placeholder="Enter Name">
                                        </div>
                                    </div>
                                    <div class="row g-6">
                                        <div class="col mb-0">
                                            <label for="deskripsi" class="form-label">Description</label>
                                            <input type="text" id="deskripsi" name="deskripsi" class="form-control">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col mb-6">
                                            <label for="harga" class="form-label">Price</label>
                                            <input type="number" id="harga" name="harga" class="form-control"
                                                placeholder="Enter Price">
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-outline-secondary"
                                        data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            @endif
        </div>

        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>Menu Name</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $item)
                <tr>
                    <td>{{ $item->nama }}</td>
                    <td>{{ $item->deskripsi }}</td>
                    <td>Rp.{{ $item->harga }}</td>
                    <td>
                        @if($user->role == 'Admin')
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-sm btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#basicModal11{{$item->id}}">
                            Edit
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="basicModal11{{$item->id}}" tabindex="-1" style="display: none;" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <form action="{{ route('menu.update', $item->id) }}" method="post">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel1">Edit Menu</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col mb-6">
                                                    <label for="nama" class="form-label">Name</label>
                                                    <input type="text" id="nama" name="nama" value="{{old('nama', $item->nama)}}" class="form-control"
                                                    >
                                                </div>
                                            </div>
                                            <div class="row g-6">
                                                <div class="col mb-0">
                                                    <label for="deskripsi" class="form-label">Description</label>
                                                    <input type="text" id="deskripsi" name="deskripsi" value="{{old('deskripsi', $item->deskripsi)}}"
                                                        class="form-control">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col mb-6">
                                                    <label for="harga" class="form-label">Price</label>
                                                    <input type="number" id="harga" name="harga" class="form-control" value="{{old('harga', $item->harga)}}"
                                                        placeholder="Enter Price">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-outline-secondary"
                                                data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Save changes</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <form action="{{ route('menu.destroy', $item->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                        </form>
                        @else
                        <span class="badge bg-secondary">No Action</span>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <a href="{{ route('logout') }}" class="btn btn-danger" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Log Out</a>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>        
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>
