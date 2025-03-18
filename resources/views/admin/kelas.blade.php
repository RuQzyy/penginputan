<html lang="en">
 <head>
  <meta charset="utf-8"/>
  <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
  <title>
   Mengelola Kelas dan Mata Pelajaran
  </title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet"/>
  <style>
   body {
            font-family: 'Roboto', sans-serif;
        }
  </style>
  <script>
   function showClassDetails(classId) {
            const classDetails = document.querySelectorAll('.class-details');
            classDetails.forEach(detail => {
                detail.classList.add('hidden');
            });
            document.getElementById(classId).classList.remove('hidden');
        }

        function addClass() {
            // Logic to add a new class
            alert('Tambah Kelas');
        }

        function editClass(classId) {
            // Logic to edit a class
            alert('Edit Kelas: ' + classId);
        }

        function deleteClass(classId) {
            // Logic to delete a class
            alert('Hapus Kelas: ' + classId);
        }

        function addSubject(classId) {
            // Logic to add a new subject to a class
            alert('Tambah Mata Pelajaran ke Kelas: ' + classId);
        }

        function editSubject(subjectId) {
            // Logic to edit a subject
            alert('Edit Mata Pelajaran: ' + subjectId);
        }

        function deleteSubject(subjectId) {
            // Logic to delete a subject
            alert('Hapus Mata Pelajaran: ' + subjectId);
        }

        function assignTeacher(subjectId) {
            // Logic to assign a teacher to a subject
            alert('Hubungkan Guru ke Mata Pelajaran: ' + subjectId);
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
     <img alt="User profile picture" class="rounded-full w-10 h-10" height="40" src="https://placehold.co/40x40" width="40"/>
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
      Mengelola Kelas dan Mata Pelajaran
     </h1>
     <button class="bg-blue-500 text-white p-2 rounded-lg shadow hover:bg-blue-600 transition duration-200" onclick="addClass()">
      Tambah Kelas
     </button>
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
      <select class="border rounded w-full p-2" onchange="showClassDetails(this.value)">
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
     <!-- Kelas 1 Details -->
     <div class="class-details" id="kelas1">
      <div class="flex justify-between items-center mb-4">
       <h3 class="text-lg font-bold">
        Kelas 1
       </h3>
       <div>
        <button class="bg-green-500 text-white p-2 rounded-lg shadow hover:bg-green-600 transition duration-200 mr-2" onclick="editClass('kelas1')">
         Edit Kelas
        </button>
        <button class="bg-red-500 text-white p-2 rounded-lg shadow hover:bg-red-600 transition duration-200" onclick="deleteClass('kelas1')">
         Hapus Kelas
        </button>
       </div>
      </div>
      <div class="flex justify-between items-center mb-4">
       <h4 class="text-md font-bold">
        Mata Pelajaran
       </h4>
       <button class="bg-blue-500 text-white p-2 rounded-lg shadow hover:bg-blue-600 transition duration-200" onclick="addSubject('kelas1')">
        Tambah Mata Pelajaran
       </button>
      </div>
      <table class="w-full text-left">
       <thead>
        <tr class="border-b">
         <th class="p-2">
          Mata Pelajaran
         </th>
         <th class="p-2">
          Guru
         </th>
         <th class="p-2">
          Aksi
         </th>
        </tr>
       </thead>
       <tbody>
        <tr class="border-b">
         <td class="p-2">
          Matematika
         </td>
         <td class="p-2">
          Pak Budi
         </td>
         <td class="p-2">
          <button class="bg-green-500 text-white p-1 rounded-lg shadow hover:bg-green-600 transition duration-200 mr-2" onclick="editSubject('matematika')">
           Edit
          </button>
          <button class="bg-red-500 text-white p-1 rounded-lg shadow hover:bg-red-600 transition duration-200 mr-2" onclick="deleteSubject('matematika')">
           Hapus
          </button>
          <button class="bg-yellow-500 text-white p-1 rounded-lg shadow hover:bg-yellow-600 transition duration-200" onclick="assignTeacher('matematika')">
           Hubungkan Guru
          </button>
         </td>
        </tr>
        <tr class="border-b">
         <td class="p-2">
          Bahasa Indonesia
         </td>
         <td class="p-2">
          Bu Siti
         </td>
         <td class="p-2">
          <button class="bg-green-500 text-white p-1 rounded-lg shadow hover:bg-green-600 transition duration-200 mr-2" onclick="editSubject('bahasa_indonesia')">
           Edit
          </button>
          <button class="bg-red-500 text-white p-1 rounded-lg shadow hover:bg-red-600 transition duration-200 mr-2" onclick="deleteSubject('bahasa_indonesia')">
           Hapus
          </button>
          <button class="bg-yellow-500 text-white p-1 rounded-lg shadow hover:bg-yellow-600 transition duration-200" onclick="assignTeacher('bahasa_indonesia')">
           Hubungkan Guru
          </button>
         </td>
        </tr>
        <!-- Tambahkan baris lainnya sesuai kebutuhan -->
       </tbody>
      </table>
     </div>
     <!-- Kelas 2 Details -->
     <div class="class-details hidden" id="kelas2">
      <div class="flex justify-between items-center mb-4">
       <h3 class="text-lg font-bold">
        Kelas 2
       </h3>
       <div>
        <button class="bg-green-500 text-white p-2 rounded-lg shadow hover:bg-green-600 transition duration-200 mr-2" onclick="editClass('kelas2')">
         Edit Kelas
        </button>
        <button class="bg-red-500 text-white p-2 rounded-lg shadow hover:bg-red-600 transition duration-200" onclick="deleteClass('kelas2')">
         Hapus Kelas
        </button>
       </div>
      </div>
      <div class="flex justify-between items-center mb-4">
       <h4 class="text-md font-bold">
        Mata Pelajaran
       </h4>
       <button class="bg-blue-500 text-white p-2 rounded-lg shadow hover:bg-blue-600 transition duration-200" onclick="addSubject('kelas2')">
        Tambah Mata Pelajaran
       </button>
      </div>
      <table class="w-full text-left">
       <thead>
        <tr class="border-b">
         <th class="p-2">
          Mata Pelajaran
         </th>
         <th class="p-2">
          Guru
         </th>
         <th class="p-2">
          Aksi
         </th>
        </tr>
       </thead>
       <tbody>
        <tr class="border-b">
         <td class="p-2">
          IPA
         </td>
         <td class="p-2">
          Pak Andi
         </td>
         <td class="p-2">
          <button class="bg-green-500 text-white p-1 rounded-lg shadow hover:bg-green-600 transition duration-200 mr-2" onclick="editSubject('ipa')">
           Edit
          </button>
          <button class="bg-red-500 text-white p-1 rounded-lg shadow hover:bg-red-600 transition duration-200 mr-2" onclick="deleteSubject('ipa')">
           Hapus
          </button>
          <button class="bg-yellow-500 text-white p-1 rounded-lg shadow hover:bg-yellow-600 transition duration-200" onclick="assignTeacher('ipa')">
           Hubungkan Guru
          </button>
         </td>
        </tr>
        <tr class="border-b">
         <td class="p-2">
          IPS
         </td>
         <td class="p-2">
          Bu Rina
         </td>
         <td class="p-2">
          <button class="bg-green-500 text-white p-1 rounded-lg shadow hover:bg-green-600 transition duration-200 mr-2" onclick="editSubject('ips')">
           Edit
          </button>
          <button class="bg-red-500 text-white p-1 rounded-lg shadow hover:bg-red-600 transition duration-200 mr-2" onclick="deleteSubject('ips')">
           Hapus
          </button>
          <button class="bg-yellow-500 text-white p-1 rounded-lg shadow hover:bg-yellow-600 transition duration-200" onclick="assignTeacher('ips')">
           Hubungkan Guru
          </button>
         </td>
        </tr>
        <!-- Tambahkan baris lainnya sesuai kebutuhan -->
       </tbody>
      </table>
     </div>
     <!-- Kelas 3 Details -->
     <div class="class-details hidden" id="kelas3">
      <div class="flex justify-between items-center mb-4">
       <h3 class="text-lg font-bold">
        Kelas 3
       </h3>
       <div>
        <button class="bg-green-500 text-white p-2 rounded-lg shadow hover:bg-green-600 transition duration-200 mr-2" onclick="editClass('kelas3')">
         Edit Kelas
        </button>
        <button class="bg-red-500 text-white p-2 rounded-lg shadow hover:bg-red-600 transition duration-200" onclick="deleteClass('kelas3')">
         Hapus Kelas
        </button>
       </div>
      </div>
      <div class="flex justify-between items-center mb-4">
       <h4 class="text-md font-bold">
        Mata Pelajaran
       </h4>
       <button class="bg-blue-500 text-white p-2 rounded-lg shadow hover:bg-blue-600 transition duration-200" onclick="addSubject('kelas3')">
        Tambah Mata Pelajaran
       </button>
      </div>
      <table class="w-full text-left">
       <thead>
        <tr class="border-b">
         <th class="p-2">
          Mata Pelajaran
         </th>
         <th class="p-2">
          Guru
         </th>
         <th class="p-2">
          Aksi
         </th>
        </tr>
       </thead>
       <tbody>
        <tr class="border-b">
         <td class="p-2">
          Bahasa Inggris
         </td>
         <td class="p-2">
          Pak John
         </td>
         <td class="p-2">
          <button class="bg-green-500 text-white p-1 rounded-lg shadow hover:bg-green-600 transition duration-200 mr-2" onclick="editSubject('bahasa_inggris')">
           Edit
          </button>
          <button class="bg-red-500 text-white p-1 rounded-lg shadow hover:bg-red-600 transition duration-200 mr-2" onclick="deleteSubject('bahasa_inggris')">
           Hapus
          </button>
          <button class="bg-yellow-500 text-white p-1 rounded-lg shadow hover:bg-yellow-600 transition duration-200" onclick="assignTeacher('bahasa_inggris')">
           Hubungkan Guru
          </button>
         </td>
        </tr>
        <tr class="border-b">
         <td class="p-2">
          Seni Budaya
         </td>
         <td class="p-2">
          Bu Ani
         </td>
         <td class="p-2">
          <button class="bg-green-500 text-white p-1 rounded-lg shadow hover:bg-green-600 transition duration-200 mr-2" onclick="editSubject('seni_budaya')">
           Edit
          </button>
          <button class="bg-red-500 text-white p-1 rounded-lg shadow hover:bg-red-600 transition duration-200 mr-2" onclick="deleteSubject('seni_budaya')">
           Hapus
          </button>
          <button class="bg-yellow-500 text-white p-1 rounded-lg shadow hover:bg-yellow-600 transition duration-200" onclick="assignTeacher('seni_budaya')">
           Hubungkan Guru
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
 </body>
</html>