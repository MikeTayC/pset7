<?php
        
        //configuration
        require("../includes/config.php");
        
        if ($_SERVER["REQUEST_METHOD"] == "POST")
        {
            //TODO
            //GET STOCK, AND # OF SHARES
            //checks for blank sumbit    
            if (empty($_POST["symbol"]))
            {
                apologize("Please enter a valid stock symbol to buy!");
            }
            
            $to_sell = lookup($_POST["symbol"]);
        
            //checks for valid submit
            if (empty($to_sell["name"]) || empty($to_sell["price"]) || empty($to_sell["symbol"]))
            {
                apologize("Please enter a valid stock symbol!");
            }
            
            $owned = query("SELECT symbol, shares FROM portfolios WHERE id = ? AND symbol =  ?", $_SESSION["id"], $_POST["symbol"]);
            
            if(empty($owned))
            {
                apologize("You do not own any of this stock!");
            }
            
            //checks if user has shares in this stock
            query("DELETE FROM portfolios WHERE id = ? AND symbol = ?",  $_SESSION["id"], $_POST["symbol"] );
            
            $owned = query("SELECT symbol, shares FROM portfolios WHERE id = ? AND symbol =  ?", $_SESSION["id"], $_POST["symbol"]);
            
            $total = $to_sell["price"] * $owned[0]["shares"];
            
         
            query("UPDATE users SET cash = cash + $total WHERE id = ?", $_SESSION["id"]);       
            
            redirect("/");
        }
        else     
        {   
            render("sell_form.php", ["title"=>"Sell Stocks"]);
        } 
?>
