<section id="footer">
    <div class="container">
        <div class="row text-center text-xs-center text-sm-left text-md-left">
            <div class="col-xs-12 col-sm-4 col-md-4">
                <h5>PRASASTI</h5>
                <ul class="list-unstyled quick-links">
                    <li>Merupakan aplikasi untuk pencatatan arsip statis dilingkungan Dinas Arsip dan Perpustakaan Sumedang</li>
                </ul>
            </div>
            <?php foreach ($profil as $data) {
                $telepon = $data->telepon;
                $alamat = $data->alamat;
            } ?>
            <div class="col-xs-12 col-sm-4 col-md-4">
                <h5>Kontak</h5>
                <ul class="list-unstyled quick-links">
                    <li><a href=""><i class="fa fa-phone"></i><?= $telepon ?></a></li>
                    <li><a href=""><i class="fa fa-home"></i><?= $alamat ?></a></li>
                </ul>
            </div>
            <div class="col-xs-12 col-sm-4 col-md-4">
                <h5>Link Terkait</h5>
                <ul class="list-unstyled quick-links">
                    <?php foreach ($link as $data) { ?>
                        <li><a href="<?= $data->link ?>"><i class="fa fa-angle-double-right"></i><?= $data->judul ?></a></li>
                    <?php } ?>
                </ul>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 mt-2 mt-sm-5">

            </div>
            <hr>
        </div>
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 mt-2 mt-sm-2 text-center text-white">
                <a>Dinas Arsip Dan Perpustakaan Kabupaten Sumedang</a>
                <br><a class="h6">© All right Reversed.<a class="text-green ml-2" href="" target="_blank"><?= Date('Y') ?></a></a>
            </div>
            <hr>
        </div>
    </div>
</section>