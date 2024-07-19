<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard Menu Hak Akses') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <!-- Button modal insert -->
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        <ion-icon name="add-outline"></ion-icon> Tambahkan Data
                    </button>
                </div>
            </div>
        </div>

        <!-- Tabulator menampilkan data user_priv -->
        <div class="mt-4">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <div id="user_priv-list" class="table-responsive"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<!-- Modal Tambah Data -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <form id="addForm" method="POST" action="{{ route('storeUser_Privs') }}"> 
            @csrf
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tambah Data Hak Akses</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="namaRole" class="form-label">Nama Role</label>
                            <select id="role_id" name="role_id" class="form-control">
                                <option value="">Pilih Status</option>
                                @foreach($roleList as $role)
                                    <option value="{{ $role->id }}">{{ $role->keterangan }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="namaModule" class="form-label">Nama Module</label>
                            <select id="module_id" name="module_id" class="form-control">
                            <option value="">Pilih Module</option>
                            @foreach($moduleList as $module)
                                <option value="{{ $module->id }}">{{ $module->nama_module }}</option>
                            @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Tambah</button>
                    </div>
                </div>
            </div>
        </form>
    </div>




<!-- Modal Edit Data -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <form id="editForm" method="POST" action="{{ route('storeUser_Privs', ['id' => 0]) }}">
            @csrf
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel">Edit Data Hak Akses</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="editId" name="id">
                        <div class="mb-3">
                            <label for="editRole_id" class="form-label">Nama Role</label>
                            <select id="editRole_id" name="role_id" class="form-control">
                                <option value="">Pilih Role</option>
                                @foreach($roleList as $role)
                                    <option value="{{ $role->id }}">{{ $role->keterangan }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="editModule_id" class="form-label">Nama Module</label>
                            <select id="editModule_id" name="module_id" class="form-control">
                                <option value="">Pilih Module</option>
                                @foreach($moduleList as $module)
                                    <option value="{{ $module->id }}">{{ $module->nama_module }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </div>
                </div>
            </div>
        </form>
    </div>




    <!-- Pemanggilan file js pendukung halaman dashboard user_privs -->
    <script src="{{ asset('js/user_privs/index.js') }}"></script>
</x-app-layout>
