<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Kartu Pendaftaran</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 14px;
            color: #000;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            text-align: center;
        }

        .logo {
            width: 100px;
        }

        .title {
            flex-grow: 1;
            font-weight: bold;
            font-size: 16px;
        }

        .content {
            margin-top: 20px;
            border: 1px solid black;
            padding: 10px;
        }

        table {
            width: 100%;
        }

        td {
            padding: 4px;
            vertical-align: top;
        }

        .photo {
            width: 120px;
            height: auto;
        }

        .info-penting {
            margin-top: 15px;
            border: 1px solid black;
            padding: 10px;
        }

        @media print {
            @page {
                margin: 15mm;
            }
        }
    </style>
</head>
<body>

    <div class="header">
        <img src="{{ asset('dist/assets/img/logo-yana.png') }}" class="logo" alt="logo">
        <div class="title">
            KARTU PENDAFTARAN <br>
            PMB ONLINE PROVINSI RIAU <br>
            TAHUN AJARAN 2025/2026
        </div>
        <img src="{{ asset('dist/assets/img/logo-yana.png') }}" class="logo" alt="logo">
    </div>

    <div class="content">
        <table>
            <tr>
                <td width="70%">
                    <table>
                        <tr><td>No Pendaftaran</td><td>: {{ $siswa->rPendaftaran->no_daftar ?? '-' }}</td></tr>
                        <tr><td>Nama Peserta</td><td>: {{ $siswa->name ?? '-' }}</td></tr>
                        <tr><td>Tempat Lahir</td><td>: {{ $siswa->rPendaftaran->tempat_lahir ?? '-' }}</td></tr>
                        <tr>
                            <td>Tanggal Lahir</td>
                            <td>: {{ $siswa->rPendaftaran->tanggal_lahir
                                    ? \Carbon\Carbon::parse($siswa->rPendaftaran->tanggal_lahir)->translatedFormat('d F Y')
                                    : '-' }}</td>
                        </tr>
                        <tr><td>NISN</td><td>: {{ $siswa->rPendaftaran->nisn ?? '-' }}</td></tr>
                        <tr><td>NIK</td><td>: {{ $siswa->rPendaftaran->nik ?? '-' }}</td></tr>
                        <tr><td>Asal Sekolah</td><td>: {{ $siswa->rPendaftaran->asal_sekolah ?? '-' }}</td></tr>
                    </table>
                </td>
                <td>
                    @if ($siswa->rPendaftaran && $siswa->rPendaftaran->foto)
                        <img src="{{ asset('storage/' . $siswa->rPendaftaran->foto) }}" class="photo" alt="Foto">
                    @else
                        <img src="{{ asset('dist/assets/img/marie.jpg') }}" class="photo" alt="Foto Default">
                    @endif
                </td>
            </tr>
        </table>
    </div>

    <table border="1" cellspacing="0" cellpadding="5" style="margin-top: 20px;">
        <tr style="background-color: #00a2ff; font-weight: bold;">
            <td>Tanggal Pendaftaran</td>
            <td>Jurusan Pilihan 1</td>
            <td>Jurusan Pilihan 2</td>
            <td>Status Verifikasi Berkas</td>
        </tr>
        <tr>
            <td>
                {{ $siswa->rPendaftaran->created_at
                    ? \Carbon\Carbon::parse($siswa->rPendaftaran->created_at)->translatedFormat('d F Y, H:i')
                    : '-' }}
            </td>
            <td>{{ $siswa->rPendaftaran->jurusanPilihan1->jurusan ?? '-' }}</td>
            <td>{{ $siswa->rPendaftaran->jurusanPilihan2->jurusan ?? '-' }}</td>
            <td>
                @if ($siswa->rPendaftaran->status_verifikasi == 'tolak')
                    Tidak Lolos
                @else
                    {{ ucfirst($siswa->rPendaftaran->status_verifikasi ?? '-') }}
                @endif
            </td>
        </tr>
    </table>

    <div class="content">
        Jurusan Diterima : <strong>
             @if ($siswa->rPendaftaran->status_verifikasi == 'tolak')
                Tidak Lolos
            @else
                {{ $siswa->rPendaftaran->jurusanDiterima->jurusan ?? 'Tidak Lolos' }}
            @endif
        </strong>
    </div>

    <div class="info-penting">
        <p><strong>INFORMASI PENTING</strong></p>
        <ol>
            <li>Kartu ini wajib dibawa saat pendaftaran ulang.</li>
            <li>Bawa kartu identitas asli.</li>
            <li>Bawa seluruh dokumen asli yang diunggah.</li>
        </ol>
    </div>

    <script>
        window.onload = function () {
            window.print();
        };
    </script>

</body>
</html>
