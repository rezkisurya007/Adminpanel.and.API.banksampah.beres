@extends('layout.master')

@section('css')
    <link rel="stylesheet" href="//cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
@endsection

@section('content')
<div id="layoutSidenav_content">
    <main>
<div class="container-fluid">
  <div class="page-heading"><br>
    <h3>Info Kamu

    </h3>
</div>
    <!-- Page Heading -->
    
    

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            {{-- <a href="{{url('addcustomers')}}" class="btn btn-primary btn-sm">Tambah Data</a> --}}
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahbanner"><i class="fas fa-plus"></i> Tambah Banner </button>
            @include('banner.addbanner')

        </div>
        
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="tableht" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Deskripsi</th>
                            <th>gambar</th>
                            {{-- <th>Edit</th> --}}
                            <th>Delete</th>

                            
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($banner as $data)
                        <tr>
                          <td>{{ $data->id}}</td>
                          <td>{{ $data->deskripsi_banner}}</td>
                          <td><img src="{{ $data->gambar_banner}}" alt="" width="80px" height="120px"></td>
                          {{-- <td>
                            <button  class="btn btn-success edit" data-bs-toggle="modal" data-bs-target="#updatebanner-{{$data->id}}"  ><i class="fas fa-edit"></i> Update </button>
                            @include('banner.updatebanner',[
                              'banner'=>$data
                            ])
                            </td> --}}
                          
                          
                            <td>
                                <form action="/deletebanner/{{ $data->id }}" method="post">
                                {{csrf_field()}}
                                {{method_field('DELETE')}}
                                <button type="submit" class="btn btn-danger" onclick="return confirm('yakin ingin menghapus data ?')"><i class="fas fa-trash-alt"></i> DELETE </button>
                                </form>
                                </td>
                          
                        </tr>
                        @endforeach
                        
                    </tbody>
                    
                    
                </table>
                @include('sweetalert::alert')
            </div>
        </div>
    </div>
    
</div>
</div>



@endsection
@push('scripts')
<script src="//cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>

<script>
    $(document).ready( function () {
    $('#tableht').DataTable();
} );


</script>
@endpush


