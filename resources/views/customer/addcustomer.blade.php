<div class="modal fade" id="tambahkota">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-tittle">Tambah Data Customer</h4>
          <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
         
        </div>
        <div class="modal-body">
          <form role="form" action="/addcustomer"  method="POST" enctype="multipart/form-data"  >
            @csrf
            
              
              <div class="box-body">
                
              <div class="form-group">
                <label for="exampleInputEmail1" >Id Anggota</label> 
                <input type="number" class="form-control" name="id_customer" required autocomplete="id_customer" >
              </div>
              <div class="form-group">
                <label for="">Kecamatan Customer</label>
                <select class="form-control" name="id_kecamatan_customer" id="id_kecamatan_customer" required >
                    <option selected hidden disabled value=""> Pilih Kecamatan</option>
                    @foreach ($kecamatan as $item)
                        <option value="{{ $item->id_kecamatan }}">{{ $item->nama_kecamatan}} </option>
                    @endforeach
                </select>
            </div>
              <div class="form-group">
                <label for="exampleInputEmail1" >Nama Customer</label> 
                <input type="text" class="form-control" name="nama_customer" required autocomplete="nama_customer" >
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1" >Alamat</label> 
                <input type="text" class="form-control" name="alamat_customer" required autocomplete="alamat_customer" >
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1" >Saldo</label> 
                <input type="number" class="form-control" name="saldo_customer" required autocomplete="saldo_customer" >
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1" >Pin Customer (max 6 karakter)</label> 
                <input type="password" class="form-control" name="pin_customer" maxlength="6" required autocomplete="pin_customer" >
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1" >No Handphone</label> 
                <input type="number" class="form-control" name="no_hp_customer" required autocomplete="no_hp_customer" >
              </div>
              
             
              
              
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default pull-left" data-bs-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary"> Tambah </button>
            </div>
          </form>
        </div>
        
      </div>
    </div>
  </div>