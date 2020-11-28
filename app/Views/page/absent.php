<?= $this->extend('templates/template-dashboard');
$this->section('content'); ?>
<div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
    <div>
        <h4 class="mb-3 mb-md-0">Absen</h4>
    </div>
</div>
<?php if (session()->getFlashdata('message')) : ?>
    <div class="alert alert-success" role="alert">
        <strong> <?= session()->getFlashdata('message') ?> </strong>
    </div>
<?php endif ?>
<?= $labelAbsent ?>
<?php $this->endSection(); ?>