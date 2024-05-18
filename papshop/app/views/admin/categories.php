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
                              <tr>
                                  <td><a href="basic_table.html#">Descrition</a></td>
                                  <td class="hidden-phone">Lorem Ipsum dolor</td>
                                  <td>12000.00$ </td>
                                  <td><span class="label label-info label-mini">Enable</span></td>
                                  <td>
                                      <button class="btn btn-success btn-xs"><i class="fa fa-check"></i></button>
                                      <button class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></button>
                                      <button class="btn btn-danger btn-xs"><i class="fa fa-trash-o "></i></button>
                                  </td>
                              </tr>
                            
                              </tbody>
                          </table>
                      </div><!-- /content-panel -->
                  </div><!-- /col-md-12 -->
              </div><!-- /row -->
                  
                  


<!-- Modal -->
<div class="modal fade" id="categoryModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add new caterory</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form>
            <div class="form-group">
                <label for="recipient-name" class="col-form-label">Category:</label>
                <input type="text" class="form-control" id="recipient-name">
            </div>
            <!-- <div class="form-group">
                <label for="message-text" class="col-form-label">Message:</label>
                <textarea class="form-control" id="message-text"></textarea>
            </div> -->
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            <button type="button" class="btn btn-primary" onclick=send_data(event)>Save</button>
        </div>
        </div>
    </div>
</div>
     
          </section>
      </section>



      <!--main content end-->
   
<?php $this->view("../admin/_includes/admin_footer", $data); ?>


<script>

    // function myAlertFunction() {
    // alert("I am an alert box!");
    // }




    // //Function to send data to controller
    // function send_data(data){

    //     var ajax = new XMLHttpRequest();
    //     var form = new FormData();
    //     form.append('name','myname');

    //     //Handler listener events on page
    //     ajax.addEventListener('readystatechange',function(){

    //         if(ajax.readyState == 4 && ajax.status == 200 )
    //         {
    //             alert(ajax.responseText);
    //         }
    //     })

    //     //put true to dont freeze the url page
    //     ajax.open("POST","<?=ROOT?>admin/categories/test",true);
    //     ajax.send(data);
    // } 

 



    /**
    * Function to send data to controller AJAX
    *  Need to vreate a AJAX controller
    */ 


     function send_data(data){

        var ajax = new XMLHttpRequest();

        //Sending data with form
        var form = new FormData();
        form.append('data',data);

        //Handler listener events on page
        ajax.addEventListener('readystatechange',function(){

            if(ajax.readyState == 4 && ajax.status == 200 )
            {
                alert(ajax.responseText);
            }
            })

        //put true to dont freeze the url page
        ajax.open("POST","<?=ROOT?>admin/ajax",true);
        ajax.send(JSON.stringify(data));
     } 

</script>