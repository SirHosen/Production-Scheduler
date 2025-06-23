<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Produksi PT Megalopolis Manunggal</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }
        h1 {
            text-align: center;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
        }
        .footer {
            margin-top: 30px;
            text-align: right;
            font-style: italic;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Laporan Produksi</h1>
        <p>PT Megalopolis Manunggal Industrial Development</p>
        <p>Tanggal: {{ now()->format('d F Y') }}</p>
    </div>
    
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Judul</th>
                <th>Tipe</th>
                <th>Jadwal Produksi</th>
                <th>Dibuat Oleh</th>
                <th>Tanggal</th>
            </tr>
        </thead>
        <tbody>
            @foreach($reports as $index => $report)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $report->title }}</td>
                    <td>{{ ucfirst($report->report_type) }}</td>
                    <td>{{ $report->productionSchedule ? $report->productionSchedule->title : 'N/A' }}</td>
                    <td>{{ $report->creator->name }}</td>
                    <td>{{ $report->created_at->format('d M Y H:i') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    
    <div class="footer">
        <p>Dokumen ini dibuat secara otomatis oleh sistem penjadwalan produksi.</p>
    </div>
</body>
</html>
