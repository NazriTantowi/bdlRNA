
<div class="col-sm-12">
    <?php
        if ($this->session->flashdata('pesan')) {
            echo  '<div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h5><i class="icon fas fa-check"></i>';
            echo $this->session->flashdata('pesan');
            echo '</h5></div>';
        }
    ?>
    <div class="card card-primary card-outline card-outline-tabs">
        <div class="card-header p-0 border-bottom-0">
            <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="custom-tabs-four-home" data-toggle="pill" 
                    href="#custom-tabs-four-home" role="tab" aria-controls="custom-tabs-four-home" 
                    aria-selected="true">Pesanan Masuk</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-four-profile-tab" data-toggle="pill" 
                    href="#custom-tabs-four-profile" role="tab" aria-controls="custom-tabs-four-profile" 
                    aria-selected="false">Diproses</a>
                </li>
            
                <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-four-messages-tab" data-toggle="pill" 
                    href="#custom-tabs-four-messages" role="tab" aria-controls="custom-tabs-four-messages" 
                    aria-selected="false">Dikirim</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-four-settings-tab" data-toggle="pill" 
                    href="#custom-tabs-four-settings" role="tab" aria-controls="custom-tabs-four-settings" 
                    aria-selected="false">Selesai</a>
                </li>
            </ul>
            </div>
            
            <div class="card-body">
                <div class="tab-content" id="custom-tabs-four-tabContent">

                    <div class="tab-pane fade show active" id="custom-tabs-four-home" role="tabpanel" 
                    aria-labelledby="custom-tabs-four-home-tab">
                        <table class="table">
                            <tr>
                                <th>No Order</th>
                                <th>Tanggal</th>
                                <th>Expedisi</th>
                                <th>Total_Bayar</th>
                                <th> </th>
                            </tr>
                            <?php foreach ($pesanan as $key => $value) {?>
                            <tr>
                                <td><?= $value->no_order ?></td>
                                <td><?= $value->tgl_order ?></td>
                                <td>
                                    <b><?= $value->expedisi ?></b><br>
                                    
                                </td>
                                <td>
                                    <b>Rp. <?= number_format($value->total_bayar,0) ?></b><br>
                                    <?php if($value->status_bayar==0) {?>
                                        <span class="badge badge-warning">Belum Bayar</span>
                                    <?php } else{?>
                                        <span class="badge badge-success">Sudah Bayar</span><br>
                                        <span class="badge badge-primary">Menunggu Verifikasi</span>
                                    <?php }?>
                                </td>
                                <td>
                                    <?php if($value->status_bayar== 1) {?>
                                        <button class="btn btn-sm btn-success" data-toggle="modal" data-target="#modal-default">Cek Bukti Bayar</button>
                                        <a href="<?= base_url('admin/Proses/'.$value->id_transaksi)?>" 
                                        class="btn btn-sm btn-flat btn-primary">Proses</a?>
                                    <?php }?>
                                    
                                </td>
                            </tr>
                           <?php } ?>
                           
                        </table>
                    </div>

                    <div class="tab-pane fade" id="custom-tabs-four-profile" role="tabpanel" aria-labelledby="custom-tabs-four-profile-tab">
                    Mauris tincidunt mi at erat gravida, eget tristique urna bibendum. 
                    Mauris pharetra purus ut ligula tempor, et vulputate metus facilisis. 
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                    Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Maecenas sollicitudin, nisi a luctus interdum, nisl ligula placerat mi, quis posuere purus ligula eu lectus. Donec nunc tellus, elementum sit amet ultricies at, posuere nec nunc. Nunc euismod pellentesque diam.
                    </div>

                    <div class="tab-pane fade" id="custom-tabs-four-messages" role="tabpanel" aria-labelledby="custom-tabs-four-messages-tab">
                    Morbi turpis dolor, vulputate vitae felis non, tincidunt congue mauris. Phasellus volutpat augue id mi placerat mollis. Vivamus faucibus eu massa eget condimentum. Fusce nec hendrerit sem, ac tristique nulla. Integer vestibulum orci odio. Cras nec augue ipsum. Suspendisse ut velit condimentum, mattis urna a, malesuada nunc. Curabitur eleifend facilisis velit finibus tristique. Nam vulputate, eros non luctus efficitur, ipsum odio volutpat massa, sit amet sollicitudin est libero sed ipsum. Nulla lacinia, ex vitae gravida fermentum, lectus ipsum gravida arcu, id fermentum metus arcu vel metus. Curabitur eget sem eu risus tincidunt eleifend ac ornare magna.
                    </div>

                    <div class="tab-pane fade" id="custom-tabs-four-settings" role="tabpanel" aria-labelledby="custom-tabs-four-settings-tab">
                    Pellentesque vestibulum commodo nibh nec blandit. Maecenas neque magna, iaculis tempus turpis ac, ornare sodales tellus. Mauris eget blandit dolor. Quisque tincidunt venenatis vulputate. Morbi euismod molestie tristique. Vestibulum consectetur dolor a vestibulum pharetra. Donec interdum placerat urna nec pharetra. Etiam eget dapibus orci, eget aliquet urna. Nunc at consequat diam. Nunc et felis ut nisl commodo dignissim. In hac habitasse platea dictumst. Praesent imperdiet accumsan ex sit amet facilisis.
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<!-- modal cek bukti pembayaran -->
<div class="modal fade" id="modal-default">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Default Modal</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>One fine body&hellip;</p>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>