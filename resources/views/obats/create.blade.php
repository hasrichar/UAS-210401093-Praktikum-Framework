<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Obat</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
</head>
<body>

    <div class="container mt-5">
        <h1 class="mb-4">Add New Obat</h1>

        <form method="POST" action="{{ route('obats.store') }}">
            @csrf

            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control" id="title" name="title" required>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
            </div>

            <div class="mb-3">
                <label for="penyakit_id" class="form-label">Penyakit</label>
                <select class="form-select" id="penyakit_id" name="penyakit_id" required>
                    @foreach($penyakits as $penyakit)
                        <option value="{{ $penyakit->id }}">{{ $penyakit->name }}</option>
                    @endforeach
                    <option value="+Tambah Penyakit">+Tambah Penyakit</option>
                </select>
            </div>
            
            <div id="newPenyakitInput" style="display:none;">
                <label for="new_penyakit" class="form-label">Tambah Penyakit Baru</label>
                <input type="text" class="form-control" id="new_penyakit" name="new_penyakit">
            </div>

            <button type="submit" class="btn btn-primary">Add Obat</button>
        </form>
    </div>

    <script>
        document.getElementById('penyakit_id').addEventListener('change', function() {
        var newPenyakitInput = document.getElementById('newPenyakitInput');
        var penyakitId = this.value;

        if (penyakitId == '+Tambah Penyakit') {
            newPenyakitInput.style.display = 'block';
        } else {
            newPenyakitInput.style.display = 'none';
        }
    });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    
</body>
</html>