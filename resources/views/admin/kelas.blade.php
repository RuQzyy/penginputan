<html lang="id">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Mengelola Kelas dan Mata Pelajaran</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet"/>
    <style>
        body {
            font-family: 'Roboto', sans-serif;
        }
    </style>
    <script>
        function toggleModal(modalId, show = true) {
            const modal = document.getElementById(modalId);
            modal.classList.toggle('hidden', !show);
        }

        function showClassDetails(classId) {
            document.querySelectorAll('.class-details').forEach(el => el.classList.add('hidden'));
            if (classId) {
                document.getElementById(classId).classList.remove('hidden');
            }
        }

        function addClass() {
            toggleModal('addClassModal', true);
        }

        function closeModal() {
            toggleModal('addClassModal', false);
            toggleModal('editClassModal', false);
            toggleModal('addSubjectModal', false);
            document.getElementById('editClassName').value = ''; // Reset input nama kelas
        }

        function openEditModal(classId, className) {
            document.getElementById('editClassId').value = classId;
            document.getElementById('editClassName').value = className;
            document.getElementById('editClassForm').action = `/admin/kelas/${classId}`;
            toggleModal('editClassModal', true);
        }

        function addSubject(classId) {
            document.getElementById('subjectClassId').value = classId;
            toggleModal('addSubjectModal', true);
        }

        // Event listener untuk mencegah modal tertutup saat klik di dalam modal
        document.querySelectorAll('.modal-content').forEach(modal => {
            modal.addEventListener('click', function (event) {
                event.stopPropagation();
            });
        });
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
                <img src="{{ asset('img/gaga.jpg') }}" class="rounded-full w-14 h-14 border-2 border-white" alt="Gambar profil pengguna">
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
        <!-- Konten Utama -->
        <div class="flex-1 p-6 ml-64">
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-2xl font-bold">Mengelola Kelas dan Mata Pelajaran</h1>
                <button class="bg-blue-500 text-white p-2 rounded-lg shadow hover:bg-blue-600 transition duration-200" onclick="addClass()">
                    Tambah Kelas
                </button>
            </div>
            <!-- Daftar Kelas Section -->
            <div class="bg-white rounded shadow p-4 mb-6">
                <div class="flex items-center mb-4">
                    <div class="bg-blue-500 text-white p-2 rounded mr-2">
                        <i class="fas fa-chalkboard"></i>
                    </div>
                    <h2 class="text-xl font-bold">Daftar Kelas</h2>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700">Pilih Kelas</label>
                    <select class="border rounded w-full p-2" onchange="showClassDetails(this.value)">
                        <option value="">-- Pilih Kelas --</option>
                        @foreach ($kelas as $k)
                            <option value="kelas{{ $k->id }}">{{ $k->nama_kelas }}</option>
                        @endforeach
                    </select>
                </div>
                <!-- Looping Data Kelas -->
                @foreach ($kelas as $k)
                <div class="class-details hidden" id="kelas{{ $k->id }}">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-bold">{{ $k->nama_kelas }}</h3>
                        <div>
                            <button class="bg-green-500 text-white p-2 rounded-lg shadow hover:bg-green-600 transition duration-200 mr-2" 
                                onclick="openEditModal('{{ $k->id }}', '{{ $k->nama_kelas }}')">
                                Edit Kelas
                            </button>
                            <button class="bg-red-500 text-white p-2 rounded-lg shadow hover:bg-red-600 transition duration-200" onclick="deleteClass('{{ $k->id }}')">
                                Hapus Kelas
                            </button>
                        </div>
                    </div>
                    <div class="flex justify-between items-center mb-4">
                        <h4 class="text-md font-bold">Mata Pelajaran</h4>
                        <button class="bg-blue-500 text-white p-2 rounded-lg shadow hover:bg-blue-600 transition duration-200" onclick="addSubject('{{ $k->id }}')">
                            Tambah Mata Pelajaran
                        </button>
                    </div>
                    <table class="w-full text-left">
                        <thead>
                            <tr class="border-b">
                                <th class="p-2">Mata Pelajaran</th>
                                <th class="p-2">Guru</th>
                                <th class="p-2">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($k->matapelajaran as $m)
                            <tr class="border-b">
                                <td class="p-2">{{ $m->nama_mapel }}</td>
                                <td class="p-2">{{ $m->guru->nama ?? 'Belum ada guru' }}</td>
                                <td class="p-2">
                                    <button class="bg-green-500 text-white p-1 rounded-lg shadow hover:bg-green-600 transition duration-200 mr-2" onclick="editSubject('{{ $m->id }}')">
                                        Edit
                                    </button>
                                    <button class="bg-red-500 text-white p-1 rounded-lg shadow hover:bg-red-600 transition duration-200 mr-2" onclick="deleteSubject('{{ $m->id }}')">
                                        Hapus
                                    </button>
                                    <button class="bg-yellow-500 text-white p-1 rounded-lg shadow hover:bg-yellow-600 transition duration-200" onclick="assignTeacher('{{ $m->id }}')">
                                        Hubungkan Guru
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Modal Tambah Kelas -->
    <div id="addClassModal" class="fixed inset-0 bg-gray-800 bg-opacity-50 flex items-center justify-center hidden">
        <div class="bg-white p-6 rounded-lg w-1/3">
            <h2 class="text-xl font-bold mb-4">Tambah Kelas</h2>
            <form action="{{ route('admin.kelas.store') }}" method="POST">
                @csrf
                <label class="block">Nama Kelas</label>
                <input type="text" name="nama_kelas" class="border rounded w-full p-2 mb-4" placeholder="Masukkan nama kelas" required>
                <div class="flex justify-end">
                    <button type="button" onclick="closeModal()" class="bg-gray-300 px-4 py-2 rounded-lg hover:bg-gray-400">Batal</button>
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 ml-2">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Edit Kelas -->
    <div id="editClassModal" class="fixed inset-0 bg-gray-800 bg-opacity-50 flex items-center justify-center hidden">
        <div class="bg-white p-6 rounded-lg w-1/3">
            <h2 class="text-xl font-bold mb-4">Edit Kelas</h2>
            <form id="editClassForm" method="POST">
                @csrf
                @method('PUT')
                <input type="hidden" name="id_kelas" id="editClassId">
                <label class="block">Nama Kelas</label>
                <input type="text" name="nama_kelas" id="editClassName" class="border rounded w-full p-2 mb-4" required>
                <div class="flex justify-end">
                    <button type="button" onclick="closeModal()" class="bg-gray-300 px-4 py-2 rounded-lg hover:bg-gray-400">Batal</button>
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 ml-2">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Tambah Mata Pelajaran -->
    <div id="addSubjectModal" class="fixed inset-0 bg-gray-800 bg-opacity-50 flex items-center justify-center hidden">
        <div class="bg-white p-6 rounded-lg w-1/3">
            <h2 class="text-xl font-bold mb-4">Tambah Mata Pelajaran</h2>
            <form id="addSubjectForm" method="POST">
                @csrf
                <input type="hidden" name="id_kelas" id="subjectClassId">
                <label class="block">Nama Mata Pelajaran</label>
                <input type="text" name="nama_mapel" class="border rounded w-full p-2 mb-4" required>
                <label class="block">Pilih Guru</label>
                <select name="id_guru" class="border rounded w-full p-2 mb-4" required>
                    <option value="">-- Pilih Guru --</option>
                    @if(isset($gurus))
                        @foreach($gurus as $guru)
                            <option value="{{ $guru->id }}">{{ $guru->name }}</option>
                        @endforeach
                    @endif

                </select>
                <div class="flex justify-end">
                    <button type="button" onclick="closeModal('addSubjectModal')" class="bg-gray-300 px-4 py-2 rounded-lg hover:bg-gray-400">Batal</button>
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 ml-2">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>