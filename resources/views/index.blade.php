<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sistem Pencarian Obat</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
    </script>
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container">
            <a class="navbar-brand" href="#">Navbar</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Home</a>
                    </li>
                </ul>
                <form action="{{ route('logout') }}" method="POST" class="d-flex" role="search">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger" type="submit">Logout</button>
                </form>
            </div>
        </div>
    </nav>

    <div class="container">
        <h1> Welcome, {{ Auth::user()->name }}</h1>

        <!-- Inserted HTML content -->
        <h1 class="text-center pt-4 ">Search <strong class="text-primary">Obat</strong> Dengan <strong
                class="text-danger">Penyakit</strong></h1>
        <hr>

        <div class="row py-2">
            <div class="col-md-6">
                @if(auth()->check() && auth()->user()->role === 'admin')
                <h2><a href="{{ route('obats.create') }}" class="btn btn-success">Add New Obat</a></h2>
                @endif
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <form method="get" action="/search">
                        <div class="input-group">
                            <input class="form-control" name="search" placeholder="Search..."
                                value="{{ isset($search) ? $search : ''}}">
                            <button type="submit" class="btn btn-primary">Search</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Title</th>
                    <th scope="col">Nama Penyakit</th>
                    <th scope="col">Description</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($obats as $obat)
                <tr>
                    <th scope="row">{{ $obat->id }}</th>
                    <td>{{ $obat->title }}</td>
                    <td>{{ $obat->penyakit->name }}</td>
                    <td>{{ $obat->description }}</td>
                    <td>
                        @if(auth()->check() && auth()->user()->role === 'admin')
                        <form method="POST" action="{{ route('obats.destroy', $obat) }}" style="display: inline;">
                            @csrf
                            @method('DELETE')

                            <button type="submit" class="btn btn-danger"
                                onclick="return confirm('Are you sure you want to delete this obat?')">Delete</button>
                        </form>
                        <a href="{{ route('obats.edit', $obat) }}" class="btn btn-primary">Edit</a>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>

</html>
