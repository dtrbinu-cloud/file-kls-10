<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Upload Gambar</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f4f4;
            margin: 0;
            padding: 40px;
        }

        .container {
            max-width: 900px;
            margin: auto;
            background: white;
            padding: 30px;
            border-radius: 10px;
        }

        h1 {
            margin-top: 0;
        }

        .upload-form {
            margin-bottom: 30px;
        }

        input[type="file"] {
            margin: 10px 0;
        }

        button {
            padding: 8px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .upload-button {
            background: #2563eb;
            color: white;
        }

        .delete-button {
            background: #dc2626;
            color: white;
        }

        .success {
            background: #dcfce7;
            color: #166534;
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 5px;
        }

        .error {
            background: #fee2e2;
            color: #991b1b;
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 5px;
        }

        .images {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
        }

        .image-card {
            border: 1px solid #ddd;
            padding: 10px;
            border-radius: 8px;
        }

        .image-card img {
            width: 100%;
            height: 180px;
            object-fit: cover;
            border-radius: 5px;
        }

        .image-name {
            margin: 10px 0;
            word-break: break-all;
        }
    </style>
</head>

<body>

<div class="container">

    <h1>Upload Gambar</h1>

    {{-- Pesan berhasil --}}
    @if(session('success'))
        <div class="success">
            {{ session('success') }}
        </div>
    @endif

    {{-- Pesan error --}}
    @if($errors->any())
        <div class="error">
            @foreach($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        </div>
    @endif


    {{-- Form Upload --}}
    <form
        action="{{ route('gambar.store') }}"
        method="POST"
        enctype="multipart/form-data"
        class="upload-form"
    >

        @csrf

        <input
            type="file"
            name="gambar"
            accept="image/*"
            required
        >

        <br>

        <button
            type="submit"
            class="upload-button"
        >
            Upload
        </button>

    </form>


    <h2>Daftar Gambar</h2>

    <div class="images">

        @forelse($gambars as $gambar)

            <div class="image-card">

                <img
                    src="{{ asset('storage/' . $gambar->path) }}"
                    alt="{{ $gambar->name }}"
                >

                <div class="image-name">
                    {{ $gambar->name }}
                </div>

                <small>
                    {{ number_format($gambar->size / 1024, 2) }} KB
                </small>

                <br><br>

                <form
                    action="{{ route('gambar.destroy', $gambar->id) }}"
                    method="POST"
                >

                    @csrf

                    @method('DELETE')

                    <button
                        type="submit"
                        class="delete-button"
                    >
                        Hapus
                    </button>

                </form>

            </div>

        @empty

            <p>Belum ada gambar.</p>

        @endforelse

    </div>

</div>

</body>

</html>