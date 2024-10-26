@extends('layouts.app')


@section('title')
Kelola Produk
@endsection

@section('content')

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Kelola Produk</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                <li class="breadcrumb-item active">Kelola Produk</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center">
            <h5 class="card-title mb-0">Data Kategori Produk</h5>
            <x-primary-button class="w-full flex justify-center items-center" style="width: 200px;" data-bs-toggle="modal" data-bs-target="#addCategory" style="width: 200px;">Tambah Kategori</x-primary-button>
        </div>

        <div class="table-responsive">
            <table id="tableCategory" class="table table-striped table-bordered dt-responsive nowrap mx-auto" style="border-collapse: collapse; border-spacing: 0; width: 100%; font-size:14px;">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($category as $ct)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $ct->name }}</td>
                        <td>
                            <x-button-action style="background-color: #415643;" data-bs-toggle="modal" data-bs-target="#editCategory"
                                data-id="{{ $ct->id }}" data-name="{{ $ct->name }}"
                                title="Edit Data Kategori">
                                <i class="bi bi-pencil text-white"></i>
                            </x-button-action>
                            <x-button-action style="background-color: #E33437;" data-bs-toggle="modal" data-bs-target="#hapusCategory"
                                data-id="{{ $ct->id }}" data-name="{{ $ct->name }}"
                                title="Hapus Data Kategori">
                                <i class="bi bi-trash text-white"></i>
                            </x-button-action>
                        </td>
                    </tr>
                    @empty
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center">
            <h5 class="card-title mb-0">Data Produk</h5>
            <x-primary-button class="w-full flex justify-center items-center" style="width: 200px;" data-bs-toggle="modal" data-bs-target="#addProduct">
                Tambah Produk
            </x-primary-button>
        </div>

        <div class="table-responsive">
            <table id="tableProduct" class="table table-striped table-bordered dt-responsive nowrap mx-auto" style="border-collapse: collapse; border-spacing: 0; width: 100%; font-size:14px;">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Harga</th>
                        <th>Stok</th>
                        <th>Gambar</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($product as $pd)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $pd->name }}</td>
                        <td>Rp {{ number_format($pd->price, 2, ',', '.') }}</td> <!-- Format harga -->
                        <td>{{ $pd->stock }}</td>
                        <td>
                            @if($pd->image)
                            <img src="{{ asset('storage/' . $pd->image) }}" alt="{{ $pd->name }}" style="width: 50px; height: auto;">
                            @else
                            <span>Tidak ada gambar</span>
                            @endif
                        </td>
                        <td>
                            <x-button-action style="background-color: #415643;" data-bs-toggle="modal" data-bs-target="#editProduct"
                                data-id="{{ $pd->id }}" data-name="{{ $pd->name }}" data-price="{{ $pd->price }}"
                                data-stock="{{ $pd->stock }}" data-category-id="{{ $pd->categories_id }}"
                                data-image-url="{{ $pd->image }}" title="Edit Data Produk">
                                <i class="bi bi-pencil text-white"></i>
                            </x-button-action>
                            <x-button-action style="background-color: #E33437;" data-bs-toggle="modal" data-bs-target="#hapusProduct"
                                data-id="{{ $pd->id }}" data-name="{{ $pd->name }}"
                                title="Hapus Data Produk">
                                <i class="bi bi-trash text-white"></i>
                            </x-button-action>
                        </td>
                    </tr>
                    @empty

                    @endforelse
                </tbody>
            </table>
        </div>
    </div>


    <!-- card addCategory modal -->
    <div class="modal fade" id="addCategory" tabindex="-1" aria-labelledby="addNewCardTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-transparent">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body px-sm-5 mx-50 pb-5">
                    <h3 class="text-center mb-1" id="addNewCardTitle">Tambah Kategori</h3>
                    <!-- form -->
                    <form class="form row gy-1 gx-2 mt-75" method="POST" action="{{route('tambah.category')}}">
                        @method('post')
                        @csrf
                        <div class="col-12">
                            <label class="form-label" for="name">Nama</label>
                            <div class="input-group input-group-merge">
                                <input id="name" name="name" class="form-control" type="text" required />
                            </div>
                        </div>
                        <div class="col-12 text-center">
                            <button type="submit" class="btn btn-primary me-1 mt-1">Tambah</button>
                            <button type="reset" class="btn btn-outline-secondary mt-1" data-bs-dismiss="modal" aria-label="Close">
                                kembali
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--end card modal -->

    <!-- card editCategory modal -->
    <div class="modal fade" id="editCategory" tabindex="-1" aria-labelledby="addNewCardTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-transparent">
                    <h3 class="text-center" id="addNewCardTitle">Edit Kategori</h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body px-sm-5 mx-50 pb-5">
                    <!-- form -->
                    <form class="form row gy-1 gx-2 mt-75" method="POST" action="{{ route('edit.category') }}">
                        @method('put')
                        @csrf
                        <input id="id" name="id" class="form-control" type="text" hidden />
                        <div class="col-12">
                            <label class="form-label" for="name">Nama</label>
                            <div class="input-group input-group-merge">
                                <input id="name" name="name" class="form-control" type="text" required />
                            </div>
                        </div>
                        <div class="col-12 text-center">
                            <button type="submit" class="btn btn-primary me-1 mt-1">Edit</button>
                            <button type="reset" class="btn btn-outline-secondary mt-1" data-bs-dismiss="modal" aria-label="Close">
                                kembali
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--end card modal -->


    <!-- card hapusCategory modal -->
    <div class="modal fade" id="hapusCategory" tabindex="-1" aria-labelledby="addNewCardTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-transparent">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body px-sm-5 mx-50 pb-5">
                    <h3 class="text-center mb-1" id="addNewCardTitle">Hapus Kategori</h3>
                    <p class="text-center">Kamu yakin ingin menghapus data ini?</p>
                    <!-- form -->
                    <form class="form row gy-1 gx-2 mt-75" method="POST" action="{{ route('hapus.category') }}">
                        @method('delete')
                        @csrf
                        <input type="text" name="id" id="id" hidden>
                        <div class="col-12">
                            <label class="form-label" for="name">Nama</label>
                            <div class="input-group input-group-merge">
                                <input id="name" name="name" class="form-control" type="text" disabled />
                            </div>
                        </div>
                        <div class="col-12 text-center">
                            <button type="submit" class="btn btn-danger me-1 mt-1">Hapus</button>
                            <button type="reset" class="btn btn-outline-secondary mt-1" data-bs-dismiss="modal" aria-label="Close">
                                Kembali
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--end card modal -->


    <!-- card addProduct modal -->
    <div class="modal fade" id="addProduct" tabindex="-1" aria-labelledby="addNewProductTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-transparent">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body px-sm-5 mx-50 pb-5">
                    <h3 class="text-center mb-1" id="addNewProductTitle">Tambah Produk</h3>
                    <!-- form -->
                    <form class="form row gy-1 gx-2 mt-75" method="POST" action="{{ route('tambah.produk') }}" enctype="multipart/form-data">
                        @method('post')
                        @csrf
                        <div class="col-12">
                            <label class="form-label" for="name">Nama Produk</label>
                            <div class="input-group input-group-merge">
                                <input id="name" name="name" class="form-control" type="text" required />
                            </div>
                        </div>
                        <div class="col-12">
                            <label class="form-label" for="price">Harga</label>
                            <div class="input-group input-group-merge">
                                <input id="price" name="price" class="form-control" type="number" required />
                            </div>
                        </div>
                        <div class="col-12">
                            <label class="form-label" for="stock">Stok</label>
                            <div class="input-group input-group-merge">
                                <input id="stock" name="stock" class="form-control" type="number" required min="0" />
                            </div>
                        </div>
                        <div class="col-12">
                            <label class="form-label" for="categories_id">Kategori</label>
                            <select id="categories_id" name="categories_id" class="form-select" required>
                                <option value="">Pilih Kategori</option>
                                @foreach($category as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-12">
                            <label class="form-label" for="image">Gambar</label>
                            <input id="image" name="image" class="form-control" type="file" accept="image/*" required />
                        </div>
                        <div class="col-12 text-center">
                            <button type="submit" class="btn btn-primary me-1 mt-1">Tambah</button>
                            <button type="reset" class="btn btn-outline-secondary mt-1" data-bs-dismiss="modal" aria-label="Close">
                                Kembali
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--end card modal -->

    <!-- card hapusProduk modal -->
    <div class="modal fade" id="hapusProduct" tabindex="-1" aria-labelledby="addNewCardTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-transparent">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body px-sm-5 mx-50 pb-5">
                    <h3 class="text-center mb-1" id="addNewCardTitle">Hapus Produk</h3>
                    <p class="text-center">Kamu yakin ingin menghapus data ini?</p>
                    <!-- form -->
                    <form class="form row gy-1 gx-2 mt-75" method="POST" action="{{ route('hapus.produk') }}">
                        @method('delete')
                        @csrf
                        <input type="text" name="id" id="id" hidden>
                        <div class="col-12">
                            <label class="form-label" for="name">Nama</label>
                            <div class="input-group input-group-merge">
                                <input id="name" name="name" class="form-control" type="text" disabled />
                            </div>
                        </div>
                        <div class="col-12 text-center">
                            <button type="submit" class="btn btn-danger me-1 mt-1">Hapus</button>
                            <button type="reset" class="btn btn-outline-secondary mt-1" data-bs-dismiss="modal" aria-label="Close">
                                Kembali
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--end card modal -->




</main><!-- End #main -->


<!-- datatable js -->
<script src="{{ asset('plugin/jQuery-3.7.0/jquery-3.7.0.js') }}"></script>
<script src="{{ asset('plugin/DataTables-1.13.8/js/jquery.dataTables.min.js') }}"></script>

<script src="{{ asset('plugin/pdfmake-0.2.7/pdfmake.min.js') }}"></script>
<script src="{{ asset('plugin/pdfmake-0.2.7/vfs_fonts.js') }}"></script>

<script src="{{ asset('plugin/JSZip-3.10.1/jszip.min.js') }}"></script>


<script src="{{ asset('plugin/Buttons-2.4.2/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('plugin/Buttons-2.4.2/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('plugin/Buttons-2.4.2/js/buttons.print.min.js') }}"></script>

<script>
    $(document).ready(function() {
        $('#tableCategory').DataTable({
            responsive: true,
            info: false,
            "language": {
                "paginate": {
                    "next": "Selanjutnya",
                    "previous": "Sebelumnya"
                },
                "search": "Pencarian :",
                "emptyTable": "Tidak ada data",
                "zeroRecords": "Tidak ada data",
                "lengthMenu": "Menampilkan _MENU_ data per halaman",
            }
        });
    });
</script>

<script>
    $(document).ready(function() {
        $('#tableProduct').DataTable({
            responsive: true,
            info: false,
            "language": {
                "paginate": {
                    "next": "Selanjutnya",
                    "previous": "Sebelumnya"
                },
                "search": "Pencarian :",
                "emptyTable": "Tidak ada data",
                "zeroRecords": "Tidak ada data",
                "lengthMenu": "Menampilkan _MENU_ data per halaman",
            }
        });
    });
</script>

<script>
    $(document).ready(function() {
        $('#editCategory').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget);
            var id = button.data('id');
            var name = button.data('name');

            var modal = $(this);
            modal.find('.modal-body #id').val(id);
            modal.find('.modal-body #name').val(name);
        });
    });
</script>

<script>
    $(document).ready(function() {
        $('#hapusCategory').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var id = button.data('id')
            var name = button.data('name')

            var modal = $(this)
            modal.find('.modal-body #id').val(id)
            modal.find('.modal-body #name').val(name)

        })
    });
</script>

<script>
    $(document).ready(function() {
        $('#hapusProduct').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var id = button.data('id')
            var name = button.data('name')

            var modal = $(this)
            modal.find('.modal-body #id').val(id)
            modal.find('.modal-body #name').val(name)

        })
    });
</script>

@endsection