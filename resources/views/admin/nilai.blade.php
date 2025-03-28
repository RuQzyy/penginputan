<html lang="en">
 <head>
  <meta charset="utf-8"/>
  <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
  <title>
   Mengelola Nilai Siswa
  </title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet"/>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.16.9/xlsx.full.min.js"></script>
  <style>
   body {
            font-family: 'Roboto', sans-serif;
        }
  </style>
  <script>
   function showStudents(classId) {
            const studentLists = document.querySelectorAll('.student-list');
            studentLists.forEach(list => {
                list.classList.add('hidden');
            });
            document.getElementById(classId).classList.remove('hidden');
        }

        function printReport() {
            window.print();
        }

        function downloadPDF() {
            const { jsPDF } = window.jspdf;
            const doc = new jsPDF();
            const reportContent = document.getElementById('report-content').innerHTML;
            doc.fromHTML(reportContent, 10, 10);
            doc.save('nilai_siswa.pdf');
        }

        function downloadExcel() {
            const table = document.getElementById('report-table');
            const workbook = XLSX.utils.table_to_book(table, { sheet: "Sheet1" });
            XLSX.writeFile(workbook, 'nilai_siswa.xlsx');
        }
  </script>
 </head>
 <body class="bg-gray-100">
  <div class="flex">
 <!-- Sidebar -->
 <div class="w-64 bg-gray-900 text-white min-h-screen fixed">
            <div class="p-4 flex items-center">
                <div class="text-2xl font-bold">Sekolah</div>
            </div>
            <div class="p-4 flex items-center bg-gray-800 rounded-lg mb-4">
                <img src="{{ asset('img/gaga.jpg') }}" class="rounded-full w-14 h-14 border-2 border-white" alt="User  profile picture">
                <div class="ml-3">
                    <div class="text-lg font-semibold">{{ auth()->user()->name }}</div>
                    <div class="text-sm">Admin</div>
                </div>
            </div>
            <nav class="mt-4">
                <ul>
                    <li class="p-2 hover:bg-gray-700 cursor-pointer">
                        <a href="{{ route('admin.index') }}" class="flex items-center">
                            <i class="fas fa-list mr-2"></i> dashboard
                        </a>
                    </li>
                    <li class="p-2 hover:bg-gray-700 cursor-pointer">
                        <a href="{{ route('admin.pengguna') }}" class="flex items-center">
                            <i class="fas fa-users mr-2"></i> data pengguna
                        </a>
                    </li>
                    <li class="p-2 hover:bg-gray-700 cursor-pointer">
                        <a href="{{ route('admin.kelas') }}" class="flex items-center">
                            <i class="fas fa-chalkboard-teacher mr-2"></i> kelas dan mata pelajaran
                        </a>
                    </li>
                    <li class="p-2 hover:bg-gray-700 cursor-pointer">
                        <a href="{{ route('admin.nilai') }}" class="flex items-center">
                            <i class="fas fa-graduation-cap mr-2"></i> nilai siswa
                        </a>
                    </li>
                    <li class="p-2 hover:bg-gray-700 cursor-pointer">
                        <a href="{{ route('admin.pengumuman') }}" class="flex items-center">
                            <i class="fas fa-bullhorn mr-2"></i> pengumuman
                        </a>
                    </li>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button class="p-2 hover:bg-gray-700 cursor-pointer flex items-center w-full text-left" type="submit">
                            <i class="fas fa-sign-out-alt mr-2"></i> Logout
                        </button>
                    </form>
                </ul>
            </nav>
        </div>
   <!-- Main Content -->
   <div class="flex-1 p-6 ml-64">
    <div class="flex justify-between items-center mb-6">
     <h1 class="text-2xl font-bold">
      Mengelola Nilai Siswa
     </h1>
    </div>
    <!-- Daftar Kelas Section -->
    <div class="bg-white rounded shadow p-4 mb-6">
     <div class="flex items-center mb-4">
      <div class="bg-blue-500 text-white p-2 rounded mr-2">
       <i class="fas fa-chalkboard">
       </i>
      </div>
      <h2 class="text-xl font-bold">
       Daftar Kelas
      </h2>
     </div>
     <div class="mb-4">
      <label class="block text-gray-700">
       Pilih Kelas
      </label>
      <select class="border rounded w-full p-2" onchange="showStudents(this.value)">
       <option value="kelas1">
        Kelas 1
       </option>
       <option value="kelas2">
        Kelas 2
       </option>
       <option value="kelas3">
        Kelas 3
       </option>
      </select>
     </div>
     <!-- Daftar Siswa Section -->
     <div class="overflow-x-auto">
      <!-- Kelas 1 Students -->
      <div class="student-list" id="kelas1">
       <div class="flex justify-between items-center mb-4">
        <button class="bg-blue-500 text-white p-2 rounded" onclick="printReport()">
         Cetak Laporan
        </button>
        <button class="bg-green-500 text-white p-2 rounded" onclick="downloadPDF()">
         Unduh PDF
        </button>
        <button class="bg-yellow-500 text-white p-2 rounded" onclick="downloadExcel()">
         Unduh Excel
        </button>
       </div>
       <div id="report-content">
        <table class="w-full text-left" id="report-table">
         <thead>
          <tr class="border-b">
           <th class="p-2">
            Nama Siswa
           </th>
           <th class="p-2">
            Mata Pelajaran
           </th>
           <th class="p-2">
            Tugas
           </th>
           <th class="p-2">
            UTS
           </th>
           <th class="p-2">
            UAS
           </th>
           <th class="p-2">
            Aksi
           </th>
          </tr>
         </thead>
         <tbody>
          <tr class="border-b">
           <td class="p-2">
            Budi
           </td>
           <td class="p-2">
            Matematika
           </td>
           <td class="p-2">
            85
           </td>
           <td class="p-2">
            90
           </td>
           <td class="p-2">
            88
           </td>
           <td class="p-2">
            <button class="bg-red-500 text-white p-1 rounded">
             Koreksi
            </button>
           </td>
          </tr>
          <tr class="border-b">
           <td class="p-2">
            Siti
           </td>
           <td class="p-2">
            Bahasa Indonesia
           </td>
           <td class="p-2">
            80
           </td>
           <td class="p-2">
            85
           </td>
           <td class="p-2">
            87
           </td>
           <td class="p-2">
            <button class="bg-red-500 text-white p-1 rounded">
             Koreksi
            </button>
           </td>
          </tr>
          <!-- Tambahkan baris lainnya sesuai kebutuhan -->
         </tbody>
        </table>
       </div>
      </div>
      <!-- Kelas 2 Students -->
      <div class="student-list hidden" id="kelas2">
       <div class="flex justify-between items-center mb-4">
        <button class="bg-blue-500 text-white p-2 rounded" onclick="printReport()">
         Cetak Laporan
        </button>
        <button class="bg-green-500 text-white p-2 rounded" onclick="downloadPDF()">
         Unduh PDF
        </button>
        <button class="bg-yellow-500 text-white p-2 rounded" onclick="downloadExcel()">
         Unduh Excel
        </button>
       </div>
       <div id="report-content">
        <table class="w-full text-left" id="report-table">
         <thead>
          <tr class="border-b">
           <th class="p-2">
            Nama Siswa
           </th>
           <th class="p-2">
            Mata Pelajaran
           </th>
           <th class="p-2">
            Tugas
           </th>
           <th class="p-2">
            UTS
           </th>
           <th class="p-2">
            UAS
           </th>
           <th class="p-2">
            Aksi
           </th>
          </tr>
         </thead>
         <tbody>
          <tr class="border-b">
           <td class="p-2">
            Andi
           </td>
           <td class="p-2">
            IPA
           </td>
           <td class="p-2">
            78
           </td>
           <td class="p-2">
            82
           </td>
           <td class="p-2">
            80
           </td>
           <td class="p-2">
            <button class="bg-red-500 text-white p-1 rounded">
             Koreksi
            </button>
           </td>
          </tr>
          <tr class="border-b">
           <td class="p-2">
            Rina
           </td>
           <td class="p-2">
            IPS
           </td>
           <td class="p-2">
            85
           </td>
           <td class="p-2">
            88
           </td>
           <td class="p-2">
            90
           </td>
           <td class="p-2">
            <button class="bg-red-500 text-white p-1 rounded">
             Koreksi
            </button>
           </td>
          </tr>
          <!-- Tambahkan baris lainnya sesuai kebutuhan -->
         </tbody>
        </table>
       </div>
      </div>
      <!-- Kelas 3 Students -->
      <div class="student-list hidden" id="kelas3">
       <div class="flex justify-between items-center mb-4">
        <button class="bg-blue-500 text-white p-2 rounded" onclick="printReport()">
         Cetak Laporan
        </button>
        <button class="bg-green-500 text-white p-2 rounded" onclick="downloadPDF()">
         Unduh PDF
        </button>
        <button class="bg-yellow-500 text-white p-2 rounded" onclick="downloadExcel()">
         Unduh Excel
        </button>
       </div>
       <div id="report-content">
        <table class="w-full text-left" id="report-table">
         <thead>
          <tr class="border-b">
           <th class="p-2">
            Nama Siswa
           </th>
           <th class="p-2">
            Mata Pelajaran
           </th>
           <th class="p-2">
            Tugas
           </th>
           <th class="p-2">
            UTS
           </th>
           <th class="p-2">
            UAS
           </th>
           <th class="p-2">
            Aksi
           </th>
          </tr>
         </thead>
         <tbody>
          <tr class="border-b">
           <td class="p-2">
            John
           </td>
           <td class="p-2">
            Bahasa Inggris
           </td>
           <td class="p-2">
            88
           </td>
           <td class="p-2">
            90
           </td>
           <td class="p-2">
            92
           </td>
           <td class="p-2">
            <button class="bg-red-500 text-white p-1 rounded">
             Koreksi
            </button>
           </td>
          </tr>
          <tr class="border-b">
           <td class="p-2">
            Ani
           </td>
           <td class="p-2">
            Seni Budaya
           </td>
           <td class="p-2">
            85
           </td>
           <td class="p-2">
            87
           </td>
           <td class="p-2">
            89
           </td>
           <td class="p-2">
            <button class="bg-red-500 text-white p-1 rounded">
             Koreksi
            </button>
           </td>
          </tr>
          <!-- Tambahkan baris lainnya sesuai kebutuhan -->
         </tbody>
        </table>
       </div>
      </div>
     </div>
    </div>
   </div>
  </div>
 </body>
</html>