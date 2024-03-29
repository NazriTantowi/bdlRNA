<div class="invoice p-3 mb-3">

    <div class="row">
        <div class="col-12">
            <h4>
            <i class="fas fa-shopping-cart"></i> Cekout.
            <small class="float-right">Date: <?= date('d-m-Y')?></small>
            </h4>
        </div>

    </div>
    
    <!-- Tabel row -->
    <div class="row">
        <div class="col-12 table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                    <th>Qty</th>
                    <th width="150 px" class="text-center">Harga</th>
                    <th class= >Barang</th>
                    <th class="text-center">Total Harga</th>
                    <th class="text-center">Berat</th>
                    </tr>
                </thead>
                <tbody>
                
                    <?php 
                    $i = 1;
                    $tot_berat = 0; 
                    foreach ($this->cart->contents() as $items){ 
                        $barang = $this->m_home->detail_barang($items['id']); 
                        $berat = ($items['qty']) * $barang->berat;
                                        
                        $tot_berat = $tot_berat + $berat;
                        ?>
                    <tr>
                        <td><?php echo $items['qty']; ?></td>
                        <td class="text-center">Rp. <?php echo $this->cart->format_number($items['price'], 0); ?></td>
                        <td><?php echo $items['name']; ?></td>  
                        <td class="text-center">Rp. <?php echo $this->cart->format_number($items['subtotal'], 0); ?></td>
                        <td class="text-center"><?= $berat ?> Gr</td>
                    </tr>
                    <?php } ?>                            
        
                </tbody>
            </table>
        </div>

    </div><br>
    ORDER ID: 
    <!-- buat random angka di cekout -->
    <?php
    echo form_open ('belanja/proses_cekout');
    $no_order= date('Ymd').strtoupper(random_string('alnum',8));
    echo $no_order;
    ?>
    <div class="row">


        <!-- acc pyment colum -->
        <div class="col-sm-8 invoice-col">
        Tujuan:
            <div class="row">
                <div class="col-sm-4">
                    <div class="form-group">
                            <label>Provinsi</label>
                            <select name="provinsi" class="form-control"></select>
                        </div>
                    </div>

                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>Kota</label>
                            <select name="kota" class="form-control"></select>
                        </div>
                    </div>

                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>Ekspedisi</label>
                            <select name="expedisi" class="form-control"></select>
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="form-group">
                            <label>Nama Penerima</label>
                            <input name="nama_penerima" class="form-control"></input>
                        </div>
                    </div>

                    <div class="col-sm-9">
                        <div class="form-group">
                            <label>Alamat</label>
                            <input name="alamat" class="form-control"></input>
                        </div>
                    </div>

                    <div class="col-sm-3">
                        <div class="form-group">
                            <label>Kode POS</label>
                            <input name="kode_pos" class="form-control"></input>
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="form-group">
                            <label>Telpon Penerima</label>
                            <input name="hp_penerima" class="form-control"></input>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-4">
                <div class="table-responsive">
                    <table class="table">
                        <tr>
                            <th style="width:50%">Grand Total:</th>
                            <td>Rp. <?php echo $this->cart->format_number($this->cart->total(), 0); ?></td>
                        </tr>

                        <tr>
                            <th>Berat: (9.3%)</th>
                            <td><?= $tot_berat ?> Gr</td>
                        </tr>
                    
                        <tr>
                            <th>Ongkir:</th>
                            <td><label>free</label></td>
                        </tr>
                        
                        <tr>
                            <th>Total Bayar:</th>
                            <td><label>Rp. <?php echo $this->cart->format_number($this->cart->total(), 0); ?></label></td>
                        </tr>
                    </table>
                </div>
                
            </div>
        </div><br>
        <div class="row no-print">
            <div class="col-12">
                <a href="<?= base_url('belanja') ?>" class="btn btn-warning"><i class="fas fa-backward"></i> Kembali ke Keranjang</a>
                <button type="submit" class="btn btn-primary float-right" style="margin-right: 5px;">
                <i class="fas fa-shopping-cart"></i> Proses Cekout</button>
            </div>
        </div>
    </div>
              
<input name="no_order" value="<?= $no_order ?>"hidden>
<input name="berat" value="<?= $tot_berat ?>"hidden>
<input name="total_bayar" value="<?= $this->cart->total() ?>"hidden>

<?php 
$i = 1;
foreach ($this->cart->contents() as $items){
    echo form_hidden('qty'.$i++, $items['qty']);
}
?>
    <?php echo form_close() ?>
</div>



<script>
    $(document).ready(function() {
        //provinsi
        $.ajax({
            type: "POST",
            url: "<?= base_url('rajaongkir/provinsi') ?>",
            success: function(hasil_provinsi) {
                //console.log(hasil_provinsi);
                $("select[name=provinsi]").html(hasil_provinsi);
            }
        });

        // kota
        $("select[name=provinsi]").on("change",function() {
            var id_provinsi_terpilih = $("option:selected", this).attr("id_provinsi");
            $.ajax({
                type: "POST",
                url: "<?= base_url('rajaongkir/kota') ?>",
                data: 'id_provinsi=' + id_provinsi_terpilih,
                success: function(hasil_kota){
                    //console.log(hasil_kota);
                    $("select[name=kota]").html(hasil_kota);
                }
            });
        });

        $("select[name=kota]").on("change",function(){
            $.ajax({
                type: "POST",
                url: "<?= base_url('rajaongkir/expedisi') ?>",
                success: function(hasil_expedisi){
                    $("select[name=expedisi]").html(hasil_expedisi);
                }
            });

        });

        //data paket
        $("select[name=expedisi]").on("change",function(){
            $.ajax({
                type: "POST",
                url: "<?= base_url('rajaongkir/paket') ?>",
                success: function(hasil_paket){
                    $("select[name=paket]").html(hasil_paket);
                }
            });
        });
    });
</script>