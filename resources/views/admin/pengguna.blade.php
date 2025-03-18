<html lang="en">
 <head>
  <meta charset="utf-8"/>
  <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
  <title>
   Mengelola Data Pengguna
  </title>
  <script src="https://cdn.tailwindcss.com">
  </script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&amp;display=swap" rel="stylesheet"/>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.16.9/xlsx.full.min.js">
  </script>
  <style>
   body {
            font-family: 'Roboto', sans-serif;
        }
  </style>
  <script>
   function addUser() {
            // Logic to add a new user
            alert('Tambah Pengguna');
        }

        function editUser(userId) {
            // Logic to edit a user
            alert('Edit Pengguna: ' + userId);
        }

        function deleteUser(userId) {
            // Logic to delete a user
            alert('Hapus Pengguna: ' + userId);
        }

        function assignRole(userId) {
            // Logic to assign a role to a user
            alert('Berikan Hak Akses: ' + userId);
        }
  </script>
 </head>
 <body class="bg-gray-100">
  <div class="flex">
   <!-- Sidebar -->
   <div class="w-64 bg-gray-900 text-white min-h-screen fixed">
    <div class="p-4 flex items-center">
     <div class="text-2xl font-bold">
      Sekolah
     </div>
     <div class="ml-2 text-sm">
      Dashboard Admin
     </div>
    </div>
    <div class="p-4 flex items-center">
     <img alt="User profile picture" class="rounded-full w-10 h-10" height="40" src="https://storage.googleapis.com/a1aa/image/sWQiJsikDSFBobq_OwpQvz-9MYBHJB63ZHvxRGzKEi0.jpg" width="40"/>
     <div class="ml-2">
      <div class="text-sm">
       Nama Admin
      </div>
     </div>
    </div>
    <nav class="mt-4">
     <ul>
     <li class="p-2 hover:bg-gray-700 cursor-pointer">
            <a href="{{ route('admin.index') }}" class="flex items-center">
                <i class="fas fa-list mr-2"></i>
                dashboard
            </a>
        </li>
        <li class="p-2 hover:bg-gray-700 cursor-pointer">
            <a href="{{ route('admin.pengguna') }}" class="flex items-center">
                <i class="fas fa-list mr-2"></i>
                data pengguna
            </a>
        </li>
        <li class="p-2 hover:bg-gray-700 cursor-pointer">
            <a href="{{ route('admin.kelas') }}" class="flex items-center">
                <i class="fas fa-list mr-2"></i>
                kelas dan mata pelajaran
            </a>
        </li>
        <li class="p-2 hover:bg-gray-700 cursor-pointer">
            <a href="{{ route('admin.nilai') }}" class="flex items-center">
                <i class="fas fa-list mr-2"></i>
                nilai siswa
            </a>
        </li>
        <li class="p-2 hover:bg-gray-700 cursor-pointer">
            <a href="{{ route('admin.pengumuman') }}" class="flex items-center">
                <i class="fas fa-list mr-2"></i>
                pengumuman
            </a>
        </li>
      <form action="{{ route('logout') }}" method="POST">
       @csrf
       <button class="p-2 hover:bg-gray-700 cursor-pointer flex items-center w-full text-left" type="submit">
        <i class="fas fa-sign-out-alt mr-2">
        </i>
        Logout
       </button>
      </form>
     </ul>
    </nav>
   </div>
   <!-- Main Content -->
   <div class="flex-1 p-6 ml-64">
    <div class="flex justify-between items-center mb-6">
     <h1 class="text-2xl font-bold">
      Mengelola Data Pengguna
     </h1>
    </div>
    <!-- Daftar Pengguna Section -->
    <div class="bg-white rounded shadow p-4 mb-6">
     <div class="flex items-center mb-4">
      <div class="bg-blue-500 text-white p-2 rounded mr-2">
       <i class="fas fa-users">
       </i>
      </div>
      <h2 class="text-xl font-bold">
       Daftar Pengguna
      </h2>
     </div>
     <div class="overflow-x-auto">
      <table class="w-full text-left">
       <thead>
        <tr class="border-b">
         <th class="p-2">
          Nama
         </th>
         <th class="p-2">
          Email
         </th>
         <th class="p-2">
          Peran
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
          budi@example.com
         </td>
         <td class="p-2">
          Siswa
         </td>
         <td class="p-2">
          <button class="bg-green-500 text-white p-1 rounded-lg shadow hover:bg-green-600 transition duration-200 mr-2" onclick="editUser('1')">
           Edit
          </button>
          <button class="bg-red-500 text-white p-1 rounded-lg shadow hover:bg-red-600 transition duration-200 mr-2" onclick="deleteUser('1')">
           Hapus
          </button>
          <button class="bg-yellow-500 text-white p-1 rounded-lg shadow hover:bg-yellow-600 transition duration-200" onclick="assignRole('1')">
           Berikan Hak Akses
          </button>
         </td>
        </tr>
        <tr class="border-b">
         <td class="p-2">
          Siti
         </td>
         <td class="p-2">
          siti@example.com
         </td>
         <td class="p-2">
          Guru
         </td>
         <td class="p-2">
          <button class="bg-green-500 text-white p-1 rounded-lg shadow hover:bg-green-600 transition duration-200 mr-2" onclick="editUser('2')">
           Edit
          </button>
          <button class="bg-red-500 text-white p-1 rounded-lg shadow hover:bg-red-600 transition duration-200 mr-2" onclick="deleteUser('2')">
           Hapus
          </button>
          <button class="bg-yellow-500 text-white p-1 rounded-lg shadow hover:bg-yellow-600 transition duration-200" onclick="assignRole('2')">
           Berikan Hak Akses
          </button>
         </td>
        </tr>
        <!-- Tambahkan baris lainnya sesuai kebutuhan -->
       </tbody>
      </table>
     </div>
    </div>
    <!-- Tambah dan Import Pengguna Section -->
<div class="bg-white rounded shadow p-4">
    <div class="flex items-center mb-4">
        <div class="bg-green-500 text-white p-2 rounded mr-2">
            <i class="fas fa-user-plus"></i>
        </div>
        <h2 class="text-xl font-bold">
            Tambah dan Import Pengguna
        </h2>
    </div>
    <div class="flex justify-between items-center mb-4">
        <button class="bg-blue-500 text-white p-2 rounded-lg shadow hover:bg-blue-600 transition duration-200 mr-2" onclick="addUser()">
            Tambah Pengguna
        </button>
        <form action="{{ route('admin.import.process') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <input type="file" name="file" required>
    <button type="submit">Import</button>
</form>
    </div>
</div>


     </div>
    </div>
   </div>
  </div>
 </body>
</html>
