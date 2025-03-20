<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Dashboard Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet"/>
    <style>
        body {
            font-family: 'Roboto', sans-serif;
        }
    </style>
    <script>
        function showSchedule(classId) {
            const schedules = document.querySelectorAll('.schedule');
            schedules.forEach(schedule => {
                schedule.classList.add('hidden');
            });
            document.getElementById(classId).classList.remove('hidden');
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
                <h1 class="text-2xl font-bold">Dashboard Admin</h1>
            </div>

            <!-- Statistics Section -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                <div class="bg-white rounded shadow p-4 flex items-center">
                    <div class="bg-blue-500 text-white p-4 rounded-full mr-4">
                        <i class="fas fa-users"></i>
                    </div>
                    <div>
                        <div class="text-xl font-bold">200</div>
                        <div class="text-gray-500">Jumlah Murid</div>
                    </div>
                </div>
                <div class="bg-white rounded shadow p-4 flex items-center">
                    <div class="bg-green-500 text-white p-4 rounded-full mr-4">
                        <i class="fas fa-chalkboard-teacher"></i>
                    </div>
                    <div>
                        <div class="text-xl font-bold">20</div>
                        <div class="text-gray-500">Jumlah Guru</div>
                    </div>
                </div>
                <div class="bg-white rounded shadow p-4 flex items-center">
                    <div class="bg-red-500 text-white p-4 rounded-full mr-4">
                        <i class="fas fa-book"></i>
                    </div>
                    <div>
                        <div class="text-xl font-bold">15</div>
                        <div class="text-gray-500">Jumlah Mata Pelajaran</div>
                    </div>
                </div>
            </div>

            <!-- Kalender Pelajaran Section -->
            <div class="bg-white rounded shadow p-4 mb-6">
                <div class="flex items-center mb-4">
                    <div class="bg-yellow-500 text-white p-2 rounded mr-2">
                        <i class="fas fa-calendar-alt"></i>
                    </div>
                    <h2 class="text-xl font-bold">Kalender Pelajaran</h2>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700">Pilih Kelas</label>
                    <select class="border rounded w-full p-2" onchange="showSchedule(this.value)">
                        <option value="kelas1">Kelas 1</option>
                        <option value="kelas2">Kelas 2</option>
                        <option value="kelas3">Kelas 3</option>
                    </select>
                </div>
                <div class="overflow-x-auto">
                    <!-- Kelas 1 Schedule -->
                    <table class="w-full text-left schedule" id="kelas1">
                        <thead>
                            <tr class="border-b">
                                <th class="p-2">Hari</th>
                                <th class="p-2">Mata Pelajaran</th>
                                <th class="p-2">Jam</th>
                                <th class="p-2">Guru</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="border-b">
                                <td class="p-2">Senin</td>
                                <td class="p-2">Matematika</td>
                                <td class="p-2">08:00 - 09:30</td>
                                <td class="p-2">Pak Budi</td>
                            </tr>
                            <tr class="border-b">
                                <td class="p-2">Senin</td>
                                <td class="p-2">Bah asa Indonesia</td>
                                <td class="p-2">09:45 - 11:15</td>
                                <td class="p-2">Bu Siti</td>
                            </tr>
                            <!-- Tambahkan baris lainnya sesuai kebutuhan -->
                        </tbody>
                    </table>
                    <!-- Kelas 2 Schedule -->
                    <table class="w-full text-left schedule hidden" id="kelas2">
                        <thead>
                            <tr class="border-b">
                                <th class="p-2">Hari</th>
                                <th class="p-2">Mata Pelajaran</th>
                                <th class="p-2">Jam</th>
                                <th class="p-2">Guru</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="border-b">
                                <td class="p-2">Selasa</td>
                                <td class="p-2">IPA</td>
                                <td class="p-2">08:00 - 09:30</td>
                                <td class="p-2">Pak Andi</td>
                            </tr>
                            <tr class="border-b">
                                <td class="p-2">Selasa</td>
                                <td class="p-2">IPS</td>
                                <td class="p-2">09:45 - 11:15</td>
                                <td class="p-2">Bu Rina</td>
                            </tr>
                            <!-- Tambahkan baris lainnya sesuai kebutuhan -->
                        </tbody>
                    </table>
                    <!-- Kelas 3 Schedule -->
                    <table class="w-full text-left schedule hidden" id="kelas3">
                        <thead>
                            <tr class="border-b">
                                <th class="p-2">Hari</th>
                                <th class="p-2">Mata Pelajaran</th>
                                <th class="p-2">Jam</th>
                                <th class="p-2">Guru</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="border-b">
                                <td class="p-2">Rabu</td>
                                <td class="p-2">Bahasa Inggris</td>
                                <td class="p-2">08:00 - 09:30</td>
                                <td class="p-2">Pak John</td>
                            </tr>
                            <tr class="border-b">
                                <td class="p-2">Rabu</td>
                                <td class="p-2">Seni Budaya</td>
                                <td class="p-2">09:45 - 11:15</td>
                                <td class="p-2">Bu Ani</td>
                            </tr>
                            <!-- Tambahkan baris lainnya sesuai kebutuhan -->
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Pengumuman Akademik Section -->
            <div class="bg-white rounded shadow p-4">
                <div class="flex items-center mb-4">
                    <div class="bg-red-500 text-white p-2 rounded mr-2">
                        <i class="fas fa-bullhorn"></i>
                    </div>
                    <h2 class="text-xl font-bold">Pengumuman Akademik</h2>
                </div>
                <div class="overflow-x-auto">
                    <ul class="list-disc pl-5">
                        @foreach($pengumuman as $item)
                            <li class="mb-2">
                                {{ $item->title }}: {{ $item->content }}
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</body>
</html>