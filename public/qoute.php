<?php
        
        //configuration
        require("../includes/config.php");
        
        if ($_SERVER["REQUEST_METHOD"] == "POST")
        {
            if (empty($_POST["symbol"]))
            {
                apologize("Please provide a stock symbol to look up!");
            }
            
            $stock = lookup($_POST["symbol"]);
            
            if (empty($stock["name"]) || empty($stock["price"]) || empty($stock["symbol"]))
            {
                apologize("Please enter a valid stock symbol!");
            }
           
            render("quote_display.php", ["stock" => $stock, "title" => "Stock Quote"]) ;
            
        }
        
        else
        {   
            render("quote_form.php", ["title"=>"Quote Inquiry"]);
        }
?>
