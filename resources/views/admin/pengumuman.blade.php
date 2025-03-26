<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Mengelola Pengumuman</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet"/>
    <style>
        body {
            font-family: 'Roboto', sans-serif;
        }
    </style>
    <script>
        function addAnnouncement() {
            document.getElementById('createAnnouncementModal').classList.remove('hidden');
        }

        function closeModal() {
            document.getElementById('createAnnouncementModal').classList.add('hidden');
        }

        function editAnnouncement(announcementId) {
            // Mengambil data pengumuman dari server
            fetch(`/admin/pengumuman/${announcementId}`)
                .then(response => response.json())
                .then(data => {
                    // Mengisi data ke dalam form
                    document.getElementById('editTitle').value = data.title;
                    document.getElementById('editContent').value = data.content;

                    // Set action form untuk mengupdate pengumuman
                    document.getElementById('editAnnouncementForm').action = `/admin/pengumuman/${announcementId}`;

                    // Tampilkan modal
                    document.getElementById('editAnnouncementModal').classList.remove('hidden');
                })
                .catch(error => console.error('Error fetching announcement:', error));
        }

        function closeEditModal() {
            document.getElementById('editAnnouncementModal').classList.add('hidden');
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
                <h1 class="text-2xl font-bold">Mengelola Pengumuman</h1>
                <button class="bg-blue-500 text-white p-2 rounded-lg shadow hover:bg-blue-600 transition duration-200 flex items-center space-x-2" onclick="addAnnouncement()">
                    <i class="fas fa-plus"></i>
                    <span>Tambah Pengumuman</span>
                </button>
            </div>

            <!-- Daftar Pengumuman Section -->
            <div class="bg-white rounded shadow p-4 mb-6">
                <div class="flex items-center mb-4">
                    <div class="bg-red-500 text-white p-2 rounded mr-2">
                        <i class="fas fa-bullhorn"></i>
                    </div>
                    <h2 class="text-xl font-bold">Daftar Pengumuman</h2>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead>
                            <tr class="border-b">
                                <th class="p-2">Judul Pengumuman</th>
                                <th class="p-2">Isi Pengumuman</th>
                                <th class="p-2">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pengumuman as $item)
                            <tr class="border-b">
                                <td class="p-2">{{ $item->title }}</td>
                                <td class="p-2">{{ $item->content }}</td>
                                <td class="p-2 flex space-x-2">
                                    <button class="bg-green-500 text-white p-1 rounded-lg shadow hover:bg-green-600 transition duration-200" onclick="editAnnouncement('{{ $item->id }}')">
                                        <i class="fas fa-edit"></i> Edit
                                    </button>
                                    <form action="{{ route('admin.pengumuman.destroy', $item->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-red-500 text-white p-1 rounded-lg shadow hover:bg-red-600 transition duration-200">
                                            <i class="fas fa-trash"></i> Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal untuk Tambah Pengumuman -->
<div id="createAnnouncementModal" class="fixed inset-0 flex items-center justify-center z-50 hidden bg-black bg-opacity-50">
    <div class="bg-white border border-gray-300 rounded-lg shadow-lg p-6 w-full max-w-lg">
        <h2 class="text-2xl font-semibold text-gray-800 mb-4 border-b pb-2">Tambah Pengumuman</h2>
        <form action="{{ route('admin.pengumuman.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="title" class="block text-sm font-medium text-gray-700">Judul Pengumuman</label>
                <input type="text" name="title" id="title" required 
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-200 focus:ring-opacity-50 p-2">
            </div>
            <div class="mb-4">
                <label for="content" class="block text-sm font-medium text-gray-700">Isi Pengumuman</label>
                <textarea name="content" id="content" rows="4" required 
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-200 focus:ring-opacity-50 p-2"></textarea>
            </div>
            <div class="flex justify-end space-x-2">
                <button type="button" class="bg-gray-300 text-gray-800 px-4 py-2 rounded-md border border-gray-400 hover:bg-gray-400 transition" onclick="closeModal()">Batal</button>
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-md border border-blue-700 hover:bg-blue-700 transition">Simpan</button>
            </div>
        </form>
    </div>
</div>

<script>
    function openModal() {
        document.getElementById('createAnnouncementModal').classList.remove('hidden');
    }

    function closeModal() {
        document.getElementById('createAnnouncementModal').classList.add('hidden');
    }
</script>


    <!-- Modal untuk Edit Pengumuman -->
<div id="editAnnouncementModal" class="fixed inset-0 flex items-center justify-center z-50 hidden bg-black bg-opacity-50">
    <div class="bg-white border border-gray-300 rounded-lg shadow-lg p-6 w-full max-w-lg">
        <h2 class="text-2xl font-semibold text-gray-800 mb-4 border-b pb-2">Edit Pengumuman</h2>
        <form id="editAnnouncementForm" action="" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label for="editTitle" class="block text-sm font-medium text-gray-700">Judul Pengumuman</label>
                <input type="text" name="title" id="editTitle" required 
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-200 focus:ring-opacity-50 p-2">
            </div>
            <div class="mb-4">
                <label for="editContent" class="block text-sm font-medium text-gray-700">Isi Pengumuman</label>
                <textarea name="content" id="editContent" rows="4" required 
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-200 focus:ring-opacity-50 p-2"></textarea>
            </div>
            <div class="flex justify-end space-x-2">
                <button type="button" class="bg-gray-300 text-gray-800 px-4 py-2 rounded-md border border-gray-400 hover:bg-gray-400 transition" onclick="closeEditModal()">Batal</button>
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-md border border-blue-700 hover:bg-blue-700 transition">Simpan</button>
            </div>
        </form>
    </div>
</div>

<script>
    function openEditModal() {
        document.getElementById('editAnnouncementModal').classList.remove('hidden');
    }

    function closeEditModal() {
        document.getElementById('editAnnouncementModal').classList.add('hidden');
    }
</script>

</body>
</html>