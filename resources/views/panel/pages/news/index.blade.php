@extends('panel.layouts.app')

@section('content')
    <div>
        <h1 class="h3 mb-3"><strong>Berita</strong></h1>

        @if (Session::get('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Berhasil!</strong> {{ Session::get('success') }}.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <a href="{{ url('/panel/news/create') }}" class="mt-2 btn btn-success"><i class="zmdi zmdi-plus"></i> Tambah Berita</a>

        <div class="row mt-3">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <h4>List Berita</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Judul Berita</th>
                                        <th>Sub Judul</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($news as $index => $newsItem)
                                        <tr>
                                            <td>{{ $news->firstItem() + $loop->index }}</td>
                                            <td>{{ $newsItem->title }}</td>
                                            <td>{{ $newsItem->subtitle }}</td>
                                            <td>
                                                <a href="{{ url('/panel/news/' . $newsItem->id . '/edit') }}" class="btn btn-sm btn-primary">
                                                    <i class="zmdi zmdi-edit"></i> Edit
                                                </a>
                                                <button onclick="onDelete(this)" data-url="{{ url('/panel/news/' . $newsItem->id) }}" type="button" class="btn btn-sm btn-danger">
                                                    <i class="zmdi zmdi-delete"></i> hapus
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {{ $news->links() }}
            </div>
        </div>
    </div>
@endsection
