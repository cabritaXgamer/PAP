<?php $this->view("../admin/_includes/admin_header", $data); ?>
      
<?php $this->view("../admin/_includes/admin_menu", $data); ?>


      
      <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->
      <!--main content start-->
      <section id="main-content">
          <section class="wrapper">

          <div class="row mt">
                  <div class="col-md-12">
                      <div class="content-panel">
                          <table class="table table-striped table-advance table-hover">
	                  	  	  <h4>
                                <i class="fa fa-angle-right"></i> Products Categories                              
                                  <!-- Button trigger modal --> 
                                  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#categoryModal"> 
                                    <i class="fa fa-plus"></i>Add new</button>             
                                  <!-- END Button trigger modal -->
                            </h4>
	                  	  	  <hr>
                              <thead>
                              <tr>
                                  <th><i class="fa fa-bullhorn"></i> ID</th>
                                  <th class="hidden-phone"><i class="fa fa-question-circle"></i> Category</th>
                                  <!-- <th><i class="fa fa-bookmark"></i> Price</th> -->
                                  <th><i class=" fa fa-edit"></i> Status</th>
                                  <th></th>
                              </tr>
                              </thead>
                              <tbody>
                              <?php if (!empty($data['categories'])): ?>
                                <?php foreach ($data['categories'] as $index => $category): ?>
                                    <?php $status = $category['disabled'] ? "Disabled" : "Enabled"; ?>
                                    <tr>
                                        <td><?php echo $index + 1; ?></td>
                                        <td><?php echo htmlspecialchars($category['category']); ?></td> <!-- Access as array -->
                                        <td>
                                        <?php if ($category['disabled']): ?>
                                            <span class="label label-warning label-mini" style="cursor:pointer" 
                                                onclick="disabled_row(<?php echo $category['id']; ?>, <?php echo $category['disabled']; ?>)">Disabled</span>
                                        <?php else: ?>
                                            <span class="label label-success label-mini" style="cursor:pointer" 
                                                onclick="disabled_row(<?php echo $category['id']; ?>, <?php echo $category['disabled']; ?>)">Enabled</span>
                                        <?php endif; ?>
                                        </td>  
                                        

                                        
                                     

                                                    <td>
                                                    <!-- EDIT trigger modal --> 
                                                    <button class="btn btn-primary btn-xs" onclick="openEditModal(<?php echo htmlspecialchars($category['id']); ?>, 
                                                        '<?php echo htmlspecialchars($category['category']); ?>')">
                                                            <i class="fa fa-pencil"></i></button>
                                                    <!-- END EDIT trigger modal -->
                                                    <!-- DELETE trigger modal -->
                                                    <button class="btn btn-danger btn-xs" onclick="openDeleteModal(<?php echo htmlspecialchars($category['id'], ); ?>)">
                                                        <i class="fa fa-trash-o "></i></button>
                                                    <!-- END DELETE trigger modal -->
                                                    </td>

                                                

                                           
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="5">No categories found.</td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                          </table>
                      </div><!-- /content-panel -->
                  </div><!-- /col-md-12 -->
              </div><!-- /row -->
                  

            <!-- ADD Modal -->
            <div class="modal fade" id="categoryModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add new category</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form id="categoryForm">
                                <div class="form-group">
                                    <label for="category-name" class="col-form-label">Category:</label>
                                    <input type="text" class="form-control" id="category-name" name="category">
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
            <div class="modal fade" id="editCatModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Edit category</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form id="categoryForm">
                                <div class="form-group">
                                    <label for="category-name" class="col-form-label">Category:</label>
                                    <input type="text" class="form-control" id="editCategory" name="editCategory">
                                    <input id="editCatId" name="editCatId" type="hidden" class="form-control" value="">
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
            <!-- END Edit Modal -->


            <!-- Delete Modal HTML -->
        <div id="deleteCatModal" class="modal fade" tabindex="-1" 
                aria-labelledby="deleteCatModal-Label" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form id="deleteGroup">
                        <div class="modal-header">
                            <h4 class="modal-title">Apagar grupo</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" 
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p>Tem a certeza que quer apagar este grupo?</p>
                            <p class="text-warning"><small>A ação não pode ser defeita.</small></p>
                            <input id="deleteCatId" name="deleteCatId" type="hidden" class="form-control" value="">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                            <input  class="btn btn-danger" value="Apagar" 
                                onclick="delete_row(document.getElementById('deleteCatId').value)">
                        </div>
                    </form>
                </div>
            </div>
        </div>



          </section>
      </section>
      <!--main content end-->
   
<?php $this->view("../admin/_includes/admin_footer", $data); ?>


<script>


