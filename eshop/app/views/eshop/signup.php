<?php $this->view("haeder",$data); ?>

<section id="form"> style="margin-top: 5px<!--form-->
		<div class="container">
			<div class="row" style="text-aling: center;">
				
				<div class="col-sm-4" style="float: none;display: inline-block;">
					<div class="signup-form"><!--sign up form-->
						<h2>New User Signup!</h2>
						<form action="#" method="post">
							<input name="name" type="text" placeholder="Nome"/>
							<input name="email" type="email" placeholder="Email"/>
							<input name="password" type="password" placeholder="Password"/>
							<input name="password2" type="password" placeholder="Confirma Password"/>
							<button type="submit" class="btn btn-default">Signup</button>
						</form>
					</div><!--/sign up form-->
				</div>
			</div>
		</div>
	</section><!--/form-->
	
	
	<?php $this->view("footer",$data); ?>

