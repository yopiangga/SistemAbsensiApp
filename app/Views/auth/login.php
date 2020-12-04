<?= $this->extend('templates/template-auth');
$this->section('content'); ?>

<div class="main-wrapper">
    <div class="page-wrapper full-page">
        <div class="page-content d-flex align-items-center justify-content-center">

            <div class="row w-100 mx-0 auth-page">
                <div class="col-md-8 col-xl-6 mx-auto">
                    <div class="card">
                        <div class="row">
                            <div class="col-md-4 pr-md-0">
                                <div class="auth-left-wrapper">
                                </div>
                            </div>
                            <div class="col-md-8 pl-md-0">
                                <div class="auth-form-wrapper px-4 py-5">
                                    <a href="#" class="noble-ui-logo d-block mb-2">Absensi<span>App</span></a>
                                    <h5 class="text-muted font-weight-normal mb-4">Selamat Datang! Masuk dengan akun anda.</h5>
                                    <?php $attributes = ['id' => 'form-login'];
                                    echo form_open('auth/user_login', $attributes);
                                    csrf_field() ?>
                                    <div class="alert alert-danger errorMessage d-none" role="alert">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Username</label>
                                        <input type="text" class="form-control" placeholder="Username" name="username" id="username" placeholder="Email">
                                        <div class="invalid-feedback errorUsername">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Password</label>
                                        <input type="password" id="password" class="form-control" placeholder="Password" name="password" autocomplete="current-password" placeholder="Password">
                                        <div class="invalid-feedback errorPassword">
                                        </div>
                                    </div>
                                    <div class="mt-3">
                                        <button type="submit" href="index.html" class="btn btn-primary mr-2 mb-2 mb-md-0 text-white btn-login">Masuk</button>
                                    </div>
                                    <?php form_close() ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<?php $this->endSection('content'); ?>

<?php $this->section('script'); ?>
<script>
    // --------------------------------------------------------------------------
    // Auth Page Script
    // --------------------------------------------------------------------------
    $('#form-login').submit(function(e) {
        e.preventDefault();
        $.ajax({
            type: "post",
            url: $(this).attr('action'),
            data: $(this).serialize(),
            dataType: "json",
            beforeSend: function() {
                $('.btn-login').html('Proses Autentifikasi!');
                $('#username').removeClass('is-invalid');
                $('#password').removeClass('is-invalid');
                $('.errorMessage').addClass('d-none');
            },
            complete: function() {
                $('.btn-login').html('Masuk');
                $('.overlay').addClass('d-none');
            },
            success: function(response) {
                if (response.error) {
                    if (response.error.username) {
                        $('#username').addClass('is-invalid');
                        $('.errorUsername').html(response.error.username);
                    }
                    if (response.error.password) {
                        $('#password').addClass('is-invalid');
                        $('.errorPassword').html(response.error.password);
                    }
                    if (response.error.message) {
                        $('.errorMessage').removeClass('d-none');
                        $('.errorMessage').html(response.error.message);
                    }
                };
                if (response.success) {
                    $('.errorMessage').removeClass('d-none');
                    $('.errorMessage').removeClass('alert-danger');
                    $('.errorMessage').addClass('alert-success');
                    $('.errorMessage').html('Berhasil Masuk! Tunggu Sebentar! Proses Autentifikasi');
                    window.location.href = '<?= base_url('dashboard') ?>'
                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError)
            }
        });
    })
</script>
<?php $this->endSection('script'); ?>