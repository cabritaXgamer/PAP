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
                                <th class="hidden-phone"><i class="fa fa-question-circle"></i> Quantity</th>
                                <th class="hidden-phone"><i class="fa fa-question-circle"></i> Category</th>
                                <th class="hidden-phone"><i class="fa fa-question-circle"></i> Price</th>
                                <th class="hidden-phone"><i class="fa fa-question-circle"></i> Date</th>
                                <th class="hidden-phone"><i class="fa fa-question-circle"></i> Image</th>
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
                                        <td><?php echo htmlspecialchars($product['quantity']); ?></td>

                                        <td><?php echo htmlspecialchars($product['categoryName']); ?></td>

                                        <td><?php echo htmlspecialchars($product['price']); ?></td>
                                        <!-- <td><?php //echo htmlspecialchars($product['date']); ?></td> -->
                                        <td>
                                            <?php
                                            // Supondo que $product['date'] está no formato Y-m-d H:i:s
                                            $date = new DateTime($product['date']);
                                            echo htmlspecialchars($date->format('jS M, Y H:i:s'));
                                            ?>
                                        </td>
                                        <!-- Show image -->
                                        <td>
                                            <img src="<?php echo ROOT . htmlspecialchars($product['image']); ?>" alt="Product Image" style="width: 70px; height: 70px;">
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
                                            <button class="btn btn-primary btn-xs" onclick="openEditModal(
                                                <?php echo htmlspecialchars($product['id']); ?>,
                                                '<?php echo htmlspecialchars($product['description']); ?>',
                                                <?php echo htmlspecialchars($product['quantity']); ?>,
                                                '<?php echo htmlspecialchars($product['categoryName']); ?>',
                                                <?php echo htmlspecialchars($product['price']); ?>,
                                                '<?php echo htmlspecialchars($product['image']); ?>')">
                                                <i class="fa fa-pencil"></i>
                                            </button>
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
                                <input type="text" class="form-control" id="product-name" name="product-name">
                            </div>
                            <div class="form-group">
                                <label for="product-quantity" class="col-form-label">Quantity:</label>
                                <input type="number" class="form-control" value="1" id="product-quantity" name="product-quantity" min="0" required>
                            </div>
                            <div class="form-group">
                                <label for="category-name" class="col-form-label">Category:</label>
                                <select name="category-name" id="category-name" class="form-control" required>
                                    <?php if (!empty($data['categories'])): ?>
                                        <?php foreach ($data['categories'] as $category): ?>
                                            <option value="<?php echo htmlspecialchars($category['id']); ?>"><?php echo htmlspecialchars($category['category']); ?></option>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <option value="" disabled>No categories available</option>
                                    <?php endif; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="price-name" class="col-form-label">Price:</label>
                                <input type="number" class="form-control" id="price-name" name="price-name" placeholder="0.00" min="0.00" step="0.01" required>
                            </div>
                            <div class="form-group">
                                <label for="price-name" class="col-form-label">Picture 1:</label>
                                <input type="file" id="product-image" accept="image/*" required>
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
        <div class="modal fade" id="editProductModal" tabindex="-1" role="dialog" aria-labelledby="editProductModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editProductModalLabel">Edit Product</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="editProductForm">
                            <div class="form-group">
                                <label for="edit-product-name" class="col-form-label">Product:</label>
                                <input type="text" class="form-control" id="edit-product-name" name="edit-product-name">
                            </div>
                            <div class="form-group">
                                <label for="edit-product-quantity" class="col-form-label">Quantity:</label>
                                <input type="number" class="form-control" id="edit-product-quantity" name="edit-product-quantity" min="0" required>
                            </div>
                            <div class="form-group">
                                <label for="edit-category-name" class="col-form-label">Category:</label>
                                <select name="edit-category-name" id="edit-category-name" class="form-control" required>
                                    <!-- Populate dynamically -->
                                    <?php if (!empty($data['categories'])): ?>
                                        <?php foreach ($data['categories'] as $category): ?>
                                            <option value="<?php echo htmlspecialchars($category['id']); ?>"><?php echo htmlspecialchars($category['category']); ?></option>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <option value="" disabled>No categories available</option>
                                    <?php endif; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="edit-price-name" class="col-form-label">Price:</label>
                                <input type="number" class="form-control" id="edit-price-name" name="edit-price-name" placeholder="0.00" min="0.00" step="0.01" required>
                            </div>
                            <!-- Editar imagem -->
                            <div class="form-group">
                                <label for="edit-product-image">Imagem do Produto</label>
                                <div>
                                    <img id="edit-product-image" class="img-fluid" src="<?php echo ROOT; ?>admin/img/ui-sam.jpg" alt="Imagem do Produto" style="width: 70px; height: 70px;">
                                </div>
                            </div>
                             <!-- Adicione um campo para selecionar uma nova imagem -->
                            <div class="form-group">
                                <label for="new-product-image">Carregar nova imagem</label>
                                <input type="file" id="new-product-image" class="form-control" accept="image/*">
                            </div>
                            <!-- Editar imagem -->
                            <input id="editProductId" name="editProductId" type="hidden" value="">
                            <!-- <input type="file" id="product-image" accept="image/*"> -->
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
    //ADD Function
    function get_data() {

        let product_name        = document.querySelector("#product-name").value.trim();
        let product_quantity    = parseInt(document.querySelector("#product-quantity").value.trim());
        let category_name       = document.querySelector("#category-name").value.trim();
        let price_name          = parseFloat(document.querySelector("#price-name").value.trim()); 
        let product_image       = document.querySelector("#product-image").files[0];

        // Validation data received
        if (!product_name) {
            Swal.fire({
                icon: 'error',
                title: 'Erro',
                text: 'O nome do produto é obrigatório.'
            });
            return;
        }

        if (isNaN(product_quantity) || product_quantity < 0) {
            Swal.fire({
                icon: 'error',
                title: 'Erro',
                text: 'A quantidade do produto deve ser um número maior que 0 ou não negativo.'
            });
            return;
        }

        if (!category_name) {
            Swal.fire({
                icon: 'error',
                title: 'Erro',
                text: 'O nome da categoria é obrigatório.'
            });
            return;
        }

        if (isNaN(price_name) || price_name < 0) {
            Swal.fire({
                icon: 'error',
                title: 'Erro',
                text: 'O preço do produto deve ser um valor maior que 0 ou não negativo.'
            });
            return;
        }

        if (!product_image) 
        {
            Swal.fire({
                icon: 'error',
                title: 'Erro',
                text: 'A imagem do produto é obrigatória.'
            });
            return;
        }

        var data = new FormData();
        data.append('product_name', product_name);
        data.append('product_quantity', product_quantity);
        data.append('category_name', category_name);
        data.append('price_name', price_name);
        data.append('product_image', product_image);
        data.append('data_type', 'add_product');

        send_data(data);
    }
    //EDIT Function
    function edit_row() {
        let productId = document.querySelector("#editProductId").value.trim();
        let productName = document.querySelector("#edit-product-name").value.trim();
        let productQuantity = parseInt(document.querySelector("#edit-product-quantity").value.trim());
        let categoryName = document.querySelector("#edit-category-name").value.trim();
        let priceName = parseFloat(document.querySelector("#edit-price-name").value.trim());
        let productImage = document.querySelector("#new-product-image").files[0]; // Input file element for image

        // Validation data received
        if (!productName) {
            Swal.fire({
                icon: 'error',
                title: 'Erro',
                text: 'O nome do produto é obrigatório.'
            });
            return;
        }

        if (isNaN(productQuantity) || productQuantity < 0) {
            Swal.fire({
                icon: 'error',
                title: 'Erro',
                text: 'A quantidade do produto deve ser um número maior que 0 ou não negativo.'
            });
            return;
        }

        if (!categoryName) {
            Swal.fire({
                icon: 'error',
                title: 'Erro',
                text: 'O nome da categoria é obrigatório.'
            });
            return;
        }

        if (isNaN(priceName) || priceName < 0) {
            Swal.fire({
                icon: 'error',
                title: 'Erro',
                text: 'O preço do produto deve ser um valor maior que 0 ou não negativo.'
            });
            return;
        }


        // Criação de FormData com os dados necessários
        let data = new FormData();
        data.append('id', productId); // Nome do campo deve ser 'id'
        data.append('description', productName); // Nome do campo deve ser 'description'
        data.append('quantity', productQuantity); // Nome do campo deve ser 'quantity'
        data.append('category', categoryName); // Nome do campo deve ser 'category'
        data.append('price', priceName); // Nome do campo deve ser 'price'
        data.append('data_type', 'edit_product');


        if (productImage) {
            data.append('product_image', productImage);
        }

        console.log(data); // Verifica se os dados estão corretos antes de enviar

        // Função para enviar os dados
        send_data_files(data);
    }
    //Disable Function ( not used in this view)
    // function disabled_row(id, state) {
    //     send_data({
    //         data_type: "disabled_row",
    //         id: id,
    //         current_state: state
    //     });
    // }
    //DELETE Function
    function delete_row(id) {

        let data = new FormData();
        data.append('data_type', 'delete_row');
        data.append('id', id);

        send_data_files(data);
    }
    /**
     * HANDLERS
     */
    function send_data_files(data) {
        
        var ajax = new XMLHttpRequest();

        ajax.addEventListener('readystatechange', function() {
            if (ajax.readyState === 4 && ajax.status === 200) {
                handle_result(ajax.responseText);
            }
        });

        ajax.open("POST", "<?=ROOT?>admin/products/product", true);
        //ajax.setRequestHeader("Content-Type", "application/json");

        ajax.send(data);
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
    function openEditModal(id, description, quantity, categoryId, price, image) {

        document.getElementById('editProductId').value = id;
        document.getElementById('edit-product-name').value = description;
        document.getElementById('edit-product-quantity').value = quantity;
        document.getElementById('edit-price-name').value = price;

        // Update field in modal
        var categorySelect = document.getElementById('edit-category-name');
        var options = categorySelect.options;
        for (var i = 0; i < options.length; i++) {
            if (options[i].text === categoryId) {
                categorySelect.selectedIndex = i;
                break;
            }
        }

        var rootPath = "<?php echo ROOT; ?>";

        // Show the actual picture with path ROOT include
        var imageElement = document.getElementById('edit-product-image');
        var fullPath = rootPath + image;
        imageElement.onerror = function() {
            // Opcional: define a image standart
            this.src="<?php echo ASSETS; ?>admin/img/ui-sam.jpg"; 
        };
        imageElement.src = fullPath;


        $('#editProductModal').modal('show');
    }
</script>
