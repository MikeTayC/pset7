<?php
        
        //configuration
        require("../includes/config.php");
        
        //if form was submitted
        if ($_SERVER["REQUEST_METHOD"] == "POST")
        {
            //TODO
            //confirm passwords
            //if password fiels are empty apolgize
            if (empty($_POST["password"]) || empty($_POST["confirmation"]))
            {
                apologize("Invalid password!");
            }
            
            //if password fields are not identical apologize
            else if ($_POST["password"] != $_POST["confirmation"])
            {
                apologize("Password confirmation does not match!");
            }
            
            //check if username is in use 
            
            else if (empty($_POST["username"]))
            {
                apologize("Please enter a valid username");
            }
            
            $result = query("INSERT INTO users (username, hash, cash) VALUE (?, ?, 10000.00)", $_POST["username"], crypt($_POST["password"]));
            
            if ($result === false)
            {
                apologize("Username already in use");
            }
            
            //insert user
            query("INSERT INTO users (username, hash, cash) VALUE (?, ?, 10000.00)", $_POST["username"], crypt($_POST["password"]));
            
            $rows = query("SELECT LAST_INSERT_ID() AS id");
            $id = $rows[0]["id"];
            $_SESSION["id"];
        }
        else
        {
            //else render form
            render("register_form.php", ["title"=>"Register"]);
        }
        
?>        
      
            
       
