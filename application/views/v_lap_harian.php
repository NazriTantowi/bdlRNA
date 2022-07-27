<div class="col-12">
     

        <div class="invoice p-3 mb-3">
            <div class="row">
                <div class="col-12">
                     <h4>
                        <i class="fas fa-shopping-cart"></i> <?= $title ?>
                        <small class="float-right">Tanggal: <?= $tanggal ?>/<?= $bulan ?>/<?= $tahun ?></small>
                    </h4>
        </div>

        </div>

        <div class="row">
            <div class="col-12 table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Barang</th>
                            <th>Customer</th>
                            <th>No order</th>
                            <th>Harga</th>
                            <th>Qty</th>
                            <th>Total Harga</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1;
                        $grand_total = 0;
                        foreach ($laporan as $key => $value) {
                            $tot_harga = $value->qty * $value->harga;
                            $grand_total = $grand_total + $tot_harga
                        ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $value->nama_barang ?></td>
                                <td><?= $value->nama_penerima ?></td>
                                <td><?= $value->no_order ?></td>
                                <td>Rp. <?= number_format($value->harga, 0) ?></td>
                                <td><?= $value->qty ?></td>
                                <td>Rp. <?= number_format($tot_harga, 0) ?></td>
                            </tr>
                        <?php } ?>
                    
                    </tbody>
                </table>
                <h4>Grand Total: Rp. <?= number_format($grand_total, 0) ?></h4>
             </div>
        </div>


        <div class="row no-print">
            <div class="col-12">
                <button class="btn btn-default" onclick="window.print()"><i class="fas fa-print"></i> 
                Print
                </button>
            </div>
            </div>
        </div>

    </div>
</div>