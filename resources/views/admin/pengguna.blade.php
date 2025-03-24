<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Mengelola Data Pengguna</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.16.9/xlsx.full.min.js"></script>
    <style>
        body {
            font-family: 'Roboto', sans-serif;
        }
    </style>
    <script>
    function addUser() {
            document.getElementById('addUserModal').classList.remove('hidden');
        }

function closeAddUserModal() {
    document.getElementById('addUserModal').classList.add('hidden');
}



function editUser(userId) {
    document.getElementById('editUserId').value = userId;
    document.getElementById('editUserForm').action = '/admin/pengguna/{id}'; // Sesuai dengan rute baru
    document.getElementById('editUserModal').classList.remove('hidden');
}

function closeEditUserModal() {
    document.getElementById('editUserModal').classList.add('hidden');
}



function assignRole(userId) {
    document.getElementById('assignUserId').value = userId;
    document.getElementById('assignRoleForm').action = `/admin/pengguna/update-role`; // Sesuai dengan rute baru
    document.getElementById('assignRoleModal').classList.remove('hidden');
}

function closeAssignRoleModal() {
    document.getElementById('assignRoleModal').classList.add('hidden');
}

        function exportToExcel() {
            const table = document.querySelector('table');
            const workbook = XLSX.utils.table_to_book(table);
            XLSX.writeFile(workbook, 'data_pengguna.xlsx');
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
                    <li class="p-2 hover:bg-gray-700 cursor-pointer">
                        <a href="{{ route('logout') }}" class="flex items-center">
                            <i class="fas fa-sign-out-alt mr-2"></i> logout
                        </a>
                    </li>
                </ul>
            </nav>
        </div>

        <div class="flex-1 ml-64 p-6">
            <h1 class="text-2xl font-bold mb-4">Mengelola Data Pengguna</h1>
           <!-- Tambah Pengguna -->
            <button onclick="addUser()" class="bg-green-500 text-white p-2 rounded mb-4 flex items-center space-x-2 shadow hover:bg-green-600 transition">
                <i class="fas fa-user-plus"></i>
                <span>Tambah Pengguna</span>
            </button>

            <!-- Ekspor ke Excel -->
            <button onclick="exportToExcel()" class="bg-blue-500 text-white p-2 rounded mb-4 flex items-center space-x-2 shadow hover:bg-blue-600 transition">
                <i class="fas fa-file-excel"></i>
                <span>Ekspor ke Excel</span>
            </button>

            <form id="importForm" method="POST" action="{{ route('admin.pengguna.import') }}" enctype="multipart/form-data" class="mb-4 flex items-center space-x-2">
                @csrf
                <input type="file" name="file" accept=".xlsx, .xls" required class="border border-gray-300 rounded p-2">
                <button type="submit" class="bg-blue-500 text-white p-2 rounded flex items-center space-x-2 shadow hover:bg-blue-600 transition">
                    <i class="fas fa-file-import"></i>
                    <span>Impor dari Excel</span>
                </button>
            </form>

            <table class="min-w-full bg-white border border-gray-300">
                <thead>
                    <tr>
                        <th class="border px-4 py-2">Nama</th>
                        <th class="border px-4 py-2">Email</th>
                        <th class="border px-4 py-2">Peran</th>
                        <th class="border px-4 py-2">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr>
                        <td class="border px-4 py-2">{{ $user->name }}</td>
                        <td class="border px-4 py-2">{{ $user->email }}</td>
                        <td class="border px-4 py-2">{{ $user->role }}</td>
                        <td class="border px-4 py-2">
                            <button onclick="editUser({{ $user->id }})" class="bg-yellow-500 text-white p-1 rounded flex items-center gap-1">
                                <i class="fas fa-edit"></i> Edit
                            </button>
                            <button onclick="assignRole({{ $user->id }})" class="bg-blue-500 text-white p-1 rounded flex items-center gap-1">
                                <i class="fas fa-user-cog"></i> Ubah Role
                            </button>
                            <form action="{{ route('admin.pengguna.delete', $user->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 text-white p-1 rounded flex items-center gap-1">
                                    <i class="fas fa-trash-alt"></i> Hapus
                                </button>
                            </form>
                        </td>

                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal Tambah Pengguna -->
    <div id="addUserModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
        <div class="bg-white rounded p-6 w-1/3">
            <h2 class="text-xl font-bold mb-4">Tambah Pengguna</h2>
            <form action="{{ route('admin.pengguna.store') }}" method="POST">
    @csrf
    <div class="mb-4">
        <label for="name" class="block text-sm font-medium">Nama</label>
        <input type="text" name="name" required class="border rounded w-full p-2">
    </div>
    <div class="mb-4">
        <label for="email" class="block text-sm font-medium">Email</label>
        <input type="email" name="email" required class="border rounded w-full p-2">
    </div>
    <div class="mb-4">
        <label for="password" class="block text-sm font-medium">Password</label>
        <input type="password" name="password" required class="border rounded w-full p-2">
    </div>
    <div class="mb-4">
    <label for="editRole" class="block text-sm font-medium">Peran</label>
    <select name="role" id="editRole" required class="border rounded w-full p-2">
        <option value="admin">Admin</option>
        <option value="guru">Guru</option>
        <option value="siswa">Siswa</option>
    </select>
</div>
    <div class="flex justify-end">
        <button type="button" class="bg-gray-300 text-black p-2 rounded mr-2" onclick="closeAddUserModal()">Batal</button>
        <button type="submit" class="bg-blue-500 text-white p-2 rounded">Simpan</button>
    </div>
</form>

        </div>
    </div>

   <!-- Modal Edit Pengguna -->
<div id="editUserModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden transition-opacity duration-300">
    <div class="bg-white rounded-lg p-6 w-full max-w-lg shadow-lg transform scale-95 transition-transform duration-300">
        <h2 class="text-xl font-bold mb-4">Edit Pengguna</h2>
        <form id="editUserForm" method="POST">
            @csrf
            <input type="hidden" name="_method" value="PUT">
            <input type="hidden" id="editUserId" name="user_id">

            <!-- Input Nama -->
            <div class="mb-4">
                <label for="editName" class="block text-sm font-medium">Nama</label>
                <input type="text" name="name" id="editName" required 
                       class="border rounded w-full p-2 focus:ring focus:ring-blue-300">
            </div>

            <!-- Input Email -->
            <div class="mb-4">
                <label for="editEmail" class="block text-sm font-medium">Email</label>
                <input type="email" name="email" id="editEmail" required 
                       class="border rounded w-full p-2 focus:ring focus:ring-blue-300">
            </div>

            <!-- Tombol Aksi -->
            <div class="flex justify-end">
            <button type="button" onclick="closeEditUserModal()"
                    class="px-4 py-2 text-gray-700 border rounded-lg hover:bg-gray-100">
                    Batal
                </button>
                <button type="submit"
                    class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>


   <!-- Modal Ubah Role -->
<div id="assignRoleModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
    <div class="bg-white rounded-lg p-6 w-1/3 shadow-lg">
        
        <!-- Header -->
        <h2 class="text-xl font-bold mb-4 text-gray-800">Ubah Hak Akses</h2>
        
        <!-- Form -->
        <form id="assignRoleForm" method="POST">
            @csrf
            <input type="hidden" name="user_id" id="assignUserId">
            
            <!-- Pilihan Role -->
            <div class="mb-4">
                <label for="assignRole" class="block text-sm font-medium text-gray-600">Pilih Peran</label>
                <select name="role" id="assignRole" required
                    class="w-full mt-1 p-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    <option value="admin">Admin</option>
                    <option value="guru">Guru</option>
                    <option value="siswa">Siswa</option>
                </select>
            </div>

            <!-- Tombol Aksi -->
            <div class="flex justify-end space-x-2">
                <button type="button" onclick="closeAssignRoleModal()"
                    class="px-4 py-2 text-gray-700 border rounded-lg hover:bg-gray-100">
                    Batal
                </button>
                <button type="submit"
                    class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>

</body>
</html>