<html lang="en">
 <head>
  <meta charset="utf-8"/>
  <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
  <title>
   Input Nilai
  </title>
  <script src="https://cdn.tailwindcss.com">
  </script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&amp;display=swap" rel="stylesheet"/>
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
    <!-- Input Nilai Page -->
    <div class="page" id="input-nilai">
     <div class="flex justify-between items-center mb-6">
      <h1 class="text-2xl font-semibold">
       Input Nilai
      </h1>
     </div>
     <form>
      <div class="mb-4">
       <label class="block text-gray-700">
        Nama Siswa
       </label>
       <input class="w-full border rounded py-2 px-4" placeholder="Nama Siswa" type="text"/>
      </div>
      <div class="mb-4">
       <label class="block text-gray-700">
        Mata Pelajaran
       </label>
       <select class="w-full border rounded py-2 px-4">
        <option value="matematika">
         Matematika
        </option>
        <option value="bahasa_indonesia">
         Bahasa Indonesia
        </option>
        <option value="bahasa_inggris">
         Bahasa Inggris
        </option>
        <option value="ipa">
         IPA
        </option>
        <option value="ips">
         IPS
        </option>
       </select>
      </div>
      <div class="mb-4">
       <label class="block text-gray-700">
        Nilai Tugas
       </label>
       <input class="w-full border rounded py-2 px-4" placeholder="Nilai Tugas" type="number"/>
      </div>
      <div class="mb-4">
       <label class="block text-gray-700">
        Nilai UTS
       </label>
       <input class="w-full border rounded py-2 px-4" placeholder="Nilai UTS" type="number"/>
      </div>
      <div class="mb-4">
       <label class="block text-gray-700">
        Nilai UAS
       </label>
       <input class="w-full border rounded py-2 px-4" placeholder="Nilai UAS" type="number"/>
      </div>
      <button class="submit-btn bg-blue-500 text-white py-2 px-4 rounded" type="submit">
       Submit
      </button>
     </form>
    </div>
   </div>
  </div>
  <script>
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
  </script>
 </body>
</html>
