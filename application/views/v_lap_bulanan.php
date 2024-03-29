<div class="col-12">
     

        <div class="invoice p-3 mb-3">
            <div class="row">
                <div class="col-12">
                     <h4>
                        <i class="fas fa-shopping-cart"></i> <?= $title ?>
                        <small class="float-right">Bulan: <?= $bulan ?> Tahun:<?= $tahun ?></small>
                    </h4>
        </div>

        </div>

        <div class="row">
            <div class="col-12 table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Customer</th>
                            <th>No order</th>
                            <th>Tanggal</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no= 1; 
                        $grand_total= 0;
                        foreach ($laporan as $key => $value) {
                            $grand_total = $grand_total + $value->total_bayar 
                        ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $value->nama_penerima ?></td>
                                <td><?= $value->no_order ?></td>
                                <td><?= $value->tgl_order ?></td>
                                <td>Rp. <?= number_format($value->total_bayar, 0)?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
                <h4>Grand Total: Rp. <?= number_format($grand_total,0) ?> </h4>
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