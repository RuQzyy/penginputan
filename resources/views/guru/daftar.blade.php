<html lang="en">
 <head>
  <meta charset="utf-8"/>
  <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
  <title>
   Daftar Nilai
  </title>
  <script src="https://cdn.tailwindcss.com">
  </script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&amp;display=swap" rel="stylesheet"/>
  <link href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css" rel="stylesheet"/>
  <style>
   body {
            font-family: 'Roboto', sans-serif;
            margin: 0; /* Remove default margin */
        }
        .sidebar-link {
            transition: background-color 0.3s, color 0.3s;
        }
        .sidebar-link:hover {
            background-color: #4a5568;
            color: #ffffff;
        }
        .active {
            background-color: #2d3748;
            color: #ffffff;
        }
        .submit-btn {
            transition: background-color 0.3s, transform 0.3s;
        }
        .submit-btn:hover {
            background-color: #2563eb;
            transform: scale(1.05);
        }
        .table-row {
            transition: background-color 0.3s;
        }
        .table-row:hover {
            background-color: #f3f4f6; /* Hover effect */
        }
        /* Zebra striping for table */
        #nilai-table tbody tr:nth-child(odd) {
            background-color: #f9f9f9; /* Light gray for odd rows */
        }
        #nilai-table tbody tr:nth-child(even) {
            background-color: #ffffff; /* White for even rows */
        }
        /* Table styling */
        #nilai-table {
            border-collapse: collapse;
            width: 100%;
        }
        #nilai-table th, #nilai-table td {
            padding: 12px;
            text-align: left;
            border: 1px solid #ddd; /* Border for table cells */
        }
        #nilai-table th {
            background-color: #4a5568; /* Header background color */
            color: white; /* Header text color */
        }
        #nilai-table tbody tr:hover {
            background-color: #e2e8f0; /* Light gray on hover */
        }
        .sidebar {
            background: rgba(0, 0, 0, 0.7);
            background-image: url('https://placehold.co/300x600');
            background-size: cover;
            background-blend-mode: darken;
            position: fixed; /* Make sidebar fixed */
            top: 0;
            left: 0;
            height: 100%; /* Full height */
            width: 250px; /* Set width */
            transform: translateX(0); /* Show sidebar by default on desktop */
            transition: transform 0.3s ease; /* Smooth transition */
            z-index: 1000; /* Ensure it appears above other content */
        }
        .sidebar.hide {
            transform: translateX(-100%); /* Hide sidebar off-screen */
        }
        .main-content {
            margin-left: 250px; /* Shift main content to the right */
            transition: margin-left 0.3s ease; /* Smooth transition for main content */
        }
        .main-content.shift {
            margin-left: 250px; /* Shift main content when sidebar is shown */
        }
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%); /* Hide sidebar off-screen on mobile */
            }
            .main-content {
                margin-left: 0; /* No margin on mobile */
            }
            .main-content.shift {
                margin-left: 250px; /* Shift main content when sidebar is shown */
            }
        }
  </style>
 </head>
 <body class="bg-gray-100">
  <div class="flex">
  <!-- Sidebar -->
<div class="sidebar" id="sidebar">
    <div class="p-4 flex items-center justify-between">
        <img alt="User profile picture" class="rounded-full mr-3" height="40" src="https://placehold.co/40x40" width="40"/>
        <button class="text-white focus:outline-none md:hidden" id="close-sidebar">
            <i class="fas fa-times fa-lg"></i>
        </button>
    </div>
    <div class="p-4">
        <h2 class="text-lg font-semibold text-white">
            Jenifer Lopez
        </h2>
    </div>
    <nav class="mt-10">
        <a class="sidebar-link flex items-center py-2 px-6 text-gray-300" href="#" onclick="showPage('dashboard')">
            <i class="fas fa-tachometer-alt mr-3"></i>
            Dashboard
        </a>
        <a class="sidebar-link flex items-center py-2 px-6 text-gray-300" href="{{ url('guru/input') }}">
            <i class="fas fa-edit mr-3"></i>
            Input Nilai
        </a>
        <a class="sidebar-link flex items-center py-2 px-6 text-gray-300" href="{{ url('guru/daftar') }}">
            <i class="fas fa-table mr-3"></i>
            Daftar Nilai
        </a>
        <a class="sidebar-link flex items-center py-2 px-6 text-gray-300 mt-6" href="#">
            <i class="fas fa-sign-out-alt mr-3"></i>
            Logout
        </a>
    </nav>
</div>
<!-- Hamburger Button -->
<div class="p-4 md:hidden">
    <button class="text-gray-600 focus:outline-none" id="hamburger">
        <i class="fas fa-bars fa-2x"></i>
    </button>
