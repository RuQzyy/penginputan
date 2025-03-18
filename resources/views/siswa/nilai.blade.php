<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Nilai Siswa</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
    <style>
        body {
            font-family: 'Roboto', sans-serif;
        }
    </style>
    <script>
        function downloadReport() {
            const { jsPDF } = window.jspdf;
            const doc = new jsPDF();
            const reportContent = document.getElementById('report-content').innerHTML;
            doc.fromHTML(reportContent, 10, 10);
            doc.save('nilai_siswa.pdf');
        }
    </script>
</head>
<body class="bg-gray-100">
<div class="flex">
    <!-- Sidebar -->
    <div class="w-64 bg-gray-900 text-white min-h-screen">
        <div class="p-4 flex items-center">
            <div class="text-2xl font-bold">Sekolah</div>
            <div class="ml-2 text-sm">Dashboard Siswa</div>
        </div>
        <div class="p-4 flex items-center">
            <img alt="User profile picture" class="rounded-full w-10 h-10" height="40" src="https://placehold.co/40x40" width="40"/>
            <div class="ml-2">
                <div class="text-sm">Nama Siswa</div>
            </div>
        </div>
        <nav class="mt-4">
    <ul>
        <li class="p-2 hover:bg-gray-700 cursor-pointer">
            <a href="{{ route('siswa.index') }}" class="flex items-center">
                <i class="fas fa-tachometer-alt mr-2"></i>
                Dashboard
            </a>
        </li>
        <li class="p-2 hover:bg-gray-700 cursor-pointer">
            <a href="{{ route('siswa.nilai') }}" class="flex items-center">
                <i class="fas fa-list mr-2"></i>
                Daftar Nilai
            </a>
        </li>
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button class="p-2 hover:bg-gray-700 cursor-pointer flex items-center w-full text-left" type="submit">
                <i class="fas fa-sign-out-alt mr-2"></i>
                Logout
            </button>
        </form>
    </ul>
</nav>
    </div>
    <!-- Main Content -->
    <div class="flex-1 p-6">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold">Nilai Siswa</h1>
            <button class="bg-green-500 text-white p-2 rounded" onclick="downloadReport()">Unduh Nilai</button>
        </div>
        <!-- Nilai Siswa Section -->
        <div class="bg-white rounded shadow p-4">
            <div class="flex items-center mb-4">
                <div class="bg-blue-500 text-white p-2 rounded mr-2">
                    <i class="fas fa-book"></i>
                </div>
                <h2 class="text-xl font-bold">Daftar Nilai</h2>
            </div>
            <div class="overflow-x-auto" id="report-content">
                <table class="w-full text-left">
                    <thead>
                    <tr class="border-b">
                        <th class="p-2">Mata Pelajaran</th>
                        <th class="p-2">Tugas</th>
                        <th class="p-2">UTS</th>
                        <th class="p-2">UAS</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr class="border-b">
                        <td class="p-2">Matematika</td>
                        <td class="p-2">85</td>
                        <td class="p-2">90</td>
                        <td class="p-2">88</td>
                    </tr>
                    <tr class="border-b">
                        <td class="p-2">Bahasa Indonesia</td>
                        <td class="p-2">80</td>
                        <td class="p-2">85</td>
                        <td class="p-2">87</td>
                    </tr>
                    <tr class="border-b">
                        <td class="p-2">IPA</td>
                        <td class="p-2">78</td>
                        <td class="p-2">82</td>
                        <td class="p-2">80</td>
                    </tr>
                    <tr class="border-b">
                        <td class="p-2">IPS</td>
                        <td class="p-2">85</td>
                        <td class="p-2">88</td>
                        <td class="p-2">90</td>
                    </tr>
                    <tr class="border-b">
                        <td class="p-2">Bahasa Inggris</td>
                        <td class="p-2">88</td>
                        <td class="p-2">90</td>
                        <td class="p-2">92</td>
                    </tr>
                    <tr class="border-b">
                        <td class="p-2">Seni Budaya</td>
                        <td class="p-2">85</td>
                        <td class="p-2">87</td>
                        <td class="p-2">89</td>
                    </tr>
                    <!-- Tambahkan baris lainnya sesuai kebutuhan -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</body>
</html>