<div class="container-fluid">

    <!-- Page Heading -->
    

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Order History</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>No Order</th>
                            <th>Customer</th>
                            <th>Produk</th>
                            <th>Kuantiti</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    
                    <tbody>
                        <?php foreach ($order as $key => $value) {?>
                        <tr>
                            <td><?= $value->tgl_order ?></td>
                            <td><?= $value->no_order ?></td>
                            <td><?= $value->nama_pelanggan ?></td>
                            <td><?= $value->nama_barang ?></td>
                            <td><?= $value->qty ?></td>
                            <td>Rp. <?= number_format($value->total_bayar,0) ?></td>
                        </tr>
                        <?php } ?>
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>