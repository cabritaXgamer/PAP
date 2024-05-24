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
                                  <th><i class="fa fa-bullhorn"></i> Category</th>
                                  <th class="hidden-phone"><i class="fa fa-question-circle"></i> Descrition</th>
                                  <th><i class="fa fa-bookmark"></i> Price</th>
                                  <th><i class=" fa fa-edit"></i> Status</th>
                                  <th></th>
                              </tr>
                              </thead>
                              <tbody>
                                    <?php if (!empty($data['categories'])): ?>
                                        <?php foreach ($data['categories'] as $index => $category): ?>
                                            <tr>
                                                <td><?php echo $index + 1; ?></td>
                                                <td><?php echo htmlspecialchars($category['category']); ?></td> <!-- Access as array -->
                                                <td>12000.00$</td>
                                                <td><span class="label label-info label-mini">Enable</span></td>
                                                <td>
                                                    <button class="btn btn-success btn-xs"><i class="fa fa-check"></i></button>
                                                    <button class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></button>
                                                    <button class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i></button>
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
                  
                  


<!-- Modal -->
<!-- Modal -->
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
        ajax.open("POST", "<?=ROOT?>admin/categories/addCategory", true);
        ajax.setRequestHeader("Content-Type", "application/json");

        // Send AJAX request
        ajax.send(JSON.stringify(data));
    }

    // Function to handle the result
    function handle_result(result) {
        // JSON data from the response
        if (result != "") {
            var obj = JSON.parse(result);

            if (obj.message_type === "info") {
                Swal.fire({
                    icon: 'success',
                    title: 'Sucesso',
                    text: obj.message
                }).then(() => {
                    // Close the modal after the alert is dismissed
                    $('#categoryModal').modal('hide');
                    // Optionally, clear the input field after successful submission
                    document.querySelector("#category-name").value = "";
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Erro',
                    text: obj.message
                });
            }
        }
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