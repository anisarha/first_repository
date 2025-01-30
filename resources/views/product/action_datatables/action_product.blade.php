<div style="text-align: center; ">
    <div class="btn-group">
        <a href="#" style="color: rgb(88, 152, 248);" data-toggle="tooltip" row-id="{{ $model->id }}"
            data-id="{{ $model->nama_produk }}" data-placement="top" title="Edit" class="dropdown-item edit">
            <i class="fa fa-edit"></i></a>


        <a href="#" style="color: red;" data-toggle="tooltip" row-id="{{ $model->id }}"
            data-id={{ $model->nama_produk }} data-target="" data-placement="top" title="Void"
            class="dropdown-item voided"><i class="fa fa-trash"></i></a>
    </div>
</div>
<script>
    // alert($model->Id_santri)
    $(function() {
        $('[data-toggle="tooltip"]').tooltip();
    });
</script>
