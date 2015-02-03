<?php
        
        //configuration
        require("../includes/config.php");
        
        if ($_SERVER["REQUEST_METHOD"] == "POST")
        {
            //TODO
            //GET STOCK, AND # OF SHARES
            //checks for blank sumbit    
            if (empty($_POST["symbol"])
            {
                apologize("Please enter a valid stock symbol to buy!");
            }
            
            
            $to_buy = lookup($_POST["symbol"]);
        
            //checks for valid submit
            if (empty($to_buy["name"]) || empty($to_buy["price"]) || empty($to_buy["symbol"]))
            {
                apologize("Please enter a valid stock symbol!");
            }
            
            //checks for adequate funds
            $cash = query("SELECT cash FROM users WHERE id = ?", $_SESSION["id"]);
            
            $total = $to_buy["price"] * $_POST["shares"];
            
            if($cash < $total)
            {
                apologize("Sorry you have insufficient funds for this purchase!");
            }
             //ADD STOCK TO PORTFOLIO           
            
            $owned = query("SELECT symbol, shares FROM portfolios WHERE id = ?", $_SESSION["id"] );
            
            query("INSERT INTO portfolios (id, symbol, shares) VALUES ( $_SESSION["id"], $to_buy["symbol"], $_POST["shares"] ON DUPLICATE KEYS UPDATE shares = shares + VALUES(shares)");

            //UPDATE CASH             
            query("UPDATE users SET cash = cash - $total WHERE id = ?", $_SESSION["id"]);

        }
        else     
        {   
            render("buy_form.php", ["title"=>"Buy Stocks"]);
        } 
?>
