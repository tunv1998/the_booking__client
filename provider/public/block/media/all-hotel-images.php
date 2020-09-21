<?php foreach ($allImage['filePath'] as $imgKey => $imgValue) : ?>
    <div class="d-flex justify-content-start nopad text-center" style="flex-basis: 12%;max-width: 12%;">
        <img class="img-responsive mw-100 mb-3" src="<?php echo $imgValue; ?>" style="width: 120px;height: 100px" />
    </div>
<?php endforeach; ?>