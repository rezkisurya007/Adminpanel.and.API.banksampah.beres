@extends('layout.master')

@section('css')
    <link rel="stylesheet" href="//cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
@endsection

@section('content')
<div id="layoutSidenav_content">
    <main>
<div class="container-fluid">
  <div class="page-heading"><br>
    <h3>Data Toko

    </h3>
</div>
    <!-- Page Heading -->
    
    

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            {{-- <a href="{{url('addcustomers')}}" class="btn btn-primary btn-sm">Tambah Data</a> --}}
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahkota"><i class="fas fa-plus"></i> Tambah Toko </button>
            @include('toko.addtoko')

        </div>
        
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="tableht" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Id Toko</th>
                            <th>Kecamatan</th>
                            <th>Nama Toko</th>
                            <th>Alamat</th>
                            <th>Saldo</th>
                            <th>No Handphone</th>
                            <th>QrQode</th>
                            <th>Edit</th>
                            <th>Delete</th>
                            <th>Top Up</th>
                            {{-- <th>Log</th> --}}

                            
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($toko as $data)
                        <tr>
                            <td>{{ $data->id_customer}}</td>
                            <td>{{ $data->kecamatan->nama_kecamatan}}</td>
                            <td>{{ $data->nama_customer}}</td>
                            <td>{{ $data->alamat_customer}}</td>
                            <td>{{ $data->saldo_customer}}</td>
                            <td>{{ $data->no_hp_customer}}</td>
                          <td>
                            <button  class="btn btn-secondary edit" data-bs-toggle="modal" data-bs-target="#qrcodetoko-{{$data->id_customer}}"  ><i class="fa fa-code"></i> QrQode </button>
                            @include('toko.qrcodetoko',[
                              'toko'=>$data
                            ])
                            </td>
                          
                          <td>
                            <button  class="btn btn-success edit" data-bs-toggle="modal" data-bs-target="#updatetoko-{{$data->id_customer}}"  ><i class="fas fa-edit"></i> Update </button>
                            @include('toko.updatetoko',[
                              'toko'=>$data
                            ])
                            </td>
                          
                          
                            <td>
                                <form action="/deletetoko/{{ $data->id_customer }}" method="post">
                                {{csrf_field()}}
                                {{method_field('DELETE')}}
                                <button type="submit" class="btn btn-danger"><i class="fas fa-trash-alt"></i> DELETE </button>
                                </form>
                                </td>

                                <td>
                                    <button  class="btn btn-info edit" data-bs-toggle="modal" data-bs-target="#topuptoko-{{$data->id_customer}}"  ><i class="fas fa-edit"></i> Top Up </button>
                                    @include('toko.topuptoko',[
                                      'toko'=>$data
                                    ])
                                    </td>
                                {{-- <td><a href="/transaksi/{{$data->nik_customer}}" class="btn btn-info"> Log Transaksi</a></td> --}}
                                {{-- <td> <button  class="btn btn-info edit" data-bs-toggle="modal" data-bs-target="#transaksicustomer-{{$data->nik_customer}}"  ><i class="fas fa-edit"></i> Update </button>
                                    @include('customer.transaksicustomer',[
                                      'customer'=>$data
                                    ])</td> --}}
                          
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


