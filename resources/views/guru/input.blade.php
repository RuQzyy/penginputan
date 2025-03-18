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

        function selectStudent(studentName) {
            document.getElementById('selected-student').innerText = studentName;
            document.getElementById('input-nilai-form').classList.remove('hidden');
        }
  </script>
 </head>
 <body class="bg-gray-100">
  <div class="flex">
   <!-- Sidebar -->
   <div class="w-64 bg-gray-900 text-white min-h-screen">
    <div class="p-4 flex items-center">
     <div class="text-2xl font-bold">
      Sekolah
     </div>
     <div class="ml-2 text-sm">
      Dashboard Guru
     </div>
    </div>
    <div class="p-4 flex items-center">
     <img alt="User profile picture" class="rounded-full w-10 h-10" height="40" src="https://placehold.co/40x40" width="40"/>
     <div class="ml-2">
      <div class="text-sm">
       Nama Guru
      </div>
     </div>
    </div>
    <nav class="mt-4">
     <ul>
     <li class="p-2 hover:bg-gray-700 cursor-pointer">
            <a href="{{ route('guru.index') }}" class="flex items-center">
                <i class="fas fa-list mr-2"></i>
                dashboard
            </a>
        </li>
      <li class="p-2 hover:bg-gray-700 cursor-pointer">
            <a href="{{ route('guru.input') }}" class="flex items-center">
                <i class="fas fa-list mr-2"></i>
                input Nilai
            </a>
        </li>
      <li class="p-2 hover:bg-gray-700 cursor-pointer">
            <a href="{{ route('guru.nilai') }}" class="flex items-center">
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
     <h1 class="text-2xl font-bold">
      Input Nilai
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
      <table class="w-full text-left student-list" id="kelas1">
       <thead>
        <tr class="border-b">
         <th class="p-2">
          Nama Siswa
         </th>
        </tr>
       </thead>
       <tbody>
        <tr class="border-b cursor-pointer" onclick="selectStudent('Budi')">
         <td class="p-2">
          Budi
         </td>
        </tr>
        <tr class="border-b cursor-pointer" onclick="selectStudent('Siti')">
         <td class="p-2">
          Siti
         </td>
        </tr>
        <!-- Tambahkan baris lainnya sesuai kebutuhan -->
       </tbody>
      </table>
      <!-- Kelas 2 Students -->
      <table class="w-full text-left student-list hidden" id="kelas2">
       <thead>
        <tr class="border-b">
         <th class="p-2">
          Nama Siswa
         </th>
        </tr>
       </thead>
       <tbody>
        <tr class="border-b cursor-pointer" onclick="selectStudent('Andi')">
         <td class="p-2">
          Andi
         </td>
        </tr>
        <tr class="border-b cursor-pointer" onclick="selectStudent('Rina')">
         <td class="p-2">
          Rina
         </td>
        </tr>
        <!-- Tambahkan baris lainnya sesuai kebutuhan -->
       </tbody>
      </table>
      <!-- Kelas 3 Students -->
      <table class="w-full text-left student-list hidden" id="kelas3">
       <thead>
        <tr class="border-b">
         <th class="p-2">
          Nama Siswa
         </th>
        </tr>
       </thead>
       <tbody>
        <tr class="border-b cursor-pointer" onclick="selectStudent('John')">
         <td class="p-2">
          John
         </td>
        </tr>
        <tr class="border-b cursor-pointer" onclick="selectStudent('Ani')">
         <td class="p-2">
          Ani
         </td>
        </tr>
        <!-- Tambahkan baris lainnya sesuai kebutuhan -->
       </tbody>
      </table>
     </div>
    </div>
    <!-- Input Nilai Form Section -->
    <div class="bg-white rounded shadow p-4 hidden" id="input-nilai-form">
     <div class="flex items-center mb-4">
      <div class="bg-green-500 text-white p-2 rounded mr-2">
       <i class="fas fa-edit">
       </i>
      </div>
      <h2 class="text-xl font-bold">
       Input Nilai untuk
       <span id="selected-student">
       </span>
      </h2>
     </div>
     <form>
      <div class="mb-4">
       <label class="block text-gray-700">
        Mata Pelajaran
       </label>
       <input class="border rounded w-full p-2" placeholder="Masukkan mata pelajaran" type="text"/>
      </div>
      <div class="mb-4">
       <label class="block text-gray-700">
        Tugas
       </label>
       <input class="border rounded w-full p-2" placeholder="Masukkan nilai tugas" type="number"/>
      </div>
      <div class="mb-4">
       <label class="block text-gray-700">
        UTS
       </label>
       <input class="border rounded w-full p-2" placeholder="Masukkan nilai UTS" type="number"/>
      </div>
      <div class="mb-4">
       <label class="block text-gray-700">
        UAS
       </label>
       <input class="border rounded w-full p-2" placeholder="Masukkan nilai UAS" type="number"/>
      </div>
      <button class="bg-blue-500 text-white p-2 rounded">
       Simpan
      </button>
     </form>
    </div>
   </div>
  </div>
 </body>
</html>