// WORK WELL

    // function myAlertFunction() {
    // alert("I am an alert box!");
    // }

    // Function to get data from the form
    function get_data() {
        let category_input = document.querySelector("#category-name");
        if (category_input.value.trim() === "" || !isNaN(category_input.value.trim())) {
            Swal.fire({
                icon: 'error',
                title: 'Erro',
                text: 'Por favor insira um nome de categoria válido!'
            });
            return;
        } 

        var data = category_input.value.trim();

        // Force to create an object
        // You can add more datafields if you want it
        send_data({
            data: data,
            data_type: 'add_category' // expressive with the expression
        });
    }

    // Function to send data to the server
    function send_data(data = {}) {
        var ajax = new XMLHttpRequest();

        // Handler for AJAX response
        ajax.addEventListener('readystatechange', function() {
            if (ajax.readyState === 4 && ajax.status === 200) {
                handle_result(ajax.responseText);
            }
        });

        // Set request headers
        ajax.open("POST", "<?=ROOT?>admin/categories/category", true);
        ajax.setRequestHeader("Content-Type", "application/json");

        // Send AJAX request
        ajax.send(JSON.stringify(data));
    }

    // Function to edit row
    function edit_row(obj,id)
    {
        send_data(data = {
            data_type:""
        }) 
    }

    // Function to change the state
    function disabled_row(id,state)
    {
        //console.log(state);
        send_data(data = {
            data_type:"disabled_row",
            id:id,
            current_state:state
        }) 
    }
 
    // Function to delete row
    function delete_row(id)
    {
        send_data(data = {
            data_type:"delete_row",
            id:id
        })
        
    }

    /**
     * HANDLERS
     */

    // Function to handler the result
    function handle_result(result) {
        // Check if the result is not empty
        console.log("The result is" + result);
        if (result !== "") {
            try {
                // Parse the JSON data from the response
                var obj = JSON.parse(result);
                console.log(obj);
                // Handle adding a new category
                if (obj.data_type === "add_new") {
                    // Display a success message if the message_type is "info"
                    if (obj.message_type === "info") {
                        Swal.fire({
                            icon: 'success',
                            title: 'Sucesso',
                            text: obj.message
                        }).then(() => {
                            // Close the modal after the alert is dismissed
                            $('#categoryModal').modal('hide');
                            // Clear the input field after successful submission
                            document.querySelector("#category-name").value = "";
                            // Reload the page to show updated data
                            location.reload();
                        });
                    } else {
                        // Display an error message if the message_type is not "info"
                        Swal.fire({
                            icon: 'error',
                            title: 'Erro',
                            text: obj.message
                        });
                    }
                }

                // Handle disabling/enabling a category
                if (obj.data_type === "disabled_row") {
                    // Reload the page to show updated data
                    location.reload();
                }

                // Handle deleting a category
                if (obj.data_type === "delete_row") {
                    // Display a success message if the message_type is "info"
                    if (obj.message_type === "info") {
                        Swal.fire({
                            icon: 'success',
                            title: 'Sucesso',
                            text: obj.message
                        }).then(() => {
                            // Reload the page to show updated data
                            location.reload();
                        });
                    } else {
                        // Display an error message if the message_type is not "info"
                        Swal.fire({
                            icon: 'error',
                            title: 'Erro',
                            text: obj.message
                        });
                    }
                }
            } catch (e) {
                // Handle any errors that occur during JSON parsing
                Swal.fire({
                    icon: 'error',
                    title: 'Erro',
                    text: 'Ocorreu um erro ao processar a resposta do servidor.'
                });
            }
        }
    }


    //Function to handler the delete modal
    function openDeleteModal(id) {
        // Define o valor do campo oculto no modal de exclusão
        document.getElementById('deleteCatId').value = id;
        //console.log(id);
        // Abre o modal de exclusão
        $('#deleteCatModal').modal('show');
    }

    //Function to handler the delete modal
    function openEditModal(id,category) {
        // Define o valor do campo oculto no modal de exclusão
        document.getElementById('editCatId').value = id;
        document.getElementById('editCategory').value = category;
        //console.log(id);
        // Abre o modal de exclusão
        $('#editCatModal').modal('show');
    }


    /**
    * Function to send data to controller AJAX
    *  Need to create a AJAX controller
    * 
    * Students TEST
    */ 

    // // // Function to get data from the form
    // function get_data(e) {
    //     let category_input = document.querySelector("#category-name");
    //     if (category_input.value.trim() === "" || !isNaN(category_input.value.trim())) {
    //         alert("Por favor insira um nome de categoria válido!");
    //         return;
    //     } 

    //     var data = category_input.value.trim();

    //     // Force to create an object
    //     send_data({data: data});
    // }

    // // // Function to send data to the server
    // function send_data(data = {}) {

    //     var ajax = new XMLHttpRequest();

    //     // Handler for AJAX response
    //     ajax.addEventListener('readystatechange', function() {
    //         if (ajax.readyState === 4 && ajax.status === 200) {
    //             alert(ajax.responseText);
    //         }
    //     });

    //     // Set request headers
    //     ajax.open("POST", "<?=ROOT?>admin/ajax", true);
    //     ajax.setRequestHeader("Content-Type", "application/json");

    //     // Send AJAX request
    //     ajax.send(JSON.stringify(data));
    // }

    // // Function to handle the result
    // function handle_result(result) {
    //     // JSON data from the response
    //     alert(result);
    // }


</script>