</div>

   <!-- Main Content -->
   <div class="flex-1 p-6 main-content" id="main-content">
    <!-- Daftar Nilai Page -->
    <div class="page" id="daftar-nilai">
     <div class="flex justify-between items-center mb-6">
      <h1 class="text-2xl font-semibold">
       Melihat Rekap Nilai Siswa
      </h1>
      <input class="border rounded py-2 px-4" id="searchInput" placeholder="Search..." type="text"/>
     </div>
     <div class="mb-4">
      <button class="submit-btn bg-blue-500 text-white py-2 px-4 rounded" onclick="generatePDF()">
       Cetak PDF
      </button>
     </div>
     <table class="w-full text-left" id="nilai-table">
      <thead>
       <tr class="border-b">
        <th class="py-2">
         #
        </th>
        <th class="py-2">
         Nama Siswa
        </th>
        <th class="py-2">
         Mata Pelajaran
        </th>
        <th class="py-2">
         Nilai Tugas
        </th>
        <th class="py-2">
         Nilai UTS
        </th>
        <th class="py-2">
         Nilai UAS
        </th>
        <th class="py-2">
         Aksi
        </th>
        <!-- New column for actions -->
       </tr>
      </thead>
      <tbody>
       <tr class="table-row border-b">
        <td class="py-2">
         1
        </td>
        <td class="py-2">
         John Doe
        </td>
        <td class="py-2">
         Matematika
        </td>
        <td class="py-2">
         90
        </td>
        <td class="py-2">
         85
        </td>
        <td class="py-2">
         88
        </td>
        <td class="py-2">
         <button class="text-blue-500 hover:underline" onclick="editData(1)">
          <i class="fas fa-edit">
          </i>
          Edit
         </button>
         <button class="text-red-500 hover:underline" onclick="deleteData(1)">
          <i class="fas fa-trash">
          </i>
          Hapus
         </button>
        </td>
       </tr>
       <tr class="table-row border-b">
        <td class="py-2">
         2
        </td>
        <td class="py-2">
         Jane Smith
        </td>
        <td class="py-2">
         Bahasa Indonesia
        </td>
        <td class="py-2">
         80
        </td>
        <td class="py-2">
         75
        </td>
        <td class="py-2">
         78
        </td>
        <td class="py-2">
         <button class="text-blue-500 hover:underline" onclick="editData(2)">
          <i class="fas fa-edit">
          </i>
          Edit
         </button>
         <button class="text-red-500 hover:underline" onclick="deleteData(2)">
          <i class="fas fa-trash">
          </i>
          Hapus
         </button>
        </td>
       </tr>
      </tbody>
     </table>
     <div class="mt-6">
      <h2 class="text-xl font-semibold mb-4">
       Grafik Nilai Siswa
      </h2>
      <canvas id="nilaiChart">
      </canvas>
     </div>
    </div>
   </div>
  </div>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js">
  </script>
  <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js">
  </script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js">
  </script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.3.1/jspdf.umd.min.js">
  </script>
  <script>
   $(document).ready(function() {
            $('#nilai-table').DataTable();
            renderChart();
        });

        // Toggle sidebar visibility
        document.getElementById('hamburger').addEventListener('click', function() {
            const sidebar = document.getElementById('sidebar');
            const mainContent = document.getElementById('main-content');
            sidebar.classList.toggle('show');
            mainContent.classList.toggle('shift');
        });

        // Close sidebar
        document.getElementById('close-sidebar').addEventListener('click', function() {
            const sidebar = document.getElementById('sidebar');
            const mainContent = document.getElementById('main-content');
            sidebar.classList.remove('show');
            mainContent.classList.remove('shift');
        });

        function editData(id) {
            alert('Edit data for student ID: ' + id);
            // Implement your edit logic here
        }

        function deleteData(id) {
            if (confirm('Are you sure you want to delete this student?')) {
                alert('Deleted student ID: ' + id);
                // Implement your delete logic here
            }
        }

        function renderChart() {
            const ctx = document.getElementById('nilaiChart').getContext('2d');
            const chart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['John Doe', 'Jane Smith'],
                    datasets: [
                        {
                            label: 'Nilai Tugas',
                            data: [90, 80],
                            backgroundColor: 'rgba(54, 162, 235, 0.2)',
                            borderColor: 'rgba(54, 162, 235, 1)',
                            borderWidth: 1
                        },
                        {
                            label: 'Nilai UTS',
                            data: [85, 75],
                            backgroundColor: 'rgba(75, 192, 192, 0.2)',
                            borderColor: 'rgba(75, 192, 192, 1)',
                            borderWidth: 1
                        },
                        {
                            label: 'Nilai UAS',
                            data: [88, 78],
                            backgroundColor: 'rgba(153, 102, 255, 0.2)',
                            borderColor: 'rgba(153, 102, 255, 1)',
                            borderWidth: 1
                        }
                    ]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        }

        function generatePDF() {
            const { jsPDF } = window.jspdf;
            const doc = new jsPDF();
            doc.text('Rekap Nilai Siswa', 10, 10);
            doc.autoTable({ html: '#nilai-table' });
            doc.save('rekap_nilai_siswa.pdf');
        }
  </script>
 </body>
</html>