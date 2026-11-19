<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Perangkat - LabTrack</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f6f8;
            margin: 0;
            padding: 30px;
        }

        .container {
            max-width: 700px;
            margin: auto;
            background-color: white;
            padding: 25px;
            border-radius: 10px;
        }

        h1 {
            margin-top: 0;
        }

        .form-group {
            margin-bottom: 16px;
        }

        label {
            display: block;
            margin-bottom: 6px;
            font-weight: bold;
        }

        input,
        select,
        textarea {
            width: 100%;
            padding: 10px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 6px;
        }

        textarea {
            min-height: 100px;
        }

        .btn-simpan {
            background-color: #2563eb;
            color: white;
            border: none;
            padding: 10px 16px;
            border-radius: 6px;
            cursor: pointer;
        }

        .btn-kembali {
            display: inline-block;
            margin-left: 10px;
            text-decoration: none;
            color: #555;
        }

        .error {
            background-color: #fee2e2;
            color: #991b1b;
            padding: 12px;
            margin-bottom: 20px;
            border-radius: 6px;
        }
    </style>
</head>

<body>

<div class="container">

    <h1>Tambah Perangkat</h1>

    @if ($errors->any())
        <div class="error">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('devices.store') }}" method="POST">

        @csrf

        <div class="form-group">
            <label>Nama Perangkat</label>
            <input type="text"
                   name="nama_perangkat"
                   value="{{ old('nama_perangkat') }}">
        </div>

        <div class="form-group">
            <label>Kategori</label>
            <input type="text"
                   name="kategori"
                   value="{{ old('kategori') }}">
        </div>

        <div class="form-group">
            <label>Lokasi</label>
            <input type="text"
                   name="lokasi"
                   value="{{ old('lokasi') }}">
        </div>

        <div class="form-group">
            <label>IP Address</label>
            <input type="text"
                   name="ip_address"
                   value="{{ old('ip_address') }}">
        </div>

        <div class="form-group">
            <label>Status</label>

            <select name="status">
                <option value="">-- Pilih Status --</option>
                <option value="Aktif">Aktif</option>
                <option value="Maintenance">Maintenance</option>
                <option value="Rusak">Rusak</option>
            </select>
        </div>

        <div class="form-group">
            <label>Keterangan</label>
            <textarea name="keterangan">{{ old('keterangan') }}</textarea>
        </div>

        <button type="submit" class="btn-simpan">
            Simpan
        </button>

        <a href="{{ route('devices.index') }}"
           class="btn-kembali">
            Kembali
        </a>

    </form>

</div>

</body>
</html>
