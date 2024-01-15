<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data</title>
    <!-- Bootstrap CSS link -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body class="container mt-5">

    <h2>Edit Data</h2>

    <form action="{{ route('obats.update', $obat->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" class="form-control" id="title" name="title" value="{{ $obat->title }}" required>
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <textarea class="form-control" id="description" name="description" required>{{ $obat->description }}</textarea>
        </div>

        <div class="form-group">
            <label for="penyakit_id">Penyakit</label>
            <select class="form-control" id="penyakit_id" name="penyakit_id" required>
                @foreach($penyakits as $penyakit)
                    <option value="{{ $penyakit->id }}" {{ $obat->penyakit_id == $penyakit->id ? 'selected' : '' }}>
                        {{ $penyakit->name }}
                    </option>
                @endforeach
                <option value="+Tambah Penyakit">+Tambah Penyakit</option>
            </select>
        </div>

        <div id="newPenyakitInput" class="form-group" style="display:none;">
            <label for="new_penyakit">Tambah Penyakit Baru</label>
            <input type="text" class="form-control" id="new_penyakit" name="new_penyakit">
        </div>

        <button type="submit" class="btn btn-primary">Update Data</button>
    </form>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

    <script>
        document.getElementById('penyakit_id').addEventListener('change', function () {
            var newPenyakitInput = document.getElementById('newPenyakitInput');
            newPenyakitInput.style.display = this.value === '+Tambah Penyakit' ? 'block' : 'none';
        });
    </script>

</body>
</html>
