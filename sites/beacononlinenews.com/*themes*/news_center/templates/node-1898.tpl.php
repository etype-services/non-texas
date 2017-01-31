


<body>

  <section class="container">
    <div class="login">
      <h1>Login Page</h1>
      <form method="POST" action="">
        <p style="color:red"><?php echo $msg; ?></p>
        <p><input type="text" name="name"  placeholder="User Name" required="required"></p>
        <p><input type="password" name="password"  placeholder="Password" required="required"></p>
        <p class="remember_me">
         <!-- <label>
            <input type="checkbox" name="remember_me" id="remember_me">
            Remember me on this computer
          </label> -->
        </p>
        <p class="submit">
                          <input type="submit" name="submit" value="Login" style="background-color: gainsboro;border-radius: 4px;width: 93px;height: 28px;border: 1px solid #CCC;text-decoration: none;color: #000;text-shadow: white 0 1px 1px;padding: 2px;" />   
    </p>
      </form>
    </div>

    <div class="login-help" style="color:#000">
     <p style="color:#000">Forgot your password? <a href="/forgot-password" style="color:#000">Click here </a>.</p>
       <!-- <p style="color:#000">Change password? <a href="/change-password" style="color:#000">Click here to Change Password</a>.</p>-->
    </div>
  </section>

 </body>