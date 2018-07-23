<!-- =============================================== -->

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
        Productos
        <small>Nuevo</small>
        </h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="box box-solid">
            <div class="box-body">
                <div class="row">
                    <div class="col-md-12">
                        <?php if($this->session->flashdata("error")): ?>
                            <div class="alert alert-danger alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <p><i class="icon fa fa-ban"></i> <?php echo $this->session->flashdata("error"); ?></p>
                            </div>
                        <?php endif; ?>
                        <form action="<?php echo base_url();?>mantenimiento/productos/store" method="post">
                            <div class="form-group <?php echo !empty(form_error("codigo")) ? 'has-error':''; ?>">
                                <label for="codigo">Código:</label>
                                <input type="text" class="form-control" id="codigo" name="codigo" value="<?php echo set_value("codigo"); ?>">
                                <?php echo form_error("codigo","<span class='help-block'>","</span>"); ?>
                            </div>
                            <div class="form-group <?php echo !empty(form_error("nombre")) ? 'has-error':''; ?>">
                                <label for="nombre">Nombre:</label>
                                <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo set_value("nombre"); ?>">
                                <?php echo form_error("nombre","<span class='help-block'>","</span>"); ?>
                            </div>
                            <div class="form-group">
                                <label for="descripcion">Descripcion:</label>
                                <input type="text" class="form-control" id="descripcion" name="descripcion">
                            </div>
                            <div class="form-group <?php echo !empty(form_error("precio")) ? 'has-error':''; ?>">
                                <label for="precio">Precio:</label>
                                <input type="text" class="form-control" id="precio" name="precio" value="<?php echo set_value("precio"); ?>">
                                <?php echo form_error("precio","<span class='help-block'>","</span>"); ?>
                            </div>
                            <div class="form-group <?php echo !empty(form_error("stock")) ? 'has-error':''; ?>">
                                <label for="stock">Stock:</label>
                                <input type="text" class="form-control" id="stock" name="stock" value="<?php echo set_value("stock"); ?>">
                                <?php echo form_error("stock","<span class='help-block'>","</span>"); ?>
                            </div>
                            <div class="form-group">
                                <label for="categoria">Categoria:</label>
                                <select name="categoria" id="categoria" class="form-control">
                                    <?php foreach($categorias as $categoria): ?>
                                        <option value="<?php echo $categoria->id; ?>"><?php echo $categoria->nombre; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-success btn-flat">Guardar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->