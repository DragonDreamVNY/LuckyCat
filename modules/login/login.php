<h2> Performance View Page </h2>
<p>This is the about view.</p>

<div class="jumbotron">
  <h1>Please Log In</h1>
  <p class="lead">
    <img src="images/luckycatDash.png" alt="I'm alt image info"><br>
    Lucky Cat Business Dashboard
  </p>

  <!-- FORM -->
    <!-- pass in the variable if our form is valid or invalid -->
    <form name="userForm" ng-submit="submitForm(userForm.$valid)" novalidate> <!-- novalidate prevents HTML5 validation since we will be validating ourselves -->

        <!--ng-model bings data from our forms to Angular variables -->
        <!-- USERNAME -->
        <div class="form-group">
            <label>Username</label>
            <input type="text" name="username" class="form-control" ng-model="user.username" ng-minlength="3" ng-maxlength="8" required>
        </div>
        
        <!-- PASSWORD -->
        <div class="form-group">
            <label>Password</label>
            <input type="password" name="password" class="form-control" ng-model="password" required>
        </div>
        
        <!-- SUBMIT BUTTON -->
        <button type="submit" class="btn btn-primary">Submit</button>
        
    </form>



</div> <!--end jumbotron-->