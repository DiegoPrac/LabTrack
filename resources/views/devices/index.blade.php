<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LabTrack - Daftar Perangkat</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f6f8;
            margin: 0;
            padding: 30px;
        }

        .container {
            max-width: 1100px;
            margin: auto;
            background-color: white;
            padding: 25px;
            border-radius: 10px;
        }

        h1 {
            margin-top: 0;
        }

        .subtitle {
            color: #666;
            margin-bottom: 25px;
        }

        .btn-tambah {
            display: inline-block;
            background-color: #2563eb;
            color: white;
            text-decoration: none;
            padding: 10px 16px;
            border-radius: 6px;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 12px;
            border-bottom: 1px solid #ddd;
            text-align: left;
        }

        th {
            background-color: #f1f5f9;
        }

        .btn-edit {
            color: #2563eb;
            text-decoration: none;
            margin-right: 10px;
        }

        .btn-hapus {
            background: none;
            border: none;
            color: #dc2626;
            cursor: pointer;
        }

        .kosong {
            text-align: center;
            color: #777;
            padding: 25px;
        }
    </style>
</head>

<body>

<div class="container">

    <h1>LabTrack</h1>
    <p class="subtitle">Inventaris Perangkat Laboratorium</p>

    <a href="{{ route('devices.create') }}" class="btn-tambah">
        + Tambah Perangkat
    </a>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Perangkat</th>
                <th>Kategori</th>
                <th>Lokasi</th>
                <th>IP Address</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>

        @forelse ($devices as $device)

            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $device->nama_perangkat }}</td>
                <td>{{ $device->kategori }}</td>
                <td>{{ $device->lokasi }}</td>
                <td>{{ $device->ip_address ?? '-' }}</td>
                <td>{{ $device->status }}</td>

                <td>
                    <a href="{{ route('devices.edit', $device) }}"
                       class="btn-edit">
                        Edit
                    </a>

                    <form action="{{ route('devices.destroy', $device) }}"
                          method="POST"
                          style="display: inline;">

                        @csrf
                        @method('DELETE')

                        <button type="submit"
                                class="btn-hapus"
                                onclick="return confirm('Hapus perangkat ini?')">
                            Hapus
                        </button>
                    </form>
                </td>
            </tr>

        @empty

            <tr>
                <td colspan="7" class="kosong">
                    Belum ada data perangkat.
                </td>
            </tr>

        @endforelse

        </tbody>
    </table>

</div>

</body>
</html>
