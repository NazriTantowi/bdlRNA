<div class="col-lg-3 col-6">
    <!-- small box -->
    <div class="small-box bg-info">
        <div class="inner">
            <h3>150</h3>

            <p>Pesanan Masukk</p>
        </div>
        <div class="icon">
            <i class="fas fa-envelope"></i>
        </div>
        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
</div>


<div class="col-lg-3 col-6">
    <!-- small box -->
    <div class="small-box bg-success">
        <div class="inner">
            <h3><?= $total_barang ?></h3>

            <p>Produk</p>
        </div>
        <div class="icon">
            <i class="fas fa-cubes"></i>
        </div>
        <a href="<?= base_url('barang')?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
</div>


<div class="col-lg-3 col-6">
    <!-- small box -->
    <div class="small-box bg-warning">
        <div class="inner">
            <h3>150</h3>

            <p>Pelanggan</p>
        </div>
        <div class="icon">
            <i class="fas fa-users"></i>
        </div>
        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
</div>


<div class="col-lg-3 col-6">
    <!-- small box -->
    <div class="small-box bg-danger">
        <div class="inner">
            <h3><?= $total_kategori ?></h3>

            <p>Kategori</p>
        </div>
        <div class="icon">
            <i class="fas fa-list"></i>
        </div>
        <a href="<?= base_url('kategori')?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
</div>

<div class="col-lg-6 col-6">
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title">Best Seller</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table class="table table-bordered" id="example1">
                <thead class="text-center">
                    <tr>
                        <th>No.</th>
                        <th>Nama Toko</th>
                        <th>Barang Terjual</th>
                        <th>Total Pendapatan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no =1 ;
                    foreach ($toko as $key => $value) { ?>
                    <tr>
                        <td class="text-center"><?= $no++; ?></td>
                        <td><?= $value->nama_toko ?></td>
                        <td class="text-center"><?= $value->produk ?></td>
                        <td class="text-center">Rp. <?= number_format($value->jumlah, 0) ?></td>
                        
                    </tr>
                    <?php } ?>

                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
    </div>
</div>
<div class="col-lg-6 col-6">
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title">Best Product</h3>
        </div>    
        <!-- /.card-header -->
        <div class="card-body">
            <table class="table table-bordered" id="example1">
                <thead class="text-center">
                    <tr>
                        <th>No.</th>
                        <th>Nama Produk</th>
                        <th>Total Terjual</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no =1 ;
                    foreach ($produk as $key => $value) { ?>
                    <tr>
                        <td class="text-center"><?= $no++; ?></td>
                        <td><?= $value->nama_barang ?></td>
                        <td class="text-center"><?= $value->jumlah ?></td>
                        
                    </tr>
                    <?php } ?>

                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
    </div>
</div>
<div class="col-lg-12 col-6">
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title">Best Customer</h3>
        </div>    
        <!-- /.card-header -->
        <div class="card-body">
            <table class="table table-bordered" id="example1">
                <thead class="text-center">
                    <tr>
                        <th>No.</th>
                        <th>Nama Customer</th>
                        <th>E-mail</th>
                        <th>Total Belanja</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no =1 ;
                    foreach ($cust as $key => $value) { ?>
                    <tr>
                        <td class="text-center"><?= $no++; ?></td>
                        <td><?= $value->nama_pelanggan ?></td>
                        <td><?= $value->email ?></td>
                        <td class="text-center"><?= $value->jumlah ?></td>
                        
                    </tr>
                    <?php } ?>

                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
    </div>
</div>
