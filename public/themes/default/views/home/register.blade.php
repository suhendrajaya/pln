<div>
   <a class="hiddenanchor" id="signup"></a>
   <a class="hiddenanchor" id="signin"></a>

   <div class="login_wrapper">
      <div class="animate form login_form">
         <section class="login_content">

            {!! Form::open(array('name'=>'form_login', 'url'=> route('auth-register'))) !!}

            <h1>Register Form</h1>
            @if (count($errors) > 0)
            <div class="pb10">
               <ul style="color: #ff0000;">
                  @foreach($errors->all() as $error)
                  <li>{!! $error !!}</li>
                  @endforeach
               </ul>
            </div>
            @endif
            <div>
               <input type="text" name="name" class="form-control" placeholder="Name" required="" />
            </div>
            <div>
               <input type="text" name="email" class="form-control" placeholder="Email" required="" />
            </div>
            <div>
               <input type="password" name="password" class="form-control" placeholder="Password" required="" />
            </div>
            <div>
               <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm Password" required="" />
            </div>
            <div>
               <input class="btn btn-default submit" type="submit" value="Register">
            </div>

            <div class="clearfix"></div>

            <div class="separator">

               <div>
                  {{-- <h1><i class="fa fa-paw"></i> Gentelella Alela!</h1> --}}
                  <p>©2016 All Rights Reserved</p>
               </div>
            </div>
            {!! Form::close() !!}
         </section>
      </div>

      <div id="register" class="animate form registration_form">
         <section class="login_content">
            <form>
               <h1>Create Account</h1>
               <div>
                  <input type="text" class="form-control" placeholder="Username" required="" />
               </div>
               <div>
                  <input type="email" class="form-control" placeholder="Email" required="" />
               </div>
               <div>
                  <input type="password" class="form-control" placeholder="Password" required="" />
               </div>
               <div>
                  <a class="btn btn-default submit" href="index.html">Submit</a>
               </div>

               <div class="clearfix"></div>

               <div class="separator">
                  <p class="change_link">Already a member ?
                     <a href="#signin" class="to_register"> Log in </a>
                  </p>

                  <div class="clearfix"></div>
                  <br />

                  <div>
                     <!--<h1><i class="fa fa-paw"></i> Gentelella Alela!</h1>-->
                     <p>©2016 All Rights Reserved</p>
                  </div>
               </div>
            </form>
         </section>
      </div>
   </div>
</div>