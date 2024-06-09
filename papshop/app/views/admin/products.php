<?php $this->view("../admin/_includes/admin_header", $data); ?>
<?php $this->view("../admin/_includes/admin_menu", $data); ?>

<section id="main-content">
    <section class="wrapper">
        <div class="row mt">
            <div class="col-md-12">
                <div class="content-panel">
                    <table class="table table-striped table-advance table-hover">
                        <h4>
                            <i class="fa fa-angle-right"></i> Products                              
                            <!-- Button trigger modal --> 
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#productModal"> 
                                <i class="fa fa-plus"></i>Add new</button>             
                            <!-- END Button trigger modal -->
                        </h4>
                        <hr>
                        <thead>
                            <tr>
                                <th><i class="fa fa-bullhorn"></i> ID</th>
                                <th class="hidden-phone"><i class="fa fa-question-circle"></i> Product</th>
                                <th><i class=" fa fa-edit"></i> Status</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($data['products'])): ?>
                                <?php foreach ($data['products'] as $index => $product): ?>
                                    <tr>
                                        <td><?php echo $index + 1; ?></td>
                                        <td><?php echo htmlspecialchars($product['description']); ?></td>
                                        <!-- <td>
                                            <?php if ($product['disabled']): ?>
                                                <span class="label label-warning label-mini" style="cursor:pointer" 
                                                    onclick="disabled_row(<?php //echo $product['id']; ?>, <?php //echo $product['disabled']; ?>)">Disabled</span>
                                            <?php else: ?>
                                                <span class="label label-success label-mini" style="cursor:pointer" 
                                                    onclick="disabled_row(<?php //echo $product['id']; ?>, <?php //echo $product['disabled']; ?>)">Enabled</span>
                                            <?php endif; ?>
                                        </td> -->
                                        <td>
                                            <!-- EDIT trigger modal --> 
                                            <button class="btn btn-primary btn-xs" onclick="openEditModal(<?php echo htmlspecialchars($product['id']); ?>, 
                                                '<?php echo htmlspecialchars($product['description']); ?>')">
                                                <i class="fa fa-pencil"></i></button>
                                            <!-- END EDIT trigger modal -->
                                            <!-- DELETE trigger modal -->
                                            <button class="btn btn-danger btn-xs" onclick="openDeleteModal(<?php echo htmlspecialchars($product['id']); ?>)">
                                                <i class="fa fa-trash-o "></i></button>
                                            <!-- END DELETE trigger modal -->
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="5">No products found.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div><!-- /content-panel -->
            </div><!-- /col-md-12 -->
        </div><!-- /row -->
                
        <!-- ADD Modal -->
        <div class="modal fade" id="productModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add new product</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="productForm">
                            <div class="form-group">
                                <label for="product-name" class="col-form-label">Product:</label>
                                <input type="text" class="form-control" id="product-name" name="product">
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-primary" onclick="get_data()">Save</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- END Modal -->

        <!-- Edit Modal -->
        <div class="modal fade" id="editProductModal" tabindex="-1" role="dialog" 
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit product</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="productForm">
                            <div class="form-group">
                                <label for="product-name" class="col-form-label">Product:</label>
                                <input type="text" class="form-control" id="editProduct" name="editProduct">
                                <input id="editProductId" name="editProductId" type="hidden" class="form-control" value="">
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-primary" onclick="edit_row()">Save</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- END Edit Modal -->

        <!-- Delete Modal HTML -->
        <div id="deleteProductModal" class="modal fade" tabindex="-1" 
            aria-labelledby="deleteProductModal-Label" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form id="deleteGroup">
                        <div class="modal-header">
                            <h4 class="modal-title">Delete product</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p>Are you sure you want to delete this product?</p>
                            <p class="text-warning"><small>This action cannot be undone.</small></p>
                            <input id="deleteProductId" name="deleteProductId" type="hidden" class="form-control" value="">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            <input  class="btn btn-danger" value="Delete" 
                                onclick="delete_row(document.getElementById('deleteProductId').value)">
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- END Delete Modal -->
    </section>
</section>

<?php $this->view("../admin/_includes/admin_footer", $data); ?>

<script>
    function get_data() {
        let product_input = document.querySelector("#product-name");
        if (product_input.value.trim() === "" || !isNaN(product_input.value.trim())) {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Please enter a valid product name!'
            });
            return;
        } 

        var data = product_input.value.trim();

        send_data({
            data: data,
            data_type: 'add_product'
        });
    }

    function send_data(data = {}) {
        var ajax = new XMLHttpRequest();

        ajax.addEventListener('readystatechange', function() {
            if (ajax.readyState === 4 && ajax.status === 200) {
                handle_result(ajax.responseText);
            }
        });

        ajax.open("POST", "<?=ROOT?>admin/products/product", true);
        ajax.setRequestHeader("Content-Type", "application/json");

        ajax.send(JSON.stringify(data));
    }

    function edit_row() {
        let product_input = document.querySelector("#editProduct");
        let id_input = document.querySelector("#editProductId");

        if (product_input.value.trim() === "" || !isNaN(product_input.value.trim())) {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Please enter a valid product name!'
            });
            return;
        }

        let data = product_input.value.trim();
        let id = id_input.value;

        send_data({
            id: id,
            data: data,
            data_type: 'edit_product'
        });
    }

    function disabled_row(id, state) {
        send_data({
            data_type: "disabled_row",
            id: id,
            current_state: state
        });
    }

    function delete_row(id) {
        send_data({
            data_type: "delete_row",
            id: id
        });
    }

    function handle_result(result) {
        console.log("The result is" + result);
        if (result !== "") {
            try {
                var obj = JSON.parse(result);
                if (obj.data_type === "add_product") {
                    if (obj.message_type === "info") {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: obj.message
                        }).then(() => {
                            $('#productModal').modal('hide');
                            document.querySelector("#product-name").value = "";
                            location.reload();
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: obj.message
                        });
                    }
                }

                if (obj.data_type === "disabled_row") {
                    location.reload();
                }

                if (obj.data_type === "edit_product") {
                    if (obj.message_type === "info") {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: obj.message
                        }).then(() => {
                            $('#editProductModal').modal('hide');
                            location.reload();
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: obj.message
                        });
                    }
                }

                if (obj.data_type === "delete_row") {
                    if (obj.message_type === "info") {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: obj.message
                        }).then(() => {
                            location.reload();
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: obj.message
                        });
                    }
                }
            } catch (e) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'An error occurred while processing the server response.'
                });
            }
        }
    }

    function openDeleteModal(id) {
        document.getElementById('deleteProductId').value = id;
        $('#deleteProductModal').modal('show');
    }

    function openEditModal(id, product) {
        document.getElementById('editProductId').value = id;
        document.getElementById('editProduct').value = product;
        $('#editProductModal').modal('show');
    }
</script>
