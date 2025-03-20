<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Mengelola Data Pengguna</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.16.9/xlsx.full.min.js"></script>
    <style>
        body {
            font-family: 'Roboto', sans-serif;
        }
    </style>
    <script>
        function addUser () {
            document.getElementById('addUser Modal').classList.remove('hidden');
        }

        function closeAddUser Modal() {
            document.getElementById('addUser Modal').classList.add('hidden');
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
                <h1 class="text-2xl font-bold">Mengelola Data Pengguna</h1>
            </div>

            <!-- Daftar Pengguna Section -->
            <div class="bg-white rounded shadow p-4 mb-6">
                <div class="flex items-center mb-4">
                    <div class="bg-blue-500 text-white p-2 rounded mr-2">
                        <i class="fas fa-users"></i>
                    </div>
                    <h2 class="text-xl font-bold">Daftar Pengguna</h2>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead>
                            <tr class="border-b">
                                <th class="p-2">Nama</th>
                                <th class="p-2">Email</th>
                                <th class="p-2">Peran</th>
                                <th class="p-2">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                            <tr class="border-b">
                                <td class="p-2">{{ $user->name }}</td>
                                <td class="p-2">{{ $user->email }}</td>
                                <td class="p-2">{{ $user->role ?? 'Belum Ditentukan' }}</td>
                                <td class="p-2">
                                    <button class="bg-green-500 text-white p-1 rounded-lg shadow hover:bg-green-600 transition duration-200 mr-2" onclick="editUser ('{{ $user->id }}')">Edit</button>
                                    <button class="bg-red-500 text-white p-1 rounded-lg shadow hover:bg-red-600 transition duration-200 mr-2" onclick="deleteUser ('{{ $user->id }}')">Hapus</button>
                                    <button class="bg-yellow-500 text-white p-1 rounded-lg shadow hover:bg-yellow-600 transition duration-200" onclick="assignRole('{{ $user->id }}')">Berikan Hak Akses</button>
                                </td>
                            </tr>
                            @endforeach
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
                    <h2 class="text-xl font-bold">Tambah Pengguna</h2>
                </div>
                <div class="flex justify-between items-center mb-4">
                    <button class="bg-blue-500 text-white p-2 rounded-lg shadow hover:bg-blue-600 transition duration-200" onclick="addUser ()">Tambah Pengguna</button>
                    <form action="{{ route('admin.import.process') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="file" name="file" required class="border rounded p-2">
                        <button type="submit" class="bg-blue-500 text-white p-2 rounded-lg">Import</button>
                    </form>
                </div>
            </div>

            <!-- Modal untuk Tambah Pengguna -->
            <div id="addUser Modal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
                <div class="bg-white rounded p-6 w-1/3">
                    <h2 class="text-xl font-bold mb-4">Tambah Pengguna Baru</h2>
                    <form action="{{ route('admin.user.store') }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label for="name" class="block text-sm font-medium">Nama</label>
                            <input type="text" name="name" id="name" required class="border rounded w-full p-2">
                        </div>
                        <div class="mb-4">
                            <label for="email" class="block text-sm font-medium">Email</label>
                            <input type="email" name="email" id="email" required class="border rounded w-full p-2">
                        </div>
                        <div class="mb-4">
                            <label for="password" class="block text-sm font-medium">Password</label>
                            <input type="password" name="password" id="password" required class="border rounded w-full p-2">
                        </div>
                        <div class="mb-4">
                            <label for="password_confirmation" class="block text-sm font-medium">Konfirmasi Password</label>
                            <input type="password" name="password_confirmation" id="password_confirmation" required class="border rounded w-full p-2">
                        </div>
                        <div class="mb-4">
                            <label for="role" class="block text-sm font-medium">Peran</label>
                            <select name="role" id="role" class="border rounded w-full p-2">
                                <option value="user">User </option>
                                <option value="admin">Admin</option>
                            </select>
                        </div>
                        <div class="flex justify-end">
                            <button type="button" class="bg-gray-300 text-black p-2 rounded mr-2" onclick="closeAddUser Modal()">Batal</button>
                            <button type="submit" class="bg-blue-500 text-white p-2 rounded">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>

            @if(session('success'))
                <div class="bg-green-500 text-white p-4 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif
        </div>
    </div>
</body>
</html>