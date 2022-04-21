@extends('layout.master')

@section('css')
    <link rel="stylesheet" href="//cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
@endsection

@section('content')
<div id="layoutSidenav_content">
    <main>
<div class="container-fluid">
  <div class="page-heading"><br>
    <h3>Data PPOB

    </h3>
</div>
    <!-- Page Heading -->
    
    

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            {{-- <a href="{{url('addcustomers')}}" class="btn btn-primary btn-sm">Tambah Data</a> --}}
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahkota"><i class="fas fa-plus"></i> Tambah PPOB </button>
            @include('ppob.addppob')

        </div>
        
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="tableht" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Id</th>
                            {{-- <th>Gambar PPob</th> --}}
                            <th>Judul PPOB</th>
                            
                            <th>Edit</th>
                            {{-- <th>Delete</th> --}}

                            
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($ppob as $data)
                        <tr>
                          <td>{{ $data->id_ppob}}</td>
                          {{-- <td>{{ $data->gambar_ppob}}</td> --}}
                          <td>{{ $data->judul_ppob}}</td>
                         
                          
                          <td>
                            <button  class="btn btn-success edit" data-bs-toggle="modal" data-bs-target="#updateppob-{{$data->id_ppob}}"  ><i class="fas fa-edit"></i> Update </button>
                            @include('ppob.updateppob',[
                              'ppob'=>$data
                            ])
                            </td>
                          
                          
                            {{-- <td>
                                <form action="/deleteppob/{{ $data->id_ppob }}" method="post">
                                {{csrf_field()}}
                                {{method_field('DELETE')}}
                                <button type="submit" class="btn btn-danger" onclick="return confirm('yakin ingin menghapus data ?')"><i class="fas fa-trash-alt"></i> DELETE </button>
                                </form>
                                </td> --}}
                          
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


