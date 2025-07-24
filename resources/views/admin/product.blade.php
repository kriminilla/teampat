@extends('master')

@section('title', 'Product')

@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <div class="col-sm-6">
                <h3 class="m-0">Daftar Produk</h3>
            </div>
        </div>
        <div class="card-body">
            <button class="btn btn-primary mb-3" data-toggle="modal" data-target="#addModal">+ Tambah Produk</button>
            <table id="example2" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Produk</th>
                        <th>Deskripsi</th>
                        <th>Kategori</th>
                        <th>Harga</th>
                        <th>Gambar</th>
                        <th style="text-align: center;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($produk as $key => $data)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $data->nama }}</td>
                            <td>{{ $data->deskripsi }}</td>
                            <td>{{ $data->kategori }}</td>
                            <td>{{ number_format($data->harga,0,',','.') }}</td>
                            <td>
                                @if ($data->gambar)
                                    <img src="{{ asset('storage/' . $data->gambar) }}" width="50">
                                @endif
                            </td>
                            <td style="text-align: center; vertical-align: middle;">
                                <button class="btn btn-warning" data-toggle="modal" data-target="#editModal{{ $data->id }}"><i class="fa fa-pen"></i></button>
                                    <form action="{{ route('destroyProduk', $data->id) }}" method="POST"
                                        style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-delete"><i
                                                class="fa fa-trash"></i></button>
                                    </form>
                            </td>
                        </tr>

                        <div class="modal fade" id="editModal{{ $data->id }}" tabindex="-1"
                            aria-labelledby="editModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <form action="{{ route('updateProduk', $data->id) }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <div class="modal-header">
                                            <h3 class="modal-title" id="editModalLabel">Edit Produk</h3>
                                        </div>
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label for="nama" class="form-label">Nama</label>
                                                <input type="text" class="form-control" id="nama" name="nama"
                                                    value="{{ $data->nama }}">
                                            </div>
                                            <div class="mb-3">
                                                <label for="deskripsi" class="form-label">Deskripsi</label>
                                                <input type="text" class="form-control" id="deskripsi" name="deskripsi"
                                                    value="{{ $data->deskripsi }}">
                                            </div>
                                            <div class="mb-3">
                                                <label for="harga" class="form-label">Harga</label>
                                                <input type="number" class="form-control" id="harga" name="harga"
                                                    value="{{ $data->harga }}">
                                            </div>
                                            <div class="mb-3">
                                                <label for="kategori_id" class="form-label">Kategori</label>
                                                <select name="kategori_id" id="kategori_id" class="form-control">
                                                    <option value="">-- Pilih Kategori --</option>
                                                    @foreach ($kategori as $ktg)
                                                        <option value="{{ $ktg->id }}"
                                                            {{ $ktg->id == $data->kategori_id ? 'selected' : '' }}>
                                                            {{ $ktg->nama }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="mb-3">
                                                <label for="gambar" class="form-label">Upload
                                                    Gambar</label><br />
                                                <!-- Pratinjau Gambar -->
                                                <img src="{{ '/storage/' . $data->gambar }}"
                                                    alt="Tidak Dapat Menampilkan Gambar" class="img-fluid rounded"
                                                    style="max-width: 100%; height: auto;">
                                                <input type="file" id="gambar" name="gambar"
                                                    class="form-control-file" accept=".pdf,.jpg,.jpeg,.png">
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Tutup</button>
                                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <form action="{{ route('storeProduk') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-header">
                            <h3 class="modal-title" id="editModalLabel">Tambah Produk</h3>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="nama" class="form-label">Nama</label>
                                <input type="text" class="form-control" id="nama" name="nama">
                            </div>
                            <div class="mb-3">
                                <label for="deskripsi" class="form-label">Deskripsi</label>
                                <input type="text" class="form-control" id="deskripsi" name="deskripsi">
                            </div>
                            <div class="mb-3">
                                <label for="harga" class="form-label">Harga</label>
                                <input type="number" class="form-control" id="harga" name="harga">
                            </div>
                            <div class="mb-3">
                                <label for="kategori_id" class="form-label">Kategori</label>
                                <select name="kategori_id" id="kategori_id" class="form-control">
                                    <option value="">-- Pilih Kategori --</option>
                                    @foreach ($kategori as $ktg)
                                        <option value="{{ $ktg->id }}">
                                            {{ $ktg->nama }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="gambar" class="form-label">Upload Gambar</label><br />
                                <input type="file" id="gambar" name="gambar" class="form-control-file"
                                    accept=".pdf,.jpg,.jpeg,.png">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
