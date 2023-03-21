<?php include_once(VIEWS . 'header.php')?>
    <div class="card p-4 bg-light">
        <div class="card-header">
            <h1 class="text-center">Usuarios</h1>
        </div>
        <div class="card-body">
            <table class="table text-center" width="100%">
                <thead>
                <th>Id</th>
                <th>Nombre</th>
                <th>Editar</th>
                <th>Borrar</th>

                </thead>
                <tbody>
                <?php foreach ($data['users'] as $user): ?>
                    <tr>
                        <td class="text-center"><?= $user->payment_id ?></td>
                        <td class="text-center"><?= $user->name ?></td>
                        <td class="text-center">
                            <a href="<?= ROOT ?>adminShop/updatePay/<?= $user->payment_id?>"
                               class="btn btn-info"
                            >Editar</a>
                        </td>
                        <td class="text-center">
                            <a href="<?= ROOT ?>adminShop/deletePay/<?= $user->payment_id?>"
                               class="btn btn-danger"
                            >Borrar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            <div class="row">
                <div class="col-sm-6">
                    <a href="<?= ROOT ?>adminShop/create" class="btn btn-success">
                        Crear metodo de pago
                    </a>
                </div>
                <div class="col-sm-6">

                </div>
            </div>
        </div>
    </div>
<?php include_once(VIEWS . 'footer.php')